<?php
	// incluyendo la clase de coneccion
	include("../modelo/coneccion.php");
  	// creando la coneccion.
	$oConn = get_coneccion("CIA");
 	// Consulta unitaria
	$lcSqlCmd = " select * from arsetup ";
								
	// obteniendo datos del servidor
	$lcResult = mysqli_query($oConn,$lcSqlCmd); // $oConn->query($lcSqlCmd);
	// convirtiendo estos datos en un array asociativo
	$ldata = mysqli_fetch_assoc($lcResult);
	// convirtiendo este array en archivo jason.
	$jsondata = json_encode($ldata,true);
	// retornando objeto json
	echo $jsondata;

?>