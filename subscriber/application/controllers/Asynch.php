<?php

  class Asynch extends CI_Controller{

    //ok
    public function __construct(){

      parent::__construct();

      $this->load->library('session');
      $this->load->model('main_model');
      $this->load->helper('url_helper');
    }

    //ok
    public function fetchsubdetail(){

      $result = $this->main_model->fetchsubdetail();

      if(empty($result)){
        echo json_encode(array(
          'success' => FALSE));
      }else{
        echo json_encode(array(
          'success' => TRUE,
          'phonenum' => $result->cell_number,
          'college' => $result->subscriber_college));
      }
    }

    //ok
    public function savesubdetail(){

      if($this->main_model->savesubdetail()){
        echo json_encode(array('Fail' == TRUE));
      }else{
        echo json_encode(array('Fail' == FALSE));
      }
    }

    //ok
    public function fetchtable(){

      $var = $this->input->post('search');

      $result = $this->main_model->getsearchresult($var);

      foreach ($result as $row){
        echo '<tr>';
        echo '<td>'.$row->queue_name.'</td>';
        echo '<td>'.$row->serving_atNo.'</td>';
        echo '<td>'.$row->total_deployNo.'</td>';
        echo '<td>'.$row->seats_offered.'</td>';
        echo '<td>'.$row->queue_description.'</td>';
        echo '<td>'.$row->queue_restriction.'</td>';
        echo '<td>'.$row->requirements.'</td>';
        echo '<td>'.$row->venue.'</td>';
        echo '</tr>';
      }
    }

    //ok
    public function fetchlist(){

      $search_result = $this->main_model->fetchlist();

      if(!empty($search_result)){

        foreach ($search_result as $row){
          echo '<div class="list-group-item list-selected">';
          echo '<span class="list-qname"><strong>'.$row->queue_name.'</strong></span>';
          echo '</div>';
        }
      }else{
        echo '';
      }
    }

    //ok
    public function fetchpanel(){

      $selected = $this->input->post('selected');

      $result = $this->main_model->fetchpanel($selected);

      //catch where the result might be empty
      //the result can be empty in 1)the subscriber is not in queue 2)some unknown error
      if(empty($result) || !$this->main_model->alreadyinqueue($selected)){

        echo json_encode(array('True' => FALSE));
      }else{

        echo json_encode(array(
          'True' => TRUE,
          'queue_name' => $result->queue_name,
          'status' => $this->main_model->getstatus($result->queue_name),
          'serving_atNo' => $this->main_model->getcurrentservicenum($selected),
          'total_deployNo' => $result->total_deployNo,
          'self' => $this->main_model->getself($selected),
          'queue_description' => $result->queue_description,
          'queue_restriction' => $result->queue_restriction,
          'requirements' => $result->requirements,
          'venue' => $result->venue,
        ));
      }
    }

    //ok
    public function join(){

      $result = array('res' => $this->main_model->join($this->input->post('selected')));
      echo json_encode($result);
    }

    //ok
    public function leave(){

      $result = array('res' => $this->main_model->leave($this->input->post('selected')));
      echo json_encode($result);
    }

    //ok
    public function check_session(){

      if(!isset($_SESSION['username'])){
        echo json_encode(array('REDIRECT' => TRUE));
      }else{
        echo json_encode(array('REDIRECT' => FALSE));
      }
    }
  }
?>
