<?php

  //require __DIR__.'/vendor/autoload.php';
  use Kreait\Firebase\Factory;
  use Kreait\Firebase\ServiceAccount;

  class Main extends CI_Controller{

    public function __construct(){

      parent::__construct();

      $this->load->library('session');
      $this->load->model('main_model');
      $this->load->helper('url_helper');
      $this->load->helper('form');
      $this->load->library('form_validation');

    }
  
    //ongoing
    function send ($tokens, $message){
      $url = 'https://fcm.googleapis.com/fcm/send';
      $fields = array(
         'registration_ids' => $tokens,
         'data' => $message
        );

      $headers = array(
        'Authorization:key = AAAAACPXaDU:APA91bEmmrQYSw1Is1yq8s_AM81AouVuB6-fCcYBPjcDSOQtEcGg1kg04W_fxMRLuM3YM3jtId3QQpnqWZxsitdQoL0fprdYwYaMDfooJPxAWxlznzQ0HOX4V7gV0ifseAEaorR4rhUE',
        'Content-Type: application/json'
        );

       $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $url);
         curl_setopt($ch, CURLOPT_POST, true);
         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
         $result = curl_exec($ch);           
         if ($result === FALSE) {
             die('Curl failed: ' . curl_error($ch));
         }
         curl_close($ch);
         return $result;
    }
     
    //ongoing
    public function send_notificationz(){
      
      $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/firebase_credentials.json');
      $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->create();
        
      $database = $firebase
        ->getDatabase();
      
      $reference = $database
        ->getReference('queue')
        ->push('oieee');
      
      //echo "ok";
      echo __DIR__.'/firebase_credentials.json';
      echo '</br>';
      //echo $reference->getValue();
      $conn = mysqli_connect("localhost","root","","fcm");

      $sql = " Select Token From users";

      $result = mysqli_query($conn,$sql);
      $tokens = array();

      if(mysqli_num_rows($result) > 0 ){

        while ($row = mysqli_fetch_assoc($result)) {
          $tokens[] = $row["Token"];
        }
      }

      mysqli_close($conn);

      $message = array("message" => " FCM PUSH NOTIFICATION TEST MESSAGE");
      $message_status = $this->send($tokens, $message);
      echo $message_status;
    }
    
    //ongoing
    public function send_notification(){
      
      $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/firebase_credentials.json');
      $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->create();
        
      $database = $firebase
        ->getDatabase();
        
      $result = $database
        ->getReference('token')
        ->getValue();
      
      $tokens = array();
      
      foreach ($result as $row){
        $tokens[] = $row;
      }
      
      $message = array("message" => " FCM PUSH NOTIFICATION TEST MESSAGE");
      $message_status = $this->send($tokens, $message);
      echo $message_status;
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
    
    //ongoing
    public function getData(){
      $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/firebase_credentials.json');
      $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->create();
        
      $database = $firebase
        ->getDatabase();
      
      $reference = $database
        ->getReference('queue')
        ->push('oieee');
      
      //echo "ok";
      echo __DIR__.'/firebase_credentials.json';
      echo '</br>';
      //echo $reference->getValue();
    }

    //ok
    public function window(){

      if(isset($_SESSION['username'])){

        $this->load
          ->view('window')
          ->view('windowjs');
      }else{

        redirect('logout');
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
        unset($_SESSION['USER_EXIST']);
      }else {

        redirect('logout');
      }
    }

    //ok
    public function dashboard(){

      if(isset($_SESSION['username'])){

        $this->load
          ->view('templates/header_logout')
          ->view('modal')
          ->view('client')
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

    //ok
    public function signup_validated(){

     if($this->form_validation->run('syntax_signup')){

       $user = $this->input->post('user');
       $pass = $this->input->post('pass');
       $confirmpass = $this->input->post('confirmpass');
       $code = $this->input->post('code');

       if($pass != $confirmpass){

         $this->setflash('PASS_NOT_MATCH');
         $this->signup();
         return;
       }

       if(!$this->main_model->existingcode()){

         $this->setflash('CODE_NOT_EXIST');
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
