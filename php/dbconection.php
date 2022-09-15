<?php

use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;
$capsule->addConnection([
   "driver" => "pgsql",
   "host" => "localhost",
   "database" => "softexpert",
   "username" => "postgres",
   "password" => "123"
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();