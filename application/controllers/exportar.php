<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exportar extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('general_model');
		$this->load->model('exportar_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		if($this->session->userdata('logged') != TRUE){
			if(!$this->input->is_ajax_request())
				redirect(base_url().'login');
			else
				return -3;
		}
	}

	public function index()
	{
		$data['option'] = 'exportar';
		$data['status'] = $this->general_model->get('app_status');
		$data['prioridad'] = $this->general_model->get('app_prioridad');
		$data['estado'] = $this->general_model->get('app_estado');
		$data['tipo_solicitud'] = $this->general_model->get('app_tiposolicitud');
		$data['programa'] = $this->general_model->get('app_programa');
		$data['orientacion'] = $this->general_model->get('app_orientacion');
		$data['categoria'] = $this->general_model->get('app_categorias');
		$this->load->view('template/header');
		$this->load->view('template/menu',$data);
		$this->load->view('exportar/exportar',$data);
		$this->load->view('template/footer');
	}

	public function excel($fsol1='',$fsol2='',$status='',$prioridad='',$estado='',$municipio='',$parroquia='',$tipo_solicitud='',
		$orientacion='',$categoria='',$donativo='',$sexo='',$fpp1='',$fpp2='')
	{
		$result = $this->exportar_model->exportar_excel($fsol1,$fsol2,$status,$prioridad,$estado,
			$municipio,$parroquia,$tipo_solicitud,$orientacion,$categoria,$donativo,$sexo,$fpp1,$fpp2);
// Load libreria
		$this->load->library('phpexcel');
		// Propiedades del archivo excel
		$this->phpexcel->getProperties()
		->setTitle("Listado de Solicitudes")
		->setDescription("Listado de Solicitudes de la Gerencia de Salud");
		// Setiar la solapa que queda actia al abrir el excel
		$this->phpexcel->setActiveSheetIndex(0);
		// Solapa excel para trabajar con PHP
		$sheet = $this->phpexcel->getActiveSheet();
		$sheet->setTitle("Hoja 1");
		for($j='a'; $j<'z';$j++)
		{
			$sheet->getColumnDimension($j)->setAutoSize(true);
		}
		$sheet->getColumnDimension('aa')->setAutoSize(true);
		$sheet->getColumnDimension('ab')->setAutoSize(true);
		$sheet->getColumnDimension('ac')->setAutoSize(true);

		$sheet->getColumnDimension('l')->setAutoSize(false);		
		$sheet->getColumnDimension('m')->setAutoSize(false);		
		$sheet->getColumnDimension('q')->setAutoSize(false);		
		$sheet->getColumnDimension('r')->setAutoSize(false);		
		$sheet->getColumnDimension('w')->setAutoSize(false);		
		$sheet->getColumnDimension('x')->setAutoSize(false);		
		$sheet->getColumnDimension('l')->setWidth(20);
		$sheet->getColumnDimension('m')->setWidth(20);
		$sheet->getColumnDimension('q')->setWidth(20);
		$sheet->getColumnDimension('r')->setWidth(30);
		$sheet->getColumnDimension('w')->setWidth(20);
		$sheet->getColumnDimension('x')->setWidth(20);
//		$sheet->getColumnDimension('c')->setAutoSize(true);		
		$sheet->setCellValue('a1', 'Nro');
		$sheet->setCellValue('b1', 'F. Solicitud');
		$sheet->setCellValue('c1', 'Prioridad');
		$sheet->setCellValue('d1', 'Estatus');
		$sheet->setCellValue('e1', 'F. Status');
		$sheet->setCellValue('f1', 'Cédula');
		$sheet->setCellValue('g1', 'Nombre');
		$sheet->setCellValue('h1', 'Edad');
		$sheet->setCellValue('i1', 'Esc.');
		$sheet->setCellValue('j1', 'Sexo');
		$sheet->setCellValue('k1', 'Fpp');
		$sheet->setCellValue('l1', 'Teléfonos');
		$sheet->setCellValue('m1', 'Dirección');
		$sheet->setCellValue('n1', 'Estado');
		$sheet->setCellValue('o1', 'Municipio');
		$sheet->setCellValue('p1', 'Parroquía');
		$sheet->setCellValue('q1', 'Referido por');
		$sheet->setCellValue('r1', 'Diagnostico');
		$sheet->setCellValue('s1', 'Tipo de Solicitud');
		$sheet->setCellValue('t1', 'Orientación');
		$sheet->setCellValue('u1', 'Categoría');
		$sheet->setCellValue('v1', 'Donativo');
		$sheet->setCellValue('w1', 'Descripción');
		$sheet->setCellValue('x1', 'Razon Social');
		$sheet->setCellValue('y1', 'Monto');
		$sheet->setCellValue('z1', 'Receptor');
		$sheet->setCellValue('aa1', 'Ubicación');
		$sheet->setCellValue('ab1', 'Cédula Sol.');
		$sheet->setCellValue('ac1', 'Nombre Sol.');
		$sheet->getStyle('a1:ac1')->getFont()->setBold(true)->setSize(10);

		$i = 2;
		foreach ($result as $row){
			$sheet->setCellValue('a'.$i, $row->id);
			$sheet->setCellValue('b'.$i, date('d-m-Y',  strtotime($row->f_solicitud)));
			$sheet->setCellValue('c'.$i, $row->prioridad);
			$sheet->setCellValue('d'.$i, $row->status);
			$sheet->setCellValue('e'.$i, strtotime($row->f_donacion)!=''?date('d-m-Y',strtotime($row->f_donacion)):'');
			$sheet->setCellValue('f'.$i, $row->cedula_paciente);
			$sheet->setCellValue('g'.$i, $row->nombre_paciente);
			$sheet->setCellValue('h'.$i, $row->edad);
			$sheet->setCellValue('i'.$i, $row->escala);
			$sheet->setCellValue('j'.$i, $row->sexo);
			$sheet->setCellValue('k'.$i, $row->fpp);
			$sheet->setCellValue('l'.$i, $row->telefonos);
			$sheet->setCellValue('m'.$i, $row->direccion);
			$sheet->setCellValue('n'.$i, $row->estado);
			$sheet->setCellValue('o'.$i, $row->municipio);
			$sheet->setCellValue('p'.$i, $row->parroquia);
			$sheet->setCellValue('q'.$i, $row->referido_por);
			$sheet->setCellValue('r'.$i, $row->diagnostico);
			$sheet->setCellValue('s'.$i, $row->tiposolicitud);
			$sheet->setCellValue('t'.$i, $row->orientacion);
			$sheet->setCellValue('u'.$i, $row->categoria);
			$sheet->setCellValue('v'.$i, $row->donativo);
			$sheet->setCellValue('w'.$i, $row->detalle_solicitud);
			$sheet->setCellValue('x'.$i, $row->razon_social);
			$sheet->setCellValue('y'.$i, $row->monto);
			$sheet->setCellValue('z'.$i, $row->receptor);
			$sheet->setCellValue('aa'.$i, $row->ubicacion);
			$sheet->setCellValue('ab'.$i, $row->cedrif_solicitante);
			$sheet->setCellValue('ac'.$i, $row->nombre_solicitante);
			$i++;
		}
		$sheet->getStyle('G2:G'.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		$sheet->getStyle('G2:G'.$i)->getAlignment()->setWrapText(true);
//		$sheet->getStyle('G1:G'.$i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
		
		// Salida
		header("Content-Type: application/vnd.ms-excel");
		$nombreArchivo = 'sac_excel_'.date('Y-m-d_H-i-s');
		header("Content-Disposition: attachment; filename=\"$nombreArchivo.xls\"");
		header("Cache-Control: max-age=0");
		// Genera Excel
		$writer = PHPExcel_IOFactory::createWriter($this->phpexcel, "Excel5");
		// Escribir
		$writer->save('php://output');
		exit;
	}
}