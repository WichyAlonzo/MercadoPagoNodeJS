<?php
require 'vendor/autoload.php';

// Configura tus credenciales de API de Mercado Pago
$clientId = '8078773172747523';
$clientSecret = 'Ckh4d750n8oGN35zDE0xbfiyU4zKBuKO';
$nameHosting = '';

// Crea una instancia de la clase MercadoPago
MercadoPago\SDK::setClientId($clientId);
MercadoPago\SDK::setClientSecret($clientSecret);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperamos los datos enviados mediante AJAX
    $codigo = $_POST["codigo"];
    $price = $_POST["price"];

    $preference = new MercadoPago\Preference();

    // Crea un objeto de ítem de compra
    $item = new MercadoPago\Item();
    $item->title = $codigo; // Nombre del producto (puedes personalizarlo o pasar un parámetro desde la URL también)
    $item->quantity = 1; // Utilizamos los parámetros recibidos desde la URL
    $item->unit_price = $price; // Utilizamos los parámetros recibidos desde la URL

    // Agrega el ítem a la preferencia
    $preference->items = array($item);

    // Configura las URLs de redirección después del pago
    $preference->back_urls = array(
        'success' => 'https://' . $nameHosting .  '.wkarbon.com.com/success', // URL en caso de pago exitoso
        'failure' => 'https://' . $nameHosting .  '.wkarbon.com/fail', // URL en caso de pago fallido
        'pending' => 'https://' . $nameHosting .  '.wkarbon.com/pay-pendient' // URL en caso de pago pendiente
    );

    // Configura una URL de notificación para recibir el estado del pago
    $preference->notification_url = 'https://' . $nameHosting .  '.wkarbon.com';

    // Guarda la preferencia en Mercado Pago
    $preference->save();

    // Redirige al usuario a la página de pago de Mercado Pago
    header('Location: ' . $preference->init_point);
    exit();

    // http://localhost:8080/procesar_compra.php?precio=15

}
