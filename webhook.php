<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('log_errors', '1');
ini_set('error_log', './error_log.log');

// requerimos el vendor
require_once 'vendor/autoload.php';

// Si .env está en el mismo directorio que index.php
//$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
//$dotenv->load();

use Rogelio\ChatBotMvc\Api\productsApi;
use Rogelio\ChatBotMvc\Controllers\HandleMessage;
use Rogelio\ChatBotMvc\Features\Conversation\States\MainMenuState;
use Rogelio\ChatBotMvc\Features\Conversation\States\pointSale;
use Rogelio\ChatBotMvc\Features\Conversation\States\SearchProduct;
use Rogelio\ChatBotMvc\Repositorys\stateRepository;
use Rogelio\ChatBotMvc\Services\handleMessageService;
use Rogelio\ChatBotMvc\Services\stateService;
use Rogelio\ChatBotMvc\Utils\whatsappCli;
$whasapCli = new whatsappCli();
$stateRepository = new stateRepository();
$handleMessageService = new handleMessageService($whasapCli, $stateRepository);
$stateService = new stateService($stateRepository);
$handleMessageController = new HandleMessage($handleMessageService, $stateService);

$productsApi = new productsApi();
$pointSale = new PointSale();
$searchProduct = new SearchProduct();
if($_POST['body'] == 'menu')
{
    $handleMessageController->Input('menu', $_POST['phone']);
}else{
    // Antes de enviar el mensaje del usuario a la entrada de la app, verificamos si hay un estado presente.
    $status = $handleMessageController->verifyState($_POST['phone']);
    if($status)
    {
        // si es true, paso
        if($status == 'view_menu')
        {
            $mainMenuState = new MainMenuState($productsApi, $stateRepository, $pointSale, $searchProduct);
            $respuesta = $mainMenuState->handleInput($_POST['body'], $_POST['phone']);
            echo $respuesta['message'];
        }
        if($status == 'view_catalog')
        {
    
        }

        if($status == 'search_initiated')
        {
    
        }
    }else{
        $handleMessageController->Input('menu', $_POST['phone']);
    }
}