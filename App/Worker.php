<?php

namespace App;

use App\{Database, Operations};


class Worker extends Operations{
    protected $db;
    protected $url;

    public function __construct($url){
        $dbInstance = Database::getInstance();
        $this->db = $dbInstance->getConnection();
        $this->addUrl($url);
        $this->url = $url;
    }

    public function run(){
        $dir = realpath(__DIR__ . '/..');
        exec('php '.$dir.'/process.php --url='.$this->url.' > /dev/null &');
    }


}
