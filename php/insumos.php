<?php 
	include("conexion.php");
	if (isset($_POST['insumos_tipo']) && !empty($_POST['insumos_tipo']) &&
		isset($_POST['usuario_activo']) && !empty($_POST['usuario_activo'])) {
		//variables
		$insumos_tipo=$_POST['insumos_tipo'];
		$numide=$_POST['usuario_activo'];
		//conectar
		$conexion = mysql_connect($host,$user,$pw) or die("Problemas al conectar");
		//conectar a la BD
		mysql_select_db($bd, $conexion) or die("Problemas al conectar a la BD");

		//verificar que la identificacion esta registrada
		$registro=mysql_query("SELECT cargo FROM usuarios WHERE numide = '$numide'") or die("Problemas en verificar existencia ".mysql_error());
		//echo $registro;
		if ($reg=mysql_fetch_assoc($registro)) {

			if ($reg['cargo']=="administrador") {
				//verificar que el insumo no exista
				$registro_insumo=mysql_query("SELECT insumo FROM insumos WHERE insumo = '$insumos_tipo'") or die("Problemas en verificar existencia ".mysql_error());
				if ($reg_insumo=mysql_fetch_assoc($registro_insumo)) {
					echo 'Insumo existe';//Usuario no existe
				}
				else {
					//insertar en la BD, CURDATE() = fecha actual
					mysql_query("INSERT INTO insumos (insumo,numide,feccre) values ('$insumos_tipo','$numide',CURDATE())",$conexion) or die("Problemas al insertar".mysql_error());
					echo 'Insumo Guardado';
				}
			}
			else {
				echo 'El usuario no tiene permiso';//Usuario no existe
			}
		}
		else {
			echo 'El usuario no tiene permiso';//Usuario no existe
		}
	}
	else {
		echo 'Problemas al insertar';
	}
 ?>