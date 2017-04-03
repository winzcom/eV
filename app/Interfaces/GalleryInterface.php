<?php

    namespace App\Interfaces;

    Interface GalleryInterface{

        public function uploadPhotos(array $files,array $captions, $name_slug = '');
        public function deletePhotos(array $files);
        public function directoryPath();
    }

?>