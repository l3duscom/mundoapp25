<?php

require '../vendor/autoload.php';


use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

$clientId = 'Client_Id_3047ae29f998bec6cd44936faa8429ef87c76153'; // insira seu Client_Id, conforme o ambiente (Des ou Prod)
$clientSecret = 'Client_Secret_6f705e8a2406fc707e38f1054b779b304da39f72'; // insira seu Client_Secret, conforme o ambiente (Des ou Prod)

$options = [
    'client_id' => $clientId,
    'client_secret' => $clientSecret,
    'sandbox' => false // altere conforme o ambiente (true = Homologação e false = producao)
];

$token = $_POST["notification"];

$servername = "mysql246.umbler.com";
$database = "mundo_app";
$username = "mundo_app";
$password = "P4|2*mLQuR";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully";

$sql = "INSERT INTO auditoria (acao, descricao) VALUES ('Test', 'Testing')";
if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}






$params = [
    'token' => $token
];

try {
    $api = new Gerencianet($options);
    $chargeNotification = $api->getNotification($params, []);
    // Para identificar o status atual da sua transação você deverá contar o número de situações contidas no array, pois a última posição guarda sempre o último status. Veja na um modelo de respostas na seção "Exemplos de respostas" abaixo.

    // Veja abaixo como acessar o ID e a String referente ao último status da transação.

    // Conta o tamanho do array data (que armazena o resultado)
    $i = count($chargeNotification["data"]);
    // Pega o último Object chargeStatus
    $ultimoStatus = $chargeNotification["data"][$i - 1];
    // Acessando o array Status
    $status = $ultimoStatus["status"];
    // Obtendo o ID da transação        
    $charge_id = $ultimoStatus["identifiers"]["charge_id"];
    // Obtendo a String do status atual
    $statusAtual = $status["current"];

    if ($statusAtual == 'paid') {
        $statusAtual = 'CONFIRMED';
    }


    $sql2 = "UPDATE pedidos SET `status` = '$statusAtual' WHERE charge_id =$charge_id";
    if (mysqli_query($conn, $sql2)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);

    // Com estas informações, você poderá consultar sua base de dados e atualizar o status da transação especifica, uma vez que você possui o "charge_id" e a String do STATUS

    echo "O id da transação é: " . $charge_id . " seu novo status é: " . $statusAtual;

    //print_r($chargeNotification);
} catch (GerencianetException $e) {
    print_r($e->code);
    print_r($e->error);
    print_r($e->errorDescription);
} catch (Exception $e) {
    print_r($e->getMessage());
}
