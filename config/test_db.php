<?php
$db = require(__DIR__ . '/db.php');
// test database! Important not to run tests on production or development databases
$db['dsn'] = 'sqlite:/home/igor/projects/backendSkill/PHPUnit/basic/data/test.db';

return $db;