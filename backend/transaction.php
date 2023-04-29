<?php
require("../required/config.php");
if (isset($_POST['deposit']) && isset($_POST['userID']) && isset($_SESSION[ACCESSTOKEN]) && isset($_SESSION[EMAIL])) {
    $deposit = $_POST['deposit'];
    $userID = $_POST['userID'];
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost:8888/user/Deposit',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
        "id":' . $userID . ',
        "setDeposit":true,
        "deposit":' . $deposit . '
    }',
        CURLOPT_HTTPHEADER => array(
            'X-API-USER: ' . $_SESSION[EMAIL] . '',
            'X-API-KEY: ' . $_SESSION[ACCESSTOKEN] . '',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $response = json_decode($response, true);
    if ($response['error'] == false && $response['success'] == true) {
        header("Location:../records.php");
        exit();
    }
} elseif (isset($_POST['withdraw']) && isset($_POST['userID']) && isset($_SESSION[ACCESSTOKEN]) && isset($_SESSION[EMAIL])) {
    $withdraw = $_POST['withdraw'];
    $userID = $_POST['userID'];
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost:8888/user/Withdraw',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
        "id":' . $userID . ',
        "setWithdraw":true,
        "withdraw":' . $withdraw . '
    }',
        CURLOPT_HTTPHEADER => array(
            'X-API-USER: ' . $_SESSION[EMAIL] . '',
            'X-API-KEY: ' . $_SESSION[ACCESSTOKEN] . '',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $response = json_decode($response, true);
    if ($response['error'] == false && $response['success'] == true) {
        header("Location:../records.php");
        exit();
    }
} elseif (isset($_POST['getTransaction']) && isset($_SESSION[ACCESSTOKEN]) && isset($_SESSION[EMAIL])) {

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
    "id":' . $_SESSION[AID] . ',
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
