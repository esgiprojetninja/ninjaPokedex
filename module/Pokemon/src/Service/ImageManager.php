<?php
namespace Pokemon\Service;

class ImageManager {
    private $saveToDir = './public/img/upload/';
    private $publicWebPath = '/img/upload/';
    private $webImageHosting = 'http://romainlambot.fr/pokemons/images/';


    public function getDefaultWebHosting($id_national)
    {
        return $this->webImageHosting.$id_national.'.png';
    }

    public function getSaveToDir() {
        return $this->saveToDir;
    }

    public function getPublicWebPath() {
        return $this->publicWebPath;
    }

    public function deteFileByName($name) {
        if ( file_exists($this->getSaveToDir().$name) )
            unlink($this->getSaveToDir().$name);
    }

    public function getSavedFiles() {
        if(!is_dir($this->saveToDir)) {
            if(!mkdir($this->saveToDir)) {
                throw new \Exception('Could not create directory for uploads: ' . error_get_last());
            }
        }
        $files = [];
        $handle  = opendir($this->saveToDir);
        while (false !== ($entry = readdir($handle))) {
            if($entry=='.' || $entry=='..')
                continue;
            $files[] = $entry;
        }
        return $files;
    }

}
