<?php
namespace NovinVision\SimpleUploader\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FilesController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'file' => ['required',
                'file',
                'mimes:'.implode(',', config('simple-uploader.allowed_mimes')),
                'max:'.config('simple-uploader.max_size')
            ],
        ]);

        $path = $request->file('file')->store(config('simple-uploader.base_path'), config('simple-uploader.disk'));

        return [
            'orig_name' => $request->file('file')->getClientOriginalName(),
            'path' => $path,
        ];
    }

    public function delete(Request $request)
    {
        try {

            \Illuminate\Support\Facades\Storage::disk(config('simple-uploader.disk'))->delete(file_get_contents('php://input'));
            return [
                'message' => 'Successfully deleted the file.',
            ];
        }catch (\Exception $e){
            return [
                'message' => 'Successfully deleted the file',
            ];
        }
    }
}
