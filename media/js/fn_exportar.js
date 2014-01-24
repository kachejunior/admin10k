function actualizar_donativo(categoria,donativo){
		$('[name=donativo]').html('<option value="0">Cualquiera</option>');
		if (categoria == '0')
			return false;
		var texto;
    $.ajax({
        url: base_url +"general/get_donativos/"+categoria,
        data: null,
        processData: 'false',
		dataType: 'json',
        type: "POST",
        success: function(datos) {
				for (var i=0; i<datos.length; i++){
					texto = '<option value="'+datos[i].id+'">'+datos[i].nombre+'</option>';
					$('[name=donativo]').append(texto);
				}
				if(donativo!='')
					$('[name=donativo]').val(donativo);
        },
        error: function() {alert('Se ha producido un error');}
    });
    return true;
}

	function actualizar_municipio(estado,municipio){
		$('[name=municipio]').html('<option value="0">Cualquiera</option>');
		$('[name=parroquia]').html('<option value="0">Cualquiera</option>');
		if (estado == '0')
			return false;
		var texto;
    $.ajax({
        url: base_url +"general/get_municipios/"+estado,
        data: null,
        processData: 'false',
		dataType: 'json',
        type: "POST",
        success: function(datos) {
				for (var i=0; i<datos.length; i++){
					texto = '<option value="'+datos[i].id+'">'+datos[i].nombre+'</option>';
					$('[name=municipio]').append(texto);
				}
				if(municipio!='')
					$('[name=municipio]').val(municipio);
        },
        error: function() {alert('Se ha producido un error');}
    });
    return true;
}

	function actualizar_parroquia(estado,municipio,parroquia){
		$('[name=parroquia]').html('<option value="0">Cualquiera</option>');
		if (estado == '0')
			return false;
		var texto;
    $.ajax({
        url: base_url +"general/get_parroquias/"+estado+'/'+municipio,
        data: null,
        processData: 'false',
		dataType: 'json',
        type: "POST",
        success: function(datos) {
				for (var i=0; i<datos.length; i++){
					texto = '<option value="'+datos[i].id+'">'+datos[i].nombre+'</option>';
					$('[name=parroquia]').append(texto);
				}
				if(parroquia!='')
					$('[name=parroquia]').val(parroquia);
        },
        error: function() {alert('Se ha producido un error');}
    });
    return true;
}


$(document).ready(function()
{

	$('[name=categoria]').change(function(){
		actualizar_donativo($('[name=categoria]').val(),'');
	});

	$('[name=estado]').change(function(){
		actualizar_municipio($('[name=estado]').val(),'');
	});

	$('[name=municipio]').change(function(){
		actualizar_parroquia($('[name=estado]').val(),$('[name=municipio]').val(),'');
	});

	$('#formulario').submit(function(e){
		e.preventDefault();
		guardar();
	});

	
	$('[name=fpp1]').datepicker({
		language: 'es',
		format: 'dd-mm-yyyy',
		weekStart: 1
	});
	$('[name=fpp2]').datepicker({
		language: 'es',
		format: 'dd-mm-yyyy',
		weekStart: 1
	});

	$('[name=f_solicitud1]').datepicker({
		language: 'es',
		format: 'dd-mm-yyyy',
		weekStart: 1
	});
	$('[name=f_solicitud2]').datepicker({
		language: 'es',
		format: 'dd-mm-yyyy',
		weekStart: 1
	});
/*	public function exportar_excel($fsol1='',$fsol2='',$status=0,$prioridad=0,$estado=0,
			$municipio=0,$parroquia=0,$tipo_solicitud=0,$orientacion=0,$categoria=0,$donativo=0,$sexo=0,$fpp1='',$fpp2='')
*/
	$('#_descargar').click(function(){
		var fsol1, fsol2, fpp1,fpp2;
		if($('[name=f_solicitud1]').val()==='')
			fsol1 = 0;
		else
			fsol1 = $('[name=f_solicitud1]').val();
		
		if($('[name=f_solicitud2]').val()==='')
			fsol2 = 0;
		else
			fsol2 = $('[name=f_solicitud2]').val();
		
		if($('[name=fpp1]').val()==='')
			fpp1 = 0;
		else
			fpp1 = $('[name=fpp1]').val();
		
		if($('[name=fpp2]').val()==='')
			fpp2 = 0;
		else
			fpp2 = $('[name=fpp2]').val();
		
		url = base_url + 'exportar/excel/' + 
					fsol1+'/'+ fsol2+'/'+
					$('[name=status]').val()+'/'+ $('[name=prioridad]').val()+'/'+
					$('[name=estado]').val()+'/'+ $('[name=municipio]').val()+'/'+
					$('[name=parroquia]').val()+'/'+ $('[name=tipo_solicitud]').val()+'/'+
					$('[name=orientacion]').val()+'/'+ $('[name=categoria]').val()+'/'+
					$('[name=donativo]').val()+'/'+ $('[name=sexo]').val()+'/'+
					fpp1+'/'+ fpp2;
		window.open(url, '_blank');
		return false;
	});

});