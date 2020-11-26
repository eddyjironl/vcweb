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

if (isset($_POST["cwhseno"])){
	$lcwhseno = $_POST["cwhseno"];
}
$lnRowsAfect = 0;

// ------------------------------------------------------------------------------------------------
// REFRESH, Recontruyendo segun todos los datos de la tabla.
// ------------------------------------------------------------------------------------------------
if($lcaccion=="REFRESH"){
	get_detalle($oConn,$lcwhseno);
}

// ------------------------------------------------------------------------------------------------
// INSERT / UPDATE, guardando datos existentes o nuevos.
// -----------------------------------------------------------------------------------------------
if($lcaccion=="NEW"){
	$json = $_POST["json"];
	$oAjt = json_decode($json,true);
	//obteniendo el numero de factura.
	$lcadjno  = GetNewDoc("ARADJM");
	$lcwhseno = $oAjt['cwhseno'];
	$lnfactor = 1;
	// Determinando el factor de movimiento en la requisa.
	$lcsql_factor = " select ctypeadj from arcate where ccateno = '". $oAjt['ccateno'] ."' ";
	$lcresult = mysqli_query($oConn,$lcsql_factor);
	$ofactor  = mysqli_fetch_assoc($lcresult);
	if ($ofactor["ctypeadj"] == "S"){
		$lnfactor = -1;
	}
	
	// -------------------------------------------------------------------------------
	// A)- insertando los datos del encabezado del requisa
	// -------------------------------------------------------------------------------
	$lcsql = "insert into aradjm(cadjno, ccateno, crespno, dtrndate,mnotas,cwhseno, ntc, cuserid)
			  values('$lcadjno','" . $oAjt['ccateno'] ."','" .$oAjt['crespno']."','".$oAjt['dtrndate'].
					"','".$oAjt['mnotas']."','".$oAjt['cwhseno']."',".$oAjt['ntc'].",'" . $_SESSION["cuserid"]. "')";
	// -------------------------------------------------------------------------------
    // B)- insertando los detalles
	// -------------------------------------------------------------------------------
	$lnveces = 1;
	$lcsql_d  = "";
	foreach ($oAjt as $a=>$b) {
		if($a == "articulos"){
			$longitud = count($b);
			for($i=0; $i<$longitud; $i++) {
				$lcservno  = $b[$i]["cservno"];
				//$lnpayamt = $b[$i]["ncost"];
				$lcsql_ser = "select cdesc , ncost from arserm where cservno = '". $lcservno ."'";
				$lcresult  = mysqli_query($oConn,$lcsql_ser);
				$ldata     = mysqli_fetch_assoc($lcresult);
				if ($lnveces == 1){
					$lcsql_d = "insert into aradjt(cadjno,cservno,cdesc, ncost,ncostu,nqty,cuserid)
					            values ('$lcadjno','". $b[$i]["cservno"] ."','". $ldata["cdesc"] ."',". $b[$i]["ncost"] .",". $ldata["ncost"] .",$lnfactor * ". $b[$i]["nqty"] .",'".$_SESSION["cuserid"]."')";
					$lnveces = 2;
				}else{
					$lcsql_d = $lcsql_d . " ,('$lcadjno','". $b[$i]["cservno"] ."','". $ldata["cdesc"] ."',". $b[$i]["ncost"] .",". $ldata["ncost"] .",$lnfactor * ". $b[$i]["nqty"] .",'".$_SESSION["cuserid"]."')";
				}
		  		//codigo ejecutado por cada una de las facturas pagadas.
			}	
		}  //if($a == "pagos"){
	}
    // instrucciones para crear el encabezado y detalle del pago.
	mysqli_query($oConn,$lcsql);
	mysqli_query($oConn,$lcsql_d);	
	// Actualizando el saldo de facturas..
	echo $lcadjno;	
}  		//if($lcaccion=="NEW")


function get_detalle($oConn,$pcwhseno){
	// --------------------------------------------------------------------
	// lista de facturas de un cliente.
	// 1 Con Saldo , 2 Estado Activa.
	// --------------------------------------------------------------------
	$lcsql = " select arinvc.cinvno,
						artcas.cdesc,
						arinvc.dend,
						arinvc.nbalance,
						arinvc.crefno
 				from arinvc 
				left outer join artcas on artcas.cpaycode = arinvc.cpaycode
				where arinvc.nbalance > 0 and 
				arinvc.cstatus = 'OP' and 
				arinvc.cwhseno = '$pcwhseno'
			 ";	
	$lcresult  = mysqli_query($oConn,$lcsql);
	echo '<tbody>';
	while($row = mysqli_fetch_assoc($lcresult)){
		echo '<tr>';
		echo '<td class="saytextd"  width="70px">'. $row["cinvno"]   .'</td>';
		echo '<td class="saytextd"  width="200px">'.$row["cdesc"]   .'</td>';
		echo '<td class="saytextd"  width="75px">'. $row["crefno"]   .'</td>';
		echo '<td class="saytextd"  width="75px">'. $row["dend"]     .'</td>';
		echo '<td class="sayamtd"   width="90px">'. $row["nbalance"] .'</td>';
		echo '<td class="sayamtd"   width="70px"> <input type="number" id="saldo" name="saldo" class="textkey"> </td>';
	echo '</tr>';
	}
	echo '</tbody>';
}

//Cerrando la coneccion.
mysqli_close($oConn);
?>
