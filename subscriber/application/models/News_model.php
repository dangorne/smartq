<?php
class News_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

		public function get_news($slug = FALSE)
		{ 
                $query = $this->db->get('client');
                return $query->result_array();
		}

		public function set_news()
		{
			$this->load->helper('url');

			$data = array(
				'user' => $this->input->post('user'),
				'pass' => $this->input->post('pass'),
				'office' => $this->input->post('office'),
				'code' => $this->input->post('code')
			);

			return $this->db->insert('client', $data);
		}

}
