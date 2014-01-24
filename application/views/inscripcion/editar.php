
<form class="form-horizontal span8 well offset2" method="post" action="<?php echo base_url().'atletas/agregar'; ?>">
	<fieldset>
		<legend>Registro de Atletas</legend>
 
		<div class="control-group">
			<label class="control-label span3">Cedula de Identidad</label>
			<div class="controls span9">
				<input type="hidden" name="id" disabled value="<?php echo $atleta->id?>">
				<input type="text" class="input-block-level" placeholder="Cedula de Identidad" name="cedula" disabled value="<?php echo $atleta->cedula?>">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label span3">Correo</label>
			<div class="controls span9">
				<input type="text" class="input-block-level" placeholder="Correo" name="correo" disabled value="<?php echo $atleta->correo?>">
			</div>
		</div>
 
		<div class="control-group">
			<label class="control-label span3">Nombre</label>
			<div class="controls span9">
				<input type="text" class="input-block-level" placeholder="Nombre" name="nombre" required value="<?php echo $atleta->nombre?>">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label span3">Apellido</label>
			<div class="controls span9">
				<input type="text" class="input-block-level" placeholder="Apellido" name="apellido" required value="<?php echo $atleta->apellido?>">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label span3">Sexo</label>
			<div class="controls span9">
				<select class="input-block-level" name="sexo">
					<option value="">Sexo</option>
					<?php
					foreach ($sexos as $sexo) {
						if($sexo->id == $atleta->sexo)
							echo '<option value="'.$sexo->id.'" selected>'.$sexo->nombre.'</option>';
						else
							echo '<option value="'.$sexo->id.'">'.$sexo->nombre.'</option>';
					}
					?>					
				</select>
				<!--<input type="text" class="input-block-level" placeholder="Apellido" name="apellido" required>-->
			</div>
		</div>

		<div class="control-group">
			<label class="control-label span3">Fecha de Nacimiento</label>
			<div class="controls span9">
				<input type="text" class="input-block-level" placeholder="Fecha de Nacimiento" name="f_nacimiento" required >
			</div>
		</div>

		<div class="control-group">
			<label class="control-label span3">Dirección</label>
			<div class="controls span9">
				<input type="text" class="input-block-level" placeholder="Dirección" name="direccion" required value="<?php echo $atleta->direccion?>">
			</div>
		</div>
 
		<div class="control-group">
			<label class="control-label span3">Teléfono</label>
			<div class="controls span9">
				<input type="text" class="input-block-level phone" placeholder="Teléfono" name="telefono" value="<?php echo $atleta->telefono?>">
			</div>
		</div>
 
		<div class="control-group">
			<label class="control-label span3">Grupo Sanguineo</label>
			<div class="controls span9">
				<select class="input-block-level" name="grupo_sanguineo">
					<option value="">Grupo Sanguineo</option>
					<?php
					foreach ($grupo_sanguineos as $grupo_sanguineo) {
						if($grupo_sanguineo->id == $atleta->grupo_sanguineo)
							echo '<option value="'.$grupo_sanguineo->id.'" selected>'.$grupo_sanguineo->nombre.'</option>';
						else
							echo '<option value="'.$grupo_sanguineo->id.'">'.$grupo_sanguineo->nombre.'</option>';
					}
					?>					
				</select>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label span3">Evento</label>
			<div class="controls span9">
				<select class="input-block-level" name="evento">
					<option value="">Evento</option>
					<?php
					foreach ($eventos as $evento) {
						if($evento->id == $atleta->evento)
							echo '<option value="'.$evento->id.'" selected>'.$evento->nombre.'</option>';
						else
							echo '<option value="'.$evento->id.'">'.$evento->nombre.'</option>';
					}
					?>					
				</select>
				<!--<input type="text" class="input-block-level" placeholder="Apellido" name="apellido" required>-->
			</div>
		</div>

		<div class="control-group">
			<label class="control-label span3">Categoría</label>
			<div class="controls span9">
				<select class="input-block-level" name="categoria">
					<option value="">Categoría</option>
					<?php
					foreach ($categorias as $categoria) {
						if($categoria->id == $atleta->categoria)
							echo '<option value="'.$categoria->id.'" selected>'.$categoria->nombre.'</option>';
						else
							echo '<option value="'.$categoria->id.'">'.$categoria->nombre.'</option>';
					}
					?>					
				</select>
				<!--<input type="text" class="input-block-level" placeholder="Apellido" name="apellido" required>-->
			</div>
		</div>

		<div class="form-actions">
			<button type="button" class="btn btn-primary btn-large">Guardar</button>
<!--			<button type="button" class="btn btn-primary btn-large offset1">Descargar Planilla</button>-->
		</div>
	</fieldset>
</form>

<script src="<?php echo base_url();?>media/jquery.maskedinput.min.js"></script>
<script src="<?php echo base_url();?>media/js/validaciones.js"></script>
<script src="<?php echo base_url();?>media/js/fn_inscripcion.js"></script>