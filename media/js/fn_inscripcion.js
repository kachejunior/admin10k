var indice = 0;
var msj_error = '<div class="alert alert-error span11">'+
				'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				'Ocurrio un error al intentar registrar el atleta</div>';
var msj_ok = '<div class="alert alert-success span11">'+
				'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				'Atleta registrado con Exito, por favor revise su correo para continuar.</div>';

function vacio(q)
{  
	for ( i = 0; i < q.length; i++ )
	{
		if ( q.charAt(i) != " " )
		{
			return false;
		}
	}
	return true;
}

function verificar()
{
	var item =
	['[name=cedula]','[name=nombre]','[name=apellido]','[name=sexo]','[name=f_nacimiento]','[name=direccion]','[name=telefono]',
	'[name=evento]','[name=categoria]','[name=correo]','[name=correo2]','[name=captcha]'];

	for( var i=0; i< item.length; i++)
	{
		if (vacio($(item[i]).val()))
		{
			$(item[i]).focus();
			return false;
		}
	}
	if($('[name=correo]').val() !== $('[name=correo2]').val())
	{
		alert('Los correos no coinciden');
		return false;
	}
	return true;
}

function filtrarTeclas()
{
	var item =
	['[name=direccion]'];
	var item2 =
	['[name=nombre]','[name=apellido]'];
	for( var i=0; i< item.length; i++){
		$(item[i]).keypress(function(){
			return soloPermitidos(event);
		});
	}
	for( var i=0; i< item2.length; i++){
		$(item2[i]).keypress(function(){
			return soloLetras(event);
		});
	}
}

function actualizar_categoria(evento){
		$('[name=categoria]').html('<option value="">Categoría</option>');
		if (evento == '')
			return false;
		if(evento == '1')
		{
			$('[name=categoria]').append('<option value="1">Caminata Familiar</option>');
		}
		if(evento == '2')
		{
			$('[name=categoria]').append('<option value="1">Juvenil (16 - 18 años)</option>');
			$('[name=categoria]').append('<option value="2">Libre (18 - 29 años)</option>');
			$('[name=categoria]').append('<option value="3">Sub-Master A (30 - 34 años)</option>');
			$('[name=categoria]').append('<option value="4">Sub-Master B (35 - 39 años)</option>');
			$('[name=categoria]').append('<option value="5">Master A (40 - 44 años)</option>');
			$('[name=categoria]').append('<option value="6">Master B (45 -49 años)</option>');
			$('[name=categoria]').append('<option value="7">Master C (50 - 54 años)</option>');
			$('[name=categoria]').append('<option value="8">Master D (55 - 59 años)</option>');
			$('[name=categoria]').append('<option value="9">Master E (60 años en adelante)</option>');
			$('[name=categoria]').append('<option value="10">Personas en situación de discapacidad Visual (18 años en adelante)</option>');
			$('[name=categoria]').append('<option value="11">Personas en situación de discapacidad Motriz (18 años en adelante)</option>');
			$('[name=categoria]').append('<option value="12">Personas en situación de discapacidad Silla de Ruedas (18 años en adelante)</option>');
		}
}

$(document).ready(function()
{
	$('#formulario').submit(function(e){
		$('#guardar').button('loading');
		if (!verificar()){	
			e.preventDefault();
			$('#guardar').button('reset');
		}
//		guardar();
	});

//	$('[name=cedula]').focus();

	filtrarTeclas();

	$(".numeric").numeric();
	$(".integer").numeric(false, function() { alert("Integers only"); this.value = ""; this.focus(); });
	$(".positive").numeric({ negative: false }, function() { alert("No negative values"); this.value = ""; this.focus(); });
	$(".positive-integer").numeric({ decimal: true, negative: false }, function() { alert("Positive integers only"); this.value = ""; this.focus(); });
	
	$.mask.definitions['~']='[VEJGPvejgp]';
	$.mask.definitions[',']='[24]';
	$.mask.definitions[';']='[1-9]';
	$('[name=cedula]').mask('~-9999999?999');
	$('.phone').mask('0,9;-9999999');

	$('[name=f_nacimiento]').datepicker({
		language: 'es',
		format: 'dd-mm-yyyy',
		autoclose: true,
		endDate: '31-12-1997',
		weekStart: 1
	});

	$('[name=evento]').change(function(){
		actualizar_categoria($('[name=evento]').val());
	});
	
});