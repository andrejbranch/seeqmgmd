<?php

namespace SEEQMGMD\Model;

class Client
{
    const TYPE_FILE_DAEMON = 'SEEQFD';
    const TYPE_MYSQL_DAEMON = 'SEEQD';

    static private $validTypes = array(
        self::TYPE_FILE_DAEMON,
        self::TYPE_MYSQL_DAEMON,
    );

    private $id;
    private $type;
    private $hostName;

    public function __construct($props)
    {
        $type = $props['type'];

        if (!in_array($type, self::$validTypes)) {
            throw new \InvalidArgumentException(sprintf('Type %s is not valid', $type)); 
        }

        $this->type = $type;
        $this->hostName = $props['host'];
        $this->version = $props['version'];
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setHostName($hostName)
    {
        $this->hostName = $hostName;
    }

    public function getHostName()
    {
        return $this->hostName;
    }

    public function setVersion($version)
    {
        $this->version = $version;
    }

    public function getVersion()
    {
        return $this->version;
    }
}
