<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaCupons extends Migration
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
			'evento_id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'null' => true,
			],
			'nome'       => [
				'type'       => 'VARCHAR',
				'constraint' => '240',
				'unique' => true,
			],
			'desconto'       => [
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

		$this->forge->addForeignKey('evento_id', 'eventos', 'id');

		$this->forge->createTable('cupons');
	}

	public function down()
	{
		$this->forge->dropTable('cupons');
	}
}
