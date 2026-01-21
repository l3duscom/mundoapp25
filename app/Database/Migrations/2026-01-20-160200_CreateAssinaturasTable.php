<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAssinaturasTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'usuario_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'plano_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'asaas_subscription_id' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'asaas_customer_id' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['PENDING', 'ACTIVE', 'OVERDUE', 'CANCELLED', 'EXPIRED'],
                'default' => 'PENDING',
            ],
            'data_inicio' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'data_fim' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'proximo_vencimento' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'valor_pago' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
            ],
            'forma_pagamento' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('usuario_id');
        $this->forge->addKey('plano_id');
        $this->forge->addKey('status');
        $this->forge->addKey('asaas_subscription_id');
        $this->forge->createTable('assinaturas');
    }

    public function down()
    {
        $this->forge->dropTable('assinaturas');
    }
}
