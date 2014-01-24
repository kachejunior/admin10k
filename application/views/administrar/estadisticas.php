
<ul class="nav nav-tabs nav-stacked span2 offset1" id="navegacion">
              <li class="active"><a href="#estadisticas">Estadisticas</a></li>
              <li><a href="#totales">Estadisticas Totales</a></li>
              <li><a href="#municipales">Estadisticas por categoria de carrera</a></li>
</ul>
<form class="span8"  id="form-paciente" class="scrollspy-example" data-target="#navegacion" >
			<!--action="http://mujervf.fsbolivar.com.ve/estadistica/getMunicipales" method="post">-->
<!--<form class="span10 offset1" action="http://mujervf.fsbolivar.com.ve/paciente/editar" method="post">-->
	<h2 id="titulo_estadisticas">
		Estadisiticas
	</h2>
	<ul class="nav nav-pills">
			<li class="active">
				<a href="<?php echo base_url();?>atletas_admin/pdf_estadistica" target="_blank">Descargar PDF <i class='icon-download-alt'></i></a>
			</li>
	</ul>
	
	<fieldset>
		<legend><h4 id="totales"><i class="icon-file"></i> Estadisticas Totales</h4></legend>
		<table id="tabla" class="table table-hover table-bordered table-striped" >
			<tr>
				<th class="span10"><h2>Total de Atletas Inscritos en Sistema</h2></th>
				<th class="span2"><h2><?php echo $total_atletas;?></h2></th>
			</tr>
		</table>
		<table id="tabla" class="table table-hover table-bordered table-striped" style="margin-top:10px;" >
			<tr>
				<th class="span10">Total de Atletas Validados</th>
				<th class="span2"><?php echo $total_atletas_validados;?></th>
			</tr>
			<tr>
				<th>Total de Atletas No Validados</th>
				<th><?php echo $total_atletas_no_validados;?></th>
			</tr>
		</table>
		
		<table id="tabla" class="table table-hover table-bordered table-striped" style="margin-top:10px;" >
			<tr>
				<th class="span10">Total de Participantes en Caminata</th>
				<th class="span2"><?php echo $total_atletas_caminata; ?></th>
			</tr>
			<tr>
				<th>Total de Participantes en Carrera</th>
				<th><?php echo $total_atletas_carrera; ?></th>
			</tr>
		</table>
		
	</fieldset>
	
	<fielset style="margin-top: 70px;">
		<legend style="margin-top: 50px;"><h4 id="municipales"><i class="icon-file"></i> Estadisticas Por Categoria</h4></legend>
		<ul id="myTab" class="nav nav-tabs">
              <li class="active"><a href="#total" data-toggle="tab">Total</a></li>
              <li class=""><a href="#masculino" data-toggle="tab">Masculino</a></li>
              <li class=""><a href="#femenino" data-toggle="tab">Femenino</a></li>
         </ul>
		<div id="myTabContent" class="tab-content">
              <div class="tab-pane fade active in" id="total">
				<table class="table table-hover table-bordered table-striped " id="tabla_municipales">
						<thead>
							<tr style="background:#802c59; color: #FFF ">
								<th class="span6">Categoria</th>
								<th class="span2">Numero de Inscritos</th>
							</tr>
						</thead>
						<tbody>
						<?php
						foreach ($atletas_categoria as $row)
						{
							$str = '<tr  style="text-transform: uppercase">'.
								'<td>'.$row->categoria_nombre.'</td>'.
								'<td class="centrado">'.$row->count.'</td>'.
								'</tr>';
							echo $str;
						}
						?>
						</tbody>
				</table>
              </div>
              <div class="tab-pane fade" id="masculino">
					<table class="table table-hover table-bordered table-striped " id="tabla_municipales">
							<thead>
								<tr style="background:#802c59; color: #FFF ">
									<th class="span6">Categoria</th>
									<th class="span2">Numero de Inscritos</th>
								</tr>
							</thead>
							<tbody>
							<?php
							foreach ($atletas_categoria_m as $row)
							{
								$str = '<tr  style="text-transform: uppercase">'.
									'<td>'.$row->categoria_nombre.'</td>'.
									'<td class="centrado">'.$row->count.'</td>'.
									'</tr>';
								echo $str;
							}
							?>
							</tbody>
					</table>              
			</div>
              <div class="tab-pane fade" id="femenino">
					<table class="table table-hover table-bordered table-striped " id="tabla_municipales">
							<thead>
								<tr style="background:#802c59; color: #FFF ">
									<th class="span6">Categoria</th>
									<th class="span2">Numero de Inscritos</th>
								</tr>
							</thead>
							<tbody>
							<?php
							foreach ($atletas_categoria_f as $row)
							{
								$str = '<tr  style="text-transform: uppercase">'.
									'<td>'.$row->categoria_nombre.'</td>'.
									'<td class="centrado">'.$row->count.'</td>'.
									'</tr>';
								echo $str;
							}
							?>
							</tbody>
					</table>  
              </div>
            </div>
		
		
	</fieldset>
	
</form>