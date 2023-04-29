<?php

use Slim\Psr7\Response as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Routing\RouteContext;



$authentication = function (Request $request, RequestHandler $handler) {
    $userName = $request->getHeaderLine('X-API-USER');
    $apiKey = $request->getHeaderLine('X-API-KEY');

    if (empty($userName) || empty($apiKey)) {
        return sendErrorResponse([
            'msg' => "Specify the username and API key for authentication"
        ]);
    } else {
        $queryBuilder = $this->get('DB')->getQueryBuilder();
        $queryBuilder->SELECT('*')->from('user')->where('emailID=?')->setParameter(1, $userName);
        $res = $queryBuilder->executeQuery();
        if ($res->rowCount() > 0) {
            if ($row = $queryBuilder->fetchAssociative()) {
                if ($row['accessToken'] != $apiKey) {
                    return sendErrorResponse([
                        'msg' => "Invalid API Key"
                    ]);
                }
            } else {
                return sendErrorResponse([
                    'msg' => "Something Went Wrong"
                ]);
            }
        } else {
            return sendErrorResponse([
                'msg' => "Invalid Username"
            ]);
        }
    }

    $response = $handler->handle($request);
    return $response;
};

$allowOrigin = function (Request $request, RequestHandlerInterface $handler): Response {
    $routeContext = RouteContext::fromRequest($request);
    $routingResults = $routeContext->getRoutingResults();
    $methods = $routingResults->getAllowedMethods();
    $requestHeaders = $request->getHeaderLine('Access-Control-Request-Headers');

    $response = $handler->handle($request);

    $response = $response->withHeader('Access-Control-Allow-Origin', '*');
    $response = $response->withHeader('Access-Control-Allow-Methods', implode(',', $methods));
    $response = $response->withHeader('Access-Control-Allow-Headers', $requestHeaders);

    // Optional: Allow Ajax CORS requests with Authorization header
    $response = $response->withHeader('Access-Control-Allow-Credentials', 'true');

    return $response;
};

function sendErrorResponse($error)
{
    $response = new Response();
    $response->getBody()->write(json_encode($error));
    $newResponse = $response->withStatus(401);
    return $newResponse;
}
