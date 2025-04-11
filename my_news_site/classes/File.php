<?php

class File {
    
    public $name;
    public $type;
    public $tmpName;
    public $error;
    public $size;

    public function __construct($file) {
        $this->name    = $file['name'];
        $this->type    = $file['type'];
        $this->tmpName = $file['tmp_name'];
        $this->error   = $file['error'];
        $this->size    = $file['size'];
    }

    public function getExtension() {
        return pathinfo($this->name, PATHINFO_EXTENSION);
    }

    public function move($dirpath, $filename = null) {
        if ($filename === null) {
            $filename = $this->name;
        }
        if ($this->error !== UPLOAD_ERR_OK) {
            throw new Exception("File upload error");
        }
        if (!is_uploaded_file($this->tmpName)) {
            throw new Exception("File is not uploaded file");
        }

        if (!file_exists($dirpath)) {
            mkdir($dirpath, 0777, true);
        }
        $filepath = rtrim($dirpath, '/') . '/' . $filename;
        if (file_exists($filepath)) {
            unlink($filepath);
        }
        $status = move_uploaded_file($this->tmpName, $filepath);
        if (!$status) {
            throw new Exception("File move error");
        }
        return $filepath;
    }

    public function __toString() {
        return $this->name;
    }
}