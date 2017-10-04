<?php
class Subscriber_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }

	public function subscriber_exists()
	{

    $this->db->where('username', $this->input->post('user'));
    $this->db->where('password', $this->input->post('pass'));

    if($this->db->count_all_results('subscriber') == 1){
      return TRUE;
    }

    return FALSE;

	}

	public function register_subscriber()
	{
		$this->load->helper('url');

    if($this->subscriber_exists()){
      return FALSE;
    }

		$data = array(

			'userName' => $this->input->post('user'),
			'password' => $this->input->post('pass'),
      'id_number' => $this->input->post('idnum'),
      'cell_number' => $this->input->post('phonenum'),
      'subscriber_college' => $this->input->post('college'),
      'join_attempt_failed' => 0,
      'swap_attempt' => 0,
      'view_attempt' => 0,

		);

		$this->db->insert('subscriber', $data);

    return TRUE;
	}

}
