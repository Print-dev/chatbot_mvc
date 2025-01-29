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
        $stateType = '';
        switch($message){
            case 'menu':
                $stateType = 'view_menu';
                $this->whatsappCli->renderMenu();
                break;
        }

        // $status = $this->stateRepository->save($stateType, $phone);

    }
}