<?php

namespace SEEQMGMD;

class Messenger
{
    static public function send($msg)
    {
        printf('Received message %s', $msg);
    }
}
