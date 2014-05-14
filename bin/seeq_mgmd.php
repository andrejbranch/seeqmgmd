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

$dispatcher = $container->get('dispatcher');
$responder->on('message', function ($msg) use ($responder, $dispatcher) {
    $responder->send($dispatcher->dispatch(json_decode($msg, true)));
});

$loop->run();
