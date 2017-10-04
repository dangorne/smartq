<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'main/';
$route['logout'] = 'main/logout';
$route['dashboard'] = 'main/dashboard';
$route[''] = 'main/index';
$route['join'] = 'asynch/join';
$route['leave'] = 'asynch/leave';
$route['fetchtable'] = 'asynch/fetchtable';
$route['fetchpanel'] = 'asynch/fetchpanel';
$route['fetchlist'] = 'asynch/fetchlist';
$route['fetchsubdetail'] = 'asynch/fetchsubdetail';
$route['savesubdetail'] = 'asynch/savesubdetail';
$route['check_session'] = 'asynch/check_session';

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
