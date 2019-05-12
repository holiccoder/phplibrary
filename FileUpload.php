<?php

class FileUpload {

    public $files;
    const maxFileSize = '38292722';
    const uploadDir = 'uploads/';
    const imageFileExtensions = "jpg,jpeg,png,svg,gif";
    const allowedExtensions = "jpg,png,gif";
    const allowedExtesionsError = "this type of file could not be uploaded";
    const allowedFileSizeError = "Your file has exeeded the limit of the filesize";
    const fileNameSize = 6;

    public function __construct($FILES){
        $this->files = $FILES;
    }

    //检查上传的文件类型是否在允许的文件类型范围内
    function checkAllowedFileExtensions(){
        $files = $this->files;
        if($files){
            $allowedExts = $this->commaDelimitedStringsToArray($this::allowedExtensions);
            $checkSuccess = false;
            foreach($files as $key => $value){
                 $filename = $_FILES[$key]["name"];
                 $extension = $this->getUploadedFileExtension($filename);
                 if(in_array($extension, $allowedExts) == false){
                     return $this::allowedExtesionsError;
                 }else{
                     $checkSuccess = true;
                 }
            }

            return $checkSuccess;
        }
    }

    function checkFileSize(){
        if($this->files){
            $files = $this->files;
            foreach($files as $key => $value){
                $filesize = $_FILES[$key]["size"];
                if($filesize > $this::maxFileSize){
                    return $this::allowedFileSizeError;
                }else{
                    return true;
                }
            }
        }
    }

    function renameFile($originalFilename){
        $extension = $this->getUploadedFileExtension($originalFilename);
        $newFileName = $this->generateRandomString($this::fileNameSize);
        return $newFileName.".".$extension;
    }

    function fileUpload(){
        if($this->checkAllowedFileExtensions() == 1 && $this->checkFileSize() == 1){
               $files = $this->files;

               foreach($files as $key => $value){
                    $tmpname = $files[$key]["tmp_name"];
                    $filename = $files[$key]["name"];
                    $newfilename = $this->renameFile($filename);
                    $destinationfile = $this::uploadDir.$newfilename;
                    move_uploaded_file($tmpname, $destinationfile);
               }
               return "File Uploaded";
        }else{
            echo $this->checkAllowedFileExtensions();
            echo $this->checkFileSize();
        }
    }

    function getUploadedFileExtension($filename){
        return substr($filename, strrpos($filename, '.')+1);
    }

//$strings可以是一个也可以是多个，都会转化为数组，如果多个的话用英文逗号隔开，它会遍历返回
    function commaDelimitedStringsToArray($commaDelimitedStrings){
        if(strpos($commaDelimitedStrings, ",") === false){
            return $arrays = array();
        }else{
            $arrays = explode(',',$commaDelimitedStrings);
            return $arrays;
        }
    }

    function generateRandomString($length) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
