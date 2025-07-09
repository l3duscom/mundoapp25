<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaEnderecos extends Migration
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
			'user_id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'null' => true, // será populado depois que o usuário fro criado para o cliente
			],

			'cep' => [
				'type' => 'VARCHAR',
				'constraint' => '20',
			],
			'endereco' => [
				'type' => 'VARCHAR',
				'constraint' => '128',
			],
			'numero' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => true,
			],
			'bairro' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
			'cidade' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
			'estado' => [
				'type' => 'VARCHAR',
				'constraint' => '5',
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

		$this->forge->addForeignKey('user_id', 'usuarios', 'id');

		$this->forge->createTable('enderecos');
	}

	public function down()
	{
		$this->forge->dropTable('enderecos');
	}
}
