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
        $this->stateRepository->update(['phone' => $phone, 'type' => 'catalog_product_view']);
        return $this->formatProductResponse($products, $product);
    }

    private function formatProductResponse(array $products, string $title): array 
    {
        if (empty($products)) {
            return ['message' => "⚠️ No hay productos disponibles en esta categoría en este momento."];
        }

        $response = [
            "🛍️ *PRODUCTOS DE {$title}* 🛍️",
            "-------------------------------------"
        ];

        foreach ($products as $index => $producto) {
            $numero = $index + 1;
            $precio = number_format($producto['precio'], 2, ',', '.'); // Formato 1.810,00
            $response[] = "\n{$numero}. *{$producto['titulo']}*";
            $response[] = "   🆔 ID: {$producto['idProducto']}";
            $response[] = "   💵 Precio: \${$precio}";
        }

        $response[] = "\n-------------------------------------";
        $response[] = "*ACCIONES DISPONIBLES:*";
        $response[] = "1. Ver detalles/fotos ➡️ Escriba el *ID* del producto";
        $response[] = "2. Volver al catálogo 📂 Escriba 'catalogo'";
        $response[] = "3. Menú principal 🏠 Escriba 'menu'";
        $response[] = "\n🔍 ¿No ves tu producto? Escribe 'buscar producto' para buscar en esta categoría";

        return ['message' => implode("\n", $response)];
    }
}
