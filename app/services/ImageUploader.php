<?php

class ImageUploader {
    public static function uploadImage(array $file, string $path) : string
    {
        $uploadDir = 'uploads/' . $path;
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $maxSize = 10 * 1024 * 1024;
        if ($file['size'] > $maxSize) {
            throw new Exception('File must be smaller than 10MB.');
        }

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($file['tmp_name']);

        if ($mimeType !== 'image/jpeg' && $mimeType !== 'image/png') {
            throw new Exception("Only JPG and PNG allowed");
        }
        
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid('img_', true) . '.' . $extension;
        $filepath = $uploadDir . $filename;
        if (!move_uploaded_file($file['tmp_name'], $filepath)) {
            throw new Exception('Failed to upload file');
        }
        
        return $filepath;
    }
}
