<?php

namespace MetaverseSystems\MultiChain;

use MetaverseSystems\MultiChain\RPC;

class MultiChainClient
{
    private $rpc;

    public function __construct($host, $port, $user, $pass)
    {
        $this->rpc = new RPC($host, $port, $user, $pass);
    }

    function __call($method, $params)
    {
        $response = $this->rpc->execute($method, $params);
        if($response->error) 
        {
            throw new \Exception($response->error->message);
        }
        return $response->result;
    }

    function get()
    {
        return $this;
    }
}
