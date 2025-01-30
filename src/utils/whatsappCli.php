<?php

namespace Rogelio\ChatBotMvc\Utils;

class whatsappCli {

    public function __construct()
    {
        
    }

    public function renderMenu()
    {
        echo <<<EOD

        🌟 *TIENDA VIRTUAL* 🌟
        ========================
        
        📋 *Menú Principal*
        
        1. 📚 Ver Catálogo Completo
        2. 🔍 Buscar Producto
        3.  Punto de venta
        4.  Preguntras frecuentes      
        _Envía el número de la opción deseada_
        ========================
        🛍️ ¡Encuentra tus productos favoritos! 🛍️
        
        EOD;
    }
}