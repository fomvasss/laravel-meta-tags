<?php
/**
 * Created by PhpStorm.
 * User: fomvasss
 * Date: 23.10.18
 * Time: 21:25
 */

namespace Fomvasss\LaravelMetaTags;

use App\Models\MetaTag;
use Illuminate\Database\Eloquent\Model;

class Builder
{
    /** @var null  */
    protected $entityModel = null;

    /** @var string  */
    protected $path = '';

    /** @var array  */
    protected $tags = [];

    /** @var array  */
    protected $result = [];

    /** @var null  */
    private $pathModel = null;

    /**
     * @return mixed
     */
    public function render()
    {
        return view('meta-tags::tags', [
            'tags' => $this->get(),
            'available' => config('meta-tags.available', []),
        ])->render();
    }

    /**
     * @param Model $entityModel
     * @return $this
     */
    public function setEntity(Model $entityModel)
    {
        $this->entityModel = $entityModel;

        return $this;
    }

    /**
     * @param string $path
     * @return $this
     */
    public function setPath(string $path = '')
    {
        $this->pathModel = null;

        $this->path = $path ?: request()->path();

        return $this;
    }

    /**
     * @param array $tags
     * @return $this
     */
    public function setTags(array $tags = [])
    {
        $this->tags = array_merge($this->tags, $tags);

        return $this;
    }

    /**
     * @return array
     */
    public function get(): array
    {
        if ($this->path) {
            $this->result = $this->getForPath();
        }

        if ($this->entityModel) {
            $this->result = $this->getForEntity();
        }

        if ($this->tags) {
            $this->result = $this->getTags();
        }

        if ($this->result) {
            return $this->result;
        }

        $this->setPath();
        $this->result = $this->getForPath();

        return $this->result;
    }

    /**
     * @param string $tag
     * @return string
     */
    public function tag(string $tag): string
    {
        return $this->get()[$tag] ?? '';
    }

    /**
     * @return array
     */
    public function getForEntity(): array
    {
        if ($this->entityModel && ($tags = $this->entityModel->metaTag)) {
            return array_merge(
                $this->getResult(),
                $tags->toArray()
            );
        }

        return [];
    }

    /**
     * @return array
     */
    public function getForPath(): array
    {
        if ($this->path) {
            if (! $this->pathModel) { // Singleton
                $modelClass = config('meta-tags.model', \Fomvasss\LaravelMetaTags\Models\MetaTag::class);
                $this->pathModel = $modelClass::wherePath($this->path)->first();
            }

            return array_merge(
                $this->getResult(),
                $this->pathModel ? $this->pathModel->toArray() : []
            );
        }

        return [];
    }

    /**
     * @return array
     */
    protected function getTags(): array
    {
        return array_merge(
            $this->getResult(),
            $this->tags
        );
    }

    /**
     * @return array
     */
    public function getResult(): array
    {
        return $this->result;
    }
}