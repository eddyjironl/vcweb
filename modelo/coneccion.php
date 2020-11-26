<?php
	// procedimientos de la clase.
function get_coneccion($opc){
	include("parameters_conection.php");
	$lcDbb = "";
	if($opc == 'SYS'){
		$lcDbb=$oPSys;
	}else{
		$lcDbb=$oPCia;
	}
	
	$oConn = mysqli_connect($gHostId,$gUserId,$gPasWord,$lcDbb);
	//if($this->oConn->errno){
	if(!mysqli_connect_errno($oConn)){
		mysqli_set_charset($oConn,"utf8");
	}else{
		echo "Coneccion NO Establecida.";
	}
	return $oConn;
}
?>