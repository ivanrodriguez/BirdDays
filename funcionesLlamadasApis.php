<?php
include('configuraciones.php');

function llamaApiFoursquare($url, $parametrosAntes = false) {
    $cookieSesion = 'PHPSESSID=' . $_COOKIE['PHPSESSID'] . '; path=/';
    session_write_close();
    $curl = curl_init();
    if ($parametrosAntes == false)
        curl_setopt($curl, CURLOPT_URL, $url . '?client_id=' . FOURSQUARE_CLIENT_ID . '&client_secret=' . FOURSQUARE_CLIENT_SECRET);
    else
        curl_setopt($curl, CURLOPT_URL, $url . '&client_id=' . FOURSQUARE_CLIENT_ID . '&client_secret=' . FOURSQUARE_CLIENT_SECRET);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_COOKIE, $cookieSesion );
    $respuesta = curl_exec($curl);
    if ($respuesta == false)
        echo 'Tenemos problemas, por favor intenta de nuevo';
    session_start();
    $respuesta = json_decode($respuesta, true);
    return $respuesta;
}

function llamaApiFacebook($url, $parametrosAntes = false) {
    $cookieSesion = 'PHPSESSID=' . $_COOKIE['PHPSESSID'] . '; path=/';
    session_write_close();
    $curl = curl_init();
    if ($parametrosAntes == false)
        curl_setopt($curl, CURLOPT_URL, $url . '?access_token=' . $_SESSION['token_acceso_facebook']);
    else
        curl_setopt($curl, CURLOPT_URL, $url . '&access_token=' . $_SESSION['token_acceso_facebook']);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_COOKIE, $cookieSesion );
    $respuesta = curl_exec($curl);
    if ($respuesta == false)
        echo 'Tenemos problemas, por favor intenta de nuevo';
    session_start();
    $respuesta = json_decode($respuesta, true);
    return $respuesta;
}

?>
