<?php

use core\library\Session;

Session::flash('error', 'Something goes wrong');

redirect('/user/create');
