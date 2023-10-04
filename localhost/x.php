<?php
// Obtener los datos del formulario
$code = $_POST['code'];
$nombre = $_POST['nombre'];
$price = $_POST['price'];
$phone = $_POST['phone'];

// Obtener el contenido actual del archivo JSON
$jsonFile = 'pedidos.json';
$currentData = file_get_contents($jsonFile);
$data = json_decode($currentData, true);

// Agregar los nuevos datos al arreglo "pedidos"
$data['pedidos'][] = array(
    "code" => $code,
    "nombre" => $nombre,
    "price" => $price,
    "phone" => $phone
);

// Guardar el archivo JSON actualizado
file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT));
exit();
?>
