<?php class Atletas_admin extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('atletas_admin_model');
		$this->load->helper('url');
		$this->load->model('general_model');
		$this->load->model('usuario_model');
		$this->load->model('evento_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	public function index()
	{
		if($this->session->userdata('logged') != TRUE){
			redirect(base_url().'gs_login');
		}
		$data['atletas'] =  $this->atletas_admin_model->get(1);
		$data['paginas'] =  $this->atletas_admin_model->numero_paginas();
		$data['pagina'] =  1;
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('administrar/atletas_admin',$data);
		$this->load->view('template/footer');
	}
	
	public function nuevo()
	{
		if($this->session->userdata('logged') != TRUE){
			redirect(base_url().'gs_login');
		}	
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('inscripcion/nueva');
		$this->load->view('template/footer');
	}
	
	public function exporte_xls()
	{
		if($this->session->userdata('logged') != TRUE){
			redirect(base_url().'gs_login');
		}
		
		$cedula = $this->input->post('_cedula');
		$nombre = $this->input->post('_nombre');
		$sexo = $this->input->post('_sexo');
		$validado = $this->input->post('_validado');
		$evento = $this->input->post('_evento');
		$categoria = $this->input->post('_categoria');
		
		$data['atletas'] = $this->atletas_admin_model->buscar($cedula, $nombre, $sexo, $validado, $evento, $categoria);
		$this->load->view('template/header');
		$this->load->view('administrar/importe_xls',$data);
		$this->load->view('template/footer');
	}
	
	public function p($pagina)
	{
		if($this->session->userdata('logged') != TRUE){
			redirect(base_url().'gs_login');
		}
		$data['atletas'] =  $this->atletas_admin_model->get($pagina);
		$data['paginas'] =  $this->atletas_admin_model->numero_paginas();
		$data['pagina'] =  $pagina;
		if ($pagina>$data['paginas']+1)
		{
			redirect(base_url().'atletas_admin');
		}
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('administrar/atletas_admin',$data);
		$this->load->view('template/footer');
	}
	
	public function validacion_carrera()
	{
		if($this->session->userdata('logged') != TRUE){
			redirect(base_url().'gs_login');
		}
		
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('administrar/validacion_carrera');
		$this->load->view('template/footer');
	}
	public function validacion_caminata()
	{
		if($this->session->userdata('logged') != TRUE){
			redirect(base_url().'gs_login');
		}
		
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('administrar/validacion_caminata');
		$this->load->view('template/footer');
	}
	
	public function estadisticas()
	{
		if($this->session->userdata('logged') != TRUE){
			redirect(base_url().'gs_login');
		}
		$data['total_atletas'] =  $this->atletas_admin_model->total_atletas();
		$data['total_atletas_validados'] =  $this->atletas_admin_model->total_atletas_validados('true');
		$data['total_atletas_no_validados'] =  $this->atletas_admin_model->total_atletas_validados('false');
		$data['total_atletas_caminata'] =  $this->atletas_admin_model->total_atletas_evento(1);
		$data['total_atletas_carrera'] =  $this->atletas_admin_model->total_atletas_evento(2);
//		$data['atletas'] =  $this->atletas_admin_model->get($pagina);
		$data['atletas_categoria'] =  $this->atletas_admin_model->atletas_categoria();
		$data['atletas_categoria_m'] =  $this->atletas_admin_model->atletas_categoria('M');
		$data['atletas_categoria_f'] =  $this->atletas_admin_model->atletas_categoria('F');
		
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('administrar/estadisticas' , $data);
		$this->load->view('template/footer');
	}

public function pdf_estadistica()
{
		$data['total_atletas'] =  $this->atletas_admin_model->total_atletas();
		$data['total_atletas_validados'] =  $this->atletas_admin_model->total_atletas_validados('true');
		$data['total_atletas_no_validados'] =  $this->atletas_admin_model->total_atletas_validados('false');
		$data['total_atletas_caminata'] =  $this->atletas_admin_model->total_atletas_evento(1);
		$data['total_atletas_carrera'] =  $this->atletas_admin_model->total_atletas_evento(2);
//		$data['atletas'] =  $this->atletas_admin_model->get($pagina);
		$data['atletas_categoria_carrera'] =  $this->atletas_admin_model->atletas_categoria();
		$data['atletas_categoria_caminata'] =  $this->atletas_admin_model->atletas_categoria_caminata();

		$this->load->library('mpdf');

		$header = $this->load->view('pdf/pdf_header',null,TRUE);
		$html = $this->load->view('pdf/estadistica',$data,TRUE);
		$pie = $this->load->view('pdf/pdf_pie',null,TRUE);
		
		$mpdf = new mPDF('utf-8', 'LETTER');//, 0, '', 15, 15, 15, 15, 8, 8);
		$mpdf->SetTopMargin(50);
		$mpdf->SetHTMLHeader($header);
		$mpdf->setHTMLFooter($pie);
		$mpdf->WriteHTML($html);
		$nombre = 'inscripcion10k5k_'.$id.'.pdf';
		$mpdf->Output($nombre,'I');
	}
	
	public function get_numero()
	{
		$cedula = $this->input->post('cedula');
		
		echo json_encode($this->atletas_admin_model->get_numero($cedula));
	}
	
	public function buscar()
	{
		$cedula = $this->input->post('_cedula');
		$nombre = $this->input->post('_nombre');
		$sexo = $this->input->post('_sexo');
		$validado = $this->input->post('_validado');
		$evento = $this->input->post('_evento');
		$categoria = $this->input->post('_categoria');
		
		echo json_encode($this->atletas_admin_model->buscar($cedula, $nombre, $sexo, $validado, $evento, $categoria));
	}
	
	public function eliminar($id)
	{
		echo $this->atletas_admin_model->eliminar($id);
	}
	
	
	/*-------------------------------Validacion de carrera y caminata-----------------------------*/
		public function validacion_carrera_envio()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('cedula', 'Cedula', 'required|min_length[7]|max_length[10]');
		$this->form_validation->set_rules('numero', 'Numero', 'required|min_length[1]|max_length[4]');
		if($this->form_validation->run())
		{
			$cedula = $this->input->post('cedula');
			$numero = $this->input->post('numero');
			echo $this->atletas_admin_model->validar_usuario_carrera($numero, $cedula);
		}
		else{
			echo -10;
		}
	}
	
		public function validacion_caminata_envio()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('cedula', 'Cedula', 'required|min_length[7]|max_length[10]');
		$this->form_validation->set_rules('numero', 'Numero', 'required|min_length[1]|max_length[4]');
		if($this->form_validation->run())
		{
			$cedula = $this->input->post('cedula');
			$numero = $this->input->post('numero');
			echo $this->atletas_admin_model->validar_usuario_caminata($numero, $cedula);
		}
		else{
			echo -10;
		}
	}
		
}

?>
