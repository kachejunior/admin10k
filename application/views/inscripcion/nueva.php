
<form class="form-horizontal span8 well offset2" method="post" action="<?php echo base_url().'atletas/agregar'; ?>" id="formulario">
	<fieldset>
		<legend>Registro de Atletas	</legend>
 
		<div class="control-group">
			<label class="control-label span3">Cedula de Identidad</label>
			<div class="controls span9">
				<input type="text" class="input-block-level" placeholder="V-#######" name="cedula" required>
			</div>
		</div>
 
		<div class="control-group">
			<label class="control-label span3">Nombre</label>
			<div class="controls span9">
				<input type="text" class="input-block-level" placeholder="Nombre" name="nombre" required maxlength="100">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label span3">Apellido</label>
			<div class="controls span9">
				<input type="text" class="input-block-level" placeholder="Apellido" name="apellido" required maxlength="100">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label span3">Sexo</label>
			<div class="controls span9">
				<select class="input-block-level" name="sexo" required>
					<option value="">Sexo</option>
					<option value="F">Femenino</option>
					<option value="M">Masculino</option>
				</select>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label span3">Fecha de Nacimiento</label>
			<div class="controls span9">
				<input type="text" class="input-block-level" placeholder="dd-mm-aaaa" name="f_nacimiento" required maxlength="15">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label span3">Dirección</label>
			<div class="controls span9">
				<input type="text" class="input-block-level" placeholder="Dirección" name="direccion" required maxlength="255">
			</div>
		</div>
 
		<div class="control-group">
			<label class="control-label span3">Teléfono</label>
			<div class="controls span9">
				<input type="text" class="input-block-level phone" placeholder="Teléfono" name="telefono" maxlength="15">
			</div>
		</div>
 
		<div class="control-group">
			<label class="control-label span3">Evento</label>
			<div class="controls span9">
				<select class="span9" name="_evento" id="_evento	" onchange="cargarCategorias()">
						<option value="">--Todos--</option>
						<option value="1">Caminata</option>
						<option value="2">Carrera</option>	
				</select>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label span3">Categoría</label>
			<div class="controls span9">
				<select class="input-block-level" name="categoria">
					<option value="">Categoría</option>
				</select>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label span3">Correo Electronico</label>
			<div class="controls span9">
				<input type="email" class="input-block-level" placeholder="Correo Electronico" name="correo" required maxlength="255">
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label span3">Estado Inicial</label>
			<div class="controls span9">
				<select class="input-block-level" name="categoria">
					<option value="True">Validado</option>
					<option value="False">No Validado</option>
				</select>
			</div>
		</div>
		
		<div class="form-actions">
			<button type="submit" id="guardar" class="btn btn-primary btn-large" data-loading-text="Registrando Atleta...">Registrar Atleta</button>
		</div>
	</fieldset>
</form>

<script src="<?php echo base_url();?>media/jquery.maskedinput.min.js"></script>
<script src="<?php echo base_url();?>media/js/validaciones.js"></script>
<script src="<?php echo base_url();?>media/js/fn_inscripcion.js"></script>