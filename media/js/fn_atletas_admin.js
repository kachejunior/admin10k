var mensaje_exito= '<div class="alert alert-success" id="_mensaje"><button type="button" class="close" data-dismiss="alert">×</button><strong>Guardado con Exito!</strong></div>';
var mensaje_error_datos= '<div class="alert alert-error" id="_mensaje"><button type="button" class="close" data-dismiss="alert">×</button><strong>Error al Guardar!</strong> Verifica los datos (La cedula puede ser repetida o faltan campos)</div>';
var tipo_usuario = $('[name=tipo_usuario]').val();
function vacio(q) {  
	for ( i = 0; i < q.length; i++ ){
		if ( q.charAt(i) != "" ){
			return false;
		}
	}
	return true;
}

function cargarCategorias(){
	var post = "evento="+$('[name=_evento]').val();
    var url = base_url+'eventos/get_categoria';
    $.ajax({
        url: url,
        data: post,
        processData: 'false',
		dataType: 'json',
        type: "POST",
        success: function(datos) {
			for (var i=0; i<datos.length; i++){
				var cadena = '<option value ='+datos[i].id+'>'+datos[i].nombre+'</option>' ;
				$('#_categoria').append(cadena);
				if(!$('#_categoria').is(':visible')){
					$('#_categoria caption').click();
				}
			}
        },
        error: function() {alert('Se ha producido un error');}
    });
    return true;
}

function actualizar(){
    var url = base_url+'atletas_admin/get2';
    $.ajax({
        url: url,
        data: null,
        processData: 'false',
				dataType: 'json',
        type: "POST",
        success: function(datos) {
				$('#tabla tbody').html('');
			for (var i=0; i<datos.length; i++){
				cadena='<tr style="text-transform: uppercase">';
					'<td class="centrado">'+datos[i].cedula+'</td>'+
					'<td>'+datos[i].nombre+' '+datos[i].apellido+'</td>'+
					'<td class="centrado">'+datos[i].sexo+'</td>'+
					'<td class="centrado">'+datos[i].evento_nombre+'</td>'+
					'<td class="centrado">'+datos[i].categoria_nombre+'</td>'+
					'<td class="centrado" style="text-transform: lowercase">'+datos[i].correo+'</td>'+
					'<td class="centrado">';		
				if(true)
				{
				cadena +='<a class="btn btn-mini btn-warning" onclick="get(\''+datos[i].cedula+'\')">'+
							   ' <i class="icon-wrench icon-white"></i></a>';
				cadena +=' <a class="btn btn-mini btn-danger" onclick="eliminar(\''+datos[i].cedula+'\')">'+
							    ' <i class="icon-minus icon-white"></i></a>';
				}
				if(tipo_usuario==2)
				{
				cadena +='<a class="btn btn-mini btn-warning" onclick="get(\''+datos[i].id+'\')">'+
							   ' <i class="icon-wrench icon-white"></i></a>';
				}
				cadena +=	'</td>'+
				'</tr>';
				$('#tabla tbody').append(cadena);
				if(!$('#tablal tbody').is(':visible')){
					$('#tabla caption').click();
				}
			}
        },
        error: function() {alert('Se ha producido un error');}
    });
    return true;
}


function eliminar(id){
	if(!confirm('Esta seguro. ¿Desea eliminarla?'))
		return false;
	if(!confirm('Se le recuerda que el registro quedara eliminado totalmente,  ¿Desea Continuar?'))
		return false;
	var url = base_url+'atletas_admin/eliminar/'+id;
	//alert(url);
	$.ajax({
			url: url,
			data: null,
			processData: 'false',
			dataType: 'json',
			type: "POST",
			success: function(){
				document.location.href = base_url+'atletas_admin/p/'+pagina;
			},
			error: function() {alert('Se ha producido un error');}
	});
	return true;
}


function verificar(){
	var item =['[name=_cedula]', '[name=_nombre]' , '[name=_sexo]' , '[name=_validado]' , '[name=_evento]' , '[name=_categoria]'];
	for( var i=0; i< item.length; i++){
		if (vacio($(item[i]).val())){
			document.location.href = base_url+'atletas_admin';
		}
	}
	return true;
}

