<?php

class FileHandling {

    //fopen会覆盖另一个
    static function writetoFile($filename, $content){
         $file = fopen($filename, 'w');
         fwrite($file, $content);
         fclose($file);
    }

    static function writetoFileLinebyLine($filePath, $linecontent){
        $file = fopen($filePath,"a");
        fwrite($file,$linecontent.PHP_EOL);
        fclose($file);
    }

    static function readingFileLinebyLine($filePath){
          $fp = fopen($filePath, "r");
          if($fp == false){
              exit();
          }

          while(!foef($fp)){
              echo fgets($fp)."<br>";
          }
    }

}