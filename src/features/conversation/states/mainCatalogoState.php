<?php

namespace Rogelio\ChatBotMvc\Features\Conversation\States;

use Rogelio\ChatBotMvc\Api\productsApi;
use Rogelio\ChatBotMvc\Repositorys\stateRepository;

class MainCatalogoState
{
    public function __construct(protected productsApi $productApi, protected stateRepository $stateRepository) {}

    public function handleInput(string $input, string $phone): array
    {
        $product = '';
        switch ($input) {
            case '1':
                $product = 'CAJONES DE DINERO';
                break;
            case '2':
                $product = 'MONITORES';
                break;
            case '3':
                $product = 'CPUS';
                break;
            case '4':
                $product = 'COMPUTADORAS';
                break;
            case '5':
                $product = 'IMPRESORAS';
                break;
            case '6':
                $product = 'PUNTOS DE VENTA';
                break;
            case '7':
                $product = 'ACCESORIOS';
                break;
            case '8':
                $product = 'ESCANERS';
                break;
            default:
                return ['message' => "Opción inválida. Intente nuevamente."];
        }

        $products = $this->productApi->getProductsByCategory($product);
        \var_dump($products);
        //return $this->formatProductResponse($products);
    }

    private function formatProductResponse(string $products): array 
    {
        if (empty($products)) {
            return ['message' => "⚠️ No hay productos disponibles en este momento para esta categoria."];
        }

        // $response[] = "\nIngrese 'menu' para volver al menú principal";
        // return ['message' => implode("\n", $response)];
    }
}
