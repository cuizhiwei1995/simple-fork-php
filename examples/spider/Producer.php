<?php

/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2015/8/19
 * Time: 14:32
 */
class Producer extends \Jenner\SimpleFork\Process
{
    public function start(){
        for($i=0; $i<100; $i++){
            $this->queue->put(1, mt_rand(0, 100));
            usleep(500000);
        }
    }
}

$queue = new \Jenner\SimpleFork\IPC\SystemVMessageQueue(1, "/tmp/simple-fork-test.ipc");
$producer = new Producer();
$producer->setQueue($queue);
$producer->start();