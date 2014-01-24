<?php

/**
 * Description of administracion1
 *
 * @author desarrollo
 */
class Atletas extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('general_model');
		$this->load->model('atletas_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['atleta'] = $this->atletas_model->get($this->session->userdata('id'));
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('inscripcion/ver',$data);
		$this->load->view('template/footer');
	}

	public function registro()
	{
		$this->rand = random_string('alnum', 3);
		$this->load->helper('captcha');
		$vals = array(
				'word' => $this->rand,
				'img_path' => './media/captcha/',
				'img_url' => base_url().'media/captcha/',
				//'img_width' => '150',
				//'img_height' => 30,
				'expiration' => '600'
		);
		$cap  = create_captcha($vals);
		$this->atletas_model->guardar_captcha($cap);
		$data['cap'] = $cap;
		$data['eventos'] = $this->general_model->get('eventos');
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('inscripcion/nueva',$data);
		$this->load->view('template/footer');
	}


	public function agregar()
	{
		$this->form_validation->set_rules('cedula', 'Cedula', 'trim|required|max_length[15]');
		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('apellido', 'Apellido', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('sexo', 'Sexo', 'trim|required|max_length[1]');
		$this->form_validation->set_rules('f_nacimiento', 'Fecha Nacimiento', 'trim|required|max_length[12]');
		$this->form_validation->set_rules('direccion', 'Direccion', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('telefono', 'Telefono', 'trim|max_length[15]');
		$this->form_validation->set_rules('evento', 'Evento', 'trim|required|is_natural');
		$this->form_validation->set_rules('categoria', 'Categoria', 'trim|required|is_natural');
		$this->form_validation->set_rules('correo', 'Correo','required|valid_email|matches[correo2]');
		$this->form_validation->set_rules('correo2', 'Correo','required|valid_email');
		$this->form_validation->set_rules('captcha', 'Captcha','required|callback_verificar_captcha');

	if($this->form_validation->run())
		{
			$cedula = $this->input->post('cedula');
			$nombre = $this->input->post('nombre');
			$apellido = $this->input->post('apellido');
			$sexo = $this->input->post('sexo');
			$f_nacimiento = $this->input->post('f_nacimiento');
			$direccion = $this->input->post('direccion');
			$telefono = $this->input->post('telefono');
			$evento = $this->input->post('evento');
			$categoria = $this->input->post('categoria');
			$correo = $this->input->post('correo');

			$id = $this->atletas_model->agregar($cedula,$nombre,$apellido,$sexo,$f_nacimiento,
							$direccion,$telefono,$evento,$categoria,$correo);
			$fh_registro = $this->atletas_model->get($id);
			$fh_registro = $fh_registro->fh_registro;
			
			if ($id < 0)
			{
				$data['mensaje'] = 'Error al registrar el atleta. ¿Seguro no se registro antes?';
//				echo '-1';
			}
			else
			{
				$this->__enviar_correo($id,$correo,$nombre,$apellido,$fh_registro);
				$data['mensaje'] = 'Atleta registrado con exito, por favor verifique su correo para validar la inscripción.';
//				echo '1';
			}
		}
		else
		{
			$data['mensaje'] = 'Error al registrar el atleta. Intente de nuevo.';
//			echo '-2';
		}
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('inscripcion/mensaje',$data);
		$this->load->view('template/footer');
	}

	
	public function pdf($id,$key) {
		if(!$this->atletas_model->verificar($id,$key))
			return false;
		
		$data['atleta'] = $this->atletas_model->get($id);

		$this->load->library('mpdf');

		$header = $this->load->view('pdf/pdf_header',null,TRUE);
		$html = $this->load->view('pdf/planilla_inscripcion',$data,TRUE);
		$pie = $this->load->view('pdf/pdf_pie',null,TRUE);
		
		$mpdf = new mPDF('utf-8', 'LETTER');//, 0, '', 15, 15, 15, 15, 8, 8);
		$mpdf->SetTopMargin(50);
		$mpdf->SetHTMLHeader($header);
		$mpdf->setHTMLFooter($pie);
		$mpdf->WriteHTML($html);
		$nombre = 'inscripcion10k5k_'.$id.'.pdf';
		$mpdf->Output($nombre,'I');
	}
	
	private function __enviar_correo($id,$correo,$nombre,$apellido,$fh_registro)
	{
		$mensaje = 'Hola '.ucwords(strtolower($nombre)).' '.ucwords(strtolower($apellido))
.'.
Para validar su inscripción y descargar su comprobante visite en siguiente enlace
'.base_url().'atletas/verificar/'.$id.'/'.sha1($fh_registro);

		//Envio de Correo
		$this->load->library('email','','correo');
		$this->correo->from('carrerapazyvidabolivar@gmail.com','Carrera Paz y Vida Bolivar');
		$this->correo->to($correo);
		$this->correo->subject('Validación de Inscripción en Carrera 10k y Caminata 5k Ciudad Bolivar 2013');
		$this->correo->message($mensaje);
		if($this->correo->send())
			return 1;
		else
			return -1;
//			show_error($this->correo->print_debugger());
	}
	
	public function verificar($id,$key)
	{
		$result = $this->atletas_model->verificar($id,$key);
		if ($result == 1)
		{
			$data['mensaje']='Correo Validado con Exito.<br>';
			$data['atleta'] = $this->atletas_model->get($id);
			$data['key']= $key;
			$this->load->view('template/header');
			$this->load->view('template/menu');
			$this->load->view('inscripcion/ver',$data);
			$this->load->view('template/footer');
		}
		else
		{
			$data['mensaje']='Disculpe pero su correo no pudo ser validado. Recuerde que si ya lo validó no puede volver a hacerlo.';
			$this->load->view('template/header');
			$this->load->view('template/menu');
			$this->load->view('inscripcion/mensaje',$data);
			$this->load->view('template/footer');
		}

	}

	public function login(){
		$this->form_validation->set_rules('correo', 'Correo', 'trim|required|valid_email');
		$this->form_validation->set_rules('contrasena', 'Contraseña', 'trim|required|xss_clean');
		if ($this->form_validation->run() === FALSE)
		{
			echo -2;
		}
		else
		{	
			$correo = $this->input->post('correo');
			$contrasena = $this->input->post('contrasena');
			echo $this->_iniciar_session($correo,$contrasena);
		}
	}

	private function _iniciar_session($correo,$contrasena){
		$userdata = false;//$this->atletas_model->verificar_clave($correo,$contrasena);
		if($userdata == false){
			return -1;
		}else{
			$newdata = array(
				'id' => $userdata->id,
				'cedula' => $userdata->cedula,
				'nombre'=> $userdata->nombre,
				'apellido'=> $userdata->apellido,
				'correo'=> $userdata->correo,
				'logged' => TRUE
				);
			$this->session->set_userdata($newdata);
			return 1;
		}
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url().'login');
	}
	
	function verificar_captcha($captcha)
	{
		return $this->atletas_model->verificar_captcha($captcha);
	}
	
	public function validar_captcha()
	{
		$captcha = $this->input->post('captcha');
		if($this->atletas_model->verificar_captcha($captcha))
			echo '1';
		else			
			echo '-1';
	}
	
}

?>
