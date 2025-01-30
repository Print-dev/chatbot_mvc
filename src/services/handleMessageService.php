<?php

namespace Rogelio\ChatBotMvc\Services;

use Rogelio\ChatBotMvc\Repositorys\stateRepository;
use Rogelio\ChatBotMvc\Utils\whatsappCli;

class handleMessageService {
    public function __construct(protected whatsappCli $whatsappCli, protected stateRepository $stateRepository)
    {
        
    }

    public function handleInput(string $message, string $phone)
    {
        $stateType = 'view_menu';
        $this->stateRepository->add(['phone' => $phone, 'type' => $stateType]);
        $this->whatsappCli->renderMenu();
        
    }
}