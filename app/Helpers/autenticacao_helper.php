<?php

if(function_exists('usuario_logado') === false){

    function usuario_logado(){

        return service('autenticacao')->pegaUsuarioLogado();

    }


}

if(function_exists('evento_selecionado') === false){

    function evento_selecionado(){

        return session()->get('event_id');

    }


}

if(function_exists('evento_nome') === false){

    function evento_nome(){

        $event_id = session()->get('event_id');
        if($event_id) {
            $eventoModel = new \App\Models\EventoModel();
            $evento = $eventoModel->find($event_id);
            return $evento ? $evento->nome : null;
        }
        return null;

    }


}

if(function_exists('precisa_contexto_evento') === false){

    function precisa_contexto_evento($rota){

        $rotas_com_contexto = [
            'concursos',
            'pedidos/gerenciar_evento',
            'ingressos/add'
        ];
        
        foreach ($rotas_com_contexto as $rota_contexto) {
            if (strpos($rota, $rota_contexto) !== false) {
                return true;
            }
        }
        
        return false;

    }


}