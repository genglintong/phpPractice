<?php

$server = new swoole_websocket_server("127.0.0.1", 9502);

$server->on('open', function($server, $req) {
    echo "connection open: {$req->fd}\n";
});

$server->on("message", function($server, $frame) {
    echo "received message: {$frame->data}\n";
});

$server->on('close', function($server, $fd) {
    echo "Connect close: {$fd}\n";
});

$server->start();