<?php
// Versão simples do notify que funciona como o original

header("Access-Control-Allow-Origin: *");
header('Cache-Control: no-cache, must-revalidate');
header("Content-Type: application/json; charset=UTF-8");

$json = file_get_contents("php://input");
$data = json_decode($json, true);

if (!$data || !isset($data['payment'])) {
    echo json_encode(['error' => 'Dados de pagamento ausentes ou inválidos']);
    exit;
}

$payment_id = $data['payment']['id'] ?? null;
$payment_status = $data['payment']['status'] ?? null;
$payment_transactionReceiptUrl = $data['payment']['transactionReceiptUrl'] ?? null;

if (!$payment_id || !$payment_status) {
    echo json_encode(['error' => 'Dados obrigatórios não encontrados']);
    exit;
}

// Configuração do banco de dados
$servername = "localhost";
$database = "wwdrea_mundoapp";
$username = "wwdrea_ledus";
$password = "TanOA&@+0Rq";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    echo json_encode(['error' => 'Connection failed: ' . mysqli_connect_error()]);
    exit;
}

// Auditoria
$sql = "INSERT INTO auditoria (acao, descricao, created_at) VALUES ('Notify', 'Notificação Asaas pay - ID: $payment_id - Status: $payment_status', NOW())";
if (!mysqli_query($conn, $sql)) {
    echo json_encode(['error' => 'Erro na auditoria: ' . mysqli_error($conn)]);
    mysqli_close($conn);
    exit;
}

// Atualiza pedido
$update = "UPDATE pedidos SET status = '$payment_status', comprovante = '$payment_transactionReceiptUrl', updated_at = NOW() WHERE charge_id = '$payment_id'";
if (mysqli_query($conn, $update)) {
    echo json_encode(['status' => 'success', 'message' => 'Pedido atualizado com sucesso']);
} else {
    echo json_encode(['error' => 'Erro ao atualizar pedido: ' . mysqli_error($conn)]);
}

mysqli_close($conn);
?> 