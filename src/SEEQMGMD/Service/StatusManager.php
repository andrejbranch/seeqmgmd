<?php

namespace SEEQMGMD\Service;

use SEEQMGMD\Model\ClientCollection;

class StatusManager 
{
    const FILE_DAEMON_STATUS = <<<EOF
id=%s    @%s  (version=%s)
EOF;

    public function getStatus(ClientCollection $clients)
    {
        $lines = array();

        list($fdClients, $seeqdClients) = $clients->getClientsByType();

        $lines[] = sprintf('[SEEQFD]    %s node(s)', count($fdClients));
        foreach ($fdClients as $client) {
            $lines[] = sprintf(self::FILE_DAEMON_STATUS,
                $client->getId(),
                $client->getHostName(),
                $client->getVersion()
            );
        }

        return implode("\n", $lines);
    } 
}
