<?php
require_once '../vendor/autoload.php';

use App\Form;

$data = ['name' => 'Vasya', 'login' => 'Vasya123', 'id' => 11452321, 'favorites' => ['asd', 'asd'], 'some_staff' => ['key1' => 123, 'key2' => 'asd']];
$form = new Form($data);

$isValidated = $form->validate([
    'name' => 'string',
    'login' => 'string|required|min:3',
    'id' => 'integer|len:8',
    'favorites' => 'array'
]);

//If you really need to validate not associative array in form do it separately.
$formArray = new Form($data['favorites']);

$isValidatedFavorites = $formArray->validate([
    0 => 'string',
    1 => 'string|max:1'
]);

//If you need to validate associative array in form you must always do it separately.
$formAssocArray = new Form($data['some_staff']);

$isValidatedAssoc = $formAssocArray->validate([
    'key1' => 'int|len:3',
    'key2' => 'string|max:3'
]);

dd($isValidated, $isValidatedFavorites, $isValidatedAssoc);