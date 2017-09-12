<?php 
	include("conexion.php");
	if (isset($_POST['mostrar_numide']) && !empty($_POST['mostrar_numide'])
		&& isset($_POST['mostrar_nombres']) && !empty($_POST['mostrar_nombres'])
		&& isset($_POST['mostrar_apellidos']) && !empty($_POST['mostrar_apellidos'])
		&& isset($_POST['mostrar_password']) && !empty($_POST['mostrar_password'])) {
		//variables
		$numide=$_POST['mostrar_numide'];
		$nom=$_POST['mostrar_nombres'];
		$ape=$_POST['mostrar_apellidos'];
		$pas=$_POST['mostrar_password'];
		//conectar
		$conexion = mysql_connect($host,$user,$pw) or die("Problemas al conectar");
		//conectar a la BD
		mysql_select_db($bd, $conexion) or die("Problemas al conectar a la BD");

		//verificar que la identificacion no este registrada
		$registro=mysql_query("SELECT numide FROM usuarios WHERE numide = '$numide'",$conexion) or die("Problemas en verificar existencia".mysql_error());

		if ($reg=mysql_fetch_assoc($registro)) {
			mysql_query("UPDATE usuarios set numide = '$numide',nom = '$nom',ape = '$ape',pas = '$pas',feccre=CURDATE() WHERE numide='$reg[numide]'",$conexion) or die("Problemas al modifcar".mysql_error());
			echo "El empleado ".$reg['numide']." fue modificado";
		}
		else {
			echo 'Empleado no encontrado';
		}
	}
	else {
		echo 'Problemas al modificar';
	}
 ?>