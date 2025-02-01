<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('log_errors', '1');
ini_set('error_log', './error_log.log');

// requerimos el vendor
require_once '../vendor/autoload.php';

// Si .env está en el mismo directorio que index.php
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once './app/api/productsApi.php';
require_once './app/controllers/HandleMessage.php';
require_once './app/features/conversation/states/frequentQuestions.php';
require_once './app/features/conversation/states/mainCatalogoState.php';
require_once './app/features/conversation/states/mainMenuState.php';
require_once './app/features/conversation/states/mainProductDetails.php';
require_once './app/features/conversation/states/pointSale.php';
require_once './app/features/conversation/states/productSale.php';
require_once './app/features/conversation/states/searchProduct.php';

require_once './app/repositorys/stateRepository.php';
require_once './app/services/handleMessageService.php';
require_once './app/services/stateService.php';
require_once './app/utils/whatsappCli.php';

$whasapCli = new whatsappCli();
$stateRepository = new stateRepository();
$handleMessageService = new handleMessageService($whasapCli, $stateRepository);
$stateService = new stateService($stateRepository);
$handleMessageController = new HandleMessage($handleMessageService, $stateService);

$productsApi = new productsApi();
$pointSale = new PointSale();
$frecuentQuestions = new frequentQuestions();

$_POST['body'] = trim($_POST['body']);

if ($_POST['body'] == 'menu') {
    $handleMessageController->Input('menu', $_POST['phone']);
} elseif ($_POST['body'] == 'catalogo')
{
    $mainMenuState = new MainMenuState($productsApi, $stateRepository, $pointSale, $frecuentQuestions);
    $response = $mainMenuState->handleInput('1', $_POST['phone']);
    echo $response['message'];
} elseif(strtolower($_POST['body']) == 'buscar producto')
{
    $mainMenuState = new MainMenuState($productsApi, $stateRepository, $pointSale, $frecuentQuestions);
    $response = $mainMenuState->handleInput('2', $_POST['phone']);
    echo $response['message'];
}
else {
    // Antes de enviar el mensaje del usuario a la entrada de la app, verificamos si hay un estado presente.
    // Nos devolverea un array, debido a que, sera tanto el campo 'type_state' y 'additional_info'
    $response = $handleMessageController->verifyState($_POST['phone']);
    $status = $response['type_state'];
    $additional_info = $response['additional_info'] ?? '';
    if ($status) {
        // si es true, paso
        if ($status == 'view_menu') {
            $mainMenuState = new MainMenuState($productsApi, $stateRepository, $pointSale, $frecuentQuestions);
            $response = $mainMenuState->handleInput($_POST['body'], $_POST['phone']);
            echo $response['message'];
        }
        if ($status == 'catalog_view') {
            $mainCatalogoState = new MainCatalogoState($productsApi, $stateRepository);
            $response = $mainCatalogoState->handleInput($_POST['body'], $_POST['phone']);
            echo $response['message'];
        }
        if ($status == 'catalog_product_view'){
            $mainProductDetail = new mainProductDetails($productsApi, $stateRepository);
            $response = $mainProductDetail->handleInput($_POST['body'], $_POST['phone'], $additional_info);
            echo $response['message'];
        }
        if ($status == 'product_sale_view')
        {
            $mainProductSale = new productSale($stateRepository);
            $response = $mainProductSale->handleInput($_POST['body'], $_POST['phone'], $additional_info);
            echo $response['message'];
        }
        if ($status == 'search_initiated') {

            $mainSearchState = new SearchProduct($productsApi, $stateRepository);

            $input = strtolower($_POST['body']); // Convertir a minúsculas para hacer la comparación insensible a mayúsculas
            $keyword = 'buscar producto';
        
            // Verificar si la palabra clave está en el input
            if (stripos($input, $keyword) !== false) {
                $whasapCli->renderSearchProduct();
            } else{
                $response = $mainSearchState->handleInput($_POST['body'], $_POST['phone']);
                echo $response['message'];
            }
        }
        if ($status == 'points_view'){     
            $pointSale = new pointSale();     
            $respuesta = $pointSale->getInformation();
        }
        if ($status == 'questions_view'){
            $questionsFrec = new frequentQuestions();
            $questionsFrec->getInformation();
        }
    } else {
        $handleMessageController->Input('menu', $_POST['phone']);
    }
}
