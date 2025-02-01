<?php

require_once '../../../api/productsApi.php';
require_once '../../../repositorys/stateRepository.php';

class SearchProduct
{
    public function __construct(protected productsApi $productApi, protected stateRepository $stateRepository) {}

    public function handleInput(string $input, string $phone): array
    {
        $products = $this->productApi->getProductByName($input);
        // si hay productos, guardamos el estado para los productos mostrados;
        if(!empty($products))
        {
            $this->stateRepository->update(['phone' => $phone, 'type' => 'search_product_view']);
        }
        return $this->formatProductResponse($products, $input);
    }

    private function formatProductResponse(array $products, string $title): array 
    {
        if (empty($products)) {
            $response[] = "⚠️ No hay productos disponibles en la busquedad de " . $title;
            $response[] = "*ACCIONES DISPONIBLES:*";
            $response[] = "1. Menú principal 🏠 Escriba 'menu'";
            $response[] = "\n🔍 ¿No ves tu producto? Escribe 'buscar producto' nuevamente.";

            return ['message' => implode("\n", $response)];
        }

        $response = [
            "🛍️ *PRODUCTOS DE -{$title}-* 🛍️",
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
        $response[] = "1. Ver detalles(fotos) ➡️ Escriba el *ID* del producto";
        $response[] = "2. Menú principal 🏠 Escriba 'menu'";
        $response[] = "\n🔍 ¿No ves tu producto? Escribe 'buscar producto' nuevamente.";

        return ['message' => implode("\n", $response)];
    }
}