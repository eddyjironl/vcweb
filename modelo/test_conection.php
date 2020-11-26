<?php
	// incluyendo parametros de coneccion.
	//include("coneccion.php");
	include("coneccion.php");
	echo "Iniciando Verificacion de datos<br>";
	$oConn = get_coneccion("SYS");
	$lcsql = " select * from sysuser ";
	$lcresult = mysqli_query($oConn,$lcsql);
	echo "Lista de usuarios <br>";
	while ($lcrow = mysqli_fetch_assoc($lcresult)){
		echo "Nombre :". $lcrow["cfullname"] . " - Userid:" . $lcrow["cuserid"] . " - clave: " . $lcrow["cpasword"] ."<br>";
	}
	echo "Proceso concluido";
?>