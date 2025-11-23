<?php

namespace NovinVision\SimpleUploader;

use Illuminate\Support\ServiceProvider;

class SimpleUploaderServiceProvider  extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        \Illuminate\Support\Facades\Validator::extend('simple_file', function ($attribute, $value, $parameters, $validator) {
            return \Illuminate\Support\Facades\Storage::disk(config('simple-uploader.disk'))->exists((string)$value);
        }, ':attribute وارد شده موجود نیست');


        $this->mergeConfigFrom(__DIR__ . '/config/simple-uploader.php', 'simple-uploader');

        $this->publishes([
            __DIR__ . '/config/simple-uploader.php' => config_path('simple-uploader.php'),
        ], 'simple-uploader');

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
    }
}
