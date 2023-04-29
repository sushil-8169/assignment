<?php


use Psr\http\Message\ServerRequestInterface as Request;
use Psr\http\Message\ResponseInterface as Response;

require_once __DIR__ . '/../middlewares/jsonBodyParsed.php';
require_once __DIR__ . '/../middlewares/authentication.php';
require_once __DIR__ . '/../src/user-defined.php';


$app->get('/banker/all-user', function (Request $request, Response $response, $args) {
    $error = false;
    $success = false;
    $msg = "";
    if ($request->getMethod() == 'GET') {
        $data = $request->getParsedBody();
        $data1 = [];
        if (isset($data['getUser']) && $data['getUser'] == true) {
            try {
                $queryBuilder = $this->get('DB')->getQueryBuilder();
                $queryBuilder->SELECT('*')->from('user')->where('userFlag = ?')->setParameter(1, '0');
                $res = $queryBuilder->executeQuery();
            } catch (\Exception $e) {
                return configFunction::sendErrorResponse([
                    "msg" => "Something went wrong"
                ]);
            }
            if ($res->rowCount() > 0) {
                $success = true;
                $msg = "User Data Fetch Successfully";
                while ($row = $res->fetchAssociative()) {
                    $value = array("id" => $row['id'], "name" => $row['name'], "email" => $row['emailID'], "createdOn" => $row['createdOn']);
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
