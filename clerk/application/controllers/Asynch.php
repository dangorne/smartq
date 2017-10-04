<?php

  class Asynch extends CI_Controller{

    public function __construct(){

      parent::__construct();

      $this->load
        ->library('session')
        ->model('main_model')
        ->helper('url_helper');
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

    public function fetchtable(){

      $var = $this->getpost('search');

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

    public function fetchqueuers(){

      $result = $this->main_model->fetchqueuers($_SESSION['username'], $this->getpost('selected'));

      foreach ($result as $row){

        echo '<tr>';
        echo '<td>'.date('h:i:s A, l - d M Y', strtotime($row->join_time)).'</td>';
        echo '<td>'.$row->queue_number.'</td>';
        echo '</tr>';
      }
    }

    public function join(){

      echo json_encode(array('res' => $this->main_model->join($_SESSION['username'], $this->input->post('selected'))));
    }
  }

?>
