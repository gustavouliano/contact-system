<?php

namespace App\Controllers;

use App\Models\PersonModel;
use App\Repositories\PersonRepository;
use App\Views\View;
use Pecee\Http\Request;
use Pecee\SimpleRouter\SimpleRouter;

class PersonController
{

    private PersonRepository $repository;

    public function __construct(PersonRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findAll()
    {

        $personModel = $this->repository->findAll();
        return $this->getAsJson($personModel);
    }

    public function create(string $name, string $cpf)
    {
        if (!$name || !$cpf) {
            return SimpleRouter::response()->httpCode(400);
        }
        $person = $this->repository->create($name, $cpf);
        SimpleRouter::response()->httpCode(201);
        return $this->getAsJson([$person]);
    }

    public function update(int $id, ?string $name, ?string $cpf)
    {
        $person = $this->repository->update($id, $name, $cpf);
        return $this->getAsJson([$person]);
    }

    public function delete(int $id)
    {
        $this->repository->delete($id);
        SimpleRouter::response()->httpCode(204);
        return true;
    }

    protected function getAsJson(array $personModel): string
    {
        $persons = [];
        foreach ($personModel as $person) {
            $persons[] = [
                'id' => $person->getId(),
                'name' => $person->getName(),
                'cpf' => $person->getCpf(),
            ];
        }
        return json_encode($persons);
    }
}
