<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaLogs extends Migration
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

			'action' => [
				'type' => 'VARCHAR',
				'constraint' => '128',
			],
			'descricao' => [
				'type' => 'VARCHAR',
				'constraint' => '500',
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

		$this->forge->createTable('logs');
	}

	public function down()
	{
		$this->forge->dropTable('logs');
	}
}
