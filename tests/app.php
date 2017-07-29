<?php
use app\models\User2;

require __DIR__ . '/_bootstrap.php';

$user = new User2();

$user->username = 'test_name';
$user->email = 'test@mail.ru';

print_r($user->getAttributes());
