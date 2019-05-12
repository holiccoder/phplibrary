<?php

class FileUpload {

    public $file;
    public $maxFileSize;
    public $uploadDir;
    public $Extensions;

    public function __construct($file, $maxFileSize, $uploadDir, $fileExtensions){
        $this->file = $file;
        $this->maxFileSize = $maxFileSize;
        $this->uploadDir = $uploadDir;
        $this->Extensions = $fileExtensions;
    }

    function getUploadedFileExtension(){
        return end(explode(".",$this->file));
    }

    function checkFileExtensions(){
        $extensions = $this->Extensions;

    }

    function restrictFileSize(){

    }

    public function checkFileSize(){

    }

    public function fileUpload(){

    }

    function renameFile(){

    }
//$strings可以是一个也可以是多个，都会转化为数组，如果多个的话用英文逗号隔开，它会遍历返回
    function commaDelimitedStringsToArray(){
        if(strpos($this->Extensions, ",") === false){
            return $arrays = array($this->Extensions);
        }else{
            $arrays = explode(',',$this->extensions);
            return $arrays;
        }
    }

}

