<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transacoes';
    protected $returnType = 'App\Entities\Transaction';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'pedido_id',
        'charge_id',
        'expire_at',
        'barcode',
        'qrcode',
        'qrcode_image',
        'link',
        'billet_link',
        'pdf',
        'payment',
        'cretade_at',

    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'charge_id' => 'required',

    ];

    protected $validationMessages = [];

    public function geraCodigoPedido(): string
    {
        do {
            $codigo = strtoupper(random_string('alnum', 20));

            $this->select('codigo')->where('codigo', $codigo);
        } while ($this->countAllResults() > 1);

        return $codigo;
    }

    public function recuperaTransaction(string $id)
    {

        $atributos = [
            'pedido_id',
            'charge_id',
            'expire_at',
            'barcode',
            'qrcode',
            'qrcode_image',
            'link',
            'billet_link',
            'pdf',
            'payment',
            'installment_value',
            'created_at',
        ];

        return $this->select($atributos)
            ->where('charge_id', $id)
            ->first();
    }
}
