<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAssinaturaHistoricosTable extends Migration
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
            'assinatura_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'evento' => [
                'type' => 'ENUM',
                'constraint' => ['CREATED', 'PAYMENT_CONFIRMED', 'PAYMENT_FAILED', 'RENEWED', 'CANCELLED', 'EXPIRED', 'REACTIVATED'],
                'default' => 'CREATED',
            ],
            'descricao' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'dados_json' => [
                'type' => 'TEXT',
                'null' => true,
                'comment' => 'Dados adicionais em JSON',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('assinatura_id');
        $this->forge->addKey('evento');
        $this->forge->createTable('assinatura_historicos');
    }

    public function down()
    {
        $this->forge->dropTable('assinatura_historicos');
    }
}
