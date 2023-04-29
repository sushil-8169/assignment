<?php

use Psr\http\Message\ServerRequestInterface as Request;
use Psr\http\Message\ResponseInterface as Response;

require_once __DIR__ . '/../middlewares/jsonBodyParsed.php';
require_once __DIR__ . '/../middlewares/authentication.php';
require_once __DIR__ . '/../src/user-defined.php';



$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world!");
    return $response;
})->add($authentication);

$app->add(function ($request, $handler) {
    $response = $handler->handle($request);
    return $response
        ->withHeader('Access-Control-Allow-Origin', 'http://mysite')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

$app->post('/user', function (Request $request, Response $response, $args) {
    $error = false;
    $success = false;
    $msg = "";
    if ($request->getMethod() == 'POST') {
        $data = $request->getParsedBody();
        $username = $data['username'];
        $password = $data['password'];
        if (!empty($username) || !empty($password)) {
            try {
                $queryBuilder = $this->get('DB')->getQueryBuilder();
                $queryBuilder->SELECT('*')->from('user')->where('emailID=?', 'password=?')->setParameter(1, $username)->setParameter(2, $password);
                $res = $queryBuilder->executeQuery();
            } catch (\Exception $e) {
                return configFunction::sendErrorResponse([
                    "msg" => "Something went wrong"
                ]);
            }
            if ($res->rowCount() > 0) {
                $row = $res->fetchAssociative();
                if ($password == $row['password']) {
                    $accessToken = configFunction::randomString();
                    $queryBuilder->update('user')->set('accessToken', '?')->where('id = ?')->setParameter('1', $accessToken)->setParameter('2', $row['id']);
                    $res = $queryBuilder->executeQuery();
                    $error = false;
                    $success = true;
                    $msg = "Authorised";
                    $outputData = array("id" => $row['id'], "userType" => $row['userFlag'], "name" => $row['name'], "emailID" => $row['emailID'], "accessToken" => $accessToken);
                }
            } else {
                $error = false;
                $success = false;
                $msg = "No user Found";
            }
        } else {
            $error = false;
            $success = false;
            $msg = "Username & Password cannot be empty";
        }
    } else {
        $error = true;
        $success = false;
        $msg = "something went wrong";
    }
    $response->getBody()->write(json_encode(array(
        "error" => $error,
        "success" => $success,
        "msg" => $msg,
        "data" => $outputData
    )));
    return $response->withHeader('Content-type', 'application/json');
})->add($jsonParser)->add($allowOrigin);

$app->post('/user/transaction', function (Request $request, Response $response, $args) {
    $error = false;
    $success = false;
    $msg = "";
    if ($request->getMethod() == 'POST') {
        $data = $request->getParsedBody();
        $data1 = [];
        if (isset($data['id']) && isset($data['getTransaction']) && is_numeric($data['id']) && $data['getTransaction'] == true) {
            $id = $data['id'];
            $queryBuilder = $this->get('DB')->getQueryBuilder();
            $queryBuilder->SELECT('*')->from('accounts')->where('userID = ?')->setParameter(1, $id);
            $res = $queryBuilder->executeQuery();
            if ($res->rowCount() > 0) {
                $success = true;
                $msg = "Transaction Data Fetch Successfully";
                while ($row = $res->fetchAssociative()) {
                    $value = array("deposit" => $row['deposit'], "withdraw" => $row['withdraw'], "totalAmount" => $row['totalAmount'], "createdOn" => $row['createdOn']);
                    array_push($data1, $value);
                }
            } else {
                $error = false;
                $success = false;
                $msg = "No Records Found";
            }
        } else {
            $error = false;
            $success = false;
            $msg = "Invalid Crenditials";
        }
        $response->getBody()->write(json_encode(array("error" => $error, "success" => $success, "msg" => $msg, "data" => $data1)));
        return $response->withHeader('Content-Type', 'application/json');
    }
})->add($jsonParser)->add($authentication);

$app->post('/user/Deposit', function (Request $request, Response $response, $args) {
    $error = false;
    $success = false;
    $msg = "";
    if ($request->getMethod() == 'POST') {
        $data = $request->getParsedBody();
        if (isset($data['id']) && isset($data['setDeposit']) && is_numeric($data['id']) && $data['setDeposit'] == true && isset($data['deposit']) && is_numeric($data['deposit'])) {
            $id = $data['id'];
            $deposit = $data['deposit'];
            $queryBuilder = $this->get('DB')->getQueryBuilder();
            try {
                $queryBuilder->select('*')
                    ->from('accounts', 'a')
                    ->where('a.userID = ?')
                    ->setParameter(1, $id)
                    ->orderBy('a.id', 'DESC')
                    ->setMaxResults('1');
                $res = $queryBuilder->executeQuery();
            } catch (\Exception $e) {
                return configFunction::sendErrorResponse([
                    "msg" => "Something went wrong"
                ]);
            }
            if ($res->rowCount() > 0) {
                if ($row = $res->fetchAssociative()) {
                    $totalAmount = $row['totalAmount'];
                }
            }
            if (isset($totalAmount) && is_numeric($totalAmount)) {
                $totalAmount += $deposit;
            }
            try {
                $queryBuilder->insert('accounts')
                    ->setValue('userID', '?')
                    ->setValue('deposit', '?')
                    ->setValue('totalAmount', '?')
                    ->setParameter(1, $id)
                    ->setParameter(2, $deposit)
                    ->setParameter(3, $totalAmount);
                $res = $queryBuilder->executeQuery();
                $msg = "Deposited Succesfully";
                $success = true;
            } catch (\Exception $e) {
                return configFunction::sendErrorResponse([
                    "msg" => "Something went wrong"
                ]);
            }
        } else {
            $error = false;
            $success = false;
            $msg = "Invalid Crenditials";
        }
        $response->getBody()->write(json_encode(array("error" => $error, "success" => $success, "msg" => $msg)));
        return $response->withHeader('Content-Type', 'application/json');
    }
})->add($authentication)->add($jsonParser);

$app->post('/user/Withdraw', function (Request $request, Response $response, $args) {
    $error = false;
    $success = false;
    $msg = "";
    if ($request->getMethod() == 'POST') {
        $data = $request->getParsedBody();
        if (isset($data['id']) && isset($data['setWithdraw']) && is_numeric($data['id']) && $data['setWithdraw'] == true && isset($data['withdraw']) && is_numeric($data['withdraw'])) {
            $id = $data['id'];
            $withdraw = $data['withdraw'];
            $queryBuilder = $this->get('DB')->getQueryBuilder();
            try {
                $queryBuilder->select('*')
                    ->from('accounts', 'a')
                    ->where('a.userID = ?')
                    ->setParameter(1, $id)
                    ->orderBy('a.id', 'DESC')
                    ->setMaxResults('1');
                $res = $queryBuilder->executeQuery();
            } catch (\Exception $e) {
                return configFunction::sendErrorResponse([
                    "msg" => "Something went wrong"
                ]);
            }
            if ($res->rowCount() > 0) {
                if ($row = $res->fetchAssociative()) {
                    $totalAmount = $row['totalAmount'];
                }
            }
            if (isset($totalAmount) && is_numeric($totalAmount)) {
                $totalAmount -= $withdraw;
            }
            try {
                $queryBuilder->insert('accounts')
                    ->setValue('userID', '?')
                    ->setValue('withdraw', '?')
                    ->setValue('totalAmount', '?')
                    ->setParameter(1, $id)
                    ->setParameter(2, $withdraw)
                    ->setParameter(3, $totalAmount);
                $res = $queryBuilder->executeQuery();
                $msg = "Withdraw Succesfully";
                $success = true;
            } catch (\Exception $e) {
                return configFunction::sendErrorResponse([
                    "msg" => "Something went wrong"
                ]);
            }
        } else {
            $error = false;
            $success = false;
            $msg = "Invalid Crenditials";
        }
        $response->getBody()->write(json_encode(array("error" => $error, "success" => $success, "msg" => $msg)));
        return $response->withHeader('Content-Type', 'application/json');
    }
})->add($jsonParser)->add($authentication);
