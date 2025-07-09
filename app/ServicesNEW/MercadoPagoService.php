<?php

namespace App\Services;

use MercadoPago;


class MercadoPagoService
{


    public function create()
    {

        $access_token = "TEST-4187391579192936-010717-87c0c8befa2e55e2e9045210417bd93e-613926042";
        MercadoPago\SDK::setAccessToken($access_token);
        $payment = new MercadoPago\Payment();

        $payment->transaction_amount = 10.4;
        $payment->token = $_POST['token'];
        $payment->description = $_POST['description'];
        $payment->installments = (int)$_POST['installments'];
        $payment->payment_method_id = $_POST['paymentMethodId'];
        $payment->issuer_id = (int)$_POST['issuer'];

        $payer = new MercadoPago\Payer();
        $payer->email = $_POST['email'];
        $payer->identification = array(
            "type" => $_POST['identificationType'],
            "number" => $_POST['identificationNumber']
        );
        $payment->payer = $payer;

        $payment->save();

        $response = array(
            'status' => $payment->status,
            'status_detail' => $payment->status_detail,
            'id' => $payment->id
        );
        echo json_encode($response);
    }
}
