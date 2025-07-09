<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaIngressos extends Migration
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
			'pedido_id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'null' => true, // será populado depois que o usuário fro criado para o cliente
			],
			'user_id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'null' => true, // será populado depois que o usuário fro criado para o cliente
			],

			'nome' => [
				'type' => 'VARCHAR',
				'constraint' => '128',
			],
			'valor_unitario'       => [
				'type'       => 'DECIMAL',
				'constraint' => '10,2',
			],
			'valor'       => [
				'type'       => 'DECIMAL',
				'constraint' => '10,2',
			],
			'quantidade'          => [
				'type'           => 'INT',
				'constraint'     => 5,
			],
			'codigo' => [
				'type' => 'VARCHAR',
				'constraint' => '128',
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

		$this->forge->addForeignKey('pedido_id', 'pedidos', 'id');

		$this->forge->createTable('ingressos');
	}

	public function down()
	{
		$this->forge->dropTable('ingressos');
	}
}
