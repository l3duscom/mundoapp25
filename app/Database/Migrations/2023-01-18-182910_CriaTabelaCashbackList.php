<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaCashbackList extends Migration
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
			'imagem'       => [
				'type'       => 'VARCHAR',
				'constraint' => '240',
				'unique' => true,
			],
			'url'       => [
				'type'       => 'VARCHAR',
				'constraint' => '240',
				'unique' => true,
			],
			'titulo'       => [
				'type'       => 'VARCHAR',
				'constraint' => '240',
				'unique' => true,
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

		$this->forge->createTable('lista_cachback');
	}

	public function down()
	{
		$this->forge->dropTable('lista_cachback');
	}
}
