<?php

namespace App\Http\Middleware;

use Closure;
use Aws\Rekognition\RekognitionClient;
use Aws\S3\S3Client;

class CheckImageModeration
{
    private $request;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        set_time_limit(120);
        return $next($request);
    }
}
