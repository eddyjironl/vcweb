<?php
// ------------------------------------------------------------------------------------------------
// Descripcion.
// 	Definiendo funciones que se realizaran .
//	$lcaccion = isset($_POST["accion"])? $_POST["accion"],$_GET["accion"];
// ------------------------------------------------------------------------------------------------

include("../modelo/armodule.php");
include("../modelo/vc_funciones.php");
vc_funciones::Star_session();
$oConn = get_coneccion("CIA");


if(isset($_POST["accion"])){
	$lcaccion = $_POST["accion"]; 	
}else{
	$lcaccion = $_GET["accion"]; 	
}

if (isset($_POST["ccateno"])){
	$lccateno = $_POST["ccateno"];
}
$lnRowsAfect = 0;

// ------------------------------------------------------------------------------------------------
// DELETE, Borrando los datos.
// ------------------------------------------------------------------------------------------------
if($lcaccion=="DELETE"){
	//$oConn = get_coneccion("CIA");
	$lcsqlcmd = " delete from arcate where ccateno = '" . $lccateno . "' ";
	$lresultF = mysqli_query($oConn,$lcsqlcmd);	
}

// ------------------------------------------------------------------------------------------------
// INSERT / UPDATE, guardando datos existentes o nuevos.
// -----------------------------------------------------------------------------------------------
if($lcaccion=="NEW"){
	// haciendo la coneccion.
	//$oConn = get_coneccion("CIA");
	if (isset($_POST["ccateno"])){
		$lcdesc     = $_POST["cdesc"];
		$lcstatus   = $_POST["cstatus"];
		$lctypecate = $_POST["ctypecate"];
		$lmnotas    = $_POST["mnotas"];
		$lctypeadj  = $_POST["ctypeadj"];
		$lcctaid    = $_POST["cctaid"];
		$lcctaid_tax= $_POST["cctaid_tax"];
		$llctaresp  = isset($_POST["lctaresp"]) ? 1:0;   
		$llexpcont  = isset($_POST["lexpcont"]) ? 1:0;
		$llupdcost  = isset($_POST["lupdcost"]) ? 1:0; 


		// verificando que el codigo exista o no 
		$lcsql   = " select ccateno from arcate where ccateno = '$lccateno' ";
		$lresult = mysqli_query($oConn,$lcsql);	
		$lnCount = mysqli_num_rows($lresult);
		if ($lnCount == 0){
			// este codigo de cliente no existe por tanto lo crea	
			// ejecutando el insert para la tabla de clientes.
			$lcsqlcmd = " insert into arcate (ccateno,cdesc,cstatus,ctypecate,mnotas,ctypeadj,cctaid,cctaid_tax,lctaresp,lexpcont,lupdcost )
							values('$lccateno','$lcdesc','$lcstatus','$lctypecate','$lmnotas','$lctypeadj','$lcctaid','$lcctaid_tax',$llctaresp,$llexpcont,$llupdcost)";
		}else{
			// el codigo existe lo que hace es actualizarlo.	
			$lcsqlcmd = " update arcate set ctypecate = '$lctypecate', cdesc = '$lcdesc',cstatus = '$lcstatus',mnotas = '$lmnotas',ctypeadj = '$lctypeadj' ,
			              cctaid = '$lcctaid',cctaid_tax = '$lcctaid_tax',lctaresp =$llctaresp ,lexpcont =$llexpcont,lupdcost =$llupdcost
						  where ccateno = '$lccateno' ";
		}
		// ------------------------------------------------------------------------------------------------
		// Generando coneccion y procesando el comando.
		// ------------------------------------------------------------------------------------------------
		$lresultF = mysqli_query($oConn,$lcsqlcmd);	
		//mysqli_query($oConn,$lcsqlcmd);
		$lnRowsAfect = mysqli_affected_rows($oConn);
	}  	// if (isset($_POST["ccateno"])){
	header("location:../view/arcate.php");		
}  		//if($lcaccion=="NEW")

// ------------------------------------------------------------------------------------------------
// JSON, - Informacion detallada de un solo registro.
// ------------------------------------------------------------------------------------------------
if ($lcaccion == "JSON"){
	if (isset($_POST["ccateno"])){
 		// Consulta unitaria
		$lcSqlCmd = " select * from arcate where ccateno ='". $_POST["ccateno"] ."'";
		// obteniendo datos del servidor
		$lcResult = mysqli_query($oConn,$lcSqlCmd);
		// convirtiendo estos datos en un array asociativo
		$ldata = mysqli_fetch_assoc($lcResult);
		// convirtiendo este array en archivo jason.
		$jsondata = json_encode($ldata,true);
		// retornando objeto json
		echo $jsondata;
	}	
}

// menu interactivo
if($lcaccion=="MENU"){
	// el where no siempre viene incluido
	$lcwhere  = "";
	if (!empty($_POST["filtro"])){
		$lcwhere  = " where ". $_POST["orden"]. " like '%". $_POST["filtro"] ."%' ";
	}
	// ordenamiento del reporte siempre debe estar lleno.	
	$lcorder  = " order by ". $_POST["orden"];
	// sentencia sql filtrada.
	$lcsql    = " select * from arcate ". $lcwhere . $lcorder;
	
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
		$ojson = $ojson . $lcSpace .'{"ccateno":"' .$ldata["ccateno"] .'","cdesc":"'. $ldata["cdesc"] .'","ctypecate":"'. $ldata["ctypecate"] .'","ctypeadj":"'. $ldata["ctypeadj"] .'"}';	
	}
	$ojson = $ojson . ']';
	// enviando variable json.
	echo $ojson;		
}

// LISTA, Genera menu de lista de proveedores.
if ($lcaccion == "LISTA"){
		//$oConn = get_coneccion("CIA");
		$lcwhere  = "";
		if(isset($_POST["where"])){
			$lcwhere  = " where cstatus = 'OP' and ctypecate = '". $_POST["where"] ."'";		
		}
	    $lcSqlCmd = " select * from arcate  $lcwhere order by cdesc ";
		$lcResult = mysqli_query($oConn,$lcSqlCmd);
		echo '<select class="listas" name="ccateno" id="ccateno" required>';
		echo '<option value="">Elija un Registro </option>';		
		while ($rows = mysqli_fetch_assoc($lcResult)){
			echo "<option value='" . $rows["ccateno"] ."'>"  . $rows["cdesc"]  . "</option>";
		}
		echo '</select>';
}

//Cerrando la coneccion.
mysqli_close($oConn);
?>
