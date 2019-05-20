<?php

/**
 * 毫秒级别定时器 底层给予epoll_wait 和 setitimer 实现 底层使用 最小堆 可支持添加大量定时器
 */

 // 间隔时钟定时器 每隔100ms 执行一次 直到 执行clear
$id = Swoole\Timer::tick(100, function () {
    echo "⚙️ Do something...\n";
});

// 执行一次 定时器
Swoole\Timer::after(500, function () use ($id) {
    // 清除间隔定时器
    Swoole\Timer::clear($id);
    echo "⏰ Done\n";
});

Swoole\Timer::after(1000, function () use ($id) {
    // 该定时器 被清除
    if (! Swoole\Timer::exists($id)) {
        # code...
        echo "✅ All right!\n";
    }
});

/**
 * 使用协程
 */
 go(function () {
    $i = 0;
    while (true) {
        Co::sleep(0.1);
        echo "📝 Do something...\n";

        if (++$i == 5) {
            # code...
            echo "🛎 Done\n";
            break;
        }
    }
    echo "🎉 All right!\n";
 });