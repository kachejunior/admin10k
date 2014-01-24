<!--<form action="<?php echo base_url().'atletas_admin/get_numero'?>" method="post">-->
<div class='container'>
	<h2>Asignacion Numero de Carrera 10k</h2>
	<div class="control-group">
		<div class="controls">
				<div class="span2">
					<label>Numero</label>
					<input class="span11 positive-integer" name="numero" id="numero" type="text" placeholder="###" maxlength='4' required>
				</div>
			</div>
		<div class="controls">
				<div class="span2">
					<label>Cedula</label>
					<input class="span11 cedula" name="cedula" id="cedula" type="text" placeholder="##########" maxlength='10'  required>
					<input name="bandera" type="hidden" value="0">
				</div>
		</div>
		<div class="controls">
				<div class="span2">
					<label style="color:#fff;">Buscar</label>
					<button class="btn btn-success " type="button" id="_validar"><i class="icon-ok icon-white"></i>Validar</button>
					<!--<input type="submit">-->
				</div>		
		</div>
	</div>
	</div>
	<div class="container">
	<address class='span8 well'>
		<strong id="cedula_nombre"></strong><br>
		<div id="evento"></div>
		<div id="categoria"></div>
		<div id="sexo"> </div>
<!--		<div id="telefono"></div>
		<div id="correo"></div>-->
		<div id="numero_fh_validacion"></div>
		<div class="controls" id="_alerta" style="font-size: 24px;">
		</div>
	</address>
		
	</div>
<!--	<input type="submit">
	</form>-->
<script src="<?php echo base_url();?>media/jquery.maskedinput.min.js"></script>
<script src="<?php echo base_url();?>media/js/fn_validacion_carrera.js"></script>
