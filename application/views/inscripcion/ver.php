<form class="span10 offset1" id="formulario">
	<h3>Planilla de Inscripción</h3>
	<fieldset>
		<legend>Datos del Atleta</legend>
		<div class="span3"><b>Cedula: </b><?php echo $atleta->cedula;?></div>
		<div class="span6"><b>Nombre: </b><?php echo $atleta->nombre.' '.$atleta->apellido;?></div>
		<div class="span3"><b>Sexo: </b><?php echo $atleta->sexo=='M'?'Masculino':'Femenino';?></div>
		<div class="span3"><b>Fecha de Nacimiento: </b><?php echo strtotime($atleta->fecha_nacimiento)!=''?date('d-m-Y',  strtotime($atleta->fecha_nacimiento)):'';?></div>
		<div class="span3"><b>Teléfono: </b><?php echo $atleta->telefono;?></div>
		<div class="span3"><b>Correo: </b><?php echo $atleta->correo;?></div>
		<div class="span11"><b>Dirección: </b><?php echo str_replace("\n", '<br>',$atleta->direccion);?></div>
	</fieldset>
	<fieldset>
		<legend>Inscripto para participar en</legend>
		<div class="span3"><b>Evento: </b><?php echo $atleta->evento_nombre;?></div>
		<div class="span3"><b>Categoría: </b><?php echo $atleta->categoria_nombre;?></div>
	</fieldset>
	<div class="control-group">
	<?php 
//		echo '<a class="btn btn-primary" href="'.base_url().'atletas/modificar/"><i class="icon-edit icon-white"></i> Completar Inscripción </a> ';
		echo '<a class="btn btn-primary" href="'.base_url().'atletas/pdf/'.$atleta->id.'/'.$key.'" target="_blank"><i class="icon-download icon-white"></i> Descargar Planilla de Inscripción en formato PDF</a>';
	?>
	</div>
</form>
