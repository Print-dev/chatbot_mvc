<?php

namespace Rogelio\ChatBotMvc\Services;

use Rogelio\ChatBotMvc\Repositorys\stateRepository;
use Rogelio\ChatBotMvc\Utils\whatsappCli;

class handleMessageService
{
    public function __construct(protected whatsappCli $whatsappCli, protected stateRepository $stateRepository) {}

    public function handleInput(string $message, string $phone)
    {
        $stateType = 'view_menu';

        $userExist = $this->getUser($phone);

        if (!$userExist) {
            // Solo añade si el usuario no existe
            $this->stateRepository->add(['phone' => $phone, 'type' => $stateType]);
        }

        $this->whatsappCli->renderMenu();
    }

    public function getUser(string $phone)
    {
        return $this->stateRepository->find($phone);
    }
}
