<?php

    class mysqlOperation{

        private $serverip;
        private $user;
        private $password;
        private $dbname;

        public function __construct($serverip, $user, $password, $dbname){
            $this->serverip = $serverip;
            $this->user = $user;
            $this->password = $password;
            $this->dbname = $dbname;
        }

        public function connectDB(){
            $conn = mysqli($this->serverip, $this->user, $this->password, $this->dbname);
            if(!$conn){
                die('Could not Connect to Database' . $conn->mysqli_error );
            }
        }


    }
