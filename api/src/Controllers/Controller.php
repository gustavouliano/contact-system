<?php

namespace App\Controllers;

abstract class Controller
{
    protected abstract function getAsJson(array $model): string;
}
