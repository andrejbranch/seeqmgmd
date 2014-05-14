<?php

namespace SEEQMGMD;

use SEEQMGMD\Model\Client;
use SEEQMGMD\Model\ClientCollection;
use SEEQMGMD\Log\Logger;
use Symfony\Component\DependencyInjection\Container;

class Controller
{
    private $clients;
    private $logger;

    public function __construct(Container $container, Logger $logger)
    {
        $this->container = $container;
        $this->logger = $logger;
        $this->clients = new ClientCollection();
    }

    public function connect($clientProps)
    {
        $this->logger->info('Controller: connecting client');

        $client = new Client($clientProps);
        $client->setId(count($this->clients) + 1);

        $this->clients->attach($client);

        $this->logger->info(sprintf('Controller: %s client %s connected',
            $client->getType(), $client->getHostName())
        );
    }

    public function showStatus()
    {
        $this->logger->info('Controller: calling get status');

        return $this->container->get('status_manager')->getStatus($this->clients);
    }
}
