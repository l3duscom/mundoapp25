<?php

namespace App\Models;

use CodeIgniter\Model;

class DeclarationModel extends Model
{
    protected $table = 'declarations';
    protected $returnType = 'App\Entities\Declaration';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'client_id',
        'code',
        'year',
        'month',
        'status',
        'type',
        'recibo',
        'trimestre'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';



    protected $validationMessages = [];

    public function recuperaDeclaracoes()
    {
        $atributos = [
            'declarations.id',
            'declarations.created_at',
            'declarations.deleted_at',
            'declarations.status',
            'declarations.type',
            'clientes.nome',
            'clientes.cnpj',
            'declarations.month'

        ];

        return $this->select($atributos)
            ->join('clientes', 'clientes.id = declarations.client_id')
            ->orderBy('declarations.id', 'DESC')
            ->findAll();
    }

    public function paraNotificar($month)
    {
        $atributos = [
            'clientes.nome',
            'clientes.email',
            'usuarios.id',
            'declarations.type'
        ];

        return $this->distinct()->select($atributos)
            ->join('clientes', 'clientes.id = declarations.client_id')
            ->join('usuarios', 'usuarios.id = clientes.usuario_id')
            ->where('EXTRACT(MONTH FROM declarations.created_at) != EXTRACT(MONTH FROM NOW()) AND usuarios.ativo = 1')
            ->findAll();
    }

    public function paraNotificarTrimestral($month)
    {
        $atributos = [
            'clientes.nome',
            'clientes.email',
            'usuarios.id',
            'declarations.type'
        ];

        return $this->distinct()->select($atributos)
            ->join('clientes', 'clientes.id = declarations.client_id')
            ->join('usuarios', 'usuarios.id = clientes.usuario_id')
            ->where("EXTRACT(MONTH FROM declarations.created_at) != EXTRACT(MONTH FROM NOW()) AND usuarios.ativo = 1 AND declarations.type = 'dici-scm-trimestral'")
            ->findAll();
    }

    public function recuperaPlanosDeclaracoes()
    {
        $atributos = [
            'declarations.id',
            'declarations.created_at',
            'declarations.status',
            'declarations.type',
            'clientes.nome',
            'clientes.cnpj',
        ];

        return $this->select($atributos)
            ->join('clientes', 'clientes.id = declarations.client_id')
            ->orderBy('declarations.id', 'DESC')
            ->withDeleted(true)
            ->findAll();
    }

    public function geraCsvDiciScm(int $id)
    {
        //"REGEXP_REPLACE(clientes.cnpj, '[^0-9]+','')",
        $atributos = [
            "REPLACE(REPLACE(REPLACE(clientes.cnpj,'.', ''),'-', ''),'/', '')",
            'declarations.year',
            "CASE
				    WHEN declarations.month = 'Janeiro' THEN 1
				    WHEN declarations.month = 'Fevereiro' THEN 2
				    WHEN declarations.month = 'Março' THEN 3
				    WHEN declarations.month = 'Abril' THEN 4
				    WHEN declarations.month = 'Maio' THEN 5
				    WHEN declarations.month = 'Junho' THEN 6
				    WHEN declarations.month = 'Julho' THEN 7
				    WHEN declarations.month = 'Agosto' THEN 8
				    WHEN declarations.month = 'Setembro' THEN 9
				    WHEN declarations.month = 'Outubro' THEN 10
				    WHEN declarations.month = 'Novembro' THEN 11
				    WHEN declarations.month = 'Dezembro' THEN 12
				END AS MES",
            'cidade.Codigo',
            'dici_scm.tipo_cliente',
            'dici_scm.tipo_atendimento',
            'dici_scm.tipo_meio',
            'dici_scm.tipo_produto',
            'dici_scm.tipo_tecnologia',
            'dici_scm.velocidade',
            'dici_scm.qtd_acessos'

        ];

        return $this->select($atributos)
            ->join('dici_scm', 'dici_scm.declaration_id = declarations.id')
            ->join('cidade', 'cidade.Codigo = dici_scm.city_code')
            ->join('clientes', 'clientes.id = declarations.client_id')
            ->where('declarations.id', $id)
            ->orderBy('dici_scm.id', 'DESC')
            ->get()->getResultArray();
    }

