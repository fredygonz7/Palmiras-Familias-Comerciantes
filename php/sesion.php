<?php 
	include("conexion.php");

	//conectar
	$conexion = mysql_connect($host,$user,$pw) or die("Problemas al conectar");
	//conectar a la BD
	mysql_select_db($bd, $conexion) or die("Problemas al conectar a la BD");

	if (isset($_POST['usuario']) && !empty($_POST['usuario']) &&isset($_POST['password']) && !empty($_POST['password'])) {
		//variables
		$usuario=$_POST['usuario'];
		$password=$_POST['password'];
		
		//verificar que la identificacion no este registrada
		$registro=mysql_query("SELECT numide,cargo FROM usuarios WHERE numide='$usuario' AND pas='$password'") or die("Problemas en verificar existencia".mysql_error());
		//echo $registro;
		if ($reg=mysql_fetch_assoc($registro)) {
			echo json_encode($reg);
		}
		else {
			echo 'Empleado no encontrado';
		}
	}
	else if (isset($_POST['nombre']) && !empty($_POST['nombre'])){
		$usuario=$_POST['nombre'];
		//verificar que la identificacion no este registrada
		$registro=mysql_query("SELECT numide,cargo FROM usuarios WHERE numide='$usuario'") or die("Problemas en verificar existencia".mysql_error());
		//echo $registro;
		if ($reg=mysql_fetch_assoc($registro)) {
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