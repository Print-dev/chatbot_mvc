<?php

require_once '../../../api/productsApi.php';
require_once '../../../repositorys/stateRepository.php';


class mainProductDetails
{
    public function __construct(protected productsApi $productApi,  protected stateRepository $stateRepository)
    {
        
    }

    // aca manejaremos ya como tal, el detalle de ese producto, con fotos y preguntando si comprara.
    public function handleInput($message, $phone, $additional_infos)
    {
        $productDetail = $this->productApi->getProductById($message, $additional_infos);
        if(!empty($productDetail))
        {
            $this->stateRepository->update(['phone' => $phone, 'type' => 'product_sale_view', 'additional_info' => $productDetail['titulo']]);
        }
        return $this->formatProductResponse($productDetail);
    }
    
    private function formatProductResponse(array $product): array 
    {
        if (empty($product)) {
            return ['message' => "⚠️ No hay información disponible para este producto en este momento."];
        }

        // Formatear el precio
        $precio = number_format($product['precio'], 2, ',', '.'); // Formato 1.810,00

        // Construir la respuesta
        $response = [
            "🛍️ *DETALLES DEL PRODUCTO* 🛍️",
            "-------------------------------------",
            "\n*{$product['titulo']}*",
            "   💵 Precio: \${$precio}",
            "   📸 *Imágenes del producto:*",
            "     - {$product['imagen1']}",
            "     - {$product['imagen2']}",
            "     - {$product['imagen3']}",
            "     - {$product['imagen4']}",
            "\n-------------------------------------",
            "*¿Estás interesado en hacer este pedido?* Escribe 'si' para continuar.",
            "\n*ACCIONES DISPONIBLES:*",
            "1. Volver al catálogo 📂 Escriba 'catalogo'",
            "2. Menú principal 🏠 Escriba 'menu'",
            "\n🔍 ¿Necesitas más ayuda? Escribe 'buscar producto' para buscar otro producto."
        ];

        return ['message' => implode("\n", $response)];
    }
}