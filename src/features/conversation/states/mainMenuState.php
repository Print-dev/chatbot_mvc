<?php

namespace Rogelio\ChatBotMvc\Features\Conversation\States;

use Rogelio\ChatBotMvc\Api\productsApi;
use Rogelio\ChatBotMvc\Repositorys\stateRepository;

class MainMenuState {
    public function __construct(protected productsApi $productApi, protected stateRepository $stateRepository, protected pointSale $pointSale, protected SearchProduct $searchProduct) {
        
    }

    public function handleInput(string $input, string $phone): array {
        switch ($input) {
            case '1': // Catalogo
                $products = $this->productApi->getAllCategory();
                
                // Actualiza estado si es necesario
                $this->stateRepository->update(['phone' => $phone, 'type' => 'catalog_view']);
                
                // Devuelve directamente la respuesta formateada
                return $this->formatProductsResponse($products);
    
            case '2': // Buscar producto
                $this->stateRepository->update(['phone' => $phone, 'type' => 'search_initiated']);
                return ['message' => "Por favor ingrese el término de búsqueda:"];

            case '3': // Punto de venta
                $message = $this->pointSale->getInformation();
                return ['message' => $message];


            case '4': // Preguntas frecuentes
                $message = $this->searchProduct->getInformation();
                return ['message' => $message];
            default:
                return ['message' => "Opción inválida. Intente nuevamente."];
        }
    }

    private function formatProductsResponse(array $products): array {
        // Verificar si hay categorías disponibles
        if (empty($products)) {
            return ['message' => "⚠️ No hay categorías disponibles en este momento."];
        }
        
        $response = ["📁 *CATÁLOGO DE CATEGORÍAS* 📁\n"];
        
        // Numerar cada categoría
        foreach ($products as $index => $categoria) {
            $numero = $index + 1;
            $response[] = "{$numero}. {$categoria}";
        }
        
        // Añadir instrucciones
        $response[] = "\nℹ️ *Para seleccionar:* Escriba el número de la categoría";
        $response[] = "🏠 *Volver al menú:* Escriba 'menu'";
        
        return ['message' => implode("\n", $response)];
    }
}
