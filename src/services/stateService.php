<?php

namespace Rogelio\ChatBotMvc\Services;

use Rogelio\ChatBotMvc\Repositorys\stateRepository;

class stateService
{
    public function __construct(protected stateRepository $stateRepository)
    {
        
    }

    // verificaremos si hay un estado presente
    public function getState(string $phone)
    {
        return $this->stateRepository->find($phone);
    }
}