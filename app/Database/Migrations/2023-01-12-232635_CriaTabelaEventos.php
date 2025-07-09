<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaEventos extends Migration
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
			'nome'       => [
				'type'       => 'VARCHAR',
				'constraint' => '128',
			],
			'slug'       => [
				'type'       => 'VARCHAR',
				'constraint' => '128',
			],
			'subtitulo'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'free'       => [ // Se o grupo estiver com esse campo como true, então ele será exibido com opção 
				// na hora de definir um responsável técnico pela ordem de serviço
				'type'       => 'BOOLEAN',
				'null' => false,
			],
			'data_inicio'       => [
				'type'       => 'DATE',
				'null' => true,
			],
			'hora_inicio'       => [
				'type'       => 'TIME',
				'null' => true,
			],
			'data_fim'       => [
				'type'       => 'DATE',
				'null' => true,
			],
			'hora_fim'       => [
				'type'       => 'TIME',
				'null' => true,
			],
			'integracao'       => [
				'type'       => 'INT',
				'constraint'     => 5,
			],
			'descricao'       => [
				'type'       => 'TEXT',
				'null' => true,
			],
			'codigo'       => [
				'type'       => 'VARCHAR',
				'constraint' => '30',
			],
			'nomenclatura'       => [
				'type'       => 'VARCHAR',
				'constraint' => '30',
			],
			'produtora'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'proprio'       => [
				'type'       => 'BOOLEAN',
				'null' => false,
			],
			'visibilidade'       => [
				'type'       => 'INT',
				'constraint'     => 5,
			],
			'avatar'       => [
				'type'       => 'VARCHAR',
				'constraint' => '240',
				'null' => true,
				'default' => null,
			],
			'cover'       => [
				'type'       => 'VARCHAR',
				'constraint' => '240',
				'null' => true,
				'default' => null,
			],
			'ativo'       => [
				'type'       => 'BOOLEAN',
				'null' => false,
			],
			'taxa'       => [
				'type'       => 'BOOLEAN',
				'null' => false,
			],
			'assunto' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => true,
			],
			'categoria' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => true,
			],
			'cep' => [
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => true,
			],
			'endereco' => [
				'type' => 'VARCHAR',
				'constraint' => '128',
				'null' => true,
			],
			'numero' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => true,
			],
			'bairro' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => true,
			],
			'cidade' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => true,
			],
			'estado' => [
				'type' => 'VARCHAR',
				'constraint' => '5',
				'null' => true,
			],
			'created_at' => [
				'type' => 'DATETIME',
				'null' => true,
				'default' => null,
			],
			'updated_at' => [
				'type' => 'DATETIME',
				'null' => true,
				'default' => null,
			],
			'deleted_at' => [
				'type' => 'DATETIME',
				'null' => true,
				'default' => null,
			],
		]);

		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('user_id', 'usuarios', 'id');
		$this->forge->addUniqueKey('nome');
		$this->forge->addUniqueKey('slug');

		$this->forge->createTable('eventos');
	}

	public function down()
	{
		$this->forge->dropTable('eventos');
	}
}
