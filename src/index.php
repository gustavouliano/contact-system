<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require 'vendor/autoload.php';

$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . '/Models'],

);

$connection = DriverManager::getConnection([
    'dbname' => 'contact-system',
    'user' => 'postgres',
    'password' => 'postgres',
    'host' => 'localhost',
    'port' => 5432,
    'driver' => 'pgsql'
], $config);

$entityManager = new EntityManager($connection, $config);