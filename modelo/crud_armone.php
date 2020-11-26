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

if (isset($_POST["dtrndate"])){
	$ldtrndate = $_POST["dtrndate"];
}
$lnRowsAfect = 0;

// ------------------------------------------------------------------------------------------------
// REFRESH, Recontruyendo segun todos los datos de la tabla.
// ------------------------------------------------------------------------------------------------
if($lcaccion=="REFRESH"){
	get_detalle($oConn);
}

// ------------------------------------------------------------------------------------------------
// DELETE, Borrando los datos.
// ------------------------------------------------------------------------------------------------
if($lcaccion=="DELETE"){
	$lcuid = $_POST["cuid"];
	$lcsqlcmd = " delete from armone where cuid = '" . $lcuid . "' ";
	$lresultF = mysqli_query($oConn,$lcsqlcmd);	
}
// ------------------------------------------------------------------------------------------------
// INSERT / UPDATE, guardando datos existentes o nuevos.
// -----------------------------------------------------------------------------------------------
if($lcaccion=="NEW"){
	if (isset($_POST["dtrndate"])){
		$lntc = $_POST["ntc"];
		// verificando que el codigo exista o no 
		$lcsql   = " select dtrndate from armone where dtrndate ='$ldtrndate' ";
		$lresult = mysqli_query($oConn,$lcsql);	
		$lnCount = mysqli_num_rows($lresult);
		if ($lnCount == 0){
			// ejecutando el insert para la tabla de clientes.
			$lcsqlcmd = " insert into armone (dtrndate,ntc) values('$ldtrndate',$lntc) ";
		}else{
			// el codigo existe lo que hace es actualizarlo.	
			$lcsqlcmd = " update armone set ntc = $lntc where dtrndate = '$ldtrndate' ";
		}
		// ------------------------------------------------------------------------------------------------
		// Generando coneccion y procesando el comando.
		// ------------------------------------------------------------------------------------------------
		$lresultF = mysqli_query($oConn,$lcsqlcmd);	
		//mysqli_query($oConn,$lcsqlcmd);
		$lnRowsAfect = mysqli_affected_rows($oConn);
	}  	// if (isset($_POST["dtrndate"])){
	header("location:../view/armone.php");		
}  		//if($lcaccion=="NEW")

function get_detalle($oConn){
	$lcsql     = " select * from armone order by dtrndate desc  ";	
					
	$lcresult  = mysqli_query($oConn,$lcsql);
	echo '<tbody>';
	while($row = mysqli_fetch_assoc($lcresult)){
		echo '<tr>';
		echo '<td class="saytextd"  width="100px">'. $row["dtrndate"] .' </td>';
		echo '<td class="sayamtd" width="70px">'. $row["ntc"]      .'</td>';
		echo '<td>';
		echo '	<input type="button" id="btquitar"  value="Eliminar" onclick="eliminarFila('.$row["cuid"].')" >';
		echo '</td>';
		echo '</tr>';
	}
	echo '</tbody>';
}

//Cerrando la coneccion.
mysqli_close($oConn);
?>
