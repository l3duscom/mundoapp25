<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFooterSettings extends Migration
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
            'chave' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'valor' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'tipo' => [
                'type' => 'ENUM',
                'constraint' => ['text', 'image', 'json', 'html'],
                'default' => 'text',
            ],
            'descricao' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('chave');
        $this->forge->createTable('footer_settings');

        // Inserir configurações padrão
        $this->db->table('footer_settings')->insertBatch([
            // Métodos de pagamento
            ['chave' => 'pagamento_titulo', 'valor' => 'Métodos de pagamento', 'tipo' => 'text', 'descricao' => 'Título da seção de pagamentos'],
            ['chave' => 'pagamento_imagens', 'valor' => json_encode(['visa.png', 'mastercard.png', 'elo.png', 'pix.png']), 'tipo' => 'json', 'descricao' => 'Bandeiras de cartão'],
            ['chave' => 'pagamento_parcelamento', 'valor' => 'Parcele sua compra em até 12x', 'tipo' => 'text', 'descricao' => 'Texto de parcelamento'],
            
            // Segurança
            ['chave' => 'seguranca_titulo', 'valor' => 'Compre com total segurança', 'tipo' => 'text', 'descricao' => 'Título da seção de segurança'],
            ['chave' => 'seguranca_texto', 'valor' => 'Os dados sensíveis são criptografados e não serão salvos em nossos servidores.', 'tipo' => 'text', 'descricao' => 'Texto de segurança'],
            ['chave' => 'seguranca_selos', 'valor' => json_encode(['google_safe.png', 'pci_dss.png']), 'tipo' => 'json', 'descricao' => 'Selos de segurança'],
            
            // Ajuda
            ['chave' => 'ajuda_titulo', 'valor' => 'Precisando de ajuda?', 'tipo' => 'text', 'descricao' => 'Título da seção de ajuda'],
            ['chave' => 'ajuda_texto', 'valor' => 'Acesse nossa Central de Ajuda ou Fale Conosco', 'tipo' => 'text', 'descricao' => 'Texto de ajuda'],
            ['chave' => 'ajuda_link', 'valor' => 'https://wa.me/5551993406154', 'tipo' => 'text', 'descricao' => 'Link do WhatsApp'],
            ['chave' => 'ajuda_link_texto', 'valor' => 'Fale conosco', 'tipo' => 'text', 'descricao' => 'Texto do botão de contato'],
            
            // Footer inferior
            ['chave' => 'footer_logo', 'valor' => '', 'tipo' => 'image', 'descricao' => 'Logo do footer'],
            ['chave' => 'footer_copyright', 'valor' => '© ' . date('Y') . ' Mundo Dream. Todos os direitos reservados.', 'tipo' => 'text', 'descricao' => 'Texto de copyright'],
            
            // Redes sociais
            ['chave' => 'social_facebook', 'valor' => '', 'tipo' => 'text', 'descricao' => 'Link do Facebook'],
            ['chave' => 'social_instagram', 'valor' => 'https://instagram.com/mundodream', 'tipo' => 'text', 'descricao' => 'Link do Instagram'],
            ['chave' => 'social_twitter', 'valor' => '', 'tipo' => 'text', 'descricao' => 'Link do Twitter'],
            ['chave' => 'social_linkedin', 'valor' => '', 'tipo' => 'text', 'descricao' => 'Link do LinkedIn'],
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('footer_settings');
    }
}
