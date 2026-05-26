<?php


namespace App\Traits;

trait ValidacoesTrait
{
    public function consultaViaCep(string $cep) : array
    {
        $cep = preg_replace('/\D/', '', $cep);

        if (strlen($cep) !== 8) {
            session()->set('blockCep', true);
            return ['erro' => '<span class="text-danger">Informe um CEP válido</span>'];
        }

        $providers = [
            fn() => $this->cepViaCep($cep),
            fn() => $this->cepBrasilApi($cep),
            fn() => $this->cepOpenCep($cep),
        ];

        $cepInvalido = false;
        $ultimoErro = null;

        foreach ($providers as $consulta) {
            $resultado = $consulta();

            if ($resultado === null) {
                continue;
            }

            if (isset($resultado['_invalido'])) {
                $cepInvalido = true;
                continue;
            }

            if (isset($resultado['_erro'])) {
                $ultimoErro = $resultado['_erro'];
                continue;
            }

            session()->set('blockCep', false);

            return [
                'endereco' => esc($resultado['logradouro'] ?? ''),
                'bairro'   => esc($resultado['bairro'] ?? ''),
                'cidade'   => esc($resultado['localidade'] ?? ''),
                'estado'   => esc($resultado['uf'] ?? ''),
            ];
        }

        if ($cepInvalido) {
            session()->set('blockCep', true);
            return ['erro' => '<span class="text-danger">Informe um CEP válido</span>'];
        }

        return ['erro' => '<span class="text-danger">Não foi possível consultar o CEP no momento. Preencha o endereço manualmente.</span>'];
    }

    private function httpGetJson(string $url): ?array
    {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CONNECTTIMEOUT => 3,
            CURLOPT_TIMEOUT        => 6,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_USERAGENT      => 'mundo-app/1.0',
        ]);

        $resposta = curl_exec($ch);
        $erro     = curl_error($ch);
        $status   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($erro || $status >= 500 || $resposta === false) {
            return null;
        }

        return ['status' => $status, 'body' => $resposta];
    }

    private function cepViaCep(string $cep): ?array
    {
        $r = $this->httpGetJson("https://viacep.com.br/ws/{$cep}/json/");
        if ($r === null) return ['_erro' => 'viacep_indisponivel'];

        $d = json_decode($r['body'], true);
        if (!is_array($d)) return ['_erro' => 'viacep_resposta_invalida'];

        if (isset($d['erro']) && empty($d['cep'])) return ['_invalido' => true];

        return [
            'logradouro' => $d['logradouro'] ?? '',
            'bairro'     => $d['bairro'] ?? '',
            'localidade' => $d['localidade'] ?? '',
            'uf'         => $d['uf'] ?? '',
        ];
    }

    private function cepBrasilApi(string $cep): ?array
    {
        $r = $this->httpGetJson("https://brasilapi.com.br/api/cep/v1/{$cep}");
        if ($r === null) return ['_erro' => 'brasilapi_indisponivel'];

        if ($r['status'] === 404) return ['_invalido' => true];

        $d = json_decode($r['body'], true);
        if (!is_array($d) || empty($d['cep'])) return ['_erro' => 'brasilapi_resposta_invalida'];

        return [
            'logradouro' => $d['street'] ?? '',
            'bairro'     => $d['neighborhood'] ?? '',
            'localidade' => $d['city'] ?? '',
            'uf'         => $d['state'] ?? '',
        ];
    }

    private function cepOpenCep(string $cep): ?array
    {
        $r = $this->httpGetJson("https://opencep.com/v1/{$cep}");
        if ($r === null) return ['_erro' => 'opencep_indisponivel'];

        if ($r['status'] === 404) return ['_invalido' => true];

        $d = json_decode($r['body'], true);
        if (!is_array($d) || empty($d['cep'])) return ['_erro' => 'opencep_resposta_invalida'];

        return [
            'logradouro' => $d['logradouro'] ?? '',
            'bairro'     => $d['bairro'] ?? '',
            'localidade' => $d['localidade'] ?? '',
            'uf'         => $d['uf'] ?? '',
        ];
    }


    public function checkEmail(string $email, bool $bypass = false)
    {
        $retorno = [];

        if ($bypass === true) {
            return $retorno;
        }


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://mailcheck.p.rapidapi.com/?domain={$email}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "x-rapidapi-host: mailcheck.p.rapidapi.com",
                "x-rapidapi-key: ".getenv('CHAVE_CHECK_MAIL_ORG_API')
            ),
        ));

        $resposta = curl_exec($curl);
        $erro = curl_error($curl);

        curl_close($curl);

        if ($erro) {
            $retorno['erro'] = "cURL Error #:" . $erro;

            return $retorno;
        }


        $consulta = json_decode($resposta);

        // Debug
        //return $consulta;


        session()->set('blockEmail', esc($consulta->block)); // Usaremos no controller

        if ($consulta->block) {
            $retorno['erro'] = '<span class="text-danger">O domínio '.$consulta->domain.' não é valido. Tente novamente.</span>';
            return $retorno;
        }


        return $retorno;
    }
}
