<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaCartao extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'user_id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'null' => true, // será populado depois que o usuário fro criado para o cliente
			],
			'matricula'       => [
				'type'       => 'VARCHAR',
				'constraint' => '240',
				'unique' => true,
			],
			'bloqueado'       => [
				'type'       => 'BOOLEAN',
				'null' => false,
			],
			'status'       => [
				'type'       => 'VARCHAR',
				'constraint' => '240',
				'unique' => true,
			],
			'via' => [
				'type' => 'INT',
				'constraint' => 5,
				'null' => true,
			],
			'expiration'       => [
				'type'       => 'DATETIME',
				'default' => null,
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

		$this->forge->createTable('cartoes');
	}

	public function down()
	{
		$this->forge->dropTable('cartoes');
	}
}
