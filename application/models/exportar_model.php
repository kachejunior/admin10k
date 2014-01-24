<?php
class Exportar_model extends CI_Model {
	public function __construct(){
		$this->load->database();
	}
	
	public function exportar_excel($fsol1=0,$fsol2=0,$status=0,$prioridad=0,$estado=0,
			$municipio=0,$parroquia=0,$tipo_solicitud=0,$orientacion=0,$categoria=0,$donativo=0,$sexo=0,$fpp1=0,$fpp2=0)
	{
		$sql = "select * from export_excel_v2 ";
		$where = "";
		if(strtotime($fsol1)!='')
		{
			$where .= " f_solicitud >= ". $this->db->escape($fsol1);
		}
		if(strtotime($fsol2)!='')
		{
			if($where != '')
				$where .= ' and ';
			$where .= " f_solicitud <= ". $this->db->escape($fsol2);
		}
		if($status != 0)
		{
			if($where != '')
				$where .= ' and ';
			$where .= ' id_status = '.$status;
		}
		if($prioridad != 0)
		{
			if($where != '')
				$where .= ' and ';
			$where .= ' id_prioridad = '.$prioridad;
		}
		if($estado != 0)
		{
			if($where != '')
				$where .= ' and ';
			$where .= ' id_estado = '.$estado;
		}
		if($municipio != 0)
		{
			if($where != '')
						$where .= ' and ';
			$where .= ' id_municipio = '.$municipio;
		}
		if($parroquia != 0)
		{
			if($where != '')
				$where .= ' and ';
			$where .= ' id_parroquia = '.$parroquia;
		}
		if($tipo_solicitud != 0)
		{
			if($where != '')
				$where .= ' and ';
			$where .= ' id_tipo_solicitud = '.$tipo_solicitud;
		}
		if($orientacion != 0)
		{
			if($where != '')
				$where .= ' and ';
			$where .= ' id_orientacion = '.$orientacion;
		}
		if($categoria != 0)
		{
			if($where != '')
				$where .= ' and ';
			$where .= ' id_categoria = '.$categoria;
		}
		if($donativo != 0)
		{
			if($where != '')
				$where .= ' and ';
			$where .= ' id_donativo = '.$donativo;
		}
		if($sexo != 0)
		{
			if($where != '')
				$where .= ' and ';
			$where .= ' sexo = '.$this->db->escape($sexo);
		}
		if(strtotime($fpp1)!='')
		{
			if($where != '')
				$where .= ' and ';
			$where .= " fpp >= ". $this->db->escape($fpp1);
		}
		if(strtotime($fpp2)!='')
		{
			if($where != '')
				$where .= ' and ';
			$where .= " fpp <= ". $this->db->escape($fpp2);
		}
		if($where != '')
			$sql .= ' where '.$where;
		
//		return $sql;
		
		$query = $this->db->query($sql);
		return $query->result();
	}

}