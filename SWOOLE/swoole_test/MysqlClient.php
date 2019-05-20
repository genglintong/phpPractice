<?php

/**
 * swoole 并发1W
 */

 $s = microtime(true);

 for ($c = 100; $c-- ;) {
     go (function() use ($c, $s) {
         $mysql = new Swoole\Coroutine\MySQL;
         $mysql->connect([
            'host'      => '127.0.0.1',
            'user'      => 'root',
            'password'  => 'genglintong',
            'database'  => 'test',
         ]);
         $statement = $mysql->prepare('SELECT * FROM `t`');
         for ($n = 100; $n--;) {
             $result = $statement->execute();
             $count  = count($result);
             assert($count > 0);
             echo "{$c}_{$n} \n"; 
         }
     });
 }

 Swoole\Event::wait();

 echo 'use ' . (microtime(true) - $s) . ' s';