<?php

namespace App\Models;

use CodeIgniter\Model;

class EventoModel extends Model
{
	protected $table                = 'eventos';
	protected $returnType = 'App\Entities\EventoEntity';
	protected $useSoftDeletes = true;
	protected $allowedFields        = [
		'user_id',
		'local',
		'categoria',
		'cep',
		'endereco',
		'numero',
		'bairro',
		'cidade',
		'estado',
		'nome',
		'assunto',
		'categoria',
		'descricao',
		'data_inicio',
		'hora_inicio',
		'data_fim',
		'hora_fim',
		'nomenclatura',
		'taxa',
		'integracao',
		'proprio',
		'ativo',
		'slug',
		'free',
		'codigo',
		'produtora',
		'visibilidade',
		'avatar',
		'cover',
		'meta_pixel_id',
		'meta_pixel_view_content',
		'meta_pixel_add_to_cart',
		'meta_pixel_initiate_checkout',
		'meta_pixel_purchase',
		'meta_pixel_lead',

	];

	// Dates
	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';

	// Callbacks
	protected $allowCallbacks = true;
	protected $beforeInsert = ['generateSlug', 'generateCodigo'];
	protected $beforeUpdate = ['generateSlug'];

	// Validation
	protected $validationRules = [
		'nome' => 'required|min_length[3]|max_length[250]',
	];

	protected $validationMessages = [];



	protected function generateSlug(array $data): array
	{
		$nome = $data['data']['nome'];
		if (isset($nome)) {

			$data['data']['slug'] = strtolower(mb_url_title($nome));
		}
		return $data;
	}

	protected function generateCodigo(array $data): array
	{
		if (isset($data['data']['nome'])) {
			$data['data']['codigo'] = strtoupper(random_string('alnum', 20));
		}
		return $data;
	}
}
