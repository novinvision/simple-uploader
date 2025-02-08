<?php

namespace NovinVision\SimpleUploader;

use App\Helpers\Storage;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        \Illuminate\Support\Facades\Validator::extend('file_path', function ($attribute, $value, $parameters, $validator) {
            return Storage::disk(config('simple-uploader.disk'))->exists((string)$value);
        }, ':attribute وارد شده موجود نیست');


        $this->mergeConfigFrom(__DIR__ . '/config/simple-uploader.php', 'simple-uploader');

        $this->publishes([
            __DIR__ . '/config/simple-uploader.php' => config_path('simple-uploader.php'),
        ], 'simple-uploader');

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
    }
}
