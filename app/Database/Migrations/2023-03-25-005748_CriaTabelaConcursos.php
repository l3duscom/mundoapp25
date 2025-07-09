<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaConcursos extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'auto_increment' => true,
			],
			'event_id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'null' => true, // será populado depois que o usuário fro criado para o cliente
			],

			'nome' => [
				'type' => 'VARCHAR',
				'constraint' => '128',
			],

			'tipo' => [
				'type' => 'VARCHAR',
				'constraint' => '128',
			],
			'ativo'       => [
				'type'       => 'BOOLEAN',
				'null' => false,
			],
			'executado'       => [
				'type'       => 'BOOLEAN',
				'null' => false,
			],
			'data_execucao'       => [
				'type'       => 'DATE',
				'null' => true,
			],

			'created_at'       => [
				'type'       => 'DATETIME',
				'null' => true,
				'default' => null,
			],
			'updated_at'       => [
				'type'       => 'DATETIME',
				'null' => true,
				'default' => null,
			],
			'deleted_at'       => [
				'type'       => 'DATETIME',
				'null' => true,
				'default' => null,
			],
		]);

		$this->forge->addKey('id', true);

		$this->forge->addForeignKey('event_id', 'eventos', 'id');

		$this->forge->createTable('concursos');
	}

	public function down()
	{
		//
	}
}
