<?php

namespace Rogelio\ChatBotMvc\Features\Conversation\States;

use Rogelio\ChatBotMvc\Api\productsApi;
use Rogelio\ChatBotMvc\Repositorys\stateRepository;

class SearchProduct
{
    public function __construct(protected productsApi $productApi, protected stateRepository $stateRepository) {}

    public function handleInput(string $input, string $phone): array
    {
        $products = $this->productApi->getProductByName($input);
        \var_dump($products);
        //$this->stateRepository->update(['phone' => $phone, 'type' => 'search_product_view']);
        return $this->formatProductResponse($products, $input);
    }

    private function formatProductResponse(array $products, string $title): array 
    {
        if (empty($products)) {
            return ['message' => "⚠️ No hay productos disponibles en la busquedad de " . $title . ""];
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