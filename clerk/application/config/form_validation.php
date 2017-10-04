<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
  'syntax_login' => array(
          array(
            'field' => 'user',
            'label' => 'Username',
            'rules' => 'trim|required|min_length[8]',
          ),
          array(
            'field' => 'pass',
            'label' => 'Password',
            'rules' => 'trim|required|min_length[8]|alpha_numeric',
          ),
  ),
  'syntax_signup' => array(
          array(
            'field' => 'user',
            'label' => 'Username',
            'rules' => 'trim|required|min_length[8]',
          ),
          array(
            'field' => 'pass',
            'label' => 'Password',
            'rules' => 'trim|required|min_length[8]|alpha_numeric',
          ),
          array(
            'field' => 'confirmpass',
            'label' => 'Confirm Password',
            'rules' => 'trim|required|min_length[3]|alpha_numeric',
          ),
          array(
            'field' => 'code',
            'label' => 'Permission Code',
            'rules' => 'trim|required|min_length[6]|max_length[6]|alpha_numeric',
          ),
  ),
);
