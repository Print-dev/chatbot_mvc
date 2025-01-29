<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('log_errors', '1');
ini_set('error_log', './error_log.log');

// requerimos el vendor
require_once 'vendor/autoload.php';

// Si .env está en el mismo directorio que index.php
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use Rogelio\ChatBotMvc\Controllers\HandleMessage;
use Rogelio\ChatBotMvc\Features\Conversation\States\MainMenuState;
use Rogelio\ChatBotMvc\Repositorys\stateRepository;
use Rogelio\ChatBotMvc\Services\handleMessageService;
use Rogelio\ChatBotMvc\Services\stateService;
use Rogelio\ChatBotMvc\Utils\whatsappCli;
$whasapCli = new whatsappCli();
$stateRepository = new stateRepository();
$handleMessageService = new handleMessageService($whasapCli, $stateRepository);
$stateService = new stateService($stateRepository);
$handleMessageController = new HandleMessage($handleMessageService, $stateService);

if($_POST['body'] == 'menu')
{
    $whasapCli->renderMenu();
    
}else{
    // Antes de enviar el mensaje del usuario a la entrada de la app, verificamos si hay un estado presente.
    $status = $handleMessageController->verifyState('231 312 232');
    if(!$status)
    {
        // si es true, paso
        if($status == 'view_menu')
        {
            $mainMenuState = new MainMenuState();
            $mainMenuState->handleInput('1','423 123 534');
        }
        if($status == 'view_catalog')
        {
    
        }
    }else{
        $handleMessageController->Input('menu', '233 123 231');
    }
}