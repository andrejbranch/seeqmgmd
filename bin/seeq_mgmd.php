<?php

require 'vendor/autoload.php';

use React\EventLoop\Factory;
use React\ZMQ\Context;
use SEEQMGMD\Messenger;

$loop = Factory::create();
$context = new Context($loop);

$responder = $context->getSocket(\ZMQ::SOCKET_REP);
$responder->bind('tcp://*:5555');

$responder->on('message', function ($msg) {
    Messenger::send($msg);
});

$loop->run();
