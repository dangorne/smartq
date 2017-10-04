<?php
class Main_model extends CI_Model {

  //ok
  public function __construct(){
    $this->load->database();
  }

  //ok
  public function existingusername(){

    $result = $this->db
      ->where('username', $this->input->post('user'))
      ->count_all_results('client');

    if($result == 1){
      return TRUE;
    }

    return FALSE;
	}

  //ongoing
  public function updatedeploy($joined=0){

    $update_click = $this->db
      ->where('queue_name', $this->getqueuename())
      ->set('total_deployNo', 'total_deployNo+'.$joined, FALSE)
      ->update('client_transaction');

    if($update_click){
      return TRUE;
    }

    return FALSE;
  }

  //ok
  public function correctpassword(){

    $result = $this->db
      ->where('username', $this->input->post('user'))
      ->where('password', $this->input->post('pass'))
      ->count_all_results('client');

    if($result == 1){
      return TRUE;
    }

    return FALSE;
  }

  //ok
  public function signup(){

    if($this->existingusername()){

      return FALSE;
    }

    if(!$this->existingcode()){

      return FALSE;
    }

    $data = array(
      'username' => $this->existingusername(),
      'password' => $this->existingcode(),
      'queue_name' => "none",
      'current' => 0,
      'display_name' => "none",
    );

    if($this->db->insert('client', $data)){
      return TRUE;
    }

    return FALSE;
	}

  //ok
  public function fetchlist(){

    if($this->hasqueue()){
      return;
    }

    return $this->db->get('client_transaction')->result();
  }

  //ok
  public function getclients(){

    $queue_name = $this->getqueuename();

    if($queue_name !== 'none'){

      $result = $this->db
        ->where('queue_name', $queue_name)
        ->where('display_name !=', 'none')
        ->get('client');

      return $result;
    }

    return;
  }

  //ok
  public function existingqueue(){

    $result = $this->db
      ->where('queue_name', $this->input->post('input')['name'])
      ->count_all_results('client_transaction');

    if($result == 1){
      return TRUE;
    }

    return FALSE;
	}

  //ok
  public function existingcode(){

    $result = $this->db
      ->query("SELECT * FROM client_code WHERE BINARY code = ".$this->db->escape($this->input->post('code'))."")
      ->num_rows();

    if($result == 1){
      return TRUE;
    }

    return FALSE;
  }

  //ok
  public function create(){

    if($this->existingqueue()){
      return 'EXISTING';
    }

    $data = array(
      'queue_name' => $this->input->post('input')['name'],
      'queue_code' => $this->input->post('input')['code'],
      'seats_offered' => $this->input->post('input')['seat'],
      'requirements' => $this->input->post('input')['req'],
      'venue' => $this->input->post('input')['venue'],
      'queue_description' => $this->input->post('input')['desc'],
      'queue_restriction' => $this->input->post('input')['rest'],
      'serving_atNo' => 0,
      'total_deployNo' => 0,
      'life' => 1,
      'click' => 0
    );

    if($this->db->insert('client_transaction', $data)){
      return 'CREATED';
    }

    return 'ERROR';
  }

  //ok
  public function join(){

    if($this->hasqueue()){
      return 'HAS_QUEUE';
    }

    $result = $this->db
      ->set('queue_name', $this->input->post('selected'))
      ->where('username', $_SESSION['username'])
      ->update('client');

    if($result){
      return 'JOINED';
    }

    return 'ERROR';
  }

  //ok
  public function reset(){

    if(!$this->db
      ->set('serving_atNo', 0)
      ->set('total_deployNo', 0)
      ->set('life', 1)
      ->set('click', 0)
      ->where('queue_name', $this->getqueuename())
      ->update('client_transaction')){
        return FALSE;
      }

    //set all queuers to out
    //return FALSE if fail
    if(!$this->db
      ->set('queuer_state', 'out')
      ->where('queue_name', $this->getqueuename())
      ->update('queuer')){
        return FALSE;
      }

    //set client current service to 0
    //return FALSE if fail
    if(!$this->db
      ->set('current', 0)
      ->where('username', $_SESSION['username'])
      ->update('client')){
        return FALSE;
      }

    return TRUE;
	}

  //ok
  public function leave(){

    if(!$this->hasqueue()){
      return FALSE;
    }

    return $this->db
      ->where('username', $_SESSION['username'])
      ->set('queue_name', 'none')
      ->update('client');
  }

