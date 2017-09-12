<?php 
	include("conexion.php");

	if (isset($_POST['gestionar_numide']) && !empty($_POST['gestionar_numide'])
		&& isset($_POST['gestionar_nombres']) && !empty($_POST['gestionar_nombres'])
		&& isset($_POST['gestionar_apellidos']) && !empty($_POST['gestionar_apellidos'])
		&& isset($_POST['gestionar_password']) && !empty($_POST['gestionar_password'])) {
		//variables
		$numide=$_POST['gestionar_numide'];
		$nombres=$_POST['gestionar_nombres'];
		$apellidos=$_POST['gestionar_apellidos'];
		$password=$_POST['gestionar_password'];
		//conectar
		$conexion = mysql_connect($host,$user,$pw) or die("Problemas al conectar");
		//conectar a la BD
		mysql_select_db($bd, $conexion) or die("Problemas al conectar a la BD");

		//verificar que la identificacion esta registrada
		$registro=mysql_query("SELECT numide FROM usuarios WHERE numide = '$numide'") or die("Problemas en verificar existencia".mysql_error());
		//echo $registro;
		if ($reg=mysql_fetch_assoc($registro)) {
			echo 'Verifique los datos, posiblemente el usuario exista';//Usuario registrado
			//echo 'El usuario '.$reg['numide'].' ya existe';
		}
		else {
			//insertar en la BD, CURDATE() = fecha actual
			mysql_query("INSERT into usuarios (numide,nom,ape,pas,feccre) values ('$numide','$nombres','$apellidos','$password',CURDATE())",$conexion);
			echo 'Datos insertados';
		}
	}
	else {
		echo 'Problemas al insertar';
	}
 ?>