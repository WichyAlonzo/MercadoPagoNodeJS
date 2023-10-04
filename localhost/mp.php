<?php
require 'vendor/autoload.php';

// $clientId = '8078773172747523';
// $clientSecret = 'Ckh4d750n8oGN35zDE0xbfiyU4zKBuKO';

$production = true;
if($production === true){
    $clientId = 'XXXXXXXXXXXXXXXXXX';
    $clientSecret = 'XXXXXXXXXXXXXXXXXXXXXX';
    MercadoPago\SDK::setClientId($clientId);
    MercadoPago\SDK::setClientSecret($clientSecret);

}else{
    $publicKey = 'publicKey';
    $accessToken = 'accessToken';
    MercadoPago\SDK::setAccessToken($accessToken);
    MercadoPago\SDK::setPublicKey($publicKey);

}

$nameHosting = 'cactuspay';

MercadoPago\SDK::setClientId($clientId);
MercadoPago\SDK::setClientSecret($clientSecret);

// Obtén los datos desde la URL (usando $_GET)
$codigoCliente = $_POST['nombre'];
$precioCliente = $_POST['precio'];
$cantidadProducto = 1;
$preference = new MercadoPago\Preference();

$item = new MercadoPago\Item();
$item->title = $codigoCliente;
$item->quantity = $cantidadProducto;
$item->unit_price = $precioCliente;

$preference->items = array($item);
$preference->back_urls = array(
    'success' => 'https://' . $nameHosting .  '.wkarbon.com/success', // URL en caso de pago exitoso
    'failure' => 'https://' . $nameHosting .  '.wkarbon.com/fail', // URL en caso de pago fallido
    'pending' => 'https://' . $nameHosting .  '.wkarbon.com/pay-pendient' // URL en caso de pago pendiente
);

// $preference->notification_url = 'https://tusitio.com/notificacion-mp';
$preference->notification_url = 'https://' . $nameHosting .  '.wkarbon.com';

$preference->save();

header('Location: ' . $preference->init_point);
exit();
