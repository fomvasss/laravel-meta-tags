<?php

if (! function_exists('meta_tag_prepare_path')) {
    /**
     * @param string|null $url
     * @return null|string
     */
    function meta_tag_prepare_path(string $url = null)
    {
        $path = parse_url($url)['path'] ?? '/';

        if ($path === '/' || $url === '/' || $url === request()->root()) {
            return '/';
        } elseif ($path) {
            return trim($path, '/');
        } else {
            return null;
        }
    }
}