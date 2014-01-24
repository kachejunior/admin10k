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
	['[name=cedula]','[name=nombre]','[name=apellido]','[name=sexo]','[name=f_nacimiento]',
	'[name=direccion]','[name=telefono]','[name=evento]',
	'[name=categoria]','[name=correo]','[name=correo2]','[name=contrasena]','[name=contrasena2]'];

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

	if($('[name=contrasena]').val() !== $('[name=contrasena2]').val())
	{
		alert('Los Contraseñas no coinciden');
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

function guardar()
{
	if (!verificar() || !validar_captcha()) return false;
	$('#guardar').button('loading');
	var post = "cedula="+$('[name=cedula]').val();
	post += "&nombre="+$('[name=nombre]').val();
	post += "&apellido="+$('[name=apellido]').val();
	post += "&sexo="+$('[name=sexo]').val();
	post += "&f_nacimiento="+$('[name=f_nacimiento]').val();
	post += "&direccion="+$('[name=direccion]').val();
	post += "&telefono="+$('[name=telefono]').val();
	post += "&evento="+$('[name=evento]').val();
	post += "&categoria="+$('[name=categoria]').val();
	post += "&correo="+$('[name=correo]').val();
	post += "&correo2="+$('[name=correo2]').val();
	post += "&contrasena="+$('[name=contrasena]').val();
	post += "&contrasena2="+$('[name=contrasena2]').val();
	post += "&captcha="+$('[name=captcha]').val();
	$.ajax({
			url: base_url +"atletas/agregar",
			data: post,
			processData: 'false',
			type: "POST",
			success: function(datos){
				alert(datos);
				$('#guardar').button('reset');
			if(!$.isNumeric(datos) || datos<1){
				$('#formulario').append(msj_error);
				return false;
			}else
				$('#formulario').append(msj_ok);
			},
		error: function(){
			alert('error');
			$('#guardar').button('reset');
			$('#formulario').append(msj_error);
		}
	});
}

	function actualizar_categoria(f_nacimiento,evento){
		$('[name=categoria]').html('<option value="">Categoría</option>');
		if (evento == '' || f_nacimiento == '')
			return false;
		var texto;
		var post = "f_nacimiento="+$('[name=f_nacimiento]').val();
		post += "&evento="+$('[name=evento]').val();
    $.ajax({
        url: base_url +"general/get_categorias",
        data: post,
        processData: 'false',
				dataType: 'json',
        type: "POST",
        success: function(datos) {
					for (var i=0; i<datos.length; i++){
						texto = '<option value="'+datos[i].id+'">'+datos[i].nombre+'</option>';
						$('[name=categoria]').append(texto);
					}
        },
        error: function() {alert('Se ha producido un error');}
    });
    return true;
}

	function validar_captcha(){
		if ($('[name=captcha]').val()==''){
			$('[name=captcha]').focus();
			return false;
		}
		var post = "captcha="+$('[name=captcha]').val();
    $.ajax({
        url: base_url +"atletas/validar_captcha",
        data: post,
        processData: 'false',
        type: "POST",
        success: function(datos){
					alert(datos);
					if (datos == '1')
						return true;
					else{
						$('[name=captcha]').focus();
						return false;
					}
        },
        error: function() {return false;}
    });
}

$(document).ready(function()
{
	$('#formulario').submit(function(e){
		e.preventDefault();
		guardar();
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
		weekStart: 1
	});

	$('[name=evento]').change(function(){
		actualizar_categoria($('[name=f_nacimiento]').val(),$('[name=evento]').val());
	});
	$('[name=f_nacimiento]').change(function(){
		actualizar_categoria($('[name=f_nacimiento]').val(),$('[name=evento]').val());
	});
	
});