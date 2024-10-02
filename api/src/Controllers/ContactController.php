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
        if (strlen($description) < 3) {
            SimpleRouter::response()->httpCode(400);
            throw new Error('Description must have more than 3 characters.');
        }
        $contact = $this->repository->create($type, $description, $personId);
        if (!$contact) {
            SimpleRouter::response()->httpCode(500);
            throw new Error('Error on contact create');
        }
        SimpleRouter::response()->httpCode(201);
        return $this->getAsJson([$contact]);
    }

    public function update(int $id, ?bool $type, ?string $description)
    {
        $contact = $this->repository->findById($id);
        if (!$contact) {
            SimpleRouter::response()->httpCode(400);
            throw new Error('Contact id does not exists.');
        }
        $contact = $this->repository->update($contact, $type, $description);
        return $this->getAsJson([$contact]);
    }

    public function delete(int $id)
    {
        $this->repository->delete($id);
        SimpleRouter::response()->httpCode(204);
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
