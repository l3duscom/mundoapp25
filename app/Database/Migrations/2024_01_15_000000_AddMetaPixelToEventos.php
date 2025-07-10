<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMetaPixelToEventos extends Migration
{
    public function up()
    {
        $this->forge->addColumn('eventos', [
            'meta_pixel_id' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
                'comment' => 'ID do Pixel do Meta Ads para este evento'
            ],
            'meta_pixel_view_content' => [
                'type' => 'TEXT',
                'null' => true,
                'comment' => 'Script do Meta Pixel para ViewContent'
            ],
            'meta_pixel_add_to_cart' => [
                'type' => 'TEXT',
                'null' => true,
                'comment' => 'Script do Meta Pixel para AddToCart'
            ],
            'meta_pixel_initiate_checkout' => [
                'type' => 'TEXT',
                'null' => true,
                'comment' => 'Script do Meta Pixel para InitiateCheckout'
            ],
            'meta_pixel_purchase' => [
                'type' => 'TEXT',
                'null' => true,
                'comment' => 'Script do Meta Pixel para Purchase'
            ],
            'meta_pixel_lead' => [
                'type' => 'TEXT',
                'null' => true,
                'comment' => 'Script do Meta Pixel para Lead'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('eventos', [
            'meta_pixel_id',
            'meta_pixel_view_content',
            'meta_pixel_add_to_cart',
            'meta_pixel_initiate_checkout',
            'meta_pixel_purchase',
            'meta_pixel_lead'
        ]);
    }
} 