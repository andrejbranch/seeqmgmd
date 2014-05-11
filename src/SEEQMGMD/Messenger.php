<?php

namespace SEEQMGMD;

use SEEQMGMD\Log\Logger;

class Messenger
{
    /**
     * @var SEEQMGMD\Log\Logger
     */
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function send($msg)
    {
        $this->logger->info(sprintf('received message %s', $msg));
    }
}
