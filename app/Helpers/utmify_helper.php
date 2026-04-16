<?php

if (!function_exists('capture_utm_params')) {
    /**
     * Captura parâmetros UTM da URL e salva na sessão
     */
    function capture_utm_params()
    {
        $request = service('request');
        $session = session();

        $utmKeys = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term'];

        foreach ($utmKeys as $key) {
            $value = $request->getGet($key);
            if ($value !== null && $value !== '') {
                $session->set($key, $value);
            }
        }
    }
}

if (!function_exists('get_utm_params')) {
    /**
     * Retorna os UTM params da sessão
     */
    function get_utm_params(): array
    {
        $session = session();

        return [
            'utm_source'   => $session->get('utm_source') ?? '',
            'utm_medium'   => $session->get('utm_medium') ?? '',
            'utm_campaign' => $session->get('utm_campaign') ?? '',
            'utm_content'  => $session->get('utm_content') ?? '',
            'utm_term'     => $session->get('utm_term') ?? '',
        ];
    }
}

if (!function_exists('get_utmify_pixel_script')) {
    /**
     * Gera o script do pixel UTMify
     */
    function get_utmify_pixel_script(): string
    {
        return '
<script>
window.pixelId = "69e0fc350d119a03b6f17a74";
var a = document.createElement("script");
a.setAttribute("async", "");
a.setAttribute("defer", "");
a.setAttribute("src", "https://cdn.utmify.com.br/scripts/pixel/pixel.js");
document.head.appendChild(a);
</script>';
    }
}

if (!function_exists('get_utmify_utm_script')) {
    /**
     * Gera o script de captura de UTMs do UTMify (frontend)
     */
    function get_utmify_utm_script(): string
    {
        return '<script src="https://cdn.utmify.com.br/scripts/utms/latest.js" async defer></script>';
    }
}
