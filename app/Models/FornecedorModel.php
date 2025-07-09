<?php

namespace App\Models;

use CodeIgniter\Model;

class FornecedorModel extends Model
{
	protected $table                = 'fornecedores';
	protected $returnType           = 'App\Entities\Fornecedor';
	protected $useSoftDeletes       = true;
	protected $allowedFields        = [
		'razao',
		'cnpj',
		'ie',
		'telefone',
		'cep',
		'endereco',
		'numero',
		'bairro',
		'cidade',
		'estado',
		'ativo',
	];

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';


	// Validation
	protected $validationRules    = [
		'razao'              => 'required|max_length[230]|is_unique[fornecedores.razao,id,{id}]',
		'cnpj'               => 'required|validaCNPJ|max_length[25]|is_unique[fornecedores.cnpj,id,{id}]', // Não pode ter espaços
		'ie'           	     => 'required|max_length[25]|is_unique[fornecedores.ie,id,{id}]', // Não pode ter espaços
		'telefone'           => 'required|max_length[18]|is_unique[fornecedores.telefone,id,{id}]', // Não pode ter espaços
		'cep'                => 'required',
		'endereco'           => 'required',
		'numero'             => 'max_length[45]',
		'bairro'             => 'required',
		'cidade'             => 'required',
		'estado'             => 'required',
	];

	protected $validationMessages = [];
}
