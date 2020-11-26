<?php
include("../modelo/coneccion.php");
include("../modelo/vc_funciones.php");
//--------------------------------------------------------------------------------------------------------------
if (vc_funciones::Star_session() == 1){
	return;
}
$oConn = "";

//echo var_dump($_SESSION);


// creando la tabla temporal 
/*
create_tmp_cursor($oConn);

ckpay($oConn);

show_fields($oConn);


close_conection($oConn);

*/

if (isset($_SESSION["coneccion"])){
	$oConn = $_SESSION["coneccion"];
	echo "definida la coneccion <br>";
}else{
	echo "no esta conectado";
}

if ($_POST["accion"] == "get_conection"){
	if (!empty($_SESSION["coneccion"])){
		echo "esta conectado";
	} else{
	  $_SESSION["coneccion"] = get_coneccion("CIA");	
	   echo "se conecto";
	}
}


echo var_dump($_SESSION);
return ;


if ($_POST["accion"] == "create_tmp_cursor"){
	create_tmp_cursor($oConn);	
}
	
if ($_POST["accion"] == "show_fields"){
	show_fields($oConn);	
}

if ($_POST["accion"] == "ckpay"){
	ckpay($oConn);	
}

if ($_POST["accion"] == "close_conection"){
	close_conection($oConn);	
}


function open_conecct(){
	echo "Coneccion Establecida en el programa";
	return get_coneccion("cia");
}

function show_fields($poConn){
	$lcsql = "select * from eddy ";
	$lcresult = mysqli_query($poConn,$lcsql);
	//$data = mysqli_fetch_assoc($lcresult);
	while ($odata = mysqli_fetch_assoc($lcresult) ){
		echo "<br>";
		echo $odata["ccustno"]  . " " . $odata["cinvno"] . " " . $odata["nbalance"] . " " . $odata["npay"];
	}
}
function create_tmp_cursor($poConn){
	$lcsql = "CREATE TEMPORARY TABLE eddy select ccustno, cinvno , nbalance ,0000000.00 as npay from arinvc ";
	mysqli_query($poConn,$lcsql);
}


function ckpay($poConn){
	$lcsql = "update eddy set npay = 26";
	mysqli_query($poConn,$lcsql);
}

function close_conection($poConn){
	if ($_SESSION["coneccion"] == ""){
		echo "definida la coneccion <br>";
	}else{
		echo "no esta conectado <br>";
	}
	vc_funciones::End_session();
	mysqli_close($poConn);
	
	echo "se serro la coneccion";
	if ($_SESSION["coneccion"] == ""){
		echo "definida la coneccion <br>";
	}else{
		echo "no esta conectado";
	}
}
	
	



?>