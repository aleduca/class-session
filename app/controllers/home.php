<?php

use app\database\model\User;
use core\library\Session;

$user = new User;
$user = $user->find('id', 5);

// Session::session_flash('name', 'My name is Alexandre');

view('app/views/home.php', ['user' => $user]);
