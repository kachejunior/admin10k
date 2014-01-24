var mensaja_error_1='<p class="text-error">El numero de asignacion ya esta en uso.</p>';
var mensaja_error_2='<p class="text-error">No se encuentra registro de atletas con dicha cedula</p>';
var mensaja_error_3='<p class="text-error">Error de duplicidad, el usuario se encuentra registrado mas de una vez.</p>';
var mensaja_error_4='<p class="text-error">Disculpe el atleta se encuentra asignado en el evento "Caminata 5k" por favor dirigirse a la mesa correspondiente.</p>';
var mensaja_error_5='<p class="text-error">El atleta ya se encuentra validado.</p>';
var mensaja_error_10='<p class="text-error">Falla en la validacion de Formulario.</p>';
var mensaja_1='<p class="text-success">Felicidades ya se encuentra validado para participar en la "Carrera 10k" ¡Mucha Suerte!.</p>';
function vacio(q) {  
	for ( i = 0; i < q.length; i++ ){
		if ( q.charAt(i) != "" ){
			return false;
		}
	}
	return true;
}

function limpieza(){
			$('#cedula_nombre').html('');	
			$('#evento').html('');	
			$('#categoria').html('');	
			$('#sexo').html('');	
//			$('#correo').html('');	
//			$('#telefono').html('');	
			$('#numero_fh_validacion').html('');	
			$('#_alerta').html('');
}

function reiniciar(){
			$('[name=cedula]').val("");
			$('[name=numero]').val($('[name=numero]').val()+1);
}

function cargarDatos(){
	var post = "cedula="+$('[name=cedula]').val();
    var url = base_url+'atletas_admin/get_numero';
	//alert(post+' '+url);
    $.ajax({
        url: url,
        data: post,
        processData: 'false',
		dataType: 'json',
        type: "POST",
        success: function(datos) {
			
			$('#cedula_nombre').html(datos.cedula+'  '+datos.nombre+' '+datos.apellido);	
			$('#evento').html(datos.evento_nombre);	
			$('#categoria').html(datos.categoria_nombre);	
			$('#sexo').html(datos.sexo);	
//			$('#correo').html(datos.correo);	
//			$('#telefono').html(datos.telefono);	
			$('#numero_fh_validacion').html('N°='+datos.numero+' Fecha y Hora de Validacion='+datos.fh_validacion);	
		//}
        },
		error: function() {alert('Se ha producido un error');}
    });
    return true;
}





function verificar(){
	var item =['[name=numero]', '[name=cedula]'];
	for( var i=0; i< item.length; i++){
		if (vacio($(item[i]).val())){
			return false;
		}
	}
	return true;
}

function validar(){
	if (!verificar()){
		alert('Falta campo por llenar');
		return false;
	}
	
	var post= "cedula="+$('[name=cedula]').val();
	post += "&numero="+$('[name=numero]').val();
	var url = base_url+'atletas_admin/validacion_carrera_envio';
	
	//alert(post+'<br>'+url)
	
    $.ajax({
        url: url,
        data: post,
        processData: 'false',
	   dataType: 'json',
        type: "POST",
        success: function(datos) {
				cargarDatos();
				if(datos == -10)
				{
					$('#_alerta').html(mensaja_error_10);
				}
				if(datos == -2)
				{
					$('#_alerta').html(mensaja_error_2);
				}
				if(datos == -3)
				{
					$('#_alerta').html(mensaja_error_3);
				}
				if(datos == -4)
				{
					$('#_alerta').html(mensaja_error_4);
				}
				if(datos == -1)
				{
					$('#_alerta').html('<p class="text-error">El numero '+$('[name=numero]').val()+' ya esta en uso.</p>');
				}
				if(datos == -5)
				{
					$('#_alerta').html(mensaja_error_5);
				}
				if(datos == 1)
				{
					$('#_alerta').html(mensaja_1);
				}
        },
				error: function() {alert('Se ha producido un error');}
    });
    return true;
}


$(".positive-integer").numeric({ decimal: false, negative: false }, function() {this.value = ""; this.focus(); });
$(".cedula").mask("9999999?999");	

$(document).ready(function(){
			 
	$('#_validar').click(function(){	
		validar();
		reiniciar();
	});
		
	$('#_cerrar').click(function(){
		$('#_mensaje').remove();
		$('#cedula').addClass('span9 cedula');
	});


});

