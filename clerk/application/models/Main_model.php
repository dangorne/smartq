<?php
class Main_model extends CI_Model {

  public function __construct(){

    $this->load->database();
  }

  //ok
  public function existingusername($user, $type){

    $result = $this->db
      ->where('username', $user)
      ->count_all_results($type);

    if($result == 1){
      return TRUE;
    }

    return FALSE;
	}

  //ok
  public function correctpassword($user, $pass, $type){

    $result = $this->db
      ->where('username', $user)
      ->where('password', $pass)
      ->count_all_results($type);

    if($result == 1){

      return TRUE;
    }

    return FALSE;
  }

  //ok
  public function existingcode($code, $type){

    $result = $this->db
      ->query("SELECT * FROM " .$type.'_code'. " WHERE BINARY code = ".$this->db->escape($code)."")
      ->num_rows();

    if($result == 1){
      return TRUE;
    }

    return FALSE;
  }

  //ok
	public function signup($user, $pass, $code, $type){

    if($this->existingusername($user, $type)){

      return FALSE;
    }

    if(!$this->existingcode($code, $type)){

      return FALSE;
    }

		$this->db->insert($type, array(
			'username' => $user,
			'password' => $pass,
		));

    return TRUE;
	}

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
  public function fetchqueuers($user, $queue){

    $result = $this->db
      ->where('id_number', 'walk-in')
      ->where('queue_name', $queue)
      ->where('queuer_state', 'in')
      ->where('clerk_userName', $user)
      ->get('queuer')
      ->result();

    return $result;
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
  public function join($user, $queue){

    date_default_timezone_set('Asia/Manila');

    if($this->getstatus($queue) == 'ONGOING'){

      $this->db->insert('queuer', array(
        'id_number' => 'walk-in',
        'queue_name' => $queue,
        'queue_number' => $this->incrementedlastnumber($queue),
        'clerk_userName' => $user,
        'join_time' => date('Y-m-d H:i:s'),
        'join_type' => 'web',
   		));

      return 'ONGOING';
    }else if($this->getstatus($queue) == 'PAUSED'){

      return 'PAUSED';
    }else if($this->getstatus($queue) == 'CLOSED'){

      return 'CLOSED';
    }else if($this->getstatus($queue) == 'UNDEFINED'){

      return 'UNDEFINED';
    }
 	}

}
