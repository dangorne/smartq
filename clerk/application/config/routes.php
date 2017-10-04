<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'main/';
$route['logout'] = 'main/logout';
$route[''] = 'main/index';
$route['dashboard'] = 'main/dashboard';
$route['fetchtable'] = 'asynch/fetchtable';
$route['fetchlist'] = 'asynch/fetchlist';
$route['fetchqueuers'] = 'asynch/fetchqueuers';
$route['join'] = 'asynch/join';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

 $route['login'] = 'main/login_validated';
}else{
 $route['login'] = 'main/login';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

 $route['signup'] = 'main/signup_validated';
}else{
 $route['signup'] = 'main/signup';
}