    public function geraCsvDiciScmAnualEstacoes(int $id)
    {
        //"REGEXP_REPLACE(clientes.cnpj, '[^0-9]+','')",
        $atributos = [
            "REPLACE(REPLACE(REPLACE(clientes.cnpj,'.', ''),'-', ''),'/', '')",
            'declarations.year',
            'dici_scm_anual_estacoes.id_estacao',
            'dici_scm_anual_estacoes.numestacao',
            'dici_scm_anual_estacoes.lat',
            'dici_scm_anual_estacoes.long',
            'dici_scm_anual_estacoes.city_code',
            'dici_scm_anual_estacoes.endereco',
            'dici_scm_anual_estacoes.abertura',

        ];

        return $this->select($atributos)
            ->join('dici_scm_anual_estacoes', 'dici_scm_anual_estacoes.declaration_id = declarations.id')
            ->join('clientes', 'clientes.id = declarations.client_id')
            ->where('declarations.id', $id)
            ->orderBy('dici_scm_anual_estacoes.id', 'DESC')
            ->get()->getResultArray();
    }

    public function geraCsvDiciScmAnualEnlacesProprios(int $id)
    {
        //"REGEXP_REPLACE(clientes.cnpj, '[^0-9]+','')",
        $atributos = [
            "REPLACE(REPLACE(REPLACE(clientes.cnpj,'.', ''),'-', ''),'/', '')",
            'declarations.year',
            'dici_scm_anual_enlaces_proprios.estacao_a_id',
            'dici_scm_anual_enlaces_proprios.estacao_b_id',
            'dici_scm_anual_enlaces_proprios.enlaces_proprios_terrestres_id',
            'dici_scm_anual_enlaces_proprios.enlaces_proprios_terrestres_meio',
            'dici_scm_anual_enlaces_proprios.enlaces_proprios_terrestres_c_nominal',
            'dici_scm_anual_enlaces_proprios.enlaces_proprios_terrestres_swap',
            'dici_scm_anual_enlaces_proprios.geometria_wkt',
            'dici_scm_anual_enlaces_proprios.srid',

        ];

        return $this->select($atributos)
            ->join('dici_scm_anual_enlaces_proprios', 'dici_scm_anual_enlaces_proprios.declaration_id = declarations.id')
            ->join('clientes', 'clientes.id = declarations.client_id')
            ->where('declarations.id', $id)
            ->orderBy('dici_scm_anual_enlaces_proprios.id', 'DESC')
            ->get()->getResultArray();
    }

    public function geraCsvDiciScmAnualEnlacesContratados(int $id)
    {
        //"REGEXP_REPLACE(clientes.cnpj, '[^0-9]+','')",
        $atributos = [
            "REPLACE(REPLACE(REPLACE(clientes.cnpj,'.', ''),'-', ''),'/', '')",
            'declarations.year',
            'dici_scm_anual_enlaces_contratados.estacao_a_id',
            'dici_scm_anual_enlaces_contratados.estacao_b_id',
            'dici_scm_anual_enlaces_contratados.enlaces_contratados_id',
            'dici_scm_anual_enlaces_contratados.enlaces_contratados_meio',
            "REPLACE(REPLACE(REPLACE(dici_scm_anual_enlaces_contratados.enlaces_contratados_prestadora,'.', ''),'-', ''),'/', '')",

        ];

        return $this->select($atributos)
            ->join('dici_scm_anual_enlaces_contratados', 'dici_scm_anual_enlaces_contratados.declaration_id = declarations.id')
            ->join('clientes', 'clientes.id = declarations.client_id')
            ->where('declarations.id', $id)
            ->orderBy('dici_scm_anual_enlaces_contratados.id', 'DESC')
            ->get()->getResultArray();
    }

    public function geraCsvDiciScmTrimestral(int $id)
    {
        //"REGEXP_REPLACE(clientes.cnpj, '[^0-9]+','')",
        $atributos = [
            'dici_scm_trimestral.DADO_INFORMADO',
            'dici_scm_trimestral.SERVICO',
            'dici_scm_trimestral.UNIDADE_DA_FEDERACAO_UF',
            'dici_scm_trimestral.VALORES',
            "REPLACE(REPLACE(REPLACE(clientes.cnpj,'.', ''),'-', ''),'/', '')",
        ];

        return $this->select($atributos)
            ->join('dici_scm_trimestral', 'dici_scm_trimestral.declaration_id = declarations.id')
            ->join('clientes', 'clientes.id = declarations.client_id')
            ->where('declarations.id', $id)
            ->orderBy('dici_scm_trimestral.CODIGO')
            ->get()->getResultArray();
    }

