<?php
namespace Pokemon\Service;

class ImageManager {
    private $saveToDir = './public/img/upload/';
    private $publicWebPath = '/img/upload/';

    public function getSaveToDir() {
        return $this->saveToDir;
    }

    public function getPublicWebPath() {
        return $this->publicWebPath;
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

    public function getImagePathByName($fileName) {
        $fileName = str_replace("/", "", $fileName);
        $fileName = str_replace("\\", "", $fileName);

        return $this->saveToDir . $fileName;
    }

    public function getImageFileContent($filePath) {
        return file_get_contents($filePath);
    }

    public function getImageFileInfo($filePath) {
        if (!is_readable($filePath))
            return false;

        // Get file size in bytes.
        $fileSize = filesize($filePath);

        // Get MIME type of the file.
        $finfo = finfo_open(FILEINFO_MIME);
        $mimeType = finfo_file($finfo, $filePath);
        if( false === $mimeType )
            $mimeType = 'application/octet-stream';

        return [
            'size' => $fileSize,
            'type' => $mimeType
        ];
    }

}
