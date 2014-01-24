
<form class="span10 offset1"  id="form-paciente" action="<?php echo base_url().'atletas_admin/exporte_xls';?>" method='post'>
<!--<form class="span10 offset1"  id="form-paciente">-->
	<h2>Administración de Atletas</h2>
	<div class="accordion" id="accordion2">
		<div class="accordion-group"  style="border-color:#FFF ">
			<div class="accordion-heading accordion-toggle" style=" height:25px;">
                    <a class="collapsed text-info" data-toggle="collapse" data-parent="#accordion2" href="#acordeon" style="margin-top:5px; ">
                     Filtrado de Datos <i class="icon-search"></i>
                    </a>
<!--				<a href="<?php echo base_url().'atletas_admin/nuevo';?>" role="button" class="btn-info btn-small pull-right" data-toggle="modal">
				  <i class="icon-plus-sign icon-white"></i> Agregar Paciente</a>						-->
              </div>
			<div id="acordeon" class="accordion-body collapse">
				<div class="accordion-inner">
					<div class="control-group">
						<div class="controls">
							<div class="input-prepend span3">
								<label>Cedula</label>
								<span class="add-on"><i class="icon-barcode"></i></span>
								<input class="span9 positive-integer" name="_cedula" type="text" placeholder="Cedula">
							</div>
						</div>
						<div class="controls">
							<div class="input-prepend span3">
								<label>Nombre/Apellido</label>
								<span class="add-on"><i class="icon-barcode"></i></span>
								<input class="span9" name="_nombre" type="text" placeholder="Nombre/Apellido">
							</div>
						</div>
						<div class="controls">
							<div class="input-prepend span3">
								<label>Sexo</label>
								<span class="add-on"><i class="icon-ok"></i></span>
								<select class="span9" name="_sexo">
									<option value="">--Todos--</option>
									<option value="M">Masculino</option>
									<option value="F">Femenino</option>
								</select>
							</div>		
						</div>
						<div class="controls">
							<div class="input-prepend span3">
								<label>Validado</label>
								<span class="add-on"><i class="icon-ok"></i></span>
								<select class="span9" name="_validado">
									<option value="">--Todos--</option>
									<option value="True">Validados</option>
									<option value="False">No Validados</option>
								</select>
							</div>		
						</div>
						<div class="controls">
							<div class="input-prepend span3">
								<label>Evento</label>
								<span class="add-on"><i class="icon-home"></i></span>
								<select class="span9" name="_evento" id="_evento	" onchange="cargarCategorias()">
									<option value="">--Todos--</option>
									<option value="1">Caminata</option>
									<option value="2">Carrera</option>
								</select>
							</div>		
						</div>
						<div class="controls">
							<div class="input-prepend span3">
								<label>Categoria</label>
								<span class="add-on"><i class="icon-home"></i></span>
								<select class="span9" name="_categoria" id="_categoria">
									<option value="">--Todos--</option>
									
								</select>
							</div>		
						</div>
						<div class="controls">
								<div class="input-prepend span1">
									<label style="color:#fff;">Buscar</label>
									<button class="btn btn-success " type="button" id="_buscar" onclick="buscar();"><i class="icon-search icon-white"></i>Buscar</button>
									<input  type="submit" class="btn btn-info" type="button" id="_buscar" style='margin-left: 10px;' value="Exportar XLS">
									<!--<input type="submit">-->
								</div>		
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
	<table id="tabla" class="table table-hover table-bordered table-striped" >
		<thead>
			<tr style="background:#802c59; color: #FFF ">
				<th class="span1">Cedula</th>
				<th class="span3">Nombre y Apellido</th>
				<th class="span1">Sexo</th>
				<th class="span2">Evento</th>
				<th class="span2">Categoria</th>
				<th class="span2">Correo</th>
				<!--<th class="span1" >Edicion</th>-->
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($atletas as $row)
			{
				$str = '<tr style="text-transform: uppercase">'.
					'<td class="centrado">'.$row->cedula.'</td>'.
					'<td>'.ucwords(strtolower($row->nombre)).' '.ucwords(strtolower($row->apellido)).'</td>'.	
					'<td class="centrado">'.$row->sexo.'</td>'.		
					'<td class="centrado">'.$row->evento_nombre.'</td>'.		
					'<td class="centrado">'.$row->categoria_nombre.'</td>'.
					'<td class="centrado" style="text-transform: lowercase">'.$row->correo.'</td>'.
//					'<td class="centrado">';		
//			 if (true) { 
//				$str=$str.' <a class="btn btn-mini btn-danger" onclick="eliminar(\''.$row->id.'\')">'.
//						' <i class="icon-minus icon-white"></i></a>';
//			}
//				$str=$str.'</td>'.			
					'</tr>';
				echo $str;
			}
			?>
		</tbody>
	</table>
	<div class="pagination" id="paginacion">
		<ul>
			<?php  if($pagina>1) { ?><li><a href="<?php $antes = $pagina-1; echo base_url().'atletas_admin/p/'.$antes; ?>">Anterior</a></li><?php }?>
			<?php 
				$i=1;
				while ($i<=$paginas+1) {
				echo '<li><a href="'.  base_url().'atletas_admin/p/'.$i.'">'.$i.'</a></li>';
				$i++;
			}?>
			<?php  if($pagina<$paginas) { ?><li><a href="<?php $siguiente = $pagina+1; echo base_url().'atletas_admin/p/'.$siguiente; ?>">Siguiente</a></li><?php }?>
		</ul>
	</div>
</form>

<script type="text/javascript">var pagina = '<?php echo $pagina;?>';</script>
<script type="text/javascript">var tb = '<?php echo $tb;?>';</script>
<script src="<?php echo base_url();?>media/js/fn_atletas_admin.js"></script>