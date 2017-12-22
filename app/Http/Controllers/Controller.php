<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\FilesystemManager;
use Aws\S3\S3Client;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $laravelStorage;
    protected $s3Client;

    protected function __constructor(FilesystemManager $laravelStorage, S3Client $s3Client) {
        $this->laravelStorage = $laravelStorage;
        $this->s3Client = $s3Client;
    }

    protected function uploadFiles($disk,$files,$directory,$fileName = null) {
        $filePaths = [];
        
        if( !is_null($files) && is_array($files) ) {
            foreach($files as $file) {
                $randomName =  $fileName === null ? $file->getClientOriginalName() : $fileName;
                $filePaths[] =  $this->s3Client->upload(
                    env('AWS_BUCKET'),$directory.'/'.$randomName,file_get_contents($file->path()),
                    'public-read'
                )["ObjectURL"];
               // $filePaths[] = Storage::disk($disk)->putFile($directory,$file,$randomName,['visibility' => 'public']);
            }
        }
        return $filePaths;
    }

    protected function deleteFiles($files,$bucket_name) {
        if(!is_null($files) && is_array($files)) {
            foreach ($files as $key => $file) {
                $prefix = substr(strstr($file,$bucket_name),strlen($bucket_name)+1);
                $this->s3Client->deleteMatchingObjects(
                   $bucket_name,$prefix
                );
            }
        }
    }

    protected function success($data = [], $status = 200) {
        return response()->json($data,$status);
    }

    protected function error($message = [], $status = 422) {
        return response()->json($message,$status);
    }
}