    public function geraCsvDiciTvpa(int $id)
    {
        //"REGEXP_REPLACE(clientes.cnpj, '[^0-9]+','')",
        $atributos = [
            "REPLACE(REPLACE(REPLACE(clientes.cnpj,'.', ''),'-', ''),'/', '')",
            'declarations.year',
            "CASE
				    WHEN declarations.month = 'Janeiro' THEN 1
				    WHEN declarations.month = 'Fevereiro' THEN 2
				    WHEN declarations.month = 'Março' THEN 3
				    WHEN declarations.month = 'Abril' THEN 4
				    WHEN declarations.month = 'Maio' THEN 5
				    WHEN declarations.month = 'Junho' THEN 6
				    WHEN declarations.month = 'Julho' THEN 7
				    WHEN declarations.month = 'Agosto' THEN 8
				    WHEN declarations.month = 'Setembro' THEN 9
				    WHEN declarations.month = 'Outubro' THEN 10
				    WHEN declarations.month = 'Novembro' THEN 11
				    WHEN declarations.month = 'Dezembro' THEN 12
				END AS MES",
            'cidade.Codigo',
            'dici_tvpa.tipo_cliente',
            'dici_tvpa.tipo_meio',
            'dici_tvpa.tipo_tecnologia',
            'dici_tvpa.qtd_acessos'

        ];

        return $this->select($atributos)
            ->join('dici_tvpa', 'dici_tvpa.declaration_id = declarations.id')
            ->join('cidade', 'cidade.Codigo = dici_tvpa.city_code')
            ->join('clientes', 'clientes.id = declarations.client_id')
            ->where('declarations.id', $id)
            ->orderBy('dici_tvpa.id', 'DESC')
            ->get()->getResultArray();
    }

    public function geraCsvDiciStfc(int $id)
    {
        //"REGEXP_REPLACE(clientes.cnpj, '[^0-9]+','')",
        $atributos = [
            "REPLACE(REPLACE(REPLACE(clientes.cnpj,'.', ''),'-', ''),'/', '')",
            'declarations.year',
            "CASE
				    WHEN declarations.month = 'Janeiro' THEN 1
				    WHEN declarations.month = 'Fevereiro' THEN 2
				    WHEN declarations.month = 'Março' THEN 3
				    WHEN declarations.month = 'Abril' THEN 4
				    WHEN declarations.month = 'Maio' THEN 5
				    WHEN declarations.month = 'Junho' THEN 6
				    WHEN declarations.month = 'Julho' THEN 7
				    WHEN declarations.month = 'Agosto' THEN 8
				    WHEN declarations.month = 'Setembro' THEN 9
				    WHEN declarations.month = 'Outubro' THEN 10
				    WHEN declarations.month = 'Novembro' THEN 11
				    WHEN declarations.month = 'Dezembro' THEN 12
				END AS MES",
            'cidade.Codigo',
            'dici_stfc.tipo_cliente',
            'dici_stfc.tipo_atendimento',
            'dici_stfc.tipo_meio',


        ];

        return $this->select($atributos)
            ->join('dici_stfc', 'dici_stfc.declaration_id = declarations.id')
            ->join('cidade', 'cidade.Codigo = dici_stfc.city_code')
            ->join('clientes', 'clientes.id = declarations.client_id')
            ->where('declarations.id', $id)
            ->orderBy('dici_stfc.id', 'DESC')
            ->get()->getResultArray();
    }


    public function geraCodigoDeclaracao(): string
    {
        do {
            $code = strtoupper(random_string('alnum', 20));

            $this->select('code')->where('code', $code);
        } while ($this->countAllResults() > 1);

        return $code;
    }

    public function recuperaDeclaracoesPorUsuario(int $usuario_id)
    {
        $atributos = [
            'declarations.id',
            'declarations.created_at',
            'declarations.deleted_at',
            'declarations.status',
            'declarations.type',
            'clientes.nome',
            'clientes.cnpj',
            'declarations.month'
        ];



        return $this->select($atributos)
            ->join('clientes', 'clientes.id = declarations.client_id')
            ->join('usuarios', 'usuarios.id = clientes.usuario_id')
            ->where('usuarios.id', $usuario_id)
            ->withDeleted(true)
            ->orderBy('declarations.id', 'DESC')
            ->findAll();
    }

