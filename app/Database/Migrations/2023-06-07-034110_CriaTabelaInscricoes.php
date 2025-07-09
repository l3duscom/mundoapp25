<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaInscricao extends Migration
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
			'concurso_id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
			],
			'user_id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'null' => true, // será populado depois que o usuário fro criado para o cliente
			],
			'codigo' => [
				'type' => 'VARCHAR',
				'constraint' => '128',
			],
			'email' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'motivacao' => [
				'type' => 'VARCHAR',
				'constraint' => '555',
				'null' => true,
			],
			'tempo' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'null' => true, // será populado depois que o usuário fro criado para o cliente
			],
			'nome' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => true,
			],
			'nome_social' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'personagem' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => true,
			],
			'obra' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => true,
			],
			'genero' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => true,
			],
			'referencia' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => true,
			],
			'apoio' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => true,
			],
			'observacoes' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => true,
			],
			'video_apresentacao' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => true,
			],
			'categoria' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => true,
			],
			'marca' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => true,
			],
			'video_led' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => true,
			],
			'musica' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => true,
			],
			'integrantes' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'null' => true,
			],
			'musica' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => true,
			],
			'grupo' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => true,
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

		$this->forge->addForeignKey('concurso_id', 'concursos', 'id');

		$this->forge->createTable('inscricoes');
	}

	public function down()
	{
		//
	}
}
