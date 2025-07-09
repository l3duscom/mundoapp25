<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelCredencial extends Migration
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
			'ingresso_id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'null' => true, // será populado depois que o usuário fro criado para o cliente
			],

			'codigo' => [
				'type' => 'VARCHAR',
				'constraint' => '128',
			],
			'acessos' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'null' => true, // será populado depois que o usuário fro criado para o cliente
			],
			'ativo'       => [
				'type'       => 'BOOLEAN',
				'null' => false,
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

		$this->forge->addForeignKey('ingresso_id', 'ingressos', 'id');

		$this->forge->createTable('credenciais');
	}

	public function down()
	{
		//
	}
}
