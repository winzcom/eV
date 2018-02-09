<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\FilesystemManager;
use Aws\S3\S3Client;
use GuzzleHttp\Client;
use Aws\Rekognition\RekognitionClient;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $laravelStorage;
    protected $s3Client;
    private $headers = [
        "Content-Type" => 'application/json',
        "X-Content-Type-Options" => 'nosniff'
    ];

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
            foreach ($files as $key => $file_name) {
                if($this->contains($file_name,['http','https'])) {
                    //$prefix = substr(strstr($file_name,$bucket_name),strlen($bucket_name)+1);
                    $prefix = $this->getS3ObjectPrefixForPublicBucket($file_name);
                    $this->s3Client->deleteMatchingObjects(
                       $bucket_name,$prefix
                    );
                } else {
                    $this->laravelStorage->disk('my_public')->delete('galleries/'.$file_name);
                }
            }
        }
        return;
    }

    protected function success($data = [], $status = 200) {
        return response()->json($data,$status,$this->headers);
    }

    protected function error($message = [], $status = 421) {
        return response()->json($message,$status,$this->headers);
    }

    private function contains($string, $needle = [] ) {
        return str_contains($string,$needle);
    }

    protected function checkQuoteImage($filePaths, &$req) {
        
        $bucket_name = env('AWS_BUCKET');
        $rekognitionClient = resolve(RekognitionClient::class);
        
        $moderation = $rekognitionClient->detectModerationLabels([
            'Image' => [
                'S3Object' => [
                    'Bucket' => $bucket_name,
                    'Name' => $this->getS3ObjectPrefixForPublicBucket($filePaths[0])
                ]
            ]
        ]);
        
        $name = $moderation->get('ModerationLabels')[0]['Name'];
        $confidence =  $moderation->get('ModerationLabels')[0]['Confidence'];
        if( ($name === "Explicit Nudity" || $name === "Nudity") && $confidence >= 70) {
            
            $req->delete();
            $this->deleteFiles($filePaths,$bucket_name);
        }
    }

    private function getS3ObjectPrefixForPublicBucket($filename) {
       $explode = explode('public',$file_name);
       return 'public'.$explode[1];
    }

    protected function getRegionFromIp() {
        if(session('user_state') == null){
            $client = new Client(['base_uri'=>'http://ipinfo.io/'.request()->ip().'/json']);
            $response = $client->request('GET','json');
            $state = json_decode($response->getBody()->getContents())->region;
            session(['user_state'=>$state]);
            return $state;    
        } else {
            return session('user_state'); 
        }
    }
}
