<?php
/*
----------------------------------------------------------------------------------
INFORMACION GENERAL.
---------------------
hecho: Eddy Jiron guillen
fecha: 22/07/2020 9:40 am

DESCRIPCION.
---------------------
Este programa engloba las funciones propias del sistema de administracion.
----------------------------------------------------------------------------------
*/
include("coneccion.php");
include("../modelo/vc_funciones.php");
//--------------------------------------------------------------------------------------------------------------
if (vc_funciones::Star_session() == 1){
	return;
}
// VERFICANDO PARAMETRO
if (!isset($_POST["program"])){
	return ;
}
// estableciendo coneccion.
$oConn = get_coneccion("SYS");
// Verificando si un usuario tiene derecho de acceso o no.
if ($_POST["program"]== "permiso_de_acceso"){
	$lcmenuid = $_POST["cmenuid"];
	$lcuserid = $_SESSION["cuserid"];
	$lcCompId = $_SESSION["ccompid"];
	// buscando informacion del usuario actual
	$lcsql_1  = " select * from sysuser where cuserid = '$lcuserid' ";

	$otabla   = mysqli_query($oConn,$lcsql_1);
	$opersona = mysqli_fetch_assoc($otabla); 
	// grupo al que pertenece este usuario.
	$lcgrpid  = $opersona["cgrpid"]; 
	// buscando informacion de los permisos de esa persona.
	$lcsql_2  = " select allow from syperm 
				  where cgrpid = '$lcgrpid'  and
					    ccompid = '$lcCompId' and 
						cmenuid = '$lcmenuid' ";
	
	$otabla   = mysqli_query($oConn,$lcsql_2);
	$opermiso = mysqli_fetch_assoc($otabla); 
	echo $opermiso["allow"];
}

if ($_POST["program"]== "entry_cia_work"){
	$lccompid = $_POST["ccompid"];
	// ubicando datos de la compañia
	$lcsql  = "select * from syscomp where ccompid = '$lccompid' ";
	$otabla = mysqli_query($oConn,$lcsql);
	// si algo viene mal no deja actualizar la session y no ejecutara nada.
	if (mysqli_num_rows($otabla) == 0){
		$oCia = '{"compdesc":""}';
		echo $oCia; 
	}else{
		$oCia = mysqli_fetch_assoc($otabla); 
		// actualizando la session de datos.
		$_SESSION["ccompid"]  = $oCia["ccompid"];
		$_SESSION["compdesc"] = $oCia["compdesc"];
		
		// Parametros de coneccion a la base de datos.
		$_SESSION["cuserid_db"] = $oCia["cuserid"];
		$_SESSION["cpasword"]   = $oCia["cpasword"];
		$_SESSION["dbname"]     = $oCia["dbname"];
		$_SESSION["chost"]      = $oCia["chost"];
		echo json_encode($oCia); 
	}

}

?>