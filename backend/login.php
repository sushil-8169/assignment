<?php
require("../required/config.php");
if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost:8888/user',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
    "username":"sushilgupta.2712@gmail.com",
    "password":"12345"
}',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $response = json_decode($response, true);
    if ($response['error'] == false && $response['success'] == true) {
        $_SESSION[AID] = $response['data']['id'];
        $_SESSION[EMAIL] = $response['data']['emailID'];
        $_SESSION[ACCESSTOKEN] = $response['data']['accessToken'];
        $_SESSION[NAME] = $response['data']['name'];
        $_SESSION[USER] = $response['data']['userType'];
        if ($response['data']['userType'] != 1) {
            header('LOCATION:../records.php');
            exit();
        } else {
            header('LOCATION:../all-user.php');
            exit();
        }
    } else {
        header('LOCATION:../index.php');
        exit();
    }
}
