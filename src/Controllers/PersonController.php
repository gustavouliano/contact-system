<?php

namespace App\Controllers;

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

        $personsModel = $this->repository->findAll();
        $persons = [];
        foreach ($personsModel as $person) {
            $persons[] = [
                'id' => $person->getId(),
                'name' => $person->getName(),
                'cpf' => $person->getCpf(),
            ];
        }
        return json_encode($persons);
    }

    public function create($name, $cpf)
    {
        if (!$name || !$cpf) {
            return SimpleRouter::response()->httpCode(400);
        }
        $person = $this->repository->create($name, $cpf);
        return json_encode([
            'id' => $person->getId(),
            'name' => $person->getName(),
            'cpf' => $person->getCpf(),
        ]);
    }
}
