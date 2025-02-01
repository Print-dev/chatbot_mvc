<?php


require_once '../../../repositorys/stateRepository.php';

class productSale
{
    public function __construct(protected stateRepository $stateRepository)
    {
        
    }

    public function handleInput(string $input, string $phone, string $additional_info): array
    {
        // Si la entrada es 'si' o 'sí', se confirma la compra
        if ($input == "si" || $input == "sí") {
            $this->stateRepository->update(['phone' => $phone, 'type' => 'view_menu']);
            return $this->messageByUser($additional_info);
        } else {
            // Aquí podrías manejar otras entradas, como volver al menú o cancelar
            return ['message' => "❌ Entrada no reconocida. Por favor, escribe 'si' para confirmar tu pedido o menu para regresar"];
        }
    }

    public function messageByUser(): array
    {
        // Mensaje de confirmación de compra
        $confirmacionCompra = [
            "¡🎉 *Gracias por tu compra*! 🎉",
            "-------------------------------------",
            "Tu pedido ha sido procesado con éxito y ha sido enviado a uno de nuestros trabajadores.",
            "Pronto se pondrán en contacto contigo para coordinar los detalles de tu compra.",
            "-------------------------------------",
            "📞 *Contacto*: Si tienes alguna pregunta, no dudes en comunicarte con nosotros (escribe 'menu' para ver las opciones).",
            "🛒 *Gracias por confiar en nosotros*.",
            "¡Esperamos verte de nuevo pronto! 😊",
        ];

        // Menú principal
        $menuPrincipal = [
            "✨*ACCIONES DISPONIBLES*✨",
            "═══════════════════════════════",
            "📌 *MENÚ PRINCIPAL*",
            "",
            "1. 📚 _Catálogo Completo_",
            "2. 🔍 _Búsqueda de Productos_",
            "3. 💻 _Puntos de Venta_",
            "4. ❓ _Preguntas Frecuentes_",
            "",
            "_Escribe el número de la opción (1-4)_",
            "═══════════════════════════════",
            "🎁 ¡Encuentra ofertas increíbles!",
            "💰 Los mejores precios garantizados",
        ];

        // Combinar los mensajes (primero la confirmación, luego el menú)
        $response = array_merge($confirmacionCompra, [""], $menuPrincipal);

        return ['message' => implode("\n", $response)];
    }
}