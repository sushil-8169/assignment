<?php
if (isset($_POST['getTransaction']) && isset($_POST['id']) && is_numeric($_POST['id']) && isset($_SESSION[ACCESSTOKEN]) && isset($_SESSION[EMAIL])) {
    $id = $_POST['id'];
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost:8888/user/transaction',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
    "id":' . $id . ',
    "getTransaction":true
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
