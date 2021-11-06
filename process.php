<?php

require_once 'vendor/autoload.php';

use App\Operations;
// sleep(5);

$val = getopt(null, ["url:"]);

try{
    $process = new Operations($val['url']);
    $job = $process->getJob();
    $process->updateStatus("PROCESSING");
// sleep(8);
    $status_code = $process->fetch();
    $process->setHttpStatusCode($status_code);
}catch(\Exception $e){
    $process->updateStatus("ERROR");
}


