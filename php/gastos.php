<?php 
	include("conexion.php");
	if (isset($_POST['gastos_valor']) && !empty($_POST['gastos_valor']) && 
		isset($_POST['tipo_insumo']) && !empty($_POST['tipo_insumo'])&& 
		isset($_POST['usuario_activo']) && !empty($_POST['usuario_activo'])) {
		//variables
		$valor=$_POST['gastos_valor'];
		$tipins=$_POST['tipo_insumo'];
		$numide=$_POST['usuario_activo'];
		//conectar
		$conexion = mysql_connect($host,$user,$pw) or die("Problemas al conectar");
		//conectar a la BD
		mysql_select_db($bd, $conexion) or die("Problemas al conectar a la BD");

		//verificar que la identificacion esta registrada
		$registro=mysql_query("SELECT cargo FROM usuarios WHERE numide = '$numide'") or die("Problemas en verificar existencia".mysql_error());
		//echo $registro;
		if ($reg=mysql_fetch_assoc($registro)) {
			//insertar en la BD, CURDATE() = fecha actual
			if ($reg['cargo']=="administrador") {
				mysql_query("INSERT INTO gastos (valor,tipo_insumo,numide,feccre) values ('$valor','$tipins','$numide',CURDATE())",$conexion) or die("Problemas al insertar".mysql_error());
				echo 'Gasto Guardado';
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