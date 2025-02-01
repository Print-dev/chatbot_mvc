<?php

class PointSale
{
    public function __construct()
    {
        
    }

    public function getInformation()
    {
        echo <<<EOD
            ✨🌟✨ PUNTOS DE VENTA ✨🌟✨

            🥉 Bronce:
            - Funcionalidades básicas: facturación, gestión de productos.
            - Inventario limitado.
            - Ideal para pequeños negocios.

            🥈 Gold:
            - Todo lo de Bronce.
            - Reportes avanzados.
            - Soporte técnico prioritario.
            - Administración de usuarios.
            - Perfecto para negocios en crecimiento.

            🥇 Platinum:
            - Todo lo de Gold.
            - Integración de múltiples sucursales.
            - Análisis de datos en tiempo real.
            - Personalización avanzada.
            - La opción premium para empresas grandes.

            💡 Elige el plan que mejor se adapte a tus necesidades.

            Para regresar, por favor escriba menu.
        EOD;
    }
}