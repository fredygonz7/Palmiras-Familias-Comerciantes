<?php 
	include("conexion.php");
	if (isset($_POST['consultas_tipo']) && !empty($_POST['consultas_tipo'])) {
		$tipo=$_POST['consultas_tipo'];
		
		//conectar
		$conexion = mysql_connect($host,$user,$pw) or die("Problemas al conectar");
		//conectar a la BD
		mysql_select_db($bd, $conexion) or die("Problemas al conectar a la BD");

		switch ($tipo) {
			case "Dia":
				//hacer la consulta por dia
				if ($tipo=="Dia" && isset($_POST['consulta_dia']) && !empty($_POST['consulta_dia'])) {
					$dia=$_POST['consulta_dia'];
					$registro=mysql_query("SELECT valor FROM ventas where feccre = '$dia'") or die("Problemas en verificar existencia".mysql_error());
					$resventas = 0;
					while ($reg=mysql_fetch_assoc($registro)) {
					// 	//se obtienen los insumos y se codifican como json
					// 	echo json_encode($reg);
						//echo $reg['valor'];
						$resventas=$resventas+$reg['valor'];
					}

					//$objeto->ventas=$resventas;

					$registro=mysql_query("SELECT valor FROM gastos where feccre = '$dia'") or die("Problemas en verificar existencia".mysql_error());
					$resgastos = 0;
					while ($reg=mysql_fetch_assoc($registro)) {
					// 	//se obtienen los insumos y se codifican como json
					// 	echo json_encode($reg);
						//echo $reg['valor'];
						$resgastos=$resgastos+$reg['valor'];
					}
					//$objeto->gastos=$resgastos;
					echo '{"ventas":"'.$resventas.'","gastos":"'.$resgastos.'"}';
					//$resgastos
					//echo json_encode($objeto);
				}
				else {
					echo 'Verifique los datos';
				}
				break;
			case "Mes":
				//hacer la consulta por mes
				if ($tipo=="Mes" && isset($_POST['consulta_mes']) && !empty($_POST['consulta_mes']) && $_POST['consulta_mes']!="") {
					$mes=$_POST['consulta_mes'];
					list($año, $mes, $día) = split('[/.-]', $mes);
					$registro=mysql_query("SELECT valor FROM ventas where YEAR(feccre) = $año AND MONTH(feccre) = $mes") or die("Problemas en verificar existencia".mysql_error());
					$resventas = 0;
					while ($reg=mysql_fetch_assoc($registro)) {
						$resventas=$resventas+$reg['valor'];
					}
					$registro=mysql_query("SELECT valor FROM gastos where YEAR(feccre) = $año AND MONTH(feccre) = $mes") or die("Problemas en verificar existencia".mysql_error());
					$resgastos = 0;
					while ($reg=mysql_fetch_assoc($registro)) {
						$resgastos=$resgastos+$reg['valor'];
					}
					echo '{"ventas":"'.$resventas.'","gastos":"'.$resgastos.'"}';
				}
				else {
					echo 'Verifique los datos';
				}
				break;
			case "Rango":
				//hacer la consulta por Rango
				if ($tipo=="Rango" && isset($_POST['consulta_rangominimo']) && !empty($_POST['consulta_rangominimo']) && isset($_POST['consulta_rangomaximo']) && !empty($_POST['consulta_rangomaximo'])) {
					$rangominimo=$_POST['consulta_rangominimo'];
					$rangomaximo=$_POST['consulta_rangomaximo'];
					if ($rangominimo<=$rangomaximo) {
						$registro=mysql_query("SELECT valor FROM ventas WHERE feccre BETWEEN '$rangominimo' AND '$rangomaximo'") or die("Problemas en verificar existencia".mysql_error());
						$resventas = 0;
						while ($reg=mysql_fetch_assoc($registro)) {
							$resventas=$resventas+$reg['valor'];
						}

						$registro=mysql_query("SELECT valor FROM gastos WHERE feccre BETWEEN '$rangominimo' AND '$rangomaximo'") or die("Problemas en verificar existencia".mysql_error());
						$resgastos = 0;
						while ($reg=mysql_fetch_assoc($registro)) {
							$resgastos=$resgastos+$reg['valor'];
						}
						echo '{"ventas":"'.$resventas.'","gastos":"'.$resgastos.'"}';
					}
					else {
						echo 'Verifique que las fechas esten correctas';
					}
				}
				else {
					echo 'Verifique los datos';
				}
				break;
			
			default:
				echo 'Verifique los datos';
				break;
		}
	}
	else {
		echo 'Seleccione un opción';
	}
 ?>