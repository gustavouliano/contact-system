<?php

use App\Database\Connection;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

require 'vendor/autoload.php';

ConsoleRunner::run(
    new SingleManagerProvider(Connection::getInstance()->getEntityManager())
);
