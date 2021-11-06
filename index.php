
<?php

require_once 'vendor/autoload.php';

use App\Worker;

$worker = new Worker("https://takenjob.se");
$worker->run();

$worker2 = new Worker("https://edition.cnn.com");
$worker2->run();

$worker3 = new Worker("https://github.com");
$worker3->run();

$worker4 = new Worker("https://microsoft.com");
$worker4->run();

$worker5 = new Worker("https://stackoverflow.com");
$worker5->run();

$worker6 = new Worker("https://CNN.com");
$worker6->run();

?>

