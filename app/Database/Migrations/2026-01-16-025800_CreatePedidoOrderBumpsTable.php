<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePedidoOrderBumpsTable extends Migration
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
            'order_bump_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'quantidade' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 1,
            ],
            'preco_unitario' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
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
        $this->forge->addForeignKey('pedido_id', 'pedidos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('order_bump_id', 'order_bumps', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pedido_order_bumps');
    }

    public function down()
    {
        $this->forge->dropTable('pedido_order_bumps');
    }
}
