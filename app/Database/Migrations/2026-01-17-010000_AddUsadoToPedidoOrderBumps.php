<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUsadoToPedidoOrderBumps extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pedido_order_bumps', [
            'usado' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'after' => 'preco_unitario',
            ],
            'usado_em' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'usado',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pedido_order_bumps', ['usado', 'usado_em']);
    }
}
