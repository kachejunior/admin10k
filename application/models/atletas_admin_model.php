<?php

/**
 * @author desarrollo
 */
class Atletas_admin_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->max_caminata = 1300;
		$this->max_carrera = 1750;
		
	}
	
	public function get($pagina=FALSE)
	{
		$sql = 'select * from datos_atletas order by id';
		if($pagina==FALSE)
		{
			$consulta = $this->db->query($sql);
			return $consulta->result(); 
		}
		else
		{
			$p = ($pagina-1)*50;
			$sql = $sql.' limit 50	 offset '.$p;
			$consulta = $this->db->query($sql);
			return $consulta->result();
		}
	}
	
	 public function numero_paginas()
	{
		 $sql ='select count(*) as  total from datos_atletas';
		 $consulta = $this->db->query($sql);
		 $total = $consulta->row();
		 return $total->total/50;
		 
	}
	
   private function _validar($tabla, $id)
	{
		$sql = 'select count(*) as total from '.$tabla.' where id ='.(int)$id;
		$consulta = $this->db->query($sql);
		if($consulta->row()->total > 0) 
			return true;
		else
			return false;			
	}

	public function eliminar($id)
	{
		//Eliminamos el elemento de la tabla
		$sql = 'delete from atletas where id = '.(int)$id;
		$this->db->query($sql);
		return 1;
	}
	
	
	public function get2($id=FALSE)
	{
		$this->db->query('SET datestyle TO postgres, dmy;');
		//En dado caso que no exista id se devolvera la tabla completa, caso contrario se devolvera el registro especificado
		$sql = 'select * from datos_atletas';
		if($cedula==FALSE)
		{
			$sql = $sql.' order by id';
			$consulta = $this->db->query($sql);
			return $consulta->result(); 
		}
		else
		{
			$sql = $sql.' where id = '.(int)$id;
			$consulta = $this->db->query($sql);
			return $consulta->row();
		}
	}
	
	
	public function buscar($cedula=FALSE, $nombre=FALSE, $sexo=FALSE, $validado=FALSE, $evento=FALSE, $categoria=FALSE)
	{
		$this->db->query('SET datestyle TO postgres, dmy;');
		//En dado caso que no exista id se devolvera la tabla completa, caso contrario se devolvera el registro especificado
		$sql = 'select * from datos_atletas where id > 0';
		if($cedula==NULL && $nombre==NULL && $sexo==NULL && $validado==NULL  && $evento==NULL  && $categoria==NULL)
		{
			$sql = $sql.' order by id';
			$consulta = $this->db->query($sql);
			return $consulta->result(); 
		}
			if ($cedula!=NULL)
			{
				$sql = $sql.' and  cedula like \'%'.$cedula.'%\'';
			}
			
			if ($nombre!=NULL)
			{
				$nombre = strtolower($nombre);
				$sql = $sql.' and  ( lower(nombre) like \'%'.$nombre.'%\' or lower(apellido) like \'%'.$nombre.'%\')';
			}
			
			if ($sexo != NULL)
			{
				$sexo = $this->db->escape($sexo);
				$sql = $sql.' and  sexo = '.$sexo;
			}
			
			if ($validado !=NULL)
			{
				$sql = $sql.' and  validado  = '.$validado;
			}
			
			if ($evento!=NULL)
			{
				$sql = $sql.' and  evento = '.$evento;
			}
			
			if ($categoria!=NULL)
			{
				$sql = $sql.' and  categoria = '.$categoria;
			}
			
			//echo $sql;
			$consulta = $this->db->query($sql);
			return $consulta->result(); 
		
	}
	
	 public function total_atletas()
	{
		 $sql ='select count(*) as  total from datos_atletas';
		 $consulta = $this->db->query($sql);
		 $total = $consulta->row();
		 return $total->total;		 
	}
	
	public function total_atletas_validados($validado )
	{
		 $sql ='select count(*) as  total from datos_atletas where validado ='.$validado;
		 $consulta = $this->db->query($sql);
		 $total = $consulta->row();
		 return $total->total;		 
	}
	
	public function total_atletas_evento( $evento)
	{
		 $sql ='select count(*) as  total from datos_atletas where evento ='.$evento;
		 $consulta = $this->db->query($sql);
		 $total = $consulta->row();
		 return $total->total;		 
	}
	
	public function atletas_categoria ($sexo=FALSE){
		if($sexo==FALSE)
		{
			$sql = "select categoria_nombre, categoria, count(*) from datos_atletas where  evento = 2 group by categoria_nombre,categoria order by categoria"; 
			$consulta = $this->db->query($sql);
			return $consulta->result(); 
		}
		else
		{
			$sql = "select categoria_nombre, categoria, count(*) from datos_atletas where  evento = 2 and sexo ='".$sexo."'   group by categoria_nombre,categoria order by categoria"; 
			$consulta = $this->db->query($sql);
			return $consulta->result();
		}
	}
	
	public function atletas_categoria_caminata (){
			$sql = "select categoria_nombre, categoria, count(*) from datos_atletas where  evento = 1  group by categoria_nombre,categoria order by categoria"; 
			$consulta = $this->db->query($sql);
			return $consulta->result();
	}
	
	
	//-----------------------------------------Funciones Validacion de Carrera y Caminata ----------------------------------------------------------------
	public function validar_numero($numero)
	{
		$sql = 'select * from atletas where numero='.$numero;
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
	public function validar_cedula($cedula)
	{
		$cedula = $this->db->escape($cedula);
		$sql = 'select * from atletas where substr(cedula, 3) = '.$cedula;
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
	public function validar_evento($cedula, $evento)
	{
		$cedula = $this->db->escape($cedula);
		$sql = 'select * from atletas where substr(cedula, 3) = '.$cedula;
		$query = $this->db->query($sql);
		if($query->row()->evento != $evento){
			return false;
		}
		return true;
	}
	
	public function validar_validacion($cedula)
	{
		$cedula = $this->db->escape($cedula);
		$sql = 'select * from atletas where substr(cedula, 3) = '.$cedula;
		$query = $this->db->query($sql);
		if(($query->row()->numero != NULL) or ($query->row()->numero != ''))
		{
			return false;
		}
		return true;
	}
	
	public function validar_usuario_carrera($numero, $cedula)
	{
		if($this->validar_numero($numero) > 0)
		{
			return -1;
		}
		
		if($this->validar_cedula($cedula) == 0)
		{
			return -2;
		}
		
		if($this->validar_cedula($cedula) > 1)
		{
			return -3;
		}
		
		if(!$this->validar_evento($cedula, 2))
		{
			return -4;
		}
		
		if(!$this->validar_validacion($cedula))
		{
			return -5;
		}

		$cedula = $this->db->escape($cedula);
		$sql = 'update atletas set numero = '.$numero.', fh_validacion = localtimestamp where substr(cedula, 3) = '.$cedula;
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	public function validar_usuario_caminata($numero, $cedula)
	{
		if($this->validar_numero($numero) > 0)
		{
			return -1;
		}
		
		if($this->validar_cedula($cedula) == 0)
		{
			return -2;
		}
		
		if($this->validar_cedula($cedula) > 1)
		{
			return -3;
		}
		
		if(!$this->validar_evento($cedula, 1))
		{
			return -4;
		}
		
		if(!$this->validar_validacion($cedula))
		{
			return -5;
		}

		$cedula = $this->db->escape($cedula);
		$sql = 'update atletas set numero = '.$numero.', fh_validacion = localtimestamp where substr(cedula, 3) = '.$cedula;
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
	
		public function get_numero($cedula)
	{
		$this->db->query('SET datestyle TO postgres, dmy;');
		//En dado caso que no exista id se devolvera la tabla completa, caso contrario se devolvera el registro especificado
		$sql = 'select * from datos_atletas_numero';
		$cedula = $this->db->escape($cedula);
		$sql = $sql.' where substr(cedula, 3) = '.$cedula;
		$consulta = $this->db->query($sql);
		return $consulta->row();
	}
}
?>
