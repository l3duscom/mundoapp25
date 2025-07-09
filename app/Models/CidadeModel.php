<?php

namespace App\Models;

use CodeIgniter\Model;

class CidadeModel extends Model
{
    protected $table = 'cidade';
    protected $returnType = 'App\Entities\Cidade';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['Uf'];

    // Dates
    protected $useTimestamps = false;

    public function getCidadesByIdEstado($uf)
    {
        return $this->select()->where('Uf', $uf)->OrderBy('Nome')->findAll();
    }

    public function selectCidades($uf = null)
    {
        $cidades = $this->getCidadesByIdEstado($uf);
        $options = "<option value=''>Selecione a cidade</option>";

        foreach ($cidades as $cidade) {
            $options .= "<option value='{$cidade->Codigo}'>{$cidade->Nome}</option>" . PHP_EOL;
        }
        return $options;
    }
}
