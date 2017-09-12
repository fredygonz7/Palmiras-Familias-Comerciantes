<?php 
	include("conexion.php");

	if (isset($_POST['buscar_numide']) && !empty($_POST['buscar_numide'])) {
		//variables
		$numide=$_POST['buscar_numide'];
		//conectar
		$conexion = mysql_connect($host,$user,$pw) or die("Problemas al conectar");
		//conectar a la BD
		mysql_select_db($bd, $conexion) or die("Problemas al conectar a la BD");

		//verificar que la identificacion no este registrada
		$registro=mysql_query("SELECT * FROM usuarios WHERE numide = '$numide'") or die("Problemas en verificar existencia".mysql_error());
		//echo $registro;
		if ($reg=mysql_fetch_assoc($registro)) {
			
			//echo 'Verifique los datos, posiblemente el usuario exista';//Usuario registrado
			//echo 'El usuario '.$reg['numide'].' ya existe';
			echo json_encode($reg);
		}
		else {
			echo 'Empleado no encontrado';
		}
	}
	else {
		echo 'Problemas al buscar';
	}
 ?>