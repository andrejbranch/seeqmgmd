<?php

require 'vendor/autoload.php';

use React\EventLoop\Factory;
use React\ZMQ\Context;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

// build the container
$container = new ContainerBuilder();

$container->setParameter('appDir', __DIR__.'/../');

$loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../config'));
$loader->load('services/services.yml');
$loader->load('config.yml');

$loop = Factory::create();
$context = new Context($loop);

$responder = $context->getSocket(\ZMQ::SOCKET_REP);
$responder->bind(sprintf('tcp://*:%s', $container->getParameter('listeningPort')));

$messenger = $container->get('messenger');
$responder->on('message', function ($msg) use ($responder, $messenger) {
    $responder->send($messenger->send($msg));
});

$loop->run();
