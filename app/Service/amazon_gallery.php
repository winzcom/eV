<?php

namespace App\Service;

use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Auth;

use App\Entities\Gallery;
use App\Interfaces\GalleryInterface;

class AmazonGallery implements GalleryInterface{


    public function __construct(){

        config(['filesystems.default'=>'s3']);
    }

    public function uploadPhotos(array $files,array $captions = null,$name_slug=''){

    
        $names = [];
        $i = 0; 
        if(is_array($files)){
            foreach($files as $key=>$file){
                $names[$key] = array($name_slug.$file->getClientOriginalName(),$captions[$i]);

                try{
                    
                    if($file->storeAs('public',str_replace(' ','_',$names[$key][0]),'s3')){
                        Gallery::create(['image_name'=>$names[$key][0],'user_id'=>Auth::id(),'caption'=>htmlentities($captions[$i])]);

                    }
                }   
            
                catch(Exception $e){
                    return $e->message();
                }
            ++$i;
        }//end of foreach
        
        return $names;

    }
}

    public function deletePhotos(array $paths){

        $list  = array();
        if(is_array($paths)){
            foreach($paths as $path){
                //File::delete(public_path().'/storage/images/'.$path);
                Storage::delete('public/'.$path);
                
            }
            //Storage::delete($paths);  
           // $prefixed_array = preg_filter('/^/', $name_slug, $paths);
            //array_walk($paths, function(&$item) use ($name_slug){ $item *= $name_slug; });
             Gallery::whereIn('image_name',$paths)->where('user_id',Auth::id())->delete();
            return ;
        }
        else{
                //File::delete(public_path().'/storage/images/'.$paths);
                Storage::delete('public/'.$paths);
                return;
        }
        

    }

    public function directoryPath(){
        return Storage::url('public');
    }

}

?>
