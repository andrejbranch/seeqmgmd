<?php

namespace SEEQMGMD\Model;

class ClientCollection extends \SplObjectStorage
{
    public function getClientsByType()
    {
        $fdClients = array();
        $seeqdClients = array();

        foreach ($this as $client) {
            if ($client->getType() === Client::TYPE_FILE_DAEMON) {
                $fdClients[] = $client;
            } else {
                $seeqdClients[] = $client;
            }
        }

        return array($fdClients, $seeqdClients);
    }
}
