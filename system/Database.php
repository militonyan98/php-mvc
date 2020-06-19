<?php

namespace system;
use config\DBConfig;
use Mysqli;

class Database {
    private $connection;
    function __construct($host=DBConfig::HOST, $username=DBConfig::USERNAME, $password=DBConfig::PASSWORD, $name=DBConfig::NAME){
        $this->connection = new Mysqli($host, $username, $password, $name);
        if ($this->connection->connect_errno) {
            $this->error("Failed to connect to the database: ".$this->connection->connect_error);
            exit;
        }
        return $this->connection;
    }

    public function select($query, $needAll = true){
        $data = $this->connection->query($query);
        $output = ["error" => false, "msg" => "", "data" => []];
        if($data){
            if($needAll){
                while ($row = $data->fetch_assoc()) {
                    $output["data"][] = $row;
                }
            }
            else{
                $output["data"] = $data->fetch_assoc();
            }
        }
        else{
            $output["error"] = true;
            $output["msg"] = "Failed to select from the table: ".$this->connection->connect_error;
        }
        return $output;
    }
    
    public function insert($table, $data){
        $keys = $values = "";
        $dataCount = count($data);
        $i=0;
        foreach($data as $key => $value){
            $keys .=  "`".$this->connection->real_escape_string($key)."`".", ";
            $values .= "'".$this->connection->real_escape_string($value)."'".", ";
        }

        $keys = substr($keys, 0, -2);
        $values = substr($values, 0, -2);

        $query = "INSERT INTO $table ($keys) VALUES ($values)";
        $result = $this->connection->prepare($query);
        
        if(!$result){
            var_dump($this->connection);
            exit;
        }

        $result->execute();
        if(!$result){
            $this->error("Failed to insert into ".$table.": ".$this->connection->connect_error);
        }
        return $result;

    }
    
    public function update($table, $data, $where=1){
        $values = "";
        foreach ($data as $key => $value) {
            $values .= $this->connection->real_escape_string($key)
            ." = "
            ."'"
            .$this->connection->real_escape_string($value)
            ."'"
            .", ";
        }
        $values = substr($values, 0, -2);

        $query = "UPDATE $table SET $values WHERE " .$where;
        $result = $this->connection->prepare($query);
        $result->execute();
        if(!$result) {
            $this->error("Failed to update table ".$table.$this->connection->connect_error);
        }
        return $result;
    }
    
    public function delete($table, $where=1){
        $query = "DELETE FROM ".$table." WHERE ".$where;
        $result = $this->connection->prepare($query);
        $result->execute();
        if(!$result){
            $this->error("Failed to delete: ".$this->connection->connect_error);
        }
        return $result;
    }

    public function escapeString($data){
        return $this->connection->real_escape_string($data);
    }
    
    private function error($error){
        echo $error;
    }
}