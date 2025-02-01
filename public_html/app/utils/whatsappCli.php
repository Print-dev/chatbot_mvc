<?php

class whatsappCli {

    public function __construct()
    {
        
    }

    public function renderMenu()
    {
        echo <<<EOD

        ✨🛒 *BIENVENIDO A LA TIENDA VIRTUAL* 🛍️✨
        ═══════════════════════════════

        📌 *MENÚ PRINCIPAL*

        1. 📚 _Catálogo Completo_
        2. 🔍 _Búsqueda de Productos_
        3. 💻 _Puntos de Venta_
        4. ❓ _Preguntas Frecuentes_

        _Escribe el número de la opción (1-4)_

        ═══════════════════════════════
        🎁 ¡Encuentra ofertas increíbles! 
        💰 Los mejores precios garantizados
        EOD;
    }
    public function renderSearchProduct()
    {
        echo <<<EOD
            🔍 *BÚSQUEDA DE PRODUCTOS* 🔍
            ═══════════════════════════════

            Por favor, escribe *el nombre completo* del producto que deseas buscar:

            📌 Ejemplos:
            • "Monitor Dell 20 pulgadas"
            • "Impresora HP LaserJet"
            • "Teclado mecánico RGB"

            💡 *Consejo:* Cuanto más específico seas, mejores resultados obtendrás!
            🚪 Para voler al menú escribe 'menu'

            ═══════════════════════════════
            🎁 ¡Encuentra lo que necesitas! 
            🔎 Búsqueda rápida y precisa
        EOD;
    }
}