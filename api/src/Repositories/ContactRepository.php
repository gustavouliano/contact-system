<?php

namespace App\Repositories;

use App\Database\Connection;
use App\Models\ContactModel;
use App\Models\PersonModel;

class ContactRepository
{

    public function findByPersonId(int $personId): array
    {
        $dql = "SELECT c, p FROM App\Models\ContactModel c JOIN c.personModel p WHERE p.id = :personId ORDER BY c.id";
        $query = Connection::getInstance()->getEntityManager()->createQuery($dql);
        $query->setParameter('personId', $personId);
        return $query->getResult();
    }

    public function findById(int $contactId): ?ContactModel
    {
        return Connection::getInstance()->getEntityManager()->find(ContactModel::class, $contactId);
    }

    public function create(bool $type, string $description, int $personId): ?ContactModel
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

    public function update(ContactModel $contact, ?bool $type, ?string $description): ?ContactModel
    {
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
        $contact = $this->findById($id);
        if (!$contact) {
            return false;
        }
        Connection::getInstance()->getEntityManager()->remove($contact);
        Connection::getInstance()->getEntityManager()->flush();
        return true;
    }
}
