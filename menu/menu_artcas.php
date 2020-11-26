<?php
	// incluyendo la clase de coneccion
	include("../modelo/coneccion.php");
  // creando la coneccion.
	$oConn = get_coneccion("CIA");

	if (isset($_POST["cpaycode"])){
 		// Consulta unitaria
		$lcSqlCmd = " select * from artcas where artcas.cpaycode ='". $_POST["cpaycode"] ."'";
								
		// obteniendo datos del servidor
		//$lcResult = $oConn->query($lcSqlCmd);
		$lcResult =   mysqli_query($oConn,$lcSqlCmd); // $oConn->query($lcSqlCmd);
		// convirtiendo estos datos en un array asociativo
		$ldata = mysqli_fetch_assoc($lcResult);
		// convirtiendo este array en archivo jason.
		$jsondata =json_encode($ldata,true);
		// retornando objeto json
		echo $jsondata;

	}else{
		$lcSqlCmd = " select * from artcas order by cpaycode ";

		$lcResult = $oConn->query($lcSqlCmd);

		echo '<select class="listas" name="cpaycode" id="cpaycode" required>';
		echo '<option value="">Elija un Registro </option>';		
		
		while ($rows = mysqli_fetch_assoc($lcResult)){
			echo "<option value='" . $rows["cpaycode"] ."'>"  . $rows["cdesc"]  . "</option>";
		}
		echo '</select>';
	}
	
	
	
?>