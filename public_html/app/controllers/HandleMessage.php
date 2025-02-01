<?php

require_once '../services/handleMessageService.php';
require_once '../services/stateService.php';

class HandleMessage 
{
    public function __construct(protected handleMessageService $handleMessageService, protected stateService $stateService)
    {
        
    }

    // tomar mensaje del usuario
    public function Input(string $message, string $phone)
    {
        // hacemos que service, maneje la logica de negocio
        return $this->handleMessageService->handleInput($message, $phone);
    }

    // verificar si existe estado
    public function verifyState(string $phone)
    {
        // primero verifica en un servicio, si hay un estado
        $state = $this->stateService->getState($phone);
        return $state ?? false;
    }

    // 
}