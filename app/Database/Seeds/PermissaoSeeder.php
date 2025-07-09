<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PermissaoSeeder extends Seeder
{
    public function run()
    {
        $permissaoModel = new \App\Models\PermissaoModel();

        $permissoes = [
            /* --------------Usuarios---------------- */
            [
                'nome' => 'lista-usuarios',
            ],
            [
                'nome' => 'criar-usuarios',
            ],
            [
                'nome' => 'editar-usuarios',
            ],
            [
                'nome' => 'excluir-usuarios',
            ],


            /* -----------------Grupos---------------- */

            [
                'nome' => 'listar-grupos',
            ],
            [
                'nome' => 'criar-grupos',
            ],
            [
                'nome' => 'editar-grupos',
            ],
            [
                'nome' => 'excluir-grupos',
            ],
            /* -----------------Formas de pagamento---------------- */
            [
                'nome' => 'listar-formas',
            ],
            [
                'nome' => 'criar-formas',
            ],
            [
                'nome' => 'editar-formas',
            ],
            [
                'nome' => 'excluir-formas',
            ],

            /* -----------------Clientes---------------- */
            [
                'nome' => 'listar-clientes',
            ],
            [
                'nome' => 'criar-clientes',
            ],
            [
                'nome' => 'editar-clientes',
            ],
            [
                'nome' => 'excluir-clientes',
            ],
            /* -----------------Eventos---------------- */
            [
                'nome' => 'listar-eventos',
            ],
            [
                'nome' => 'criar-eventos',
            ],
            [
                'nome' => 'editar-eventos',
            ],
            [
                'nome' => 'excluir-eventos',
            ],
            /* -----------------Relatórios---------------- */
            [
                'nome' => 'visualizar-relatorios',
            ],

            /* -----------------Transações na Gerencianet ---------------- */
            [
                'nome' => 'alterar-vencimento-transacao',
            ],
            [
                'nome' => 'cancelar-transacao',
            ],
            [
                'nome' => 'reenviar-boleto-transacao',
            ],
            [
                'nome' => 'pagar-transacao',
            ],
            [
                'nome' => 'consultar-transacao',
            ],

            /* -----------------Fornecedores---------------- */
            [
                'nome' => 'listar-fornecedores',
            ],
            [
                'nome' => 'criar-fornecedores',
            ],
            [
                'nome' => 'editar-fornecedores',
            ],
            [
                'nome' => 'excluir-fornecedores',
            ],
            /* -----------------Contas a pagar---------------- */
            [
                'nome' => 'listar-contas',
            ],
            [
                'nome' => 'criar-contas',
            ],
            [
                'nome' => 'editar-contas',
            ],
            [
                'nome' => 'excluir-contas',
            ],
            /* ----------------- Logs ---------------- */
            [
                'nome' => 'visualizar-logs',
            ],
            /* -----------------Visualizar a Home---------------- */
            [
                'nome' => 'visualizar-home',
            ],

        ];

        foreach ($permissoes as $permissao) {
            $permissaoModel->protect(false)->insert($permissao);
        }

        echo 'Permissões criadas com sucesso!';
    }
}
