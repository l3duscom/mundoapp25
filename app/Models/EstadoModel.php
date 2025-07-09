<?php

namespace App\Models;

use CodeIgniter\Model;

class EstadoModel extends Model
{
    protected $table = 'estado';
    protected $returnType = 'App\Entities\Estado';
    //protected $useSoftDeletes = true;

    // Dates
    protected $useTimestamps = false;

    public function getAll()
    {
        return $this->select()->OrderBy('Nome')->findAll();
    }

    public function selectEstados()
    {
        $options = "<option value=''>Selecione o Estado</option>";
        $estados = $this->getAll();

        foreach ($estados as $estado) {
            $options .= "<option value='{$estado->Uf}'>{$estado->Nome}</option>" . PHP_EOL;
        }
        //26:55
        return $options;
    }
}
