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

if (isset($_POST["ccustno"])){
	$lccustno = $_POST["ccustno"];
}
$lnRowsAfect = 0;

// ------------------------------------------------------------------------------------------------
// REFRESH, Recontruyendo segun todos los datos de la tabla.
// ------------------------------------------------------------------------------------------------
if($lcaccion=="REFRESH"){
	get_detalle($oConn,$lccustno);
}

if($lcaccion=="PAY_TO_INVOICE"){
	
	$lcinvno = $_POST["cinvno"];
	$lcsql   = " select arcash.ccashno,arcasm.ctrnno,
						arcash.namount,
						arcasm.dtrndate,
						arcasm.ctypedoc,arcasm.ctype,
						arcasm.cdesc, 
						arcasm.crefno
				from arcash
				left outer join arcasm on arcasm.ccashno = arcash.ccashno 
				where arcash.cinvno = '$lcinvno' and arcasm.cstatus = 'OP'
			
			";
	$lcresult = mysqli_query($oConn,$lcsql);
	echo '<tbody>';
	while($row = mysqli_fetch_assoc($lcresult)){
		echo '<tr class="listados">';
		echo '<td  width="70px">' . $row["ccashno"]   .'</td>';
		echo '<td  width="70px">' . $row["crefno"]    .'</td>';
		echo '<td  width="70px">' . $row["dtrndate"]   .'</td>';
		echo '<td  width="150px">'. $row["cdesc"] .'</td>';
		echo '<td  width="70px">' . $row["ctrnno"] .'</td>';
		echo '<td class="sayamtd"   width="70px">' . $row["namount"]  .'</td>';
	echo '</tr>';
	}
	echo '</tbody>';
}

// ------------------------------------------------------------------------------------------------
// INSERT / UPDATE, guardando datos existentes o nuevos.
// -----------------------------------------------------------------------------------------------
if($lcaccion=="NEW"){
	$json = $_POST["json"];
	$oPay = json_decode($json,true);
	//obteniendo el numero de factura.
	$lccashno = GetNewDoc("ARCASM");
	$lccustno = $oPay['ccustno'];
	$lcdesc   = $oPay['cdesc'];
	$lcrefno  = $oPay['crefno'];
	
	// -------------------------------------------------------------------------------
	// A)- insertando los datos del encabezado del pago
	// -------------------------------------------------------------------------------
	$lcsql = "insert into arcasm(ccashno,crefno,cdesc, ccustno, ctype, dtrndate,mnotas,namount,ctypedoc, ntc, fecha)
			values('$lccashno','$lcrefno','$lcdesc','" . $oPay['ccustno'] ."','" .$oPay['ctype']."','".$oPay['dtrndate']."','".$oPay['mnotas']."',".$oPay['npayamt'].",'".$oPay['ctypedoc']."',33,'BUU')";

	// -------------------------------------------------------------------------------
    // B)- insertando los detalles
	// -------------------------------------------------------------------------------
	$lnveces = 1;
	$lcsql_d  = "";
	foreach ($oPay as $a=>$b) {
		if($a == "pagos"){
			$longitud = count($b);
			for($i=0; $i<$longitud; $i++) {
				$lcinvno  = $b[$i]["cinvno"];
				$lnpayamt = $b[$i]["npay"];
				
				if ($lnveces == 1){
					$lcsql_d = "insert into arcash(ccashno,cinvno, namount)
					            values ('$lccashno','". $b[$i]["cinvno"] ."',". $b[$i]["npay"] .")";
					$lcupd   = " update arinvc set nbalance = nbalance - $lnpayamt where cinvno = '$lcinvno' ";
					$lnveces = 2;
				}else{
					$lcupd   = $lcupd ."; update arinvc set nbalance = nbalance - $lnpayamt where cinvno = '$lcinvno' ";
					$lcsql_d = $lcsql_d . " ,('$lccashno','". $b[$i]["cinvno"] ."',". $b[$i]["npay"] .")";
				}
		  		//codigo ejecutado por cada una de las facturas pagadas.
			}	
		}  //if($a == "pagos"){
	}
    // instrucciones para crear el encabezado y detalle del pago.

	// -------------------------------------------------------------------------------
	// C)- actualizando saldo de facturas y clientes.
	// -------------------------------------------------------------------------------
	// Actualizando el saldo de clientes.
	$lnpayamt = $oPay['npayamt'];
	$lntc     = $oPay['npayamt'] / $oPay['ntc'];
	$lcsql_c  = " update arcust set nbbalance = nbbalance - $lnpayamt,  nebalance = nebalance - ($lnpayamt / $lntc)
	              where ccustno = '$lccustno'";
	// comando general para actualizar
	//$lcsql = $lcsql . "; " . $lcsql_d ."; ".$lcupd ."; ".$lcsql_c;
	
		
	mysqli_query($oConn,$lcsql);
	mysqli_query($oConn,$lcsql_d);	
	mysqli_query($oConn,$lcsql_c);	
	mysqli_multi_query($oConn,$lcupd);
	// Actualizando el saldo de facturas..
	header("location:../view/arcash.php");		
}  		//if($lcaccion=="NEW")


function get_detalle($oConn,$pccustno){
    $lcsql = " select arinvc.cinvno,
						artcas.cdesc,
						arinvc.dend,
						arinvc.nbalance,
						arinvc.crefno
 				from arinvc 
				left outer join artcas on artcas.cpaycode = arinvc.cpaycode
				where arinvc.nbalance > 0 and 
				arinvc.cstatus = 'OP' and 
				arinvc.ccustno = '$pccustno'
			 ";	
	$lcresult  = mysqli_query($oConn,$lcsql);
	echo '<tbody>';
	while($row = mysqli_fetch_assoc($lcresult)){
		echo '<tr class="listados">';
		echo '	<td width="70px">'. $row["cinvno"]   .'</td>';
		echo '	<td width="200px">'.$row["cdesc"]   .'</td>';
		echo '	<td width="75px">'. $row["crefno"]   .'</td>';
		echo '	<td width="75px">'. $row["dend"]     .'</td>';
		echo '	<td width="90px">'. $row["nbalance"] .'</td>';
		echo '<td width="70px"> <input type="number" id="saldo" name="saldo" class="textkey"> </td>';
	echo '</tr>';
	}
	echo '</tbody>';
}

//Cerrando la coneccion.
mysqli_close($oConn);
?>
