<?php

function css_asset(string $path, string $layout = 'shared'): string
{
    return asset_path($layout . '/css/' . $path . '.css');
}

function image_asset(string $path, string $layout = 'shared'): string // TODO: better layout default management.
{
    $cdn = config('app.mix_url');

    if ($cdn !== null) {

        return $cdn . '/' . $layout . '/images/' . $path;
    }

    return config('app.url') . '/assets/' . ($layout . '/images/' . $path);
}

function js_asset(string $path, string $layout = 'shared'): string
{
    return asset_path($layout . '/js/' . $path . '.js');
}

function asset_path(string $path): string
{
    $asset = mix($path);

    if (config('app.mix_url') !== null) {

        return $asset;
    }

    return config('app.url') . '/assets' . $asset;
}
