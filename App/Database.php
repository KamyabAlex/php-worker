<?php

namespace App;
use App\Parser;

class Database {
        private $_connection;
        private static $_instance;


        public static function getInstance() {
                if(!self::$_instance) {
                        self::$_instance = new self();
                }
                return self::$_instance;
        }


        private function __construct() {
                $parser = new Parser('.env');
                $conf = $parser->parse();
                $this->_connection = new \mysqli($conf['db']['host'], $conf['db']['user']['name'],
                $conf['db']['user']['password'], $conf['db']['name']);


                if(mysqli_connect_error()) {
                        trigger_error("Failed to conencto to MySQL: " . mysqli_connect_error(),
                                 E_USER_ERROR);
                }
        }


        public function getConnection() {
                return $this->_connection;
        }

}
