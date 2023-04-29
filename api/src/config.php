<?php

class Config
{
    private $dbConfig;
    private $errorSettings;

    public function __construct()
    {
        $this->dbConfig = ["dbname" => "banking", "user" => "root", "password" => "", "host" => "localhost", "driver" => "pdo_mysql"];
    }

    public function getDbConfig()
    {
        return $this->dbConfig;
    }
}
