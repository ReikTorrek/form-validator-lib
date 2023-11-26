<?php
require_once '../vendor/autoload.php';

use App\Form;

$data = ['name' => 'Vasya', 'login' => 'Vasya123', 'id' => 11452321];
$form = new Form($data);

$isValidated = $form->validate([
    'name' => 'string',
    'login' => 'string|required|min:3',
    'id' => 'integer',
]);

dd($isValidated);