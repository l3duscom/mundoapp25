<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaAvaliacao extends Migration
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
			'inscricao_id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'null' => true, // será populado depois que o usuário fro criado para o cliente
			],
			'jurado_id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'null' => true, // será populado depois que o usuário fro criado para o cliente
			],
			'nota_total'       => [
				'type'       => 'DECIMAL',
				'constraint'     => '10,2',
				'null' => true,
			],
			'nota_1'       => [
				'type'       => 'DECIMAL',
				'constraint'     => '10,2',
				'null' => true,
			],
			'nota_2'       => [
				'type'       => 'DECIMAL',
				'constraint'     => '10,2',
				'null' => true,
			],
			'nota_3'       => [
				'type'       => 'DECIMAL',
				'constraint'     => '10,2',
				'null' => true,
			],
			'nota_4'       => [
				'type'       => 'DECIMAL',
				'constraint'     => '10,2',
				'null' => true,
			],
			'nota_5'       => [
				'type'       => 'DECIMAL',
				'constraint'     => '10,2',
				'null' => true,
			],
			'checkin'       => [
				'type'       => 'BOOLEAN',
				'null' => true,
			],
			'aprovado'       => [
				'type'       => 'BOOLEAN',
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

		$this->forge->addForeignKey('inscricao_id', 'inscricoes', 'id');

		$this->forge->createTable('avaliacoes');
	}

	public function down()
	{
		//
	}
}
