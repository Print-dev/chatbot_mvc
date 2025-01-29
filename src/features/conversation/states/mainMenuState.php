<?php

namespace Rogelio\ChatBotMvc\Features\Conversation\States;

class MainMenuState {
    private $sessionManager;
    private $catalog;

    public function __construct() {
        
    }

    public function handleInput(string $input, string $phone): array {
        switch ($input) {
            case '1':
                // $products = $this->catalog->getAllProducts();
                // $this->sessionManager->updateState($phone, 'catalog_view');
                // return $this->formatProductsResponse($products);
                echo 'aca estan los catalogos';
                break;
            case '2':
                // $this->sessionManager->updateState($phone, 'search_initiated');
                // return ['message' => "Por favor ingrese el término de búsqueda:"];
            default:
                return ['message' => "Opción inválida. Intente nuevamente."];
        }
    }

    private function formatProductsResponse(array $products): array {
        $response = ["=== CATÁLOGO ==="];
        foreach ($products as $product) {
            $response[] = "{$product->getId()}. {$product->getName()} - {$product->getPrice()}";
        }
        $response[] = "\nIngrese 'menu' para volver al menú principal";
        return ['message' => implode("\n", $response)];
    }
}
