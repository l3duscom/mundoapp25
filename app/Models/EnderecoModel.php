<?php

namespace App\Models;

use CodeIgniter\Model;

class EnderecoModel extends Model
{
	protected $table                = 'enderecos';
	protected $returnType = 'App\Entities\Endereco';
	protected $useSoftDeletes = true;
	protected $allowedFields        = [
		'pedido_id',
		'user_id',
		'cep',
		'endereco',
		'numero',
		'bairro',
		'cidade',
		'estado',

	];

	// Dates
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';



	// Validation
	protected $validationRules = [
		'cep' => 'required',
	];

	protected $validationMessages = [];
}
