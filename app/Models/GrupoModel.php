<?php

namespace App\Models;

use CodeIgniter\Model;

class GrupoModel extends Model
{

	protected $table                = 'grupos';

	protected $returnType           = 'App\Entities\Grupo';
	protected $useSoftDeletes       = true;
	protected $allowedFields        = ['nome', 'descricao', 'exibir'];

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';


	// Validation
	protected $validationRules    = [
		'nome'        => 'required|max_length[120]|is_unique[grupos.nome,id,{id}]', // Não pode ter espaços
		'descricao'     => 'required|max_length[240]',
	];

	protected $validationMessages = [
		'nome'        => [
			'required' => 'O campo Nome é obrigatório.',
		],
	];
}
