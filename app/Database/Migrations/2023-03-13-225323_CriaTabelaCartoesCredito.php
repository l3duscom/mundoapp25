<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaCartoesCredito extends Migration
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
				'null' => true,
			],

			'creditCardNumber' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'creditCardBrand' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'creditCardToken' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
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

		$this->forge->createTable('cartoes_credito');
	}

	public function down()
	{
		//
	}
}
