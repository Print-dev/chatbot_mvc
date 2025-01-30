<?php

namespace Rogelio\ChatBotMvc\Features\Conversation\States;

class PointSale
{
    public function __construct()
    {
        
    }

    public function getInformation()
    {
        echo <<<EOD
            🌟 PUNTOS DE VENTA 🌟            

            Bronce 🥉: Funcionalidades básicas como facturación, gestión de productos e inventario limitado.
            Gold 🥈: Incluye todo lo de Bronce + reportes avanzados, soporte técnico y administración de usuarios.
            Platinum 🥇: Nivel premium con integración de múltiples sucursales, análisis de datos en tiempo real y personalización avanzada.
            
        EOD;
    }
}