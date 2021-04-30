<?php

namespace MetaverseSystems\MultiChain;

class RPC
{
    private $host;
    private $port;
    private $user;
    private $pass;
    private $request_id = 1;

    public function __construct($host = "", $port = 0, $user = "", $pass = "")
    {
        $this->host = $host;
        $this->port = $port;
        $this->user = $user;
        $this->pass = $pass;
    }

    public function execute($method, $params)
    {
        $command = json_encode(
            array(
                'id'=>$this->request_id,
                'method'=>$method,
                'params'=>$params
            )
        );

        $this->request_id++;
        $ch = curl_init($this->host.":".$this->port);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_USERPWD, $this->user.":".$this->pass);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $command);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);

        if($info["http_code"] == 0)
        {
            $result = new \stdClass;
            $result->error = "Could not connect to ".$this->host.":".$this->port;
            $result->info = $info;
            return $result;
        }

        $result = json_decode($response);
        if(is_object($result)) return $result;

        $result = new \stdClass;
        $result->error = "Response was not valid JSON.";
        $result->info = $info;
        return $result;
    }
}

