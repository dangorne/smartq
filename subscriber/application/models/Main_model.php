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
      ->count_all_results('subscriber');

    if($result == 1){
      return TRUE;
    }

    return FALSE;
  }

  //ok
  public function correctpassword(){

    $result = $this->db
      ->where('username', $this->input->post('user'))
      ->where('password', $this->input->post('pass'))
      ->count_all_results('subscriber');

    if($result == 1){
      return TRUE;
    }

    return FALSE;
  }

  //ok
  public function idexist(){
    return $this->db
      ->where('id_number', $this->input->post('idnum'))
      ->get('subscriber')
      ->row();
  }
  
  //ok
  public function signup(){

		$this->load->helper('url');

    if($this->existingusername()){
      return FALSE;
    }

    $this->db->reset_query();

		$data = array(
      'id_number' => $this->input->post('idnum'),
			'userName' => $this->input->post('user'),
			'password' => $this->input->post('pass'),
      'cell_number' => "+63".$this->input->post('phonenum'),
      'subscriber_college' => $this->input->post('college'),
		);

		$this->db->insert('subscriber', $data);

    return TRUE;
	}

  //ok
  public function getcurrentservicenum($var){

    $serving = $this->db
      ->where('queue_name', $var)
      ->get('client_transaction')
      ->row();

    if(empty($serving)){
      $serving = 0;
    }else{
      $serving = $serving->serving_atNo;
    }

    $click = $this->db
      ->where('queue_name', $var)
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
  public function getstatus($queue){

    $result = $this->db
      ->where('queue_name', $queue)
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
  public function getsearchresult($match){

    if(!empty($match)){

      $result = $this->db
        ->like('queue_name', $match)
        ->group_start()
        ->where('life', 1)
        ->or_where('life', 2)
        ->or_where('life', 3)
        ->group_end()
        ->get('client_transaction')
        ->result();

      return $result;
    }

    $result = $this->db
      ->where('life', 1)
      ->or_where('life', 2)
      ->or_where('life', 3)
      ->get('client_transaction')
      ->result();

    return $result;
  }

  //ok
  public function fetchlist(){

  return $this->db
          ->where('id_number', $this->getsubscriberid())
          ->where('queuer_state', 'in')
          ->get('queuer')
          ->result();
  }

  //ok
  public function getself($queue){

  $result = $this->db
    ->where('id_number', $this->getsubscriberid())
    ->where('queue_name', $queue)
    ->where('queuer_state', 'in')
    ->get('queuer')
    ->row();

  if(empty($result)){
    return 0;
  }

  return $result->queue_number;
  }

  //ok
  public function fetchpanel(){

    return $this->db
      ->where('queue_name', $this->input->post('selected'))
      ->get('client_transaction')
      ->row();
  }

  //ok
  public function alreadyinqueue($queue){

    $result = $this->db
      ->where('id_number', $this->getsubscriberid())
      ->where('queue_name', $queue)
      ->where('queuer_state', 'in')
      ->count_all_results('queuer');

    if($result == 1){
      return TRUE;
    }

    return FALSE;
  }

  //ok
  public function getsubscriberid(){

    $result = $this->db
      ->where('username', $_SESSION['username'])
      ->get('subscriber')
      ->row();

    if(!empty($result)){
      return $result->id_number;
    }else{
      return 'none';
    }
  }

  //ok
  public function incrementedlastnumber($queue){

    $increment = $this->db
      ->where('queue_name', $queue)
      ->set('total_deployNo', 'total_deployNo+1', FALSE)
      ->update('client_transaction');

    if(empty($increment)){

      return 0;
    }

    $result = $this->db
      ->where('queue_name', $queue)
      ->get('client_transaction')
      ->row();

    if(empty($result)){

      return 0;
    }

    return $result->total_deployNo;
  }

  //ok
  public function join($queue){

    date_default_timezone_set('Asia/Manila');

    if($this->alreadyinqueue($queue)){
      return 'EXIST';
    }

    $status = $this->getstatus($queue);

    if($status == 'ONGOING'){

      $this->db->insert('queuer', array(
        'id_number' => $this->getsubscriberid(),
        'queue_name' => $queue,
        'queue_number' => $this->incrementedlastnumber($queue),
        'join_time' => date('Y-m-d H:i:s'),
        'join_type' => 'web',
   		));

      return 'ONGOING';
    }else if($status == 'PAUSED'){

      return 'PAUSED';
    }else if($status == 'CLOSED'){

      return 'CLOSED';
    }else if($status == 'UNDEFINED'){

      return 'UNDEFINED';
    }
 	}

  //ok
  public function leave($queue){

    if(!$this->alreadyinqueue($queue)){
      return 'NOTINQUEUE';
    }

    if($this->db
      ->where('id_number', $this->getsubscriberid())
      ->where('queue_name', $queue)
      ->set('queuer_state', 'out')
      ->update('queuer')){

      return 'LEFT';
    }

    return 'FAIL';
  }

  //ok
  public function fetchsubdetail(){

    return $this->db
      ->where('username', $_SESSION['username'])
      ->get('subscriber')
      ->row();
  }

  //ok
  public function savesubdetail(){

    return $this->db
      ->where('userName', $_SESSION['username'])
      ->set('cell_number', $this->input->post('phonenum'))
      ->set('subscriber_college', $this->input->post('college'))
      ->update('subscriber');
  }

}
