<?php 
	include("conexion.php");
	if (isset($_POST['ventas_valor']) && !empty($_POST['ventas_valor']) && 
		isset($_POST['usuario_activo']) && !empty($_POST['usuario_activo'])) {
		//variables
		$valor=$_POST['ventas_valor'];
		$numide=$_POST['usuario_activo'];
		//conectar
		$conexion = mysql_connect($host,$user,$pw) or die("Problemas al conectar");
		//conectar a la BD
		mysql_select_db($bd, $conexion) or die("Problemas al conectar a la BD");

		//verificar que la identificacion esta registrada
		$registro=mysql_query("SELECT numide FROM usuarios WHERE numide = '$numide'") or die("Problemas en verificar existencia".mysql_error());
		//echo $registro;
		if ($reg=mysql_fetch_assoc($registro)) {
			//insertar en la BD, CURDATE() = fecha actual
			//INSERT INTO `ventas` (`id`, `valor`, `numide`, `feccre`) VALUES (NULL, '2000', '1102853723', '2017-09-10');
			mysql_query("INSERT INTO ventas (valor,numide,feccre) values ('$valor','$numide',CURDATE())",$conexion) or die("Problemas al insertar".mysql_error());
			echo 'Venta Guardada';
		}
		else {
			echo 'El usuario no tiene permiso';//Usuario no existe
		}
	}
	else {
		echo 'Problemas al insertar';
	}
 ?>