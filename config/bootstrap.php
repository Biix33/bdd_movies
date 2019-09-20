<?php
require dirname(__DIR__) . '/vendor/autoload.php';

$dotEnv = Dotenv\Dotenv::create(dirname(__DIR__));
$dotEnv->load();