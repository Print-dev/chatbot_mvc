<?php

use Twilio\Rest\Client;

class whatsappClient
{
    private $clientTwilio;

    public function __construct(string $sid, string $token)
    {
        $this->clientTwilio = new Client($sid, $token);
    }

    
}