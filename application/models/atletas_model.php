<?php

/**
 * @author desarrollo
 */
class Atletas_model extends CI_Model{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->max_caminata = 1300;
		$this->max_carrera = 1750;
		
	}
	
	
	public function agregar($cedula,$nombre,$apellido,$sexo,$f_nacimiento,
							$direccion,$telefono,$evento,$categoria,$correo)
	{
		$cedula = $this->db->escape(strtolower($cedula));
		$nombre = $this->db->escape($nombre);
		$apellido = $this->db->escape($apellido);
		$sexo = $this->db->escape(strtoupper($sexo));
		$f_nacimiento = $this->db->escape($f_nacimiento);
		$direccion = $this->db->escape($direccion);
		$telefono = $this->db->escape($telefono);
		$evento = (int)$evento;
		$categoria = (int)$categoria;
		$correo = $this->db->escape(strtolower($correo));
		$hoy = $this->db->escape(date('Y-m-d H:i:s'));

		//validamos que no exista otro atleta con la misma cedula o correo antes de agregarlo
		$sql = 'select count(*) as total from atletas where lower(cedula) = lower('.$cedula.') or lower(correo) = lower('.$correo.')';
		$query = $this->db->query($sql);
		if ($query->row()->total >0)
			return -2;
		
		//insertamos el elemento en la tabla y retornamos el id con el que se agrego
		$sql = 'insert into atletas '.
						'(cedula,nombre,apellido,sexo,fecha_nacimiento,direccion,telefono,'.
						'evento,categoria,correo,validado,fh_registro) values('.
						$cedula.','.$nombre.','.$apellido.','.$sexo.','.$f_nacimiento.','.$direccion.','.
						$telefono.','.$evento.','.$categoria.','.$correo.
						',false,'.$hoy.')';
		$this->db->query($sql);
		if ($this->db->affected_rows() > 0)
		{
			$sql = 'SELECT LASTVAL() as id';
			$query = $this->db->query($sql);
			return $query->row()->id;
		}
		return 0;
	}
	
	//Recibe el id del atleta y una llave de validacion la cual se le es enviada al correo
	public function verificar($id,$key_validation)
	{
		//Si ya esta validado retornamos 1
		$sql = 'select count(*) as total from atletas where id = '.(int)$id.' and validado = true';
		$query = $this->db->query($sql);
		if($query->row()->total == 1)
			return 1;
//		$participante = $this->get($id);
//		$inscritos = $this->get_participantes_validados($participante->evento);
//		if($inscritos)
		
		$sql = 'select fh_registro from atletas where id = '.(int)$id.' and validado = false';
		$query = $this->db->query($sql);
		if($this->db->affected_rows()<1)
			return -2;
		else 
			if ($key_validation  != sha1($query->row()->fh_registro))
				return -2;
		//actualizamos a valido el registro que corresponde al id
		$sql = 'update atletas set validado = true where id = '.(int)$id;
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	private function _borrar_captchas_antiguos($ip)
	{
		$expira = time()-1200;
		$ip = $this->db->escape($ip);
		$sql = 'delete from ci_captcha where ip_address = '.$ip. ' or captcha_time < '. $expira;
		$this->db->query($sql);
	}
	
	public function guardar_captcha($captcha)
	{
		$ip = $this->input->ip_address();
		$this->_borrar_captchas_antiguos($ip);
		$sql = 'insert into ci_captcha (captcha_time,ip_address,word) values ('.$this->db->escape($captcha['time']).
						','.$this->db->escape($ip).','.$this->db->escape($captcha['word']).')';
		$this->db->query($sql);
	}
	
	public function verificar_captcha($captcha)
	{
		$ip = $this->db->escape($this->input->ip_address());
		$captcha = $this->db->escape($captcha);
		$sql = 'select count(*) as total from ci_captcha where ip_address = '.$ip.
					' and word = '.$captcha;
		$query = $this->db->query($sql);
		return $query->row()->total == 1;
	}

	public function get_participantes_validados($evento)
	{	//$evento 1==caminata  2==carrera
		$sql = 'select count(*) as total from atletas where evento = '.(int)$evento.' and validado = TRUE';
		$consulta = $this->db->query($sql);
		return $consulta->row()->total;
	}
	
	
//funciones etapa 2
  
	
}
?>
