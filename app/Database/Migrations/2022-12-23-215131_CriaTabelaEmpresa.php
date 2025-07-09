<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaEmpresa extends Migration
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
			'cliente_id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'null' => true, // será populado depois que o usuário fro criado para o cliente
			],
			'razao'       => [
				'type'       => 'VARCHAR',
				'constraint' => '240',
				'unique' => true,
			],
			'cnpj'       => [
				'type'       => 'VARCHAR',
				'constraint' => '30',
				'unique'     => true,
			],
			'ie'       => [
				'type'       => 'VARCHAR',
				'constraint' => '30',
				'unique'     => true,
			],
			'telefone'       => [
				'type'       => 'VARCHAR',
				'constraint' => '20',
				'unique'     => true,
			],
			'cep'       => [
				'type'       => 'VARCHAR',
				'constraint' => '20',
			],
			'endereco'       => [
				'type'       => 'VARCHAR',
				'constraint' => '128',
			],
			'numero'       => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
				'null'       => true,
			],
			'bairro'       => [
				'type'       => 'VARCHAR',
				'constraint' => '128',
			],
			'cidade'       => [
				'type'       => 'VARCHAR',
				'constraint' => '128',
			],
			'estado'       => [
				'type'       => 'VARCHAR',
				'constraint' => '2',
			],
			'ativo'       => [
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

		$this->forge->addForeignKey('cliente_id', 'clientes', 'id');

		$this->forge->createTable('empresas');
	}

	public function down()
	{
		$this->forge->dropTable('empresas');
	}
}