    public function recuperaDeclaracao(int $id)
    {

        $atributos = [
            'declarations.id',
            'declarations.created_at',
            'declarations.deleted_at',
            'declarations.year',
            'declarations.month',
            'declarations.code',
            'declarations.status',
            'declarations.recibo',
            'declarations.trimestre',
            'declarations.client_id',
            'declarations.type',
            'clientes.nome',
        ];

        return $this->select($atributos)
            ->join('clientes', 'clientes.id = declarations.client_id')
            ->where('declarations.id', $id)
            ->withDeleted(true)
            ->first();
    }


    public function recuperaDeclaracaoaaaaaaaa(int $id)
    {

        //$atributos = [
        // 'declarations.id',
        // 'declarations.created_at',
        // 'declarations.year',
        //'declarations.month',
        //'declarations.city_code',
        //'declarations.Code',
        //'cidade.Nome',
        //'cidade.Uf',
        //'cidade.Codigo',
        //];

        //return $this->select($atributos)
        // ->join('cidade', 'cidade.Codigo = declarations.city_code')
        //->where('declarations.id', $id)
        //->withDeleted(true)
        //->first();
    }
    public function recuperaOrdensClienteLogado(int $usuario_id)
    {
        $atributos = [
            'ordens.codigo',
            'ordens.created_at',
            'ordens.deleted_at',
            'ordens.situacao',
            'clientes.nome',
            'clientes.cnpj',
        ];

        return $this->select($atributos)
            ->join('clientes', 'clientes.id = ordens.cliente_id')
            ->join('usuarios', 'usuarios.id = clientes.usuario_id')
            ->where('usuarios.id', $usuario_id)
            ->orderBy('ordens.id', 'DESC')
            ->findAll();
    }

    /**
     * Método responsável por recuperar a ordem de serviço.
     *
     * @param string|null $codigo
     * @return object|PageNotFoundException
     */
    public function buscaOrdemOu404(string $codigo = null)
    {

        if ($codigo === null) {

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos ordem $codigo");
        }

        $atributos = [
            'ordens.*',
            'u_aber.id AS usuario_abertura_id', // ID do usuário que abriu a ordem
            'u_aber.nome AS usuario_abertura', // nome do usuário que abriu a ordem

            'u_resp.id AS usuario_responsavel_id', // ID do usuário que trabalhou na ordem
            'u_resp.nome AS usuario_responsavel', // Nome do usuário que trabalhou na ordem

            'u_ence.id AS usuario_encerramento_id', // ID do usuário que encerrou a ordem
            'u_ence.nome AS usuario_encerramento', // Nome do usuário que encerrou a ordem

            'clientes.usuario_id AS cliente_usuario_id', // usaremos para o acesso do cliente ao sistema
            'clientes.nome',
            'clientes.cpf', // obrigatório para gerar o boleto com a gerencianet
            'clientes.telefone', // obrigatório para gerar o boleto com a gerencianet
            'clientes.email', // obrigatório para gerar o boleto com a gerencianet
        ];

        $ordem = $this->select($atributos)
            ->join('ordens_responsaveis', 'ordens_responsaveis.ordem_id = ordens.id')

            ->join('clientes', 'clientes.id = ordens.cliente_id')

            ->join('usuarios AS u_cliente', 'u_cliente.id = clientes.usuario_id')

            ->join('usuarios AS u_aber', 'u_aber.id = ordens_responsaveis.usuario_abertura_id')

            ->join('usuarios AS u_resp', 'u_resp.id = ordens_responsaveis.usuario_responsavel_id', 'LEFT') // LEFT, pois pode ser que a ordem ainda não possua um técnico responsável

            ->join('usuarios AS u_ence', 'u_ence.id = ordens_responsaveis.usuario_encerramento_id', 'LEFT') // LEFT, pois pode ser que a ordem ainda não tenha sido encerrada

            ->where('ordens.codigo', $codigo)
            ->withDeleted(true)
            ->first();

        if ($ordem === null) {

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos ordem $codigo");
        }

        return $ordem;
    }

