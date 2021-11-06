<?php

namespace App;

class Parser{
    private $file;
    private $parsed = [];

    public function __construct($file_name)
    {
        $dir = dirname(__DIR__, 1);
        $this->file = file_get_contents($dir.'/'.$file_name);
        $this->file = preg_replace("/^\s+/m", '', $this->file);
    }

    public function parse(){
        return $this->parse_lines($this->file);
    }

    private function remove_comments($lines){        
        return preg_replace("/^#.+$/m", "", $lines);
    }

    private function parse_lines($lines){
        $data = [];
        $clean_lines = $this->remove_comments($lines);
        $lines = explode("\n", $clean_lines);
        foreach($lines as $line){
            if(strlen($line) < 1)   continue;
            $parts = explode("=", $line);
            $data[trim($parts[0])] = $this->type_convert(trim($parts[1]));
        }

        return $this->parseDots($data);
    }

    public function parseDots($data)
    {
        foreach ($data as $key => $value) {
            
            if (($found = strpos($key, '.')) !== false) {
                $newKey = substr($key, 0, $found);
                $remainder = substr($key, $found + 1);
                $expandedValue = $this->parseDots([$remainder => $value]);
                if (isset($data[$newKey])) {
                    $data[$newKey] = array_merge_recursive($data[$newKey], $expandedValue);
                } else {
                    $data[$newKey] = $expandedValue;
                }
                unset($data[$key]);
            }
        }
        return $data;
    }
    
    private function type_convert($data){
        if(preg_match('/^[0-9]+$/', $data)){
            return (int) $data;
        }elseif($data == "true" || $data == "false"){
            return (bool) $data;
        }elseif(is_string($data)){
            return (string) $data;
        }
    }
}


?>