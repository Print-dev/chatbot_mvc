<?php

namespace Rogelio\ChatBotMvc\Features\Conversation\States;

use Rogelio\ChatBotMvc\Api\productsApi;
use Rogelio\ChatBotMvc\Repositorys\stateRepository;

class MainCatalogoState {
    // public function __construct(protected productsApi $productApi, protected stateRepository $stateRepository) {
        
    // }

    // public function handleInput(string $input, string $phone): array {
    //     switch ($input) {
    //         case '1': // impresora
    //             $products = $this->productApi->getAllCategory(); 

    //             die($input);
    //             // $this->stateRepository->update(['phone' => $phone, 'type' => 'catalog_view']);
    //             // // return $this->formatProductsResponse($products);
    //             // die(var_dump($products));
    //             // echo 'aca estan los catalogos';
    //             break;
    //         case '2': // componentes
    //             // $this->sessionManager->updateState($phone, 'search_initiated');
    //             // return ['message' => "Por favor ingrese el término de búsqueda:"];
    //         default:
    //             return ['message' => "Opción inválida. Intente nuevamente."];
    //     }
    // }

    // private function formatCatalog(array $products): array {
    //     $response = ["=== CATÁLOGO ==="];
    //     foreach ($products as $product) {
    //         $response[] = "{$product->getId()}. {$product->getName()} - {$product->getPrice()}";
    //     }
    //     $response[] = "\nIngrese 'menu' para volver al menú principal";
    //     return ['message' => implode("\n", $response)];
    // }
}
