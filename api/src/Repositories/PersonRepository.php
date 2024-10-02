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

    public function findById(int $id): ?PersonModel
    {
        return Connection::getInstance()->getEntityManager()->find(PersonModel::class, $id);
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

    public function update(PersonModel $person, ?string $name, ?string $cpf): ?PersonModel
    {
        if ($name !== null) {
            $person->setName($name);
        }
        if ($cpf !== null) {
            $person->setCpf($cpf);
        }
        Connection::getInstance()->getEntityManager()->flush();
        return $person;
    }

    public function delete(int $id): bool
    {
        $entityManager = Connection::getInstance()->getEntityManager();
        $person = $entityManager->find(PersonModel::class, $id);
        if (!$person) {
            return false;
        }
        $entityManager->remove($person);
        $entityManager->flush();
        return true;
    }
}
