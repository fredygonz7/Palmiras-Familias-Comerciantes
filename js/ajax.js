// function ajax_contenido(archivo,idpadre,idobj) {
// 	if (document.getElementById(idobj)==null) {
// 		var xmlhttp = new XMLHttpRequest();
//         xmlhttp.onreadystatechange = function() {
//             if (this.readyState == 4 && this.status == 200) {
//             	//console.log("this.responseText = "+this.responseText);
//             	//document.getElementById(id).appendChild(archivo);
//                 alert(this.responseText);
//             	$("#"+idpadre).append(this.responseText);
//             	console.log("fin ajax");
//             }
//         }
//         xmlhttp.open("GET", archivo, true);
//         xmlhttp.send();
// 	}
// }

// function inicio_index(){
// 	ajax_contenido('admin/html/footer.html',"body",'footer');
// }
// function inicio_admin(){
// 	ajax_contenido('html/footer.html',"body",'footer');
// }

function ajaxjQuery_contenido(url,padre) {
    var contenido=$.ajax({
        type: "POST",   
        url,
        async: false
    }).responseText;
    $(padre).append(contenido);
}

// function ajaxjQueryx(url) {
// 	//alert("serialize"+" "+ $('#forgenemp').serialize());
//     var respuesta=$.ajax({
//         type: "POST",   
//         url,
//         async: false,
//         data: $('#forgenemp').serialize()
//     }).responseText;
//     alert(respuesta);
// }

function ajaxjQuery(url,idformulario) {
	//alert("serialize"+" "+ $('#'+idformulario).serialize());
    $.ajax({
        type: "POST",   
        url,
        async: false,
        data: $('#'+idformulario).serialize()+'&usuario_activo='+$('#usuario_activo').html(),
        success: function (respuesta) {
        	switch(url) {
        		//gestionar ventas
        		case "../php/ventas.php":
	    			ventas(respuesta);
        			break;
        		case "../php/bus_empleado.php":
	    			mostrar_empleado(respuesta);
        			break;
        		//gestionar empleado
		    	case "../php/eli_empleado.php":
		    		eliminar_empleado(respuesta);
		    		break;
		    	case "../php/consulta.php":
		    		consultar(respuesta);
		    		break;
		    	case "php/sesion.php":
		    		sesion(respuesta);
		    		break;
			    default: 
			    	alert(respuesta);
			        break;
        	}
	    },
	    error: function (jqXHR,estado,error) {
	    	//$('#status').html("<i class='material-icons'>close</i>");
	    	
	    	alert(respuesta+"   error"+estado+"   "+error);
	    	console.log(estado);
	    	console.log(error);
	    },
	    complete: function (jqXHR, estado) {
	    	console.log(estado);
	    	alert(respuesta+"   complete  "+estado);
	    }
    })
}

function sesion(respuesta) {
	try {
	    objeto=JSON.parse(respuesta);
	    sessionStorage.setItem("nombre", objeto.numide);
	    if (objeto.cargo=="administrador") {
	    	window.location.href = "admin/administrador.html";
	    }
	    if (objeto.cargo=="vendedor") {
	    	window.location.href = "admin/vendedor.html";
	    }
		
		// $("#forgesempmos #mostrar_numide_span").html(objeto.numide);
		// $("#forgesempmos #mostrar_numide").val(objeto.numide);
		// $("#forgesempmos #mostrar_nom").val(objeto.nom);
		// $("#forgesempmos #mostrar_ape").val(objeto.ape);
		// $("#forgesempmos #mostrar_pas").val(objeto.pas);
		// $("#forgesempmos").show(2000);
	}
	catch(err) {
	    alert(respuesta);
	}
}

function ventas(respuesta) {
	$("#ventas_valor").val("");
	$("#ventas_cambio").html("");
	$("#ventas_efectivo").val("");
	alert(respuesta);
}

function consultar(respuesta) {
	try {
	    objeto=JSON.parse(respuesta); 
		$("#consulta_ventas").html(objeto.ventas);
		$("#consulta_gastos").html(objeto.gastos);
		$("#consulta_ganancias").html(objeto.ventas-objeto.gastos);
		$("#consulta_tabla").show(1000);
	}
	catch(err) {
	    alert(respuesta)
	}
}


function mostrar_empleado(respuesta) {
	try {
	    objeto=JSON.parse(respuesta); 
		$("#forgesempmos #mostrar_numide_span").html(objeto.numide);
		$("#forgesempmos #mostrar_numide").val(objeto.numide);
		$("#forgesempmos #mostrar_nom").val(objeto.nom);
		$("#forgesempmos #mostrar_ape").val(objeto.ape);
		$("#forgesempmos #mostrar_pas").val(objeto.pas);
		$("#forgesempmos").show(2000);
	}
	catch(err) {
	    alert(respuesta)
	}
}
function eliminar_empleado(respuesta) {
	alert(respuesta) 
	$("#forgesempmos").hide(2000);
}


function ajaxjQuery_option(url,padre) {
	$.ajax({
        type: "POST",   
        url,
        async: false,
        //data: $('#'+idformulario).serialize()+'&usuario_activo='+$('#usuario_activo').html(),
        success: function (respuesta) {
        	$('#'+padre).html("");
        	objeto = JSON.parse(respuesta);
        	$('#'+padre).append('<option value="" disabled selected>Seleccione una opción</option>');
        	for (var i = 0; i < objeto.length; i++) {
        	  	$('#'+padre).append('<option value='+objeto[i].insumo+'>'+objeto[i].insumo+'</option>');
        	}
			$('select').material_select();
	    },
	    error: function (jqXHR,estado,error) {
	    	alert(respuesta+"   error"+estado+"   "+error);
	    	console.log(estado);
	    	console.log(error);
	    },
	    complete: function (jqXHR, estado) {
	    	console.log(estado);
	    	alert(respuesta+"   complete  "+estado);
	    }
    })
}

// function ajaxjQuery_servidor(url,padre) {
//     var contenido=$.ajax({
//         type: "GET",   
//         url,
//         async: false,
//         // código a ejecutar si la petición es satisfactoria;
//         // la respuesta es pasada como argumento a la función
//         success : function() {
//            $("#mensaje").text( "Not valid!" ).show().fadeOut( 1000 );
//         },
//         // código a ejecutar si la petición falla;
//         // son pasados como argumentos a la función
//         error : function() {
//             $("#mensaje").text( "Not valid!" ).show().fadeOut( 1000 );
//         },
//     }).responseText;
//     //alert(contenido);
//     $(padre).append(contenido);
// }