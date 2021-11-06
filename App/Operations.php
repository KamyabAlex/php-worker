<?php

namespace App;

use App\Database;
use Exception;

class Operations{
    protected $db;
    protected $url;

    public function __construct($url){
        $dbInstance = Database::getInstance();
        $this->db = $dbInstance->getConnection();
        $this->url = $url;
    }

    public function fetch(){
        $ch = curl_init($this->url);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, false );
        $header = array('user-agent: Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.80 Safari/537.36');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 600);
        $a = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $httpcode;
    }

    public function updateStatus($type){
        try{
            $stmt = $this->db->prepare("UPDATE jobs SET status = ? WHERE url = ?");
            $stmt->bind_param("ss", $type, $this->url);
            $stmt->execute();
        }catch(\mysqli_sql_exception $e){
            die($e->getMessage());
        }


        return ;
    }

    public function setHttpStatusCode($code){
        try{
            $stmt = $this->db->prepare("UPDATE jobs SET http_code = ?, status = 'DONE' WHERE url = ?");
            $stmt->bind_param("is", $code, $this->url);
            $stmt->execute();
        }catch(\mysqli_sql_exception $e){
            die($e->getMessage());
        }

        return ;
    }

    public function getJob(){
        try{
            $stmt = $this->db->prepare("SELECT * FROM jobs WHERE status = ? AND url = ?");
            $status = "NEW";
            $stmt->bind_param("ss", $status, $this->url);
            $stmt->execute();
            $result = $stmt->get_result();
        }catch(\mysqli_sql_exception $e){
            die($e->getMessage());
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addUrl($url){
        if($this->url_exists($url))
            throw new Exception("Duplicate entry - URL already exists.");

        try{
            $stmt = $this->db->prepare("INSERT INTO jobs (url, status) VALUES (?, 'NEW')");
            $stmt->bind_param("s", $url);
            $stmt->execute();
        }catch(\mysqli_sql_exception $e){
            $stmt->execute();
        }catch(\mysqli_sql_exception $e){
            die($e->getMessage());
        }

        return ;
    }

    public function url_exists($url){
        try{
            $stmt = $this->db->prepare("SELECT * FROM jobs WHERE url = ?");
            $stmt->bind_param("s", $url);
            $stmt->execute();
            $stmt->store_result();
            $rows = $stmt->num_rows;
        }catch(\mysqli_sql_exception $e){
            $stmt->execute();
        }catch(\mysqli_sql_exception $e){
            die($e->getMessage());
        }

        if($rows == 0)
            return false;

        return true;
    }


}



?>