  //ok
	public function incrementcurrent(){

    $update_click = $this->db
      ->where('queue_name', $this->getqueuename())
      ->set('click', 'click+1', FALSE)
      ->update('client_transaction');

    if(!$update_click){
      return 0;
    }

    $update_current = $this->db
      ->set('current', $this->getcurrentservicenum())
      ->where('username', $_SESSION['username'])
      ->update('client');

    if(!$update_current){
      return 0;
    }

    return $this->getcurrentservicenum();
	}

  //ok
	public function incrementid(){

    $result = $this->db
      ->where('queue_name', $this->getqueuename())
      ->where('queue_number', $this->getcurrentservicenum())
      ->get('queuer')
      ->row();

   if($result){
     return $result->id_number;;
   }else{
     return "none";
   }
	}

  //ok
  public function hasqueue(){

    $result = $this->db
      ->where('username', $_SESSION['username'])
      ->where('queue_name', 'none')
      ->count_all_results('client');

    if($result == 0){

      return TRUE;
    }

    return FALSE;
  }

  //ok
  public function fetchdetail(){

    $result = $this->db
      ->where('queue_name', $this->getqueuename())
      ->get('client_transaction')
      ->row();

    return $result;
  }

  //ok
  public function fetchqueue(){

    $result = $this->db
      ->where('queue_name', $this->input->post('input')['name'])
      ->get('client_transaction')
      ->row();

    return $result;
  }

  //ok
  public function getqueuename(){

    $result = $this->db
      ->where('username', $_SESSION['username'])
      ->get('client')
      ->row();

    if(empty($result)){

      return 'none';
    }else{

      return $result->queue_name;
    }
  }

  //ok
  public function getcurrentservicenum(){

    $serving = $this->db
      ->where('queue_name', $this->getqueuename())
      ->get('client_transaction')
      ->row();

    if(empty($serving)){
      $serving = 0;
    }else{
      $serving = $serving->serving_atNo;
    }

    $click = $this->db
      ->where('queue_name', $this->getqueuename())
      ->get('client_transaction')
      ->row();

    if(empty($click)){
      $click = 0;
    }else{
      $click = $click->click;
    }

    return $serving + $click;
  }

  //ok
  public function getcurrentid(){

    $result = $this->db
      ->where('queue_name', $this->getqueuename())
      ->where('queue_number', $this->getcurrentservicenum())
      ->get('queuer')
      ->row();

    if(!empty($result)){
      return $result->id_number;
    }else{
      return "none";
    }
  }

  //ok
  public function getdeployno(){

    $result = $this->db
      ->where('queue_name', $this->getqueuename())
      ->get('client_transaction')
      ->row();

    if(!empty($result)){
      return $result->total_deployNo;
    }else{
      return 'none';
    }
	}

  //ok
  public function getstatus(){

    $result = $this->db
      ->where('queue_name', $this->getqueuename())
      ->get('client_transaction')
      ->row();

    if(empty($result)){

      return 'UNDEFINED';
    }

    if($result->life == 1){

      return 'ONGOING';
    }else if ($result->life == 2){

      return 'PAUSED';
    }else if ($result->life == 3){

      return 'CLOSED';
    }

    return 'UNDEFINED';
  }

  //ok
  public function setstatus($var){

    $status = $this->db
      ->where('queue_name', $this->getqueuename())
      ->set('life', $var)
      ->update('client_transaction');

    if(empty($status)){

      return FALSE;
    }else{

      return TRUE;
    }
	}

  //ok
  public function editq($type, $content){

    $update = $this->db
    ->where('queue_name', $this->getqueuename())
    ->set($type, $content)
    ->update('client_transaction');

    if($update){

      return array(
        'success' => TRUE,
        'error' => "Wrong Input"
      );
    }else{

      return array(
        'success' => FALSE,
        'error' => "Wrong Input"
      );
    }
  }

  //ok
  public function editdisplay($content){

    $update = $this->db
      ->where('username', $_SESSION['username'])
      ->set('display_name', $content)
      ->update('client');

    if($update){
      return array(
        'success' => TRUE,
        'error' => "Wrong Input"
      );
    }else{
      return array(
        'success' => FALSE,
        'error' => "Wrong Input"
      );
    }
  }

  //ok
  public function fetchdisplay(){

    $result = $this->db
      ->where('username', $_SESSION['username'])
      ->get('client')
      ->row();

    if(empty($result)){

      return 'none';
    }else{

      return $result->display_name;
    }
  }

}
