<?php

namespace MetaverseSystems\MultiChain;

use MetaverseSystems\MultiChain\RPC;

class MultiChainClient
{
    private $host;
    private $port;
    private $user;
    private $pass;
    private $rpc;

    public function __construct($host = "", $port = 0, $user = "", $pass = "")
    {
        $this->host = strlen($host) ? $host : env('MULTICHAIN_RPC_HOST');
        $this->port = $port ? $port : env('MULTICHAIN_RPC_PORT');
        $this->user = strlen($user) ? $user : env('MULTICHAIN_RPC_USER');
        $this->pass = strlen($pass) ? $pass : env('MULTICHAIN_RPC_PASS');
        $this->rpc = new RPC($this->host, $this->port, $this->user, $this->pass);
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
}
