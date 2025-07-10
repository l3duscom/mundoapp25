<?php

if (!function_exists('get_meta_pixel_script')) {
    /**
     * Gera o script base do Meta Pixel
     */
    function get_meta_pixel_script($pixel_id) {
        if (empty($pixel_id)) {
            return '';
        }
        
        return "
        <!-- Meta Pixel Code -->
        <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '{$pixel_id}');
        fbq('track', 'PageView');
        </script>
        <noscript><img height=\"1\" width=\"1\" style=\"display:none\"
        src=\"https://www.facebook.com/tr?id={$pixel_id}&ev=PageView&noscript=1\"
        /></noscript>
        <!-- End Meta Pixel Code -->
        ";
    }
}

if (!function_exists('get_meta_pixel_event')) {
    /**
     * Gera script para evento específico do Meta Pixel
     */
    function get_meta_pixel_event($event_name, $parameters = []) {
        $params_json = json_encode($parameters);
        return "
        <script>
        fbq('track', '{$event_name}', {$params_json});
        </script>
        ";
    }
}

if (!function_exists('get_meta_pixel_view_content')) {
    /**
     * Gera script para ViewContent
     */
    function get_meta_pixel_view_content($evento, $valor = null) {
        if (empty($evento->meta_pixel_id)) {
            return '';
        }
        
        $params = [
            'content_name' => $evento->nome,
            'content_category' => $evento->categoria ?? 'Evento',
            'content_type' => 'product'
        ];
        
        if ($valor) {
            $params['value'] = $valor;
            $params['currency'] = 'BRL';
        }
        
        return get_meta_pixel_event('ViewContent', $params);
    }
}

if (!function_exists('get_meta_pixel_add_to_cart')) {
    /**
     * Gera script para AddToCart
     */
    function get_meta_pixel_add_to_cart($evento, $valor, $quantidade = 1) {
        if (empty($evento->meta_pixel_id)) {
            return '';
        }
        
        $params = [
            'content_name' => $evento->nome,
            'content_category' => $evento->categoria ?? 'Evento',
            'content_type' => 'product',
            'value' => $valor,
            'currency' => 'BRL',
            'content_ids' => [$evento->id],
            'num_items' => $quantidade
        ];
        
        return get_meta_pixel_event('AddToCart', $params);
    }
}

if (!function_exists('get_meta_pixel_initiate_checkout')) {
    /**
     * Gera script para InitiateCheckout
     */
    function get_meta_pixel_initiate_checkout($evento, $valor) {
        if (empty($evento->meta_pixel_id)) {
            return '';
        }
        
        $params = [
            'content_name' => $evento->nome,
            'content_category' => $evento->categoria ?? 'Evento',
            'content_type' => 'product',
            'value' => $valor,
            'currency' => 'BRL',
            'content_ids' => [$evento->id]
        ];
        
        return get_meta_pixel_event('InitiateCheckout', $params);
    }
}

if (!function_exists('get_meta_pixel_purchase')) {
    /**
     * Gera script para Purchase
     */
    function get_meta_pixel_purchase($evento, $valor, $order_id) {
        if (empty($evento->meta_pixel_id)) {
            return '';
        }
        
        $params = [
            'content_name' => $evento->nome,
            'content_category' => $evento->categoria ?? 'Evento',
            'content_type' => 'product',
            'value' => $valor,
            'currency' => 'BRL',
            'content_ids' => [$evento->id],
            'order_id' => $order_id
        ];
        
        return get_meta_pixel_event('Purchase', $params);
    }
}

if (!function_exists('get_meta_pixel_lead')) {
    /**
     * Gera script para Lead
     */
    function get_meta_pixel_lead($evento, $valor = null) {
        if (empty($evento->meta_pixel_id)) {
            return '';
        }
        
        $params = [
            'content_name' => $evento->nome,
            'content_category' => $evento->categoria ?? 'Evento',
            'content_type' => 'product'
        ];
        
        if ($valor) {
            $params['value'] = $valor;
            $params['currency'] = 'BRL';
        }
        
        return get_meta_pixel_event('Lead', $params);
    }
} 