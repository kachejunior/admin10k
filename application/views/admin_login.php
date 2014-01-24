<div class="span10 offset1">
	<div class="page-header" style="text-align: center;">
			<h1>Sistema de Inscripción</h1>
			<h4>Carrera 10k y Caminata 5k Ciudad Bolivar 2013</h4>
	</div>

	<div class="span6 offset3">
			<form id="formulario" class="well">
				<!--<form class="span10 offset1" action="http://mujervf.fsbolivar.com.ve/usuarios/iniciar_session" method="post">-->
				<legend>Iniciar Sesión</legend>
				<div class="controls">
					<div class="input-prepend span12">
						<label>Cedula</label>
						<span class="add-on"><i class="icon-user"></i></span>
						<input class="positive-integer span11" type="text" name="cedula" maxlength="10" placeholder="Cedula" required autocomplete="off">
					</div>
				</div>
				<div class="controls">
					<div class="input-prepend span12">
						<label>Password</label>
						<span class="add-on"><i class="icon-certificate"></i></span>
						<input class="span11" type="password" name="clave" placeholder="Password" required>
					</div>
				</div>
				<div class="controls">
					<div  id="_alerta">
						
					</div>
				</div>
				<div class="controls">
					<button type="submit" class="btn btn-primary" id="_login" data-loading-text="Verificando....">Acceder</button>
				</div>
		</form>
	</div>

</div>

<script src="<?php echo base_url();?>media/js/fn_gs_login.js"></script>