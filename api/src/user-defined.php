<?php

use Slim\Psr7\Response as Response;

class configFunction
{

    public static function secure($string)
    {
        str_replace("<script>", "", str_replace("</script>", "", trim($string)));
    }

    public static function  Encrypt($data)
    {
        return md5(md5('SALT') . $data . md5('PAPER'));
    }

    public static function randomString()
    {
        $random_bytes = random_bytes(18);
        $random_string = bin2hex($random_bytes);
        return $random_string;
    }

    public static function sendErrorResponse($error)
    {
        $response = new Response();
        $response->getBody()->write(json_encode($error));
        $newResponse = $response->withStatus(401);
        return $newResponse;
    }
}
