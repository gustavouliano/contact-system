<?php

use App\Controllers\ContactController;
use App\Controllers\PersonController;
use App\Repositories\ContactRepository;
use App\Repositories\PersonRepository;
use Pecee\Http\Request;
use Pecee\SimpleRouter\SimpleRouter;

require '../vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$personRepository = new PersonRepository();
$contactRepository = new ContactRepository();
$personController = new PersonController($personRepository);
$contactController = new ContactController($contactRepository);


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

/**
 * Contact routes
 */

SimpleRouter::get('/contacts/{personId}', function ($personId) use ($contactController) {
    return $contactController->findAll($personId);
});

SimpleRouter::post('/contacts', function () use ($contactController) {
    $personId = (is_numeric($_POST['personId']) ? (int)$_POST['personId'] : 0);
    $type = $_POST['type'];
    if ($type == '1') {
        $type = 1;
    } else if ($type == '0') {
        $type = 0;
    } else {
        $type = null;
    }
    $description = $_POST['description'];
    return $contactController->create($personId, $type, $description);
});

SimpleRouter::patch('/contacts/{id}', function ($id) use ($contactController) {
    $type = $_POST['type'];
    if ($type == '1') {
        $type = 1;
    } else if ($type == '0') {
        $type = 0;
    } else {
        $type = null;
    }
    $description = $_POST['description'];
    return $contactController->update($id, $type, $description);
});

SimpleRouter::delete('/contacts/{id}', function ($id) use ($contactController) {
    return $contactController->delete($id);
});

SimpleRouter::error(function (Request $request, \Exception $exception) {});

SimpleRouter::start();
