<?php

  class Main extends CI_Controller{

    //ok
    public function __construct(){

      parent::__construct();

      $this->load
        ->model('main_model')
        ->helper('form')
        ->helper('url_helper')
        ->library('session')
        ->library('form_validation');
    }

    public function setflash($key){

      $_SESSION[$key] = 'TRUE';
      $this->session->mark_as_flash($key);
    }

    public function getpost($key, $type = 'NULL'){

      $data = $this->input->post($key);

      if(empty($data) && $type == 'NOT_NULL_STR'){

        return 'NONE';
      }

      if(empty($data) && $type == 'NOT_NULL_NUM'){

        return 0;
      }

      return $data;
    }













    public function index(){

      if(isset($_SESSION['username'])){

        redirect('dashboard');
      }else{

        redirect('login');
      }
    }


























    public function dashboard(){

      if(isset($_SESSION['username'])){

        $this->load
          ->view('templates/header_logout')
          ->view('dashboard')
          ->view('clerk')
          ->view('templates/footer');

          unset($_SESSION['USER_NOT_EXIST']);
          unset($_SESSION['WRONG_PASS']);
      }else{

        redirect('login');
      }
    }

    public function logout(){

      if(isset($_SESSION['username'])){

        unset($_SESSION['username']);
      }

      redirect(base_url(). '');
    }

    public function login(){

      if(!isset($_SESSION['username'])){

        $this->load
          ->view('templates/header_login_signup')
          ->view('login')
          ->view('templates/footer');
      }else{

        redirect('logout');
      }
    }

    public function signup(){

      if(!isset($_SESSION['username'])){

        $this->load
          ->view('templates/header_login_signup')
          ->view('signup')
          ->view('templates/footer');

        unset($_SESSION['SYNTAX_ERROR']);
        unset($_SESSION['PASS_NOT_MATCH']);
        unset($_SESSION['USER_EXIST']);
      }else {

        redirect('logout');
      }
    }

    //ok
    public function login_validated(){

      if($this->form_validation->run('syntax_login')){

        $type = 'clerk';
        $user = $this->getpost('user');
        $pass = $this->getpost('pass');

        if($this->main_model->existingusername($user, $type)){

          if($this->main_model->correctpassword($user, $pass, $type)){

            $_SESSION['username'] = $user;

            redirect('dashboard');
          }else{

            $this->setflash('WRONG_PASS');
            $this->login();
          }
       }else{

          $this->setflash('USER_NOT_EXIST');
          $this->login();
       }
     }else{

        $type = 'clerk';
        $user = $this->getpost('user');
        $pass = $this->getpost('pass');

        if ($this->main_model->existingusername($user, $type)){

          if(!$this->main_model->correctpassword($user, $pass, $type)){

            $this->setflash('WRONG_PASS');
          }
        }else{

          $this->setflash('USER_NOT_EXIST');
        }

        $this->login();
     }
    }

    public function signup_validated(){

      if($this->form_validation->run('syntax_signup')){

        $type = 'clerk';
        $user = $this->getpost('user');
        $pass = $this->getpost('pass');
        $confirmpass = $this->getpost('confirmpass');
        $code = $this->getpost('code');

        if($pass != $confirmpass){

          $this->setflash('PASS_NOT_MATCH');
          $this->signup();
          return;
        }

        if(!$this->main_model->existingcode($code, $type)){

          $this->setflash('CODE_NOT_EXIST');
          $this->signup();
          return;
        }

        if(!$this->main_model->existingusername($user, $type)){

          if($this->main_model->signup($user, $pass, $code, $type)){

            $_SESSION['username'] = $user;

            redirect(base_url(). '');
          }else{

            $this->signup();
          }
        }else{

         $this->setflash('USER_EXIST');
         $this->signup();
         return;

        }
      }else{

        $this->signup();
      }
    }
  }

?>
