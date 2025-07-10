<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class EventoEntity extends Entity
{

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function exibeSituacao()
    {
        if ($this->deleted_at != null) {
            // Evento excluído
            $icone = '<span class="text-white">Excluído</span>&nbsp;<i class="fa fa-undo"></i>&nbsp;Desfazer';
            $situacao = anchor("eventos/desfazerexclusao/$this->id", $icone, ['class' => 'btn btn-outline-success btn-sm']);
            return $situacao;
        }

        if ($this->ativo == true) {
            $situacao = '<span class="text-white"><i class="fa fa-thumbs-up" aria-hidden="true"></i>&nbsp;Ativo';
        } else {
            $situacao = '<span class="text-white"><i class="fa fa-thumbs-down" aria-hidden="true"></i>&nbsp;Inativo';
        }

        return $situacao;
    }
}
