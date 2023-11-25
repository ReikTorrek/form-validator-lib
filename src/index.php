<?php
use App\Form;

require_once 'app/Form.php';
require_once '../vendor/autoload.php';
$data = ['name' => 'Vasya', 'login' => 'Vasya123'];
$form = new Form($data);

$isValidated = $form->validate([
    'name' => 'string|min:3|max:10',
    'login' => 'string|required|min:3|max:10',
]);