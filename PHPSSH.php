<?php
//用SSH方式远程连接执行命令，执行相应的操作, 要按照libssh2库，并且要开启php_ssh2的插件权限，通常在php.ini里
class PHPSSH{

    private $user;
    private $password;
    private $serverip;

    public function __construct($serverip, $user, $password){
         $this->serverip = $serverip;
         $this->user = $user;
         $this->password = $password;
    }

    //可以用这个来尝试连接是否成功
    function sshExecCmd($cmd){
        $connection = ssh2_connect($this->serverip, 22);
        ssh2_auth_password($connection, $this->user, $this->password);
        $stream = ssh2_exec($connection, $cmd);
        stream_set_blocking($stream, true);
        $stream_out = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
        return stream_get_contents($stream_out);
    }

    //复制文件
    function copyFilesToDir($originalFiles, $targetLocation){
        $this->sshExecCmd("cp -r $originalFiles $targetLocation");
    }

    //.sql文件导入到数据库
    function importSqlFileToDatabase($sqlFilePath, $dbuser, $dbpassword, $dbname){
        $this->sshExecCmd("mysql --user=$dbuser --password=$dbpassword -h localhost -D $dbname < $sqlFilePath");
    }

    //寻找替换某个文件中的某个字符串
    function searchReplaceStringinFile($searchString, $replaceString, $filePath){
        $editFile = 's/'.$searchString.'/'.$replaceString.'/g';
        $this->sshExecCmd("sed -i '".$editFile."' '".$filePath."'");
        return "editsuccess";
    }

    function renameFile($originalFilePath, $newFilePath){
        //the two variables are almost the same, except file name
        $this->sshExecCmd("mv $originalFilePath $newFilePath");
        return "success";
    }

    function moveFile($originalFilePath, $newFilePath){
        //new file path needs to be a different path
        $this->sshExecCmd("mv $originalFilePath $newFilePath");
        return "success";
    }

}