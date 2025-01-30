<?php

namespace Rogelio\ChatBotMvc\Api;

class productsApi
{
    public function __construct()
    {

    }

     public static function getAllCategory()
    {
        $url = "https://equiposdehonduras.catalago.info/api/categories.php";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPGET, true);      
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer 623238a0b9838a8f1474b7a85z4ea98d78d05de93ffa4e840ee12444b63dff28'
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error en cURL: ' . curl_error($ch);
            curl_close($ch);
            return null;
        }

        $responseData = json_decode($response, true);
        curl_close($ch);
        return array_column($responseData['categories'], 'categoria') ?? [];
    }

    public function getProductsByCategory($categoryName)
    {
        $url = "https://equiposdehonduras.catalago.info/api/products.php?categoria=" . urlencode($categoryName);

        // Configuración del CURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_HTTPGET, true);        
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer 623238a0b9838a8f1474b7a85z4ea98d78d05de93ffa4e840ee12444b63dff28'
        ]);

        // Ejecutar la solicitud y obtener la respuesta
        $response = curl_exec($ch);

        // Verificar si hubo errores en la solicitud
        if (curl_errno($ch)) {
            echo 'Error en cURL: ' . curl_error($ch);
            curl_close($ch);
            return null;
        }

        // Decodificar la respuesta JSON
        $responseData = json_decode($response, true);
        curl_close($ch);
        return $responseData ?? [];
    }

    public function getProductById($id, $category)
    {
        $url = "https://equiposdehonduras.catalago.info/api/products.php?categoria=" . urlencode($category) . "&id=" . urlencode($id);

        // Configuración del CURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_HTTPGET, true);        
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer 623238a0b9838a8f1474b7a85z4ea98d78d05de93ffa4e840ee12444b63dff28'
        ]);

        // Ejecutar la solicitud y obtener la respuesta
        $response = curl_exec($ch);

        // Verificar si hubo errores en la solicitud
        if (curl_errno($ch)) {
            echo 'Error en cURL: ' . curl_error($ch);
            curl_close($ch);
            return null;
        }

        // Decodificar la respuesta JSON
        $responseData = json_decode($response, true);
        curl_close($ch);
        error_log(print_r($responseData, true));
        return $responseData ?? null;
    }

    public function getProductByName($name)
    {
        $url = "https://equiposdehonduras.catalago.info/api/products.php?products=" . urlencode($name) ;

        // Configuración del CURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_HTTPGET, true);        
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer 623238a0b9838a8f1474b7a85z4ea98d78d05de93ffa4e840ee12444b63dff28'
        ]);

        // Ejecutar la solicitud y obtener la respuesta
        $response = curl_exec($ch);

        // Verificar si hubo errores en la solicitud
        if (curl_errno($ch)) {
            echo 'Error en cURL: ' . curl_error($ch);
            curl_close($ch);
            return null;
        }

        // Decodificar la respuesta JSON
        $responseData = json_decode($response, true);
        curl_close($ch);
        error_log(print_r($responseData, true));
        return $responseData ?? [];
    }
}