<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaPedidos extends Migration
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
			'user_id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'null' => true,
			],
			'endereco_id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'null' => true,
			],
			'codigo'       => [
				'type'       => 'VARCHAR',
				'constraint' => '240',
				'unique' => true,
			],
			'rastreio'       => [
				'type'       => 'VARCHAR',
				'constraint' => '240',
				'unique' => true,
			],
			'total'       => [
				'type'       => 'DECIMAL',
				'constraint' => '10,2',
			],
			'data_vencimento'       => [
				'type'       => 'DATE',
			],
			'status'       => [
				'type'       => 'VARCHAR',
				'constraint' => '240',
			],
			'status_entrega'       => [
				'type'       => 'VARCHAR',
				'constraint' => '240',
			],
			'frete'       => [
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

		$this->forge->addForeignKey('evento_id', 'eventos', 'id');
		$this->forge->addForeignKey('user_id', 'usuarios', 'id');
		$this->forge->addForeignKey('endereco_id', 'enderecos', 'id');

		$this->forge->createTable('pedidos');
	}

	public function down()
	{
		$this->forge->dropTable('pedidos');
	}
}
