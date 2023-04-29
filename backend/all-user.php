<?php
require("../required/config.php");

if (isset($_POST['getUser']) && isset($_SESSION[ACCESSTOKEN]) && isset($_SESSION[EMAIL])) {

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost:8888/banker/all-user',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_POSTFIELDS => '{
    "getUser":true
}',
        CURLOPT_HTTPHEADER => array(
            'X-API-USER: ' . $_SESSION[EMAIL] . '',
            'X-API-KEY: ' . $_SESSION[ACCESSTOKEN] . '',
            'Content-Type: application/json'
        ),
    ));


    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
}
