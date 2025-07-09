<?php

require '../vendor/autoload.php';


header("Access-Control-Allow-Origin: *");
header('Cache-Control: no-cache, must-revalidate');
header("Content-Type: application/json; charset=UTF-8");



$json = file_get_contents("php://input");
$data = json_decode($json, true);


$payment_id = $data['payment']['id'];
$payment_status = $data['payment']['status'];
$payment_transactionReceiptUrl = $data['payment']['transactionReceiptUrl'];

$servername = "localhost";
$database = "wwdrea_mundoapp";
$username = "wwdrea_ledus";
$password = "TanOA&@+0Rq";


//$servername = "localhost";
//$database = "mundo_app";
//$username = "root";
//$password = "";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully";

$sql = "INSERT INTO auditoria (acao, descricao) VALUES ('Notify', 'Notificação Asaas pay ')";
if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}



$update = "UPDATE pedidos SET `status` = '$payment_status', comprovante = '$payment_transactionReceiptUrl' WHERE charge_id = '$payment_id'";
if (mysqli_query($conn, $update)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $update . "<br>" . mysqli_error($conn);
}



mysqli_close($conn);
