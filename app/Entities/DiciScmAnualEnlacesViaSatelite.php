<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class DiciScmAnualEnlacesViaSatelite extends Entity
{

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function exibeSituacao()
    {
        if ($this->deleted_at != null) {

            // Cliente excluído

            $icone = '<span class="text-white">Excluído</span>&nbsp;<i class="fa fa-undo"></i>&nbsp;Desfazer';

            $situacao = anchor("clientes/desfazerexclusao/$this->id", $icone, ['class' => 'btn btn-outline-succes btn-sm']);

            return $situacao;
        }

        if ($this->status == "ABERTA") {

            return '<span class="text-warning"><i class="fa fa-circle"></i>&nbsp;Aberta</span>';
        }

        if ($this->status == "ENVIADA") {

            return '<span class="text-success"><i class="fa fa-circle"></i>&nbsp;Enviada</span>';
        }

        if ($this->status == "FINALIZADA") {

            return '<span class="text-success"><i class="fa fa-circle"></i>&nbsp;Finalizada</span>';
        }

        if ($this->status == "CANCELADA") {

            return '<span class="text-secondary"><i class="fa fa-circle"></i>&nbsp;Cancelada</span>';
        }

        $status = '<span class="text-secondary"><i class="fa fa-thumbs-up" aria-hidden="true"></i>&nbsp;Disponível';
        return $status;
    }
}
