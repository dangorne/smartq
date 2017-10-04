<?php

  class Main extends CI_Controller{

    //ok
    public function __construct(){

      parent::__construct();

      $this->load->library('session');
      $this->load->model('main_model');
      $this->load->helper('url_helper');
      $this->load->helper('form');
      $this->load->library('form_validation');
    }

    //ok
    public function setflash($key){

      $_SESSION[$key] = 'TRUE';
      $this->session->mark_as_flash($key);
    }

    //ok
    public function index(){

      if(isset($_SESSION['username'])){

        redirect('dashboard');
      }else{

        redirect('login');
      }
    }

    //ok
    public function logout(){

      if(isset($_SESSION['username'])){

        unset($_SESSION['username']);
      }

      redirect(base_url(). '');
    }

    //ok
    public function login(){

      if(!isset($_SESSION['username'])){

        $this->load
          ->view('templates/header_login_signup')
          ->view('login')
          ->view('templates/footer');

        unset($_SESSION['USER_NOT_EXIST']);
        unset($_SESSION['WRONG_PASS']);
      }else{

        redirect('logout');
      }
    }

    //ok
    public function signup(){

      if(!isset($_SESSION['username'])){

        $this->load
          ->view('templates/header_login_signup')
          ->view('signup')
          ->view('templates/footer');

        unset($_SESSION['SYNTAX_ERROR']);
        unset($_SESSION['PASS_NOT_MATCH']);
        unset($_SESSION['TERM_NOT_CHECK']);
        unset($_SESSION['ID_EXIST']);
      }else {

        redirect('logout');
      }
    }

    //ok
    public function dashboard(){

      if(isset($_SESSION['username'])){

        $this->load
          ->view('templates/header_logout')
          ->view('subscriber')
          ->view('dashboard')
          ->view('templates/footer');
      }else{

        redirect('login');
      }
    }

    //ok
    public function login_validated(){

      $user = $this->input->post('user');
      $pass = $this->input->post('pass');

      if($this->form_validation->run('syntax_login')){

        if($this->main_model->existingusername()){

          if($this->main_model->correctpassword()){

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

        if ($this->main_model->existingusername()){

          if(!$this->main_model->correctpassword()){

            $this->setflash('WRONG_PASS');
          }
        }else{

          $this->setflash('USER_NOT_EXIST');
        }

        $this->login();
     }
    }

    //ongoing
    public function signup_validated(){

      if ($this->form_validation->run('syntax_signup')){

       $user = $this->input->post('user');
       $pass = $this->input->post('pass');
       $confirmpass = $this->input->post('confirmpass');
       $idnum = $this->input->post('idnum');
       $term = $this->input->post('term');

       if($pass != $confirmpass){

         $this->setflash('PASS_NOT_MATCH', 'TRUE');
         $this->signup();
         return;
       }

       if($term != "accept"){

         $this->setflash('TERM_NOT_CHECK', 'TRUE');
         $this->signup();
         return;
       }

       if(!empty($this->main_model->idexist())){

         $this->setflash('ID_EXIST', 'TRUE');
         $this->signup();
         return;
       }

       if(!$this->main_model->existingusername()){

         if($this->main_model->signup()){

           $_SESSION['username'] = $user;

           redirect(base_url(). '');
         }else{

           $this->signup();
         }
       }else{

        $this->setflash('USER_EXIST', 'TRUE');
        $this->signup();
        return;

       }
      }else{

       $this->setflash('SYNTAX_ERROR', 'TRUE');
       $this->signup();
      }
    }
  }

?>
