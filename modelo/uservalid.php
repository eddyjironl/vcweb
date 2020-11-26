<?php
	// VALIDACIONES PREVIAS CAMPOS VACIOS 
	if (empty($_POST["cuserid"])){
		// iniciando session
		session_start();
		// cerrando sesion.
		session_destroy();
		header("location:../index.php?opcmsj=2");
		RETURN ;
	}
	if (empty($_POST["cpasword"])){
		// iniciando session
		session_start();
		// cerrando sesion.
		session_destroy();
		header("location:../index.php?opcmsj=3");
		RETURN ;
	}
	include("coneccion.php");
	$oConn      = get_coneccion("SYS");
	$lcUserID 	= $_POST["cuserid"];
	$lcPasword 	= $_POST["cpasword"];
	$lcSqlCmd 	= "select * from sysuser where cuserid = '" . strtoupper($_POST["cuserid"]). 
				  "' and cpasword = '" . strtoupper($_POST["cpasword"]) ."'";
	$lcResult 	= mysqli_query($oConn,$lcSqlCmd); //$oConn->query($lcSqlCmd);
	$lnRecno 	= mysqli_num_rows($lcResult); //$lcResult->num_rows;
	echo $lcSqlCmd;
	if($lnRecno == 0){
		// iniciando session
		session_start();
		// cerrando sesion.
		session_destroy();
		header("location:../index.php?opcmsj=1");
	}else{
		session_start();
		$lcLine = mysqli_fetch_assoc($lcResult);
		$_SESSION["cuserid"]   = $_POST["cuserid"];
		$_SESSION["cpasword"]  = $_POST["cpasword"]; 
		$_SESSION["ccompid"]   = ""; 
		$_SESSION["compdesc"]   = ""; 
		$_SESSION["cfullname"] = $lcLine["cfullname"]; 
		$_SESSION["cinvno"]    = "";
		header("location:../view/escritorio.php");	
		//include("../view/escritorio.php");
	}
	//}	
?>