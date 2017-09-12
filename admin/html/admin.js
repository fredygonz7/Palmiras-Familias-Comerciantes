	// sesion *************************************************************************************
	doc = document;
		function obtenersesion() {
			alert("mango");
			var nombre = sessionStorage.getItem("nombre");
			objeto_nombre={"nombre":nombre};
			//alert(JSON.stringify(nombre));
			
			var respuesta=$.ajax({
		        type: "POST",   
		        url: "../php/sesion.php",
		        async: false,
		        data: objeto_nombre
		    }).responseText;
		    objeto=JSON.parse(respuesta);
		    if (objeto.cargo=="vendedor") {
		    	window.location.href = "vendedor.html";
		    }
		    else if (objeto.cargo=="administrador") {
		    	autenticado = doc.querySelectorAll("#autenticado");
				autenticado[0].innerHTML = nombre+'<i class="material-icons left">person_outline</i></li>';
				autenticado[1].innerHTML = nombre+'<i class="material-icons left">person_outline</i></li>';
				$('#usuario_activo').html(nombre);
		    }
		    else{
		    	sessionStorage.clear();
				window.location.href = "index.html";
		    }
			return (nombre===null || nombre === undefined)?window.location.href = "../index.html":false;
		}
		doc.querySelector("#cerrarsesion").onclick = function () {
			sessionStorage.clear();
			window.location.href = "../index.html"
		}
		window.onload = obtenersesion;

	// eventos *********************************************************************************
		$('select').material_select();
		//fecha dia
		$('.datepicker').pickadate({
		    // selectMonths: true, // Creates a dropdown to control month
		    // selectYears: 15, // Creates a dropdown of 15 years to control year,
		    // today: 'Today',
		    // clear: 'Clear',
		    // close: 'Ok',
		    // closeOnSelect: false, // Close upon selecting a date,
		    //max: new Date(2017,8,14),
		    formatSubmit: 'yyyy-mm-dd',
  			hiddenName: true
		});
    window.onload = cargar_eventos_admin;
	function cargar_eventos_admin(){
		alert();

			//opciones------------------------------
			var veltrans=500;
			//opcionventas
			$("a#opcionventas").click(function(){
				$("#seccionventas").show(veltrans);
				$("#secciongastos").hide(veltrans);
				$("#seccionconsultas").hide(veltrans);
				$("#seccionagregarinsumos").hide(veltrans);
				$("#secciongestionarempleados").hide(veltrans)
				quitaractiveopciones();
				$("a#opcionventas").addClass("active");
				//$("#mobile-demo").css("transform", "translateX(-100%)");
				//agregar o quitar clase
			});
			//opciongastos
			$("a#opciongastos").click(function(){
				//alert()
				$("#secciongastos").show(veltrans);
				$("#seccionventas").hide(veltrans);
				$("#seccionconsultas").hide(veltrans);
				$("#seccionagregarinsumos").hide(veltrans);
				$("#secciongestionarempleados").hide(veltrans)
				quitaractiveopciones();
				$("a#opciongastos").addClass("active");
			});
			//opcionconusltas
			$("a#opcionconusltas").click(function(){
				$("#secciongastos").hide(veltrans);
				$("#seccionventas").hide(veltrans);
				$("#seccionconsultas").show(veltrans);
				$("#seccionagregarinsumos").hide(veltrans);
				$("#secciongestionarempleados").hide(veltrans)
				quitaractiveopciones();
				$("a#opcionconusltas").addClass("active");
			});
			//opcionagregarinsumos
			$("a#opcionagregarinsumos").click(function(){
				$("#secciongastos").hide(veltrans);
				$("#seccionventas").hide(veltrans);
				$("#seccionconsultas").hide(veltrans);
				$("#seccionagregarinsumos").show(veltrans);
				$("#secciongestionarempleados").hide(veltrans)
				quitaractiveopciones();
				$("a#opcionagregarinsumos").addClass("active");
			});
			//opciongestionarempleados
			$("a#opciongestionarempleados").click(function(){
				$("#secciongastos").hide(veltrans);
				$("#seccionventas").hide(veltrans);
				$("#seccionconsultas").hide(veltrans);
				$("#seccionagregarinsumos").hide(veltrans);
				$("#secciongestionarempleados").show(veltrans)
				quitaractiveopciones();
				$("a#opciongestionarempleados").addClass("active");
			});
			//ventas--------------------------------
			$("#ventas_valor").keyup(function(){
				obtener_cambio();
			});
			$("#ventas_efectivo").keyup(function(){
				obtener_cambio();
			});
			function obtener_cambio() {
				if ($("#ventas_valor").val!="" && $("#ventas_efectivo").val()!="") {
					var vvalor = 1*$("#ventas_valor").val();
					var vefectivo = 1*$("#ventas_efectivo").val();
					if (vefectivo>=vvalor) {
						$("#ventas_cambio").html(vefectivo-vvalor);
					}
					else {
						$("#ventas_cambio").html("Error en los datos");
					}
				}
			}
			$("#ventas_cancelar").click(function(){
				$("#ventas_cambio").html("");
			});

			// $("#gastos_cancelar").click(function(){
			// 	$("#gastos_valor").val("");
			// });

			// consultas--------------------------------
			$("#consultas_tipo").change(function(){
				switch($("#consultas_tipo").val()) {
					case "0":
						$('#seccionconsultasdia').hide(1000);
						$('#seccionconsultasmes').hide(1000);
						$('#seccionconsultasrango').hide(1000);
						break;
					case "Dia":
						$('#seccionconsultasdia').show(1000);
						$('#seccionconsultasmes').hide(1000);
						$('#seccionconsultasrango').hide(1000);
						break;
					case "Mes":
						$('#seccionconsultasdia').hide(1000);
						$('#seccionconsultasmes').show(1000);
						$('#seccionconsultasrango').hide(1000);
						break;
					case "Rango":
						$('#seccionconsultasdia').hide(1000);
						$('#seccionconsultasmes').hide(1000);
						$('#seccionconsultasrango').show(1000);
						break;
				}
			});
			$("#consultas_cancelar").click(function(){
				$('#seccionconsultasdia').hide(1000);
				$('#seccionconsultasmes').hide(1000);
				$('#seccionconsultasrango').hide(1000);
				$("#consulta_tabla").hide(1000);
				$("#consulta_ventas").html("");
				$("#consulta_gastos").html("");
				$("#consulta_ganancias").html("");
			});
	}
		function quitaractiveopciones() {
			$("a#opcionventas").removeClass("active");
			$("a#opciongastos").removeClass("active");
			$("a#opcionconusltas").removeClass("active");
			$("a#opcionagregarinsumos").removeClass("active");
			$("a#opciongestionarempleados").removeClass("active");
		}