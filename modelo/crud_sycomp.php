<?php
// ------------------------------------------------------------------------------------------------
// Descripcion.
// 	Definiendo funciones que se realizaran .
//	$lcaccion = isset($_POST["accion"])? $_POST["accion"],$_GET["accion"];
// ------------------------------------------------------------------------------------------------
include("../modelo/vc_funciones.php");
include("../modelo/coneccion.php");

vc_funciones::Star_session();
$oConn = get_coneccion("SYS");

if(isset($_POST["accion"])){
	$lcaccion = $_POST["accion"]; 	
}else{
	$lcaccion = $_GET["accion"];
}

if($lcaccion=="JSON"){
	// codigo del grupo 
	$lccompid = $_POST["ccompid"];
	$lcSqlCmd = " select * from syscomp where ccompid = '$lccompid' ";
	// obteniendo datos del servidor
	$lcResult = mysqli_query($oConn,$lcSqlCmd);
	// convirtiendo estos datos en un array asociativo
	$ldata = mysqli_fetch_assoc($lcResult);
	// convirtiendo este array en archivo jason.
	$jsondata = json_encode($ldata,true);
	// retornando objeto json
	echo $jsondata;
}

if($lcaccion=="MENU"){
	// el where no siempre viene incluido
	$lcwhere  = "";
	if (!empty($_POST["filtro"])){
		$lcwhere  = " where ". $_POST["orden"]. " like '%". $_POST["filtro"] ."%' ";
	}
	// ordenamiento del reporte siempre debe estar lleno.	
	$lcorder  = " order by ". $_POST["orden"];
	// sentencia sql filtrada.
	$lcsql    = " select * from syscomp ". $lcwhere . $lcorder;
	//echo $lcsql;
	//return ;
	$lcresult = mysqli_query($oConn,$lcsql);
	$ojson    = '[';
	$lnveces  = 1;
	$lcSpace  = "";
	while ($ldata = mysqli_fetch_assoc($lcresult)){
		if ($lnveces == 1){
			$lnveces = 2;
		}else{
			$lcSpace = ",";			
		}
		$ojson = $ojson . $lcSpace .'{"ccompid":"' .$ldata["ccompid"] .'","compdesc":"'. $ldata["compdesc"] .'"}';	
	}
	$ojson = $ojson . ']';
	// enviando variable json.
	echo $ojson;		
}

if($lcaccion=="NEW"){
	$lccompid  = $_POST["ccompid"];
	$lcompdesc = $_POST["compdesc"];
	$lcstatus  = $_POST["cstatus"];
	$lctel     = $_POST["ctel"];
	$lcfax     = $_POST["cfax"];
	$lmdirecc  = $_POST["mdirecc"];
	$lcciudad  = $_POST["cciudad"];
	$lcpais    = $_POST["cpais"];
	$lnanofisc = $_POST["nanofisc"];
	$lcuserid  = $_POST["cuserid"];
	$lcpasword = $_POST["cpasword"];
	$lchost    = $_POST["chost"];
	$ldbname   = $_POST["dbname"];
	$lunicontdat =($_POST["lunicontdat"] == "true" )? 1:0; 

	if(!empty($_POST["cfoto"])){
		$lcfoto  = ',cfoto = "../photos/' . $_POST["cfoto"]. '"'; 	
		$lcfotoI = '../photos/' . $_POST["cfoto"]; 	
	}else{
		$lcfoto  = "";
		$lcfotoI = "";
	}	
	// verificando si existe o no .
	$lcsql_1 = " select ccompid from syscomp where ccompid = '$lccompid' ";
	//echo $lcsql_1;
	//return;
	$lodata  = mysqli_query($oConn,$lcsql_1);
	$llupd   = mysqli_num_rows($lodata);
	// desidiendo que se hara con el codigo, si crea un regisrto nuevo o actualiza el existente.	
	if ($llupd == 0){
		$lcsql = " insert into syscomp(ccompid,compdesc,cstatus,ctel,cfax,cciudad,cpais,mdirecc,
		                               nanofisc,cuserid,cpasword,chost,dbname,lunicontdat,cfoto) 
							   values('$lccompid','$lcompdesc','$lcstatus','$lctel' ,'$lcfax' ,'$lcciudad','$lcpais','$lmdirecc',
							   			$lnanofisc,'$lcuserid','$lcpasword','$lchost','$ldbname',$lunicontdat,'$lcfotoI') ";
	}else{
		$lcsql = " update syscomp set ccompid = '$lccompid',compdesc = '$lcompdesc',cstatus = '$lcstatus',ctel = '$lctel',
									   cfax = '$lcfax' ,cciudad = '$lcciudad',cpais = '$lcpais',mdirecc = '$lmdirecc',
									    nanofisc = $lnanofisc,cuserid = '$lcuserid',cpasword = '$lcpasword' ,chost = '$lchost' ,dbname = '$ldbname',lunicontdat = $lunicontdat $lcfoto										 
					where ccompid = '$lccompid' ";
	}
	
	// actualizando la base de datos.
	$lresult = mysqli_query($oConn,$lcsql);
}

?>
