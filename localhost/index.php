<?php
$jsonData = file_get_contents('pedidos.json');
$data = json_decode($jsonData, true);
$pedidoEncontrado = null;

if (isset($_GET['code'])) {
    $valorHola = $_GET['code'];

    if (isset($data['pedidos']) && is_array($data['pedidos'])) {
        foreach ($data['pedidos'] as $pedido) {
            if (isset($pedido['code']) && $pedido['code'] === $valorHola) {
                $pedidoEncontrado = $pedido;
                break;
            }
        }
    }
    if ($pedidoEncontrado !== null) {
        $code = $pedidoEncontrado['code'];
        $nombre = $pedidoEncontrado['nombre'];
        $price = $pedidoEncontrado['price'];
        $phoneNumber = $pedidoEncontrado['phone'];
        function hidePhoneNumber($number) {
            $length = strlen($number);
            $lastFourDigits = substr($number, -4);
            $hiddenDigits = str_repeat("*", $length - 4);
            
                return $hiddenDigits . $lastFourDigits;
        }
        $phone = hidePhoneNumber($phoneNumber);
        $comision = $price * 0.04;
        $extra = 5;

        $totalPay = $comision + $extra + $price;
        $totalPayTarjet = $totalPay;

        if ($totalPayTarjet >= 15.1 && $totalPayTarjet <= 15.4) {
            $totalPayTarjet = 15.5;
            
        } elseif ($totalPayTarjet >= 15.6 && $totalPayTarjet <= 15.9) {
            $totalPayTarjet = 16;
            
        }
    } else {
        header('Location: https://wkarbon.com');
        
    }
} else {
    header('Location: https://wkarbon.com');
    
}
?>


<!DOCTYPE html>
<html data-bs-theme="light" lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Realiza tu pago <?php echo $code?> - CactusPay</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/line-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic-icons.css">
    <link rel="stylesheet" href="assets/css/Testimonials-images.css">
</head>

<body>
    <div class="container py-4 py-xl-5">
        <div class="row">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <h1 style="font-size: 53px;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" style="font-size: 48px;margin-right: 11px;color: rgb(43,43,43);">
                        <path d="M15 4H21V10H15V4Z" fill="currentColor" style="color: #fcbc05;"></path>
                        <path d="M3 12C3 16.9706 7.02944 21 12 21C16.9706 21 21 16.9706 21 12H17C17 14.7614 14.7614 17 12 17C9.23858 17 7 14.7614 7 12H3Z" fill="currentColor" style="color: #4385f5;"></path>
                        <path d="M6 10C7.65685 10 9 8.65685 9 7C9 5.34315 7.65685 4 6 4C4.34315 4 3 5.34315 3 7C3 8.65685 4.34315 10 6 10Z" fill="currentColor" style="color: #ff3333;"></path>
                    </svg>Cactus<strong>Pay</strong></h1>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <h2>Detalles de pago:<span class="m-1" style="color: #34a853;"><strong><?php echo $code ?></strong></span></h2>
            </div>
        </div>
        <div class="row gy-4 row-cols-1 row-cols-sm-2 row-cols-lg-3">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-7">
                <div class="pb-2">
                    <div class="d-flex"><i class="la la-user" style="font-size: 34px;margin-right: 11px;color: rgb(43,43,43);"></i>
                        <div>
                            <p class="fw-bold text-primary mb-0" style="color: #4385f5!important;">Detalles de cliente</p>
                        </div>
                    </div>
                </div>
                <p class="bg-body-tertiary border rounded border-0 p-4"><strong>Nombre Cliente:</strong><span class="details__clients__name style__details"><strong><?php echo $nombre ?></strong></span><br><strong>Numero de Teléfono:</strong><span class="details__clients__phone style__details"><strong><?php echo $phone ?></strong></span><br><strong>Código:</strong><span class="details__clients__code style__details" style="/*margin-left: 176px;*//*color: #34a853;*/"><strong><?php echo $code ?></strong></span></p>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-5 col-xl-5">
                <div class="pb-2">
                    <div class="d-flex"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" style="font-size: 34px;margin-right: 11px;color: rgb(43,43,43);">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11 19V22H13V19H14C16.2091 19 18 17.2091 18 15C18 12.7909 16.2091 11 14 11H13V7H15V9H17V5H13V2H11V5H10C7.79086 5 6 6.79086 6 9C6 11.2091 7.79086 13 10 13H11V17H9V15H7V19H11ZM13 17H14C15.1046 17 16 16.1046 16 15C16 13.8954 15.1046 13 14 13H13V17ZM11 11V7H10C8.89543 7 8 7.89543 8 9C8 10.1046 8.89543 11 10 11H11Z" fill="currentColor"></path>
                        </svg>
                        <div>
                            <p class="fw-bold text-primary mb-0" style="color: #4385f5!important;">Detalles del pedido</p>
                        </div>
                    </div>
                </div>
                <p class="bg-body-tertiary border rounded border-0 p-4"><strong>Detalles de pedido:</strong><br><strong>-------------------------------------------</strong><br><strong>Precio:&nbsp;</strong><span class="details__clients__price" style="margin-left: 176px;/*color: #34a853;*/"><strong>$<?php echo $price ?></strong></span><br><strong>Comisión&nbsp;MP:</strong><span class="details__clients__comision" style="margin-left: 128px;/*color: #34a853;*/"><strong>$<?php echo $comision ?></strong></span><br><strong>Extras:</strong><span class="details__clients__extras" style="margin-left: 182px;/*color: #34a853;*/"><strong>$<?php echo $extra ?></strong></span><br><strong>-------------------------------------------</strong><br><strong>Total:</strong><span class="details__clients__total__mp" style="margin-left: 190px;/*color: #34a853;*/"><strong>$<?php echo $totalPay ?></strong></span></p>
                <div>
                    <form action="mp.php" method="post">
                        <input type="text" id="nombre" name="nombre" required value="<?php echo $code?>" hidden>
                        <input type="number" id="precio" name="precio" min="1" step="0.01" required value="<?php echo $totalPayTarjet?>" hidden>
                        <input type="submit" class="btn btn-primary btn__mercado__pago" type="button" style="background: #4385f5!important;width: 100%;" value="Mercado Pago">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="width: 50%;"><code class="text-center">Pago con Mercado Pago se cobra una comisión del 3.9% + 5 Extras por el uso de API. <br>Si lo que quieres es Realizar tu pago realízalo con Transferencia Electrónica puedes pedirla por WhatsApp <a href="https://wa.link/ur4jg7">Click Aqui</a></code></div>
    <footer class="text-center" style="position: absolute;width: 100%;height: 40px;color: white;/*bottom: 0;*/">
        <div class="container text-muted py-4 py-lg-5">
            <p class="mb-0"><strong>Copyright © 2023 CactusWingsMX</strong></p>
        </div>
    </footer>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>