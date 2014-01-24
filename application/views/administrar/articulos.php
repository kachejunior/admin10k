<div class="span10 offset1">
	<legend>Administración de Artículos</legend>
		<!-- Button to trigger modal -->
		<div class="control-group">
			<a href="#myModal" role="button" class="btn btn-success" data-toggle="modal">
				<i class="icon-plus-sign icon-white"></i> Agregar Artículo</a>
			<div class="btn-group">
				<a class="btn dropdown-toggle btn-primary" data-toggle="dropdown" href="#">
					Ver por Grupo
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<?php
						echo '<li><a onclick="actualizar(); return false;">Cualquiera</a></li>';
					foreach ($grupo_articulo as $row)
					{
						echo '<li><a onclick="ver_por_grupo('.$row->id.'); return false;">'.$row->nombre.'</a></li>';
					}
					?>					
				</ul>
			</div>
		</div>
		<table id="tabla_general" class="table table-hover table-bordered table-striped">
			<thead>
				<tr>
					<th class="span2">Art</th>
					<th class="span5">Nombre</th>
					<th class="span3">Grupo</th>
					<th class="span2">Opciones</th>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach ($lista as $row)
			{
				$str = '<tr>'.
					'<td class="centrado">'.$row->id.'</td>'.
					'<td>'.strtoupper($row->nombre).'</td>'.
					'<td class="centrado">'.strtoupper($row->grupo_articulo).'</td>'.
					'<td class="centrado">'.
						'<a class="btn btn-mini btn-warning" onclick="get('.$row->id.')">'.
						' <i class="icon-wrench icon-white"></i></a>'.
						' <a class="btn btn-mini btn-danger" onclick="eliminar('.$row->id.')">'.
						' <i class="icon-minus icon-white"></i></a>'.
					'</td>'.
					'</tr>';
				echo $str;
			}
			?>
			</tbody>
		</table>

</div>


<div id="myModal" class="modal hide fade span8 offset2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="left:0;">
	<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4>Datos de Artículo</h4>
  </div>
  <div class="modal-body">
		<div class="controls">
			<div class="input-prepend span3">
				<label>Art</label>
				<span class="add-on"><i class="icon-barcode"></i></span>
				<input class="span10" name="id" type="text" placeholder="Id">
				<input name="_id" type="hidden">
			</div>
		</div>
		<div class="controls">
			<div class="input-prepend span8 offset1">
				<label>Nombre</label>
				<span class="add-on"><i class="icon-info-sign"></i></span>
				<input class="span10" name="nombre" type="text" placeholder="Nombre" maxlength="60" required>
			</div>		
		</div>
		<div class="controls">
			<div class="input-prepend span4">
				<label>Grupo</label>
				<span class="add-on"><i class="icon-info-sign"></i></span>
				<select class="span10" name="grupo_articulo" required>
					<?php
					foreach ($grupo_articulo as $row)
					{
						echo '<option value="'.$row->id.'"> '.$row->nombre.'</option>';
					}
					?>
				</select>
			</div>		
		</div>
	</div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
		<button class="btn btn-primary pull-right" type="submit" id="_guardar"><i class="icon-ok icon-white"></i> Guardar</button>
  </div>
</div>

<script src="<?php echo base_url();?>media/js/fn_articulos.js"></script>

