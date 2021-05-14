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
        $this->host = strlen($host) ? $host : config('multichain.host');
        $this->port = $port ? $port : config('multichain.port');
        $this->user = strlen($user) ? $user : config('multichain.user');
        $this->pass = strlen($pass) ? $pass : config('multichain.pass');
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
