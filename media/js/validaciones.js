function soloLetras(e){
    key = e.which || e.KeyCode;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = [8];

    tecla_especial = false
    for(var i in especiales){
 if(key == especiales[i]){
     tecla_especial = true;
     break;
        } 
    }
    if(letras.indexOf(tecla)==-1 && !tecla_especial)
        return false;
}

function soloPermitidos(e){
    key = e.which || e.KeyCode;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz0987654321,.()@#";
    especiales = [8,13];

    tecla_especial = false
    for(var i in especiales){
 if(key == especiales[i]){
     tecla_especial = true;
     break;
        } 
    }
 
    if(letras.indexOf(tecla)==-1 && !tecla_especial)
        return false;
}

function textoObligatorio(valor){
    if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
        return false;
    }
    return true;
}

function comprobarSiBisisesto(anio){
    if ( ( anio % 100 != 0) && ((anio % 4 == 0) || (anio % 400 == 0))) {
        return true;
        }
    else {
        return false;
        }
}

function esFechaValida(fecha){
    if (fecha != undefined && fecha != "" ){
        if (!/^\d{2}-\d{2}-\d{4}$/.test(fecha)){
            alert("formato de fecha no válido. (Recuerde usar dd-mm-aaaa)");
            return false;
        }
        var dia  =  parseInt(fecha.substring(0,2),10);
        var mes  =  parseInt(fecha.substring(3,5),10);
        var anio =  parseInt(fecha.substring(6),10);
 
    switch(mes){
        case 1:
        case 3:
        case 5:
        case 7:
        case 8:
        case 10:
        case 12:
            numDias=31;
            break;
        case 4: case 6: case 9: case 11:
            numDias=30;
            break;
        case 2:
            if (comprobarSiBisisesto(anio)){ numDias=29 }else{ numDias=28};
            break;
        default:
            alert("Fecha introducida erronea");
            return false;
    }
 
        if (dia>numDias || dia==0){
            alert("Fecha introducida erronea");
            return false;
        }
        return true;
    }
    return true;
}

function vacio(q) {
	for ( i = 0; i < q.length; i++ ){
		if ( q.charAt(i) != " " ){
			return false;
		}
	}
	return true;
}

function cancelar(){
	if(!confirm('¿Seguro Desea Cancelar?')){
		return false;
	}
	return true;
}
