<?php 
	include("conexion.php");

	if (isset($_POST['mostrar_numide']) && !empty($_POST['mostrar_numide'])) {
		//variables
		$numide=$_POST['mostrar_numide'];
		//conectar
		$conexion = mysql_connect($host,$user,$pw) or die("Problemas al conectar");
		//conectar a la BD
		mysql_select_db($bd, $conexion) or die("Problemas al conectar a la BD");

		//verificar que la identificacion no este registrada
		$registro=mysql_query("SELECT numide FROM usuarios WHERE numide = '$numide'",$conexion) or die("Problemas en verificar existencia".mysql_error());
		//echo $registro;
		if ($reg=mysql_fetch_assoc($registro)) {
			mysql_query("DELETE FROM usuarios WHERE numide = '$numide'",$conexion) or die("Problemas al eliminar".mysql_error());
			echo "El empleado ".$reg['numide']." fue eliminado";
		}
		else {
			echo 'Empleado no encontrado';
		}
	}
	else {
		echo 'Problemas al elminar';
	}
 ?>