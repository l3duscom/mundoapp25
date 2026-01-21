<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPremiumFieldsToUsuarios extends Migration
{
    public function up()
    {
        $this->forge->addColumn('usuarios', [
            'is_premium' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'null' => false,
                'after' => 'pontos'
            ],
            'premium_ate' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'is_premium'
            ],
            'asaas_subscription_id' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'after' => 'premium_ate'
            ],
        ]);

        // Adicionar índice para consultas de premium
        $this->db->query('CREATE INDEX idx_usuarios_premium ON usuarios(is_premium, premium_ate)');
    }

    public function down()
    {
        $this->db->query('DROP INDEX idx_usuarios_premium ON usuarios');
        $this->forge->dropColumn('usuarios', ['is_premium', 'premium_ate', 'asaas_subscription_id']);
    }
}
