<?php

use App\Controllers\PersonController;
use App\Repositories\PersonRepository;
use Pecee\Http\Request;
use Pecee\SimpleRouter\SimpleRouter;

require '../vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$personRepository = new PersonRepository();
$personController = new PersonController($personRepository);


/**
 * Person routes    
 */

SimpleRouter::get('/persons', function () use ($personController) {
    return $personController->findAll();
});

SimpleRouter::post('/persons', function () use ($personController) {
    $name = $_POST['name'];
    $cpf = $_POST['cpf'];
    return $personController->create($name, $cpf);
});

SimpleRouter::patch('/persons/{id}', function ($id) use ($personController) {
    $name = $_POST['name'];
    $cpf = $_POST['cpf'];
    return $personController->update($id, $name, $cpf);
});

SimpleRouter::delete('/persons/{id}', function ($id) use ($personController) {
    return $personController->delete($id);
});

SimpleRouter::error(function (Request $request, \Exception $exception) {});

SimpleRouter::start();
