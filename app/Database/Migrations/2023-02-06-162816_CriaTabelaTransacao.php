<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaTransacao extends Migration
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
			'charge_id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'null' => true, // será populado depois que o usuário fro criado para o cliente
			],
			'expire_at' => [
				'type' => 'VARCHAR',
				'constraint' => '128',
			],
			'barcode' => [
				'type' => 'VARCHAR',
				'constraint' => '500',
			],
			'qrcode' => [
				'type' => 'VARCHAR',
				'constraint' => '500',
			],
			'qrcode_image' => [
				'type' => 'VARCHAR',
				'constraint' => '500',
			],
			'link' => [
				'type' => 'VARCHAR',
				'constraint' => '500',
			],
			'billet_link' => [
				'type' => 'VARCHAR',
				'constraint' => '500',
			],
			'pdf' => [
				'type' => 'VARCHAR',
				'constraint' => '500',
			],
			'payment' => [
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

		$this->forge->addForeignKey('pedido_id', 'pedidos', 'id');

		$this->forge->createTable('transacoes');
	}

	public function down()
	{
		$this->forge->dropTable('transacoes');
	}
}
