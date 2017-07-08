<?php
namespace Pokemon\Service;

class ImageManager {
    private $saveToDir = './data/upload/';

    public function getSaveToDir() {
        return $this->saveToDir;
    }

    public function getSavedFiles() {
        if(!is_dir($this->saveToDir)) {
            if(!mkdir($this->saveToDir)) {
                throw new \Exception('Could not create directory for uploads: ' .
                             error_get_last());
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

    public  function resizeImage($filePath, $desiredWidth = 40, $desiredHeight = 40) {
        list($originalWidth, $originalHeight) = getimagesize($filePath);

        // Get image info
        $fileInfo = $this->getImageFileInfo($filePath);

        // Resize the image
        $resultingImage = imagecreatetruecolor($desiredWidth, $desiredHeight);
        if ( substr($fileInfo['type'], 0, 9) =='image/png' )
            $originalImage = imagecreatefrompng($filePath);
        else if ( substr($fileInfo['type'], 0, 9) =='image/jpeg' )
            $originalImage = imagecreatefromjpeg($filePath);
        else
            $originalImage = imagecreatefromgif($filePath);
        imagecopyresampled($resultingImage, $originalImage, 0, 0, 0, 0,
            $desiredWidth, $desiredHeight, $originalWidth, $originalHeight);
        // Save the resized image to temporary location
        $tmpFileName = tempnam("/tmp", "FOO");
        imagejpeg($resultingImage, $tmpFileName, 80);

        // Return the path to resulting image.
        return $tmpFileName;
    }
}
