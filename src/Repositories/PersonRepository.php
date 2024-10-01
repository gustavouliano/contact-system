<?php

namespace App\Repositories;

use App\Database\Connection;
use App\Models\PersonModel;

class PersonRepository
{

    public function findAll(): array
    {
        $personRepository = Connection::getInstance()->getEntityManager()->getRepository(PersonModel::class);
        $persons = $personRepository->findAll();
        return $persons;
    }

    public function create(string $name, string $cpf): PersonModel
    {
        $person = new PersonModel();
        $person->setName($name);
        $person->setCpf($cpf);
        Connection::getInstance()->getEntityManager()->persist($person);
        Connection::getInstance()->getEntityManager()->flush();
        return $person;
    }
}
