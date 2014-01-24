<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Evento_model extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function eventos()
    {
        $this->db->order_by('eventos','asc');
        $eventos = $this->db->get('eventos');
        if($eventos->num_rows()>0)
        {
            return $eventos->result();
        }
    }
    
		
	public function categorias($eventos=FALSE)
	{
		//En dado caso que no exista id se devolvera la tabla completa, caso contrario se devolvera el registro especificado
		$sql = 'select *  from categorias';
		if($eventos == FALSE)
		{
			$sql = $sql.' order by id';
			$consulta = $this->db->query($sql);
			return $consulta->result(); 
		}
		else
		{
//			$eventos = $this->db->escape($eventos);
			$sql = $sql.' where evento = '.$eventos;
			$consulta = $this->db->query($sql);
			return $consulta->result(); 
		}
	}
}