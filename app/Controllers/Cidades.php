<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Cidades extends BaseController
{

    private $cidadeModel;

    public function __construct()
    {
        $this->cidadeModel = new \App\Models\CidadeModel();
    }

    public function getCidades()
    {
        $uf = $this->request->getPost('uf');
        //$uf = $this->input->post('uf');
        //return $this->cidadeModel->getCidadesByIdEstado($uf);
        //print_r($this->cidadeModel->getCidadesByIdEstado($uf));
        echo $this->cidadeModel->selectCidades($uf);
        //var_dump($this->cidadeModel->getCidadesByIdEstado($uf));

    }
}
