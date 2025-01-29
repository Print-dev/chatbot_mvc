<?php

namespace Rogelio\ChatBotMvc\Utils;

class MenuClient {
    public function mostrarMenuPrincipal(): string {
        echo "=== MENÚ PRINCIPAL ===\n";
        echo "1. Ver catálogo completo\n";
        echo "2. Buscar producto\n";
        return readline("Seleccione una opción: ");
    }

    public function mostrarCatalogo(array $productos): void {
        echo "\n=== CATÁLOGO DE PRODUCTOS ===\n";
        echo "1. Computadoras \n";
        echo "2. Tablets \n";
        echo "1. celulalres \n";
        readline("\nPresione Enter para continuar...");
    }

    public function pedirTerminoBusqueda(): string {
        return readline("Ingrese el producto a buscar: ");
    }
}