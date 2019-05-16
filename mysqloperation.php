<?php

    class mysqloperation{

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

        function listAllTables(){
            $conn = $this->connectDB();
            $tables = $conn->query("SHOW TABLES");
            return $tables;
        }

        function showAllColumnsinTable($tableName){
            $conn = $this->connectDB();
            $tableColumns = $conn->query("SHOW COLUMNS FROM '$tableName'");
            return $tableColumns;
        }

        function connectDB(){
            $conn = mysqli($this->serverip, $this->user, $this->password, $this->dbname);
            if(!$conn){
                die('Could not Connect to Database' . $conn->mysqli_error );
            }
            return $conn;
        }

        function insertToTable($tableName, $columnNames = null, $values){
            $conn = $this->connectDB();
            if($columnNames == null){
                $sql = "INSERT INTO $tableName VALUES ('$values')";
            }
            $sql = "INSERT INTO '$tableName' ('$columnNames') values ('$values')";

            $result = $conn->query($sql);
            return $result;
        }

        function updateColumnValue($tableName, $columnName, $secondColumnName, $value, $secondValue){
            $sql = "UPDATE '$tableName' SET '$columnName' = '$value' WHERE '$secondColumnName' = '$secondValue'";
        }

        function deleteFromTable($tableName, $columnName, $value){
            $sql = "DELETE FROM '$tableName' WHERE '$columnName' = '$value'";
        }

        function dropTable($tableName){
            $conn = $this->connectDB();
            $conn->query("DROP $tableName");
            return "delete Table Success";
        }

        function TruncateCertainTablesData($commaDelimitedTableNames){
              $tablearray = $this->commaDelimitedStringsToArray($commaDelimitedTableNames);
              foreach($tablearray as $table){
                  $connection = $this->connectDB();
                  $connection->query("truncate ".$table);
              }

              return "trucate success";
        }

        function returnNumsRowsonCondition($tableName, $cloumnName, $value){
             $conn = $this->connectDB();
             $result = $conn->query("SELECT * FROM '$tableName' WHERE '$cloumnName' = '$value'");
             return $result->num_rows;
        }

        function commaDelimitedStringsToArray($commaDelimitedStrings){
            if(strpos($commaDelimitedStrings, ",") === false){
                return $arrays = array();
            }else{
                $arrays = explode(',',$commaDelimitedStrings);
                return $arrays;
            }
        }

    }
