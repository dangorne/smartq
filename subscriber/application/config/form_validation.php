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
            'rules' => 'trim|required|min_length[8]|alpha_numeric',
          ),
          array(
            'field' => 'idnum',
            'label' => 'ID Number',
            'rules' => 'trim|required|exact_length[9]',
          ),
          array(
            'field' => 'phonenum',
            'label' => 'Phone Number',
            'rules' => 'trim|required|exact_length[10]|numeric',
          ),
  ),
);
