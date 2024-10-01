<?php

namespace App\Controllers;

use App\Repositories\PersonRepository;
use Error;
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
            SimpleRouter::response()->httpCode(400);
            throw new Error('Name or CPF field has null value.');
        }
        if (!$this->validateCpf($cpf)) {
            SimpleRouter::response()->httpCode(400);
            throw new Error('Invalid CPF');
        }
        $person = $this->repository->create($name, $cpf);
        SimpleRouter::response()->httpCode(201);
        return $this->getAsJson([$person]);
    }

    public function update(int $id, ?string $name, ?string $cpf)
    {
        if ($cpf && !$this->validateCpf($cpf)) {
            SimpleRouter::response()->httpCode(400);
            throw new Error('Invalid CPF');
        }
        $person = $this->repository->update($id, $name, $cpf);
        return $this->getAsJson([$person]);
    }

    public function delete(int $id)
    {
        $this->repository->delete($id);
        return true;
    }

    private function validateCpf(string $cpf)
    {
        // Extrai somente os números
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
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
