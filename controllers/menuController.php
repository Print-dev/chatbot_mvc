<?php

namespace Rogelio\ChatBotMvc\Controllers;

use Rogelio\ChatBotMvc\Utils\MenuClient;

class menuController {
    private $menuClient;
    public function __construct(MenuClient $menuClient) {
        $this->menuClient = $menuClient;
    }

    /**
     * 
     * 
    */
    public function ejecutarMenu(): void{
        while (true) {
            $opcion = $this->menuClient->mostrarMenuPrincipal();

            switch ($opcion) {
                case '1':
                   
                    break;
                case '2':
                    
                    break;
                default:
                    echo "Opción inválida, intente nuevamenttte.\n";
            }
        }
    }
}