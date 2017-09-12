<?php 
	include("conexion.php");

	//conectar
	$conexion = mysql_connect($host,$user,$pw) or die("Problemas al conectar");
	//conectar a la BD
	mysql_select_db($bd, $conexion) or die("Problemas al conectar a la BD");

	//verificar que la identificacion no este registrada
	$registro=mysql_query("SELECT insumo FROM insumos") or die("Problemas en verificar existencia".mysql_error());
	//echo $registro;
	$i = 0;
	$vector = array();
	while ($reg=mysql_fetch_assoc($registro)) {
	// 	//se obtienen los insumos y se codifican como json
	// 	echo json_encode($reg);
		$vector[$i]=json_encode($reg);
	 	$i++;
	}
	$json="";
	for ($i = 0; $i < count($vector); $i++) {
		$json = $json.$vector[$i];
		if ($i < count($vector)-1) {
			$json = $json.",";
		}
	}
	$json="[".$json."]";
	echo $json;

	if ($reg=mysql_fetch_assoc($registro)) {
		echo 'Problemas con los tipos de insumos';
	}
 ?>