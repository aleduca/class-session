<?php

session_start();

use core\library\Route;
use core\library\Session;

require '../vendor/autoload.php';

Route::resolve(require '../app/routes/routes.php');

Session::remove_flash();
