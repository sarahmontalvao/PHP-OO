<?php

require_once(__DIR__ . '/../../vendor/autoload.php');

use chillerlan\QRCode\QRCode;

if(isset($_POST['qrCode'])){
    print_r($_POST);
    $id = $_POST['id'];


$qrcode = new QRCode();

$data = 'https://192.168.0.103/objetos/acessoExterno/view/formulario.php?id=' . $id;
echo $data;
$image = (new QRCode)->render($data); // Armazene a imagem base64 em uma variável diferente

// default output is a base64 encoded data URI
//printf('<img src="%s" alt="QR Code" />', $image);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar QR Code</title>
</head>
<body>

    <h1>QR Code</h1>

    <!-- Exibindo o QR code -->
    <img src="<?php echo $image; ?>" alt="QR Code" style="height: 150px;">


</body>
</html>