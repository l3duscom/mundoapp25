<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRefoundsTable extends Migration
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
            'pedido_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'cliente_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'tipo_solicitacao' => [
                'type' => 'ENUM',
                'constraint' => ['upgrade', 'reembolso'],
                'default' => 'upgrade',
            ],
            'aceito' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'comment' => '1 = aceito upgrade, 0 = recusou (reembolso)',
            ],
            // Informações do pedido original
            'pedido_codigo' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'pedido_valor_total' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            'pedido_data_compra' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'pedido_forma_pagamento' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'pedido_status' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            // Informações do cliente
            'cliente_nome' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'cliente_email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            // Informações do evento original
            'evento_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'evento_nome' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'evento_data_inicio' => [
                'type' => 'DATE',
                'null' => true,
            ],
            // Ingressos originais (JSON)
            'ingressos_originais' => [
                'type' => 'TEXT',
                'null' => true,
                'comment' => 'JSON com lista de ingressos originais',
            ],
            // Oferta apresentada
            'tipo_upgrade' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
                'comment' => 'EPIC PASS ou VIP FULL',
            ],
            'oferta_titulo' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'oferta_subtitulo' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'oferta_vantagem_valor' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
                'comment' => 'Valor da vantagem em reais',
            ],
            'opcao_selecionada' => [
                'type' => 'INT',
                'constraint' => 2,
                'default' => 0,
                'comment' => 'Índice da opção selecionada quando há múltiplas',
            ],
            // Detalhes completos da oferta (JSON)
            'oferta_detalhes' => [
                'type' => 'TEXT',
                'null' => true,
                'comment' => 'JSON com todos os detalhes da oferta apresentada',
            ],
            // Benefícios apresentados (JSON)
            'beneficios_apresentados' => [
                'type' => 'TEXT',
                'null' => true,
                'comment' => 'JSON com lista de benefícios exibidos',
            ],
            // Ingressos para upgrade (JSON)
            'ingressos_para_upgrade' => [
                'type' => 'TEXT',
                'null' => true,
                'comment' => 'JSON com detalhes dos ingressos a serem atualizados',
            ],
            // Informações extras
            'ip_solicitacao' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => true,
            ],
            'user_agent' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
                'null' => true,
            ],
            'observacoes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            // Status do processamento
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pendente', 'processando', 'concluido', 'cancelado', 'erro'],
                'default' => 'pendente',
            ],
            'processado_em' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'processado_por' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
                'comment' => 'ID do usuário admin que processou',
            ],
            // Timestamps
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
        $this->forge->addKey('pedido_id');
        $this->forge->addKey('cliente_id');
        $this->forge->addKey('tipo_solicitacao');
        $this->forge->addKey('status');
        $this->forge->addKey('created_at');
        
        $this->forge->createTable('refounds');
    }

    public function down()
    {
        $this->forge->dropTable('refounds');
    }
}
