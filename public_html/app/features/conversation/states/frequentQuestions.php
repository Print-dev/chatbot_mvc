<?php


class frequentQuestions
{
    
    public function __construct()
    {
        
    }
    public function getInformation()
    {
        echo <<<EOD
            ❓ Preguntas Frecuentes (FAQ)
            
            🔹 ¿Puedo usar el sistema en varios dispositivos? 📱💻
            Sí, dependiendo del plan elegido, puedes acceder desde múltiples dispositivos.

            🔹 ¿El sistema funciona sin internet? 🌐❌
            Algunas funciones pueden estar disponibles offline, pero se requiere conexión para sincronizar datos.

            🔹 ¿Puedo agregar más usuarios a mi cuenta? 👥✅
            Sí, en los planes Gold y Platinum puedes gestionar múltiples usuarios con permisos personalizados.

            🔹 ¿El sistema genera reportes de ventas? 📊📅
            ¡Sí! Puedes ver reportes detallados de ventas, productos y clientes en tiempo real.

            🔹 ¿Qué métodos de pago acepta el sistema? 💳💵
            Soporta pagos en efectivo, tarjeta y transferencias, dependiendo de la configuración.

            Para regresar, por favor escriba menu.
        EOD;
    }
}