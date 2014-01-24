<?php
class Eventos extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('evento_model');
		$this->load->library('session');
	}
	
	public function get_categoria()
	{
		$evento = $this->input->post('evento');
		echo json_encode($this->evento_model->categorias($evento));
	}
	
}
 ?>