function buscar(){
	var post= "_cedula="+$('[name=_cedula]').val();
	post += "&_nombre="+$('[name=_nombre]').val();
	post += "&_sexo="+$('[name=_sexo]').val();
	post += "&_validado="+$('[name=_validado]').val();
	post += "&_evento="+$('[name=_evento]').val();
	post += "&_categoria="+$('[name=_categoria]').val();
    var url = base_url+'atletas_admin/buscar';
	//alert(post);
    $.ajax({
        url: url,
        data: post,
        processData: 'false',
	   dataType: 'json',
        type: "POST",
        success: function(datos) {
			$('#tabla tbody').html('');
			$('#paginacion').html('');
			for (var i=0; i<datos.length; i++){
				cadena='<tr style="text-transform: uppercase">';
				cadena +='<td class="centrado">'+datos[i].cedula+'</td>'+
					'<td>'+datos[i].nombre+' '+datos[i].apellido+'</td>'+
					'<td class="centrado">'+datos[i].sexo+'</td>'+
					'<td class="centrado">'+datos[i].evento_nombre+'</td>'+
					'<td class="centrado">'+datos[i].categoria_nombre+'</td>'+
					'<td class="centrado" style="text-transform: lowercase">'+datos[i].correo+'</td>'+
				'</tr>';
				$('#tabla tbody').append(cadena);
				if(!$('#tablal tbody').is(':visible')){
					$('#tabla caption').click();
				}
			}
        },
					error: function() {alert('Se ha producido un error');}
    });
    return true;
}

function exportar_xls(){
	var post= "_cedula="+$('[name=_cedula]').val();
	post += "&_nombre="+$('[name=_nombre]').val();
	post += "&_sexo="+$('[name=_sexo]').val();
	post += "&_validado="+$('[name=_validado]').val();
	post += "&_evento="+$('[name=_evento]').val();
	post += "&_categoria="+$('[name=_categoria]').val();
    var url = base_url+'atletas_admin/exporte_xls';
	//alert(post);
	$.post(url, 
		{ _evento: 1 }
	);
//    $.ajax({
//        url: url,
//        data: post,
//        processData: 'false',
//	   dataType: 'json',
//        type: "POST",
//        success: function() {
//					document.location.href(url);
//        },
//		error: function() {alert('Se ha producido un error');}
//    });
//    return true;
}

function aMays(e, elemento) {
tecla=(document.all) ? e.keyCode : e.which; 
 elemento.value = elemento.value.toUpperCase();
}

$(".positive-integer").numeric({ decimal: false, negative: false }, function() {this.value = ""; this.focus(); });
	
	$.mask.definitions['*']='[24]';
	$(".telefono").mask("(0*99)999-9999");
	$.mask.definitions['+']='[ve]';
	$(".cedula").mask("+-9999999?999");
	
	$.mask.definitions['m']='[01]';
	$.mask.definitions['d']='[0123]';
	$.mask.definitions['Y']='[12]';
	$.mask.definitions['y']='[089]';
     $(".fecha2").mask("d9-m9-Yy99");
	
	$('.fecha').datepicker({format: 'yyyy-mm-dd',language: 'es'});
	


$(document).ready(function(){
			 
	$('#_guardar').click(function(){
		guardar();
	});
	
//	$('#_nuevo_paciente').click(function(){
//		$('#fecha_nacimiento').datepicker({
//										language: 'es',
//										format: 'dd-mm-yyyy',
//										autoclose: true,
//										weekStart: 1
//						});
//					$('#fecha_atencion').datepicker({
//										 language: 'es',
//										 format: 'dd-mm-yyyy',
//										 autoclose: true,
//										 weekStart: 1
//						 });
//					$('#fecha_esterilizacion').datepicker({
//										 language: 'es',
//										 format: 'dd-mm-yyyy',
//										 autoclose: true,
//										 weekStart: 1
//						 });
//	});
	
	$('#_cerrar').click(function(){
		$('#_mensaje').remove();
		$('#cedula').addClass('span9 cedula');
	});
	
	$('#_buscar').click(function(){
		buscar();
	});
	
	$('#_evento').change(function(){
		alert('bandera 1');
		cargarCategorias();
	});
	
	$('#myModal').on('hidden', function (){
		limpiar_form();
	});
	

});

