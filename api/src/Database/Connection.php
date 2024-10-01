<?php

namespace App\Database;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

class Connection
{

    private static Connection $instance;
    private EntityManager $entityManager;


    private function __construct() {}

    static public function getInstance(): Connection
    {
        if (!isset(self::$instance)) {
            self::$instance = self::initConnection();
        }
        return self::$instance;
    }

    static private function initConnection(): Connection
    {
        $connection = new Connection();
        $config = ORMSetup::createAttributeMetadataConfiguration(
            paths: [__DIR__ . '/../Models'],
        );

        $doctrineConnection = DriverManager::getConnection([
            'dbname' => 'contactsystem',
            'user' => 'postgres',
            'password' => 'postgres',
            'host' => 'postgres',
            'port' => 5432,
            'driver' => 'pgsql'
        ], $config);

        $connection->entityManager = new EntityManager($doctrineConnection, $config);
        return $connection;
    }

    public function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }
}
