<?php

use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;
$capsule->addConnection([
   "driver" => "mysql",
   "host" => "localhost_mysql",
   "database" => "webjump",
   "username" => "yuri",
   "password" => "123"
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();