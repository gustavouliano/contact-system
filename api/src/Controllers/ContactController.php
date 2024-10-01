<?php

namespace App\Controllers;

use App\Repositories\ContactRepository;
use Error;
use Pecee\SimpleRouter\SimpleRouter;

class ContactController
{

    private ContactRepository $repository;

    public function __construct(ContactRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findAll(int $personId)
    {
        $contactModel = $this->repository->findByPersonId($personId);
        return $this->getAsJson($contactModel);
    }

    public function create(int $personId, bool $type, string $description)
    {
        if (!$personId || !$description) {
            SimpleRouter::response()->httpCode(400);
            throw new Error('PersonId or Description field has null value.');
        }
        $contact = $this->repository->create($type, $description, $personId);
        SimpleRouter::response()->httpCode(201);
        return $this->getAsJson([$contact]);
    }

    public function update(int $id, ?bool $type, ?string $description)
    {
        $contact = $this->repository->update($id, $type, $description);
        return $this->getAsJson([$contact]);
    }

    public function delete(int $id)
    {
        $this->repository->delete($id);
        return true;
    }

    protected function getAsJson(array $contactModel): string
    {
        $contacts = [];
        foreach ($contactModel as $contact) {
            $contacts[] = [
                'id' => $contact->getId(),
                'type' => $contact->getType() == true,
                'description' => $contact->getDescription(),
            ];
        }
        return json_encode($contacts);
    }
}
