<?php

require_once __DIR__ . '/WebSocketClient.php';

$client = new WebSocketClient('127.0.0.1', 9502);

if (!$client->connect())
{
	echo "connect failed \n";
	return false;
}

$send_data = "I am client.\n";
while ($client->send($send_data))
{
	echo $send_data. " send succ \n";
	//return false;
}

echo "send succ \n";
return true;