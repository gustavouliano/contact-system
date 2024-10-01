<?php

namespace App\Repositories;

use App\Database\Connection;
use App\Models\ContactModel;
use App\Models\PersonModel;

class ContactRepository
{

    public function findByPersonId(int $personId): array
    {
        $entityManager = Connection::getInstance()->getEntityManager();
        $dql = "SELECT c, p FROM App\Models\ContactModel c JOIN c.personModel p WHERE p.id = :personId ORDER BY c.id";
        $query = $entityManager->createQuery($dql);
        $query->setParameter('personId', $personId);
        return $query->getResult();
    }

    public function create(bool $type, string $description, int $personId): ContactModel
    {
        $person = Connection::getInstance()->getEntityManager()->find(PersonModel::class, $personId);
        if (!$person) {
            return null;
        }
        $contact = new ContactModel();
        $contact->setType($type);
        $contact->setDescription($description);
        $contact->setPersonModel($person);
        Connection::getInstance()->getEntityManager()->persist($contact);
        Connection::getInstance()->getEntityManager()->flush();

        return $contact;
    }

    public function update(int $id, ?bool $type, ?string $description): ?ContactModel
    {
        $contact = Connection::getInstance()->getEntityManager()->find(ContactModel::class, $id);
        if (!$contact) {
            return null;
        }
        if ($type !== null) {
            $contact->setType($type);
        }
        if ($description !== null) {
            $contact->setDescription($description);
        }
        Connection::getInstance()->getEntityManager()->persist($contact);
        Connection::getInstance()->getEntityManager()->flush();
        return $contact;
    }

    public function delete(int $id): bool
    {
        $entityManager = Connection::getInstance()->getEntityManager();
        $contact = $entityManager->find(ContactModel::class, $id);
        if (!$contact) {
            return false;
        }
        $entityManager->remove($contact);
        $entityManager->flush();
        return true;
    }
}
