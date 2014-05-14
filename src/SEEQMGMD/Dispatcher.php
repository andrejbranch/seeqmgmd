<?php

namespace SEEQMGMD;

use SEEQMGMD\Log\Logger;
use Symfony\Component\DependencyInjection\Container;

class Dispatcher
{
    /**
     * @var Symfony\Component\DependencyInjection\Container
     */
    private $container;

    /**
     * @var SEEQMGMD\Log\Logger
     */
    private $logger;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function dispatch(array $msg)
    {
        $c = $this->container->get($msg['service']);

        return call_user_func_array(array($c, $msg['method']), array($msg['data']));
    }
}
