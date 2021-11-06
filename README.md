
## PHP Worker 

PHP Worker handles requests in a background process that works in parallel and stores request HTTP response code.
## Demo
![PHP Worker](https://github.com/KamyabAlex/php-worker/blob/master/php-worker.gif)

## Usage
```php
use App\Worker;

$worker = new Worker("https://takenjob.se");
$worker->run();

$worker2 = new Worker("https://stackoverflow.com");
$worker2->run();

```
## Notes
Please import the Worker.sql file to your database and rename the **.env.example** to **.env**

This library is leveraged from the Linux kernel in order to run parallel processes. **It only runs on Linux operating system.**
