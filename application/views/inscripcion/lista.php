<div class="span10 offset1">
<!--	<legend>Administración de Solicitudes</legend>-->
		<!-- Button to trigger modal -->
		<div class="control-group span12">
			<div class="span4">
				<a href="<?php echo base_url().'solicitudes/nueva'; ?>" class="btn btn-primary"><i class="icon-plus-sign icon-white"></i> Agregar Solicitud</a>
			</div>
			<div class="span6 pull-right">
				<form id="listado">
					<button class="btn btn-primary pull-right"><i class="icon-search icon-white"></i> Buscar</button>
					<input class="pull-right" name="buscar" id="buscar" type="text" placeholder="Buscar" maxlength="60" value="<?php echo urldecode($id);?>">
				</form>
			</div>
		</div>
		<table id="tabla" class="table table-hover table-bordered table-striped">
			<thead>
				<tr>
					<th >Codigo</th>
					<th >Cedula</th>
					<th >Nombre</th>
					<th >Solicitud</th>
					<th >Fecha</th>
					<th >Status</th>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach ($lista as $row)
			{
				$f_dona = '';
				if($row->f_donacion!=null && $row->f_donacion!='')
					$f_dona = ' ('.date('d-m-Y',strtotime ($row->f_donacion)).')';
				$str = '<tr>'.
					'<td class="centrado"><a href="'.base_url().'solicitudes/ver/'.$row->id.'">'.
								$row->id.'</a></td>'.
					'<td class="centrado">'.$row->cedula_paciente.'</td>'.
					'<td>'.ucwords(strtolower($row->nombre)).'</td>'.
					'<td>'.ucwords(strtolower($row->donativo)).' '.ucwords(strtolower($row->detalle_solicitud)).'</td>'.
					'<td class="centrado">'.date('d-m-Y',strtotime($row->f_solicitud)).'</td>'.
					'<td class="centrado">'.ucwords(strtolower($row->status)).$f_dona.'</td>'.
					'</tr>';
				echo $str;
			}
			?>
			</tbody>
		</table>
		
		<?php
		echo $this->pagination->create_links();
		if(count($lista)===0)
			echo '<p>No se encontraron resultados para la busqueda.</p>';
		?>

</div>
<script>
	$('#listado').submit(function(event){
		event.preventDefault();
		$(location).attr('href', base_url+'solicitudes/get/0/'+$('#buscar').val());
	});
	$('.pagination ul li a').click(function(event){
		event.preventDefault();
		var link = $(this).attr('href');
//		alert(link);
		if (link == base_url+'solicitudes/get/')
			link += '0';
		$(location).attr('href',link+'/'+$('#buscar').val());
	});
</script>