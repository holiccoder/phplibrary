<?php

class FileHandling {

    function createFile($filePath){
        $handle = fopen($filePath, "r+");
        fclose($handle);
    }

    //file and script should be in the same path
    function getFileAbsolutePath($file){
        return pathinfo(realpath($file), PATHINFO_DIRNAME);
    }

    //$filePath should be absolute
    function unzipFile($filePath){
        $path = $this->getFileAbsolutePath($filePath);
        $zip = new ZipArchive;
        $res = $zip->open($filePath);
        if($res === TRUE){
           //$path should be file destination folder
            $zip->extractTo($path);
            $zip->close();
            echo "successfully extracted";

        }else{
            throw new Exception("could not open file");
        }
    }

    function copyFile($original, $target){
        $result = copy($original, $target);
        if($result == 1){
            return true;
        }else {
            return false;
        }
    }

    function copyContentofFileandRename($filePath, $rename){

    }

    function checkIfaFileContainsinFolder($filePath){
        if(file_exists($filePath)){
             return true;
        }else{
             return false;
        }
    }

    function listAllFoldersinFolder($dir){
        $dirs = array_filter(glob('*'), 'is_dir');
        foreach($dirs as $dir){
            echo $dir;
        }
    }

    function renameFile($fileName, $newFileName){
        rename($fileName, $newFileName);
    }

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
   //从含某个字符串的某行开始删除文件


    //删除某行的代码
    function removeLine($linenumber){

    }

    static function readingFileLinebyLine($filePath){
          $fp = fopen($filePath, "r");
          if($fp == false){
              exit();
          }

          while(!feof($fp)){
              echo fgets($fp)."<br>";
          }
    }

    //put this in a loop to remove line of text
    function removeALinefromFile($filePath, $line){
        file_put_contents($filePath, str_replace($line, "", file_get_contents($filePath)));
    }

    function replaceALinefromFile($filePath, $line, $replace){
        file_put_contents($filePath, str_replace($line, $replace, file_get_contents($filePath)));
    }

    function insertCertainLineBeforeSpecificLine($filePath,$searchneedle,$secondneedle,$linecontent){
        $handle = fopen($filePath, "+r") or die("could not open file");
        $linenumber = 0;
        while(!feof($handle)){
            $line = fgets($handle);
            $linenumber++;
            if(strpos($line,$searchneedle)){
                $number = $linenumber;
            }

            if(isset($number)){
                if($linenumber > $number){
                    if(strpos($line,$secondneedle)){
                        file_put_contents($filePath, str_replace($line, $secondneedle, file_get_contents($filePath)));
                    }
                }
            }
        }



    }


    function appendLineToFile($filePath, $line){
        $handle = fopen($filePath, 'a') or die("cannot open file: ".$filePath);
        $newline = "\n".$line;
        fwrite($handle, $newline);
    }

    function searchReplaceStringinFile($search, $replace, $filePath){
        $str=file_get_contents($filePath);
        $str=str_replace($search, $replace,$str);
        file_put_contents($filePath, $str);
    }

    function writeToStartofFile($filepath, $content){
        $content .= file_get_contents($filepath);
        file_put_contents($filepath, $content);
    }

    //copy files in a folder to another folder
    function recurse_copy($src,$dst) {
                $dir = opendir($src);
                @mkdir($dst);
                while(false !== ( $file = readdir($dir)) ) {
                    if (( $file != '.' ) && ( $file != '..' )) {
                    if ( is_dir($src . '/' . $file) ) {
                     recurse_copy($src . '/' . $file,$dst . '/' . $file);
               }else {
                copy($src . '/' . $file,$dst . '/' . $file);
            }
         }
      }
    closedir($dir);
    }

}
