<?php

namespace App\Models;

use CodeIgniter\Model;

class PedidoModel extends Model
{
    protected $table = 'pedidos';
    protected $returnType = 'App\Entities\Pedido';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'user_id',
        'evento_id',
        'endereco_id',
        'codigo',
        'rastreio',
        'total',
        'data_vencimento',
        'status',
        'status_entrega',
        'forma_pagamento',
        'frete',
        'convite',
        'cretade_at',

    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'codigo' => 'required',

    ];

    protected $validationMessages = [];

    public function geraCodigoPedido(): string
    {
        do {
            $codigo = strtoupper(random_string('alnum', 20));

            $this->select('codigo')->where('codigo', $codigo);
        } while ($this->countAllResults() > 1);

        return $codigo;
    }


    public function recuperaPedidosPorUsuario(int $usuario_id)
    {
        $atributos = [
            'pedidos.id',
            'pedidos.created_at',
            'pedidos.codigo as cod_pedido',
            'pedidos.rastreio',
            'pedidos.status',
            'pedidos.status_entrega',
            'pedidos.frete',
            'pedidos.total',
            'pedidos.evento_id',
            'eventos.nome as nome_evento',
            'eventos.slug',
            'eventos.data_inicio',
            'eventos.data_fim',
            'eventos.hora_inicio',
            'eventos.hora_fim',
            'eventos.local'
        ];



        return $this->select($atributos)
            ->join('usuarios', 'usuarios.id = pedidos.user_id')
            ->join('eventos', 'eventos.id = pedidos.evento_id')
            ->where('usuarios.id', $usuario_id)
            ->orderBy('pedidos.created_at', 'DESC')
            ->findAll();
    }

    public function recuperaTotalIngressosHojeValor()
    {


        $retorno = $this->select('sum(total) as total')
            ->where('DATE(created_at) >= DATE(NOW())')
            ->where('evento_id', 11)
            ->whereIn('status', ['CONFIRMED', 'RECEIVED', 'paid', 'RECEIVED_IN_CASH'])
            ->find();

        return $retorno;
    }

    public function recuperaTotalIngressosValor()
    {


        $retorno = $this->select('sum(total) as total')
            ->where('evento_id', 11)
            ->whereIn('status', ['CONFIRMED', 'RECEIVED', 'paid', 'RECEIVED_IN_CASH'])
            ->find();

        return $retorno;
    }




    public function listaPedidosAdmin()
    {
        $atributos = [
            'pedidos.id',
            'pedidos.created_at',
            'pedidos.codigo as cod_pedido',
            'pedidos.rastreio',
            'pedidos.status',
            'pedidos.status_entrega',
            'pedidos.frete',
            'pedidos.total',
            'pedidos.evento_id',
            'clientes.email',
            'clientes.telefone',
            'clientes.nome',
            'clientes.cpf'

        ];



        return $this->select($atributos)
            ->join('usuarios', 'usuarios.id = pedidos.user_id')
            ->join('clientes', 'clientes.usuario_id = usuarios.id')
            ->where('pedidos.evento_id', 11)
            ->whereIn('pedidos.status', ['CONFIRMED', 'RECEIVED', 'paid', 'RECEIVED_IN_CASH'])
            ->orderBy('pedidos.created_at', 'DESC')
            ->findAll();
    }

    public function listaPedidosAdminVip()
    {
        $atributos = [
            'pedidos.id',
            'pedidos.created_at',
            'pedidos.codigo as cod_pedido',
            'pedidos.rastreio',
            'pedidos.status',
            'pedidos.status_entrega',
            'pedidos.frete',
            'pedidos.total',
            'pedidos.evento_id',
            'clientes.email',
            'clientes.telefone',
            'clientes.nome',
            'clientes.cpf',
            'ingressos.cinemark'

        ];



        return $this->select($atributos)
            ->join('usuarios', 'usuarios.id = pedidos.user_id')
            ->join('ingressos', 'ingressos.pedido_id = pedidos.id')
            ->join('clientes', 'clientes.usuario_id = usuarios.id')
            ->whereIn('pedidos.status', ['CONFIRMED', 'RECEIVED', 'paid', 'RECEIVED_IN_CASH'])
            ->where('ingressos.cinemark is null')
            ->where('pedidos.evento_id', 11)
            ->like('ingressos.nome', 'vip')
            ->orderBy('pedidos.created_at', 'ASC')
            ->findAll();
    }

    public function listaPedidosAdminVipEntregue()
    {
        $atributos = [
            'pedidos.id',
            'pedidos.created_at',
            'pedidos.codigo as cod_pedido',
            'pedidos.rastreio',
            'pedidos.status',
            'pedidos.status_entrega',
            'pedidos.frete',
            'pedidos.total',
            'pedidos.evento_id',
            'clientes.email',
            'clientes.telefone',
            'clientes.nome',
            'clientes.cpf',
            'ingressos.cinemark'

        ];



        return $this->select($atributos)
            ->join('usuarios', 'usuarios.id = pedidos.user_id')
            ->join('ingressos', 'ingressos.pedido_id = pedidos.id')
            ->join('clientes', 'clientes.usuario_id = usuarios.id')
            ->whereIn('pedidos.status', ['CONFIRMED', 'RECEIVED', 'paid', 'RECEIVED_IN_CASH'])
            ->where('ingressos.cinemark is not null')
            ->like('ingressos.nome', 'vip')
            ->where('pedidos.evento_id', 11)
            ->orderBy('pedidos.created_at', 'DESC')
            ->findAll();
    }

    public function listaPedidosAdminEntrega($event_id)
    {
        $atributos = [
            'pedidos.id',
            'pedidos.created_at',
            'pedidos.codigo as cod_pedido',
            'pedidos.rastreio',
            'pedidos.status',
            'pedidos.status_entrega',
            'pedidos.frete',
            'pedidos.total',
            'pedidos.evento_id',
            'clientes.email',
            'clientes.telefone',
            'clientes.nome',
            'clientes.cpf'

        ];



        return $this->select($atributos)
            ->join('usuarios', 'usuarios.id = pedidos.user_id')
            ->join('clientes', 'clientes.usuario_id = usuarios.id')
            ->whereIn('pedidos.status', ['CONFIRMED', 'RECEIVED', 'paid', 'RECEIVED_IN_CASH'])
            ->where('pedidos.evento_id', $event_id)
            ->where('pedidos.frete', 1)
            ->where('pedidos.rastreio', null)
            ->where('pedidos.evento_id', 11)
            ->orderBy('pedidos.created_at', 'DESC')
            ->findAll();
    }

    public function listaPedidosAdminEnviados($event_id)
    {
        $atributos = [
            'pedidos.id',
            'pedidos.created_at',
            'pedidos.codigo as cod_pedido',
            'pedidos.rastreio',
            'pedidos.status',
            'pedidos.status_entrega',
            'pedidos.frete',
            'pedidos.total',
            'pedidos.evento_id',
            'clientes.email',
            'clientes.telefone',
            'clientes.nome',
            'clientes.cpf'

        ];



        return $this->select($atributos)
            ->join('usuarios', 'usuarios.id = pedidos.user_id')
            ->join('clientes', 'clientes.usuario_id = usuarios.id')
            ->whereIn('pedidos.status', ['CONFIRMED', 'RECEIVED', 'paid', 'RECEIVED_IN_CASH'])
            ->where('pedidos.evento_id', $event_id)
            ->where('pedidos.frete', 1)
            ->where('pedidos.evento_id', 11)
            ->where('pedidos.rastreio is not null')
            ->orderBy('pedidos.created_at', 'DESC')
            ->findAll();
    }

    public function recuperaPedido(int $id)
    {
        $atributos = [
            'pedidos.id',
            'pedidos.created_at',
            'pedidos.codigo as cod_pedido',
            'pedidos.rastreio',
            'pedidos.status',
            'pedidos.status_entrega',
            'pedidos.frete',
            'pedidos.total',
            'pedidos.evento_id',
            'pedidos.user_id'

        ];



        return $this->select($atributos)
            ->find($id);
    }
}