    /**
     * Método que gera o código interno da ordem de serviço
     *
     * @return string
     */
    public function geraCodigoOrdem(): string
    {
        do {
            $codigo = strtoupper(random_string('alnum', 20));

            $this->select('codigo')->where('codigo', $codigo);
        } while ($this->countAllResults() > 1);

        return $codigo;
    }

    public function recuperaOrdensPelaSituacao(string $situacao, string $dataInicial, string $dataFinal)
    {

        switch ($situacao) {

            case 'aberta':

                $campoDate = 'created_at';

                break;

            case 'encerrada':
            case 'aguardando':
            case 'cancelada':
            case 'nao_pago':

                $campoDate = 'updated_at';

                break;
        }

        $dataInicial = str_replace('T', ' ', $dataInicial);
        $dataFinal = str_replace('T', ' ', $dataFinal);

        $atributos = [
            'ordens.codigo',
            'ordens.situacao',
            'ordens.valor_ordem',
            'ordens.created_at',
            'ordens.updated_at',
            'ordens.deleted_at',
            'clientes.nome',
            'clientes.cpf',
        ];

        $where = 'ordens.' . $campoDate . ' BETWEEN "' . $dataInicial . '" AND "' . $dataFinal . '"';

        return $this->select($atributos)
            ->join('clientes', 'clientes.id = ordens.cliente_id')
            ->where('situacao', $situacao)
            ->where($where)
            ->orderBy('situacao', 'ASC')
            //->getCompiledSelect();
            ->findAll();
    }

    public function recuperaOrdensExcluidas(string $dataInicial, string $dataFinal)
    {

        $dataInicial = str_replace('T', ' ', $dataInicial);
        $dataFinal = str_replace('T', ' ', $dataFinal);

        $atributos = [
            'ordens.codigo',
            'ordens.situacao',
            'ordens.valor_ordem',
            'ordens.created_at',
            'ordens.updated_at',
            'ordens.deleted_at',
            'clientes.nome',
            'clientes.cpf',
        ];

        $where = 'ordens.deleted_at BETWEEN "' . $dataInicial . '" AND "' . $dataFinal . '"';

        return $this->select($atributos)
            ->join('clientes', 'clientes.id = ordens.cliente_id')
            ->where($where)
            ->onlyDeleted()
            ->orderBy('situacao', 'ASC')
            //->getCompiledSelect();
            ->findAll();
    }

    public function recuperaOrdensComBoleto($dataInicial, string $dataFinal)
    {

        $dataInicial = str_replace('T', ' ', $dataInicial);
        $dataFinal = str_replace('T', ' ', $dataFinal);

        $atributos = [
            'ordens.codigo',
            'ordens.situacao',
            'ordens.valor_ordem',
            'transacoes.charge_id',
            'transacoes.expire_at',
        ];

        $where = 'ordens.updated_at BETWEEN "' . $dataInicial . '" AND "' . $dataFinal . '"';

        return $this->select($atributos)
            ->join('transacoes', 'transacoes.ordem_id = ordens.id')
            ->where($where)
            ->withDeleted(true)
            ->orderBy('situacao', 'ASC')
            ->groupBy('ordens.codigo')
            //->getCompiledSelect();
            ->findAll();
    }

    public function recuperaClientesMaisAssiduos(string $anoEscolhido)
    {

        $atributos = [
            'clientes.id',
            'clientes.nome',
            'COUNT(*) AS ordens',
            'SUM(ordens.valor_ordem) AS valor_gerado',
            'YEAR(ordens.created_at) AS ano',
        ];

        return $this->select($atributos)
            ->join('clientes', 'clientes.id = ordens.cliente_id')
            ->where('YEAR(ordens.created_at)', $anoEscolhido)
            ->where('ordens.situacao', 'encerrada')
            ->where('ordens.valor_ordem !=', null)
            ->withDeleted(true)
            ->groupBy('clientes.nome')
            ->orderBy('ordens', 'DESC')
            ->findAll();
    }

    public function recuperaOrdensPorMesGrafico(string $anoEscolhido)
    {

        $atributos = [
            'COUNT(id) AS total_ordens',
            'YEAR(created_at) AS ano',
            'MONTH(created_at) AS mes_numerico',
            'MONTHNAME(created_at) AS mes_nome',
        ];

        return $this->select($atributos)
            ->where('YEAR(created_at)', $anoEscolhido)
            ->groupBy('mes_nome')
            ->groupBy('mes_numerico', 'ASC')
            ->findAll();
    }
}
