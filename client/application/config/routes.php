<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'main/';
$route['logout'] = 'main/logout';
$route[''] = 'main/index';
$route['next'] = 'asynch/next';
$route['create'] = 'asynch/create';
$route['dashboard'] = 'main/dashboard';
$route['join'] = 'asynch/join';
$route['pause'] = 'asynch/pause';
$route['resume'] = 'asynch/resume';
$route['reset'] = 'asynch/reset';
$route['close'] = 'asynch/close';
$route['stop'] = 'asynch/stop';
$route['create'] = 'asynch/create';
$route['fetchdetail'] = 'asynch/fetchdetail';
$route['fetchlist'] = 'asynch/fetchlist';
$route['fetchwindow'] = 'asynch/fetchwindow';
$route['status'] = 'asynch/status';
$route['editdetail'] = 'asynch/editdetail';
$route['window'] = 'main/window';
$route['join'] = 'asynch/join';
$route['leave'] = 'asynch/leave';
$route['editdisplay'] = 'asynch/editdisplay';
$route['fetchdisplay'] = 'asynch/fetchdisplay';
$route['check_session'] = 'asynch/check_session';
$route['send_notification'] = 'main/send_notification';
$route['getdata'] = 'main/getdata';

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
