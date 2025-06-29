<?php

if(!function_exists('simple_upload_path')){
    function simple_upload_path($path): string
    {
        return \App\Helpers\Storage::disk(config('simple-uploader.disk'))->path($path);
    }
}
