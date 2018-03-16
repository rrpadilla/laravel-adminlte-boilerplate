<?php

if (! function_exists('cdn_asset')) {
    /**
     * Generate a cdn asset path.
     *
     * @param string $path
     *
     * @return string
     */
    function cdn_asset(string $path)
    {
        return \App\Utils::cdnAsset($path);
    }
}
