<?php

include("../modelo/armodule.php");
include("../modelo/vc_funciones.php");
vc_funciones::Star_session();
$oConn = get_coneccion("CIA");
if (isset($_POST["xtrnno"])){
	// CAMPOS 
	$lcinvno  = $_POST["xtrnno"];
	//$lcaccion = isset($_POST["accion"])?$_POST["accion"]:$_GET["accion"];
	$lcaccion = $_POST["accion"];
	// a)- Retorna Precio, Costo y Descripcion. en forma JSON.
	// ------------------------------------------------------------------------------
	if($lcaccion == "LIST"){
		$lcuid    = $_POST["cuid"];
		$lcsql    = "select nprice, nqty, cdesc, ntax, ndesc, mnotas
		              from arinvt_tmp where cuid = '$lcuid'";
		
		$lcresult = mysqli_query($oConn,$lcsql);
		$ldata   = mysqli_fetch_assoc($lcresult);
		// enviando en formato json.	
		$jsondata = json_encode($ldata,true);
		// retornando objeto json
		echo $jsondata;
	}

	// b)-  inserta una linea en el detalle de factura temporal.
	// ------------------------------------------------------------------------------
	if($lcaccion == "INSERT"){
		$lcservno = $_POST["cservno1"];
		$lcsql    = "select nprice,ncost, cdesc, ntax from arserm where cservno = '$lcservno'";
		$lcresult = mysqli_query($oConn,$lcsql);
		$odata    = mysqli_fetch_assoc($lcresult);
		$lnqty    = 1; // $_POST["nqty"];
		$lmnotas  = ""; //$_POST["mnotas"];
		$lcsql    = " insert into arinvt_tmp(cinvno,cservno,cdesc,nqty,nprice,ncost,ntax, mnotas)
    		                          values('$lcinvno','$lcservno','". $odata['cdesc'] ."',". $lnqty .",". $odata['nprice'] .",". $odata['ncost'] .",". $odata['ntax'] .",'$lmnotas')";	
		
		// insertando los datos.
		$lcresult = mysqli_query($oConn,$lcsql);
		// Refrescando el detalle de la factura.
		get_detalle($lcinvno,$oConn);
	}

	// c)-  actualiza un registro segun el ID que se proporciona.
	// ------------------------------------------------------------------------------
	if($lcaccion == "UPDATE"){
		$lcuid   = $_POST["cuid"];		
		$lnqty   = $_POST["nqty"];
		$lnprice = $_POST["nprice"];
		$lntax   = $_POST["ntax"];
		$lndesc  = $_POST["ndesc"];
		$lmnotas = $_POST["mnotas"];
		$lcsql   = " update arinvt_tmp set nqty = $lnqty, nprice = $lnprice, mnotas = '$lmnotas',
					 ntax = $lntax, ndesc = $lndesc where arinvt_tmp.cuid = '$lcuid' ";
		// Ejecutando la instruccion.
		mysqli_query($oConn,$lcsql);
		get_detalle($lcinvno,$oConn);
	}

	// d)-  Elimina una linea.
	// ------------------------------------------------------------------------------
	if($lcaccion == "DELETE"){
		$lcuid = $_POST["cuid"];
		$lcsql = " delete from arinvt_tmp where arinvt_tmp.cuid = $lcuid ";
		// Ejecutando la instruccion.
		mysqli_query($oConn,$lcsql);
		get_detalle($lcinvno,$oConn);
	}
	
	// e)-  Guarda la factura en forma definitiva.
	// ------------------------------------------------------------------------------
	if($lcaccion == "SAVE"){
		
		$lccustno   = $_POST["ccustno"];
		$lcwhseno   = $_POST["cwhseno"];
		$lcpaycode  = $_POST["cpaycode"];
		$lcrespno   = $_POST["crespno"];
		$ldstardate = $_POST["dstardate"];
		$ldenddate  = $_POST["denddate"];
		$lmnotas    = $_POST["mnotas"];
		$lcrefno    = $_POST["crefno"];
		$lcdesc     = $_POST["cdesc"];
		$lntc       = $_POST["ntc"];
		// configuracion de los saldos de factura.
		$lnsalesamt = 0;
		$lntaxamt   = 0;
		$lndesamt   = 0;
		$lnbalance  = 0;
		$lnSaldo    = 0;
		$lnpayamt   = 0;
		$lcNewCashno = 0;
		$lnefectivo = $_POST["efectivo"];
		//obteniendo el numero de factura.
		$lcNewInvno = GetNewDoc("ARINVC");

		// -------------------------------------------------------------------------------------------------------
		// A)- Cargando el detalle de factura.
		// -------------------------------------------------------------------------------------------------------
		$lcsql = " select * from arinvt_tmp where cinvno = '$lcinvno' ";
		$lcresult = mysqli_query($oConn,$lcsql);
		// insertando en detalle definitivo de facturacion.
		while($odata = mysqli_fetch_assoc($lcresult)){
			$lcsql = " insert into arinvt(cinvno,cservno,cdesc,nqty,nprice,ncost,ntax, ndesc, mnotas,cuserid,fecha,hora)
    		          values('$lcNewInvno','". $odata['cservno']."','". $odata['cdesc'] ."',".
					  			$odata['nqty'] .",". $odata['nprice'] .",". $odata['ncost'] .",". $odata['ntax'] .",".$odata['ndesc'] .",'".$odata['mnotas'].
								"','". $_SESSION['cuserid']. "','','')";
			// insertando los datos.
			mysqli_query($oConn,$lcsql);
			// generando saldos a montar 
			$lnsalesamt += $odata['nqty'] * $odata['nprice'] ;
			$lndesamt   += $odata['ndesc'];
			$lntaxamt   += (($odata['nqty'] * $odata['nprice']) -$odata['ndesc']) * ($odata['ntax']/100);
			
		}
		//total monto de la factura.
		$lnbalance = ($lnsalesamt + $lntaxamt) - $lndesamt;


		// -------------------------------------------------------------------------------------------------------
		// B)- Generando registro del pago
		// -------------------------------------------------------------------------------------------------------
		// si registra algun pago genera el registro del escapeshellcmd
		if ($lnefectivo !=""){
			// viene un valor negativo en el pago lo cual no es posible
			if ($lnefectivo < 0){
				return ;
			}
			// paga menos de lo que debe.
			if ($lnbalance >= $lnefectivo){
				$lnpayamt = $lnefectivo;
			}
			// si paga mas de lo que debe
			if ($lnefectivo > $lnbalance){
				$lnpayamt = $lnbalance;
			}
			
			// obteniendo el numero del recibo de caja.
			$lcNewCashno = GetNewDoc("ARCASM");
			// inserta el encabezado del pago.
			$ldpay   = $_POST["dpay"];
			$mnotasr = $_POST["mnotasr"];
			// encabezado del pago.
			$lcsql_h = "insert into arcasm (ccashno, dtrndate, ccustno, mnotas,ntc,namount, cuserid,fecha,hora)
					   values('$lcNewCashno','$ldpay','$lccustno','$mnotasr',$lntc,$lnpayamt,'".$_SESSION['cuserid']."','','')";
			// detalle de facturas que paga en el encabezado del pago 
			$lcsql_d = "insert into arcash (ccashno, cinvno, namount, cuserid,fecha,hora)
					   values('$lcNewCashno','$lcNewInvno', $lnpayamt,'".$_SESSION['cuserid']."','','')";
			// ejecutando las instrucciones de insercion.	
			mysqli_query($oConn,$lcsql_h);
			mysqli_query($oConn,$lcsql_d);
		}  // if ($lnefectivo !=""){
			
		// -------------------------------------------------------------------------------------------------------
		// C)- Cargando el encabezado.
		// -------------------------------------------------------------------------------------------------------
		// saldo de la factura.

		$lnSaldo = $lnbalance - $lnpayamt;
		$lcsql   = "insert into arinvc(cinvno, ccustno, cwhseno, crespno, cpaycode, dstar, dend, mnotas,
                                      nsalesamt, ntaxamt, ndesamt, nbalance,ntc,cdesc, crefno, cuserid, fecha, hora)
							values('$lcNewInvno', '$lccustno', '$lcwhseno', '$lcrespno', '$lcpaycode', '$ldstardate', '$ldenddate', '$lmnotas',
							        $lnsalesamt, $lntaxamt, $lndesamt, $lnSaldo ,$lntc, '$lcdesc','$lcrefno','". $_SESSION['cuserid']. "','','')";
		mysqli_query($oConn,$lcsql);

		// -------------------------------------------------------------------------------------------------------
		// D)- Actualizando saldo de cliente
		// -------------------------------------------------------------------------------------------------------
		// si registra algun pago genera el registro del saldo de factura.
		$lcsql = " update arcust set nbbalance = nbbalance + $lnSaldo, nbsalestot = nbsalestot + $lnbalance where ccustno = '$lccustno' ";
		mysqli_query($oConn,$lcsql);	
		
		// -------------------------------------------------------------------------------------------------------
		// E)- Cerrando las transaciones del temporal 
		// -------------------------------------------------------------------------------------------------------
		$lcsql = " delete from arinvt_tmp where cinvno = '$lcinvno' ";
		mysqli_query($oConn,$lcsql);	
		echo $lcNewInvno;
	}	// if($lcaccion == "SAVE"){
}	// if (isset($_POST["xtrnno"])){								<input type="button" value="Eliminar" onclick="eliminarFila(' + $row["cuid"] + ')" >
// muestra todos los contenidos de la tabla.
function get_detalle($pctrnno,$oConn){
	$lcsql     = " select * from arinvt_tmp where cinvno ='$pctrnno' ";	
	$lcInsert  = "";
	$lcresult  = mysqli_query($oConn,$lcsql);
	echo '<tbody>';
	while($row = mysqli_fetch_assoc($lcresult)){
		echo '<tr class="listados">';
		echo '<td  width="90px">'.  $row["cservno"] .' </td>';
		echo '<td  width="220px">'. $row["cdesc"]   .'</td>';
		echo '<td  width="75px">'.  $row["nprice"]  .' </td>';
		echo '<td  width="75px">'.  $row["nqty"]    .'</td>';
		echo '<td  width="50px">'.  $row["ndesc"]   .'</td>';
		echo '<td  width="50px">'.  $row["ntax"]    .'</td>';
		echo '<td  width="75px">'. ($row["nqty"] * $row["nprice"]) .'</td>';
		echo '<td>';
		echo '	<input type="button" id="btquitar"  value="Eliminar" onclick="eliminarFila('.$row["cuid"].')" >';
		echo '	<input type="button" id="btupdfild" value="Editar"   onclick="editarFila('.$row["cuid"].')" >';
		echo '</td>';
		echo '</tr>';
	}
	echo '</tbody>';
}
// cerrando la coneccion.
mysqli_close($oConn);
?>