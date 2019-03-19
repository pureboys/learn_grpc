<?php

include_once __DIR__ . '/vendor/autoload.php';
include_once __DIR__ . '/GPBMetadata/Helloworld.php';
include_once __DIR__ . '/Helloworld/GreeterClient.php';
include_once __DIR__ . '/Helloworld/HelloReply.php';
include_once __DIR__ . '/Helloworld/HelloRequest.php';

$client = new Helloworld\GreeterClient("localhost:50051", [
    'credentials' => Grpc\ChannelCredentials::createInsecure(),
]);

$request = new Helloworld\HelloRequest();
$name = !empty($argv[1]) ? $argv[1] : 'world';
$request->setName($name);

list($reply, $status) = $client->SayHello($request)->wait();
$message = $reply->getMessage();
echo $message, PHP_EOL;


