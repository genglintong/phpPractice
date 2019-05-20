<?php

/**
 * redis 连接池
 */

class RedisPool 
{
    protected $pool;

    // 
    public function __construct(int $size = 100) 
    {
        $this->pool = new \Swoole\Coroutine\Channel($size);
        for ($i = 0; $i < $size; $i++) {
            $redis = new \Swoole\Coroutine\Redis();
            $res   = $redis->connect('127.0.0.1', 6379);
            if ($res == false) {
                # code...
                throw new \RuntimeException("failed to connect redis server", 1);
            }else {
                $this->put($redis);
            }
        }
    }

    // 获取 redis
    public function get(): \Swoole\Coroutine\Redis
    {
        return $this->pool->pop();
    }

    public function put(\Swoole\Coroutine\Redis $redis)
    {
        $this->pool->push($redis);
    }

    public function close(): void
    {
        $this->pool->close();
        $this->pool = null;
    }
}

go(function () {
    $pool = new RedisPool();
    // max concurrency num is more than max connections
    // but it's no problem, channel will help you with scheduling
    for ($c = 0; $c < 1000; $c++) {
        go(function () use ($pool, $c) {
            for ($n = 0; $n < 100; $n++) {
                $redis = $pool->get();
                assert($redis->set("awesome-{$c}-{$n}", 'swoole'));
                assert($redis->get("awesome-{$c}-{$n}") === 'swoole');
                //assert($redis->delete("awesome-{$c}-{$n}"));
                $pool->put($redis);
            }
        });
    }
});