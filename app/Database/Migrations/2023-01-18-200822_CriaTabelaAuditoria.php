<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaAuditoria extends Migration
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
				'null' => true,
			],
			'acao'       => [
				'type'       => 'VARCHAR',
				'constraint' => '240',
				'unique' => true,
			],
			'descricao'       => [
				'type'       => 'VARCHAR',
				'constraint' => '240',
				'unique' => true,
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

		$this->forge->createTable('auditoria');
	}

	public function down()
	{
		$this->forge->dropTable('auditoria');
	}
}
