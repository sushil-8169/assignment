<?php

use Doctrine\DBAL\DriverManager as DriverManager;

class DB
{
    private $qb;
    private $conn;
    private $connParameters;

    public function __construct(Config $config)
    {
        $this->connParameters = $config->getDbConfig();
        $this->conn = DriverManager::getConnection($this->connParameters);
        $this->qb = $this->conn->createQueryBuilder();
    }

    public function getQueryBuilder()
    {
        return $this->qb;
    }
}
