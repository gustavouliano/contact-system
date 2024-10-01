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
            isDevMode: true
        );

        $doctrineConnection = DriverManager::getConnection([
            'dbname' => getenv('DATABASE_NAME', true) ?: getenv('DATABASE_NAME'),
            'user' => getenv('DATABASE_USER', true) ?: getenv('DATABASE_USER'),
            'password' => getenv('DATABASE_PASS', true) ?: getenv('DATABASE_PASS'),
            'host' => getenv('DATABASE_HOST', true) ?: getenv('DATABASE_HOST'),
            'port' => getenv('DATABASE_PORT', true) ?: getenv('DATABASE_PORT'),
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
