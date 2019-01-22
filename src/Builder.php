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
    /**
     * @var null
     */
    protected $entityModel = null;

    /**
     * Sett path.
     *
     * @var string
     */
    protected $path;

    /**
     * Force set tags.
     *
     * @var array
     */
    protected $tags = [];

    /**
     * Default tags.
     *
     * @var array
     */
    protected $default = [];

    /**
     * Result.
     *
     * @var array
     */
    protected $result = [];

    /**
     * @var null
     */
    private $pathModel;

    /**
     * Blade template for render tags.
     *
     * @var string
     */
    const BLADE_TEMPLATE = 'meta-tags::tags';

    /**
     * @return mixed
     */
    public function render()
    {
        return view(static::BLADE_TEMPLATE, [
            'tags' => $this->get(),
            'config' => config('meta-tags', []),
            'path' => $this->path,
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
     * Set current path.
     * 
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
     * @param array $defaultTags
     */
    public function setDefault(array $defaultTags = [])
    {
        $this->default = array_merge($this->default, $defaultTags);

        return $this;
    }

    /**
     * @return array
     */
    public function get(): array
    {
        if ($this->entityModel) {
            $this->result = $this->getForEntity();
        }

        if ($this->path) {
            $this->result = $this->getForPath();
        }

        if ($this->tags) {
            $this->result = $this->getTags();
        }

        if ($this->result) {
            return $this->getResult();
        }

        $this->setPath();
        $this->result = $this->getForPath();

        return $this->getResult();
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
        if (isset($this->path)) {
            if (! isset($this->pathModel)) { // Singleton
                $modelClass = config('meta-tags.model', \Fomvasss\LaravelMetaTags\Models\MetaTag::class);
                try {
                    $this->pathModel = $modelClass::wherePath($this->path)->first() ?? 0;
                } catch (\Exception $e) {
                    //...
                }
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
        $result = array_filter($this->result, function ($tag) {
            if ($tag !== null && $tag !== '') {
                return $tag;
            }
        });

        return array_merge(
            $this->default,
            $result
        );
    }
}