<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Notification;

class Notifications extends BaseController
{


    private $notificationModel;


    public function __construct()
    {
        $this->notificationModel = new \App\Models\NotificationsModel();
    }

    public function index()
    {

        if (!$this->usuarioLogado()->temPermissaoPara('listar-eventos')) {

            return redirect()->back()->with('atencao', $this->usuarioLogado()->nome . ', você não tem permissão para acessar esse menu.');
        }

        $data = [
            'titulo' => 'Notificações - Lembrete de envio de declaração',
        ];

        return view('Notifications/index', $data);
    }

    public function recuperaNotifications()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $atributos = [
            'id',
            'nome',
            'email',
            'type',
            'created_at',
        ];

        $notifications = $this->notificationModel->select($atributos)
            ->withDeleted(true)
            ->orderBy('id', 'DESC')
            ->findAll();

        // Receberá o array de objetos de clientes
        $data = [];

        foreach ($notifications as $notification) {
            $dataformatada = date("d.m.Y H:i:s", strtotime($notification->created_at));
            $data[] = [
                'nome' => anchor("#", esc($notification->nome), 'title="Cliente ' . esc($notification->nome) . ' "'),
                'email' => esc($notification->email),
                'type' => esc($notification->type),
                'created_at' => esc($dataformatada),
            ];
        }

        $retorno = [
            'data' => $data,
        ];

        return $this->response->setJSON($retorno);
    }
}
