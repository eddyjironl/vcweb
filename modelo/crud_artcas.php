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

if (isset($_POST["cpaycode"])){
	$lcpaycode = $_POST["cpaycode"];
}
$lnRowsAfect = 0;

// ------------------------------------------------------------------------------------------------
// DELETE, Borrando los datos.
// ------------------------------------------------------------------------------------------------
if($lcaccion=="DELETE"){
	//$oConn = get_coneccion("CIA");
	$lcsqlcmd = " delete from artcas where cpaycode = '" . $lcpaycode . "' ";
	$lresultF = mysqli_query($oConn,$lcsqlcmd);	
}

// ------------------------------------------------------------------------------------------------
// INSERT / UPDATE, guardando datos existentes o nuevos.
// -----------------------------------------------------------------------------------------------
if($lcaccion=="NEW"){
	// haciendo la coneccion.
	//$oConn = get_coneccion("CIA");
	if (isset($_POST["cpaycode"])){
		$lcdesc     = $_POST["cdesc"];
		$lndays     = $_POST["nday"];
		$lcstatus   = $_POST["cstatus"];
		$lmnotas    = $_POST["mnotas"];
		$lcctaid1   = $_POST["cctaid1"];
		$lcctaid2   = $_POST["cctaid2"];
		$lcctaid3   = $_POST["cctaid3"];
		$lcctaid4   = $_POST["cctaid4"];
		$lcctaid5   = $_POST["cctaid5"];
		$llvalidcrd = isset($_POST["lvalidcrd"]) ? 1:0; 
		$llqtypay   = isset($_POST["lqtypay"]) ? 1:0; 

		// verificando que el codigo exista o no 
		$lcsql   = " select cpaycode from artcas where cpaycode ='$lcpaycode' ";
		$lresult = mysqli_query($oConn,$lcsql);	
		$lnCount = mysqli_num_rows($lresult);
		if ($lnCount == 0){
			// este codigo de cliente no existe por tanto lo crea	
			// ejecutando el insert para la tabla de clientes.
			$lcsqlcmd = " insert into artcas (cpaycode,cdesc,cstatus,nday,mnotas,cctaid1,cctaid2,cctaid3,cctaid4,cctaid5,lvalidcrd,lqtypay)
							values('$lcpaycode','$lcdesc','$lcstatus',$lndays,'$lmnotas','$lcctaid1','$lcctaid2','$lcctaid3','$lcctaid4','$lcctaid5',$llvalidcrd,$llqtypay)
						";
		}else{
			// el codigo existe lo que hace es actualizarlo.	
			//cfoto = '$lcfoto', este campo no se actualizara en el update tendra que ser mediante otra pantalla
			$lcsqlcmd = " update artcas set cpaycode = '$lcpaycode' ,cdesc = '$lcdesc',cstatus = '$lcstatus',nday = $lndays,mnotas = '$lmnotas',
											cctaid1 = '$lcctaid1',cctaid2 = '$lcctaid2',cctaid3 = '$lcctaid3',cctaid4 = '$lcctaid4',cctaid5 = '$lcctaid5',
											lvalidcrd = $llvalidcrd, lqtypay = $llqtypay where cpaycode = '$lcpaycode' ";
		}
		// ------------------------------------------------------------------------------------------------
		// Generando coneccion y procesando el comando.
		// ------------------------------------------------------------------------------------------------
		$lresultF = mysqli_query($oConn,$lcsqlcmd);	
		//mysqli_query($oConn,$lcsqlcmd);
		$lnRowsAfect = mysqli_affected_rows($oConn);
	}  	// if (isset($_POST["cpaycode"])){
	header("location:../view/artcas.php");		
}  		//if($lcaccion=="NEW")

// ------------------------------------------------------------------------------------------------
// JSON, - Informacion detallada de un solo registro.
// ------------------------------------------------------------------------------------------------
if ($lcaccion == "JSON"){
	if (isset($_POST["cpaycode"])){
 		// Consulta unitaria
		$lcSqlCmd = " select * from artcas where cpaycode ='". $_POST["cpaycode"] ."'";
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
if($lcaccion=="MENU"){
	// el where no siempre viene incluido
	$lcwhere  = "";
	if (!empty($_POST["filtro"])){
		$lcwhere  = " where ". $_POST["orden"]. " like '%". $_POST["filtro"] ."%' ";
	}
	// ordenamiento del reporte siempre debe estar lleno.	
	$lcorder  = " order by ". $_POST["orden"];
	// sentencia sql filtrada.
	$lcsql    = " select * from artcas ". $lcwhere . $lcorder;
	
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
		$ojson = $ojson . $lcSpace .'{"cpaycode":"' .$ldata["cpaycode"] .'","cdesc":"'. $ldata["cdesc"] .'"}';	
	}
	$ojson = $ojson . ']';
	// enviando variable json.
	echo $ojson;		
}
if ($lcaccion == "PANTALLA_MENU"){
	if (isset($_POST["opcion"])){
		echo "<table>
			<tr id='th_menu'>
				<th style='width:100px;'>Codigo</th>
				<th style='width:200px;'>Descripcion</th>
				<th style='width:50px;' >Periodo</th>
				<th style='width:100px;'>Accion</th>
			</tr>	
		</table>";
	}else{
		// Menu completo de lista de clie,$lcSqlCmdn;tes
		$lcSqlCmd = " select * from artcas order by cdesc ";
		$lcResult = mysqli_query($oConn,$lcSqlCmd); 
		// devolvera una tabla
		echo "<table>";
		while ($rows = mysqli_fetch_assoc($lcResult)){
			$lcpaycode   ='"'. $rows["cpaycode"] .'"';
			$lcfullname ='"btcpaycode"';
			$lcnombre   = " '".$rows["cdesc"] ."' ";
			echo	"<tr>".
					"<td style='width:100px;'>". $rows["cpaycode"] ."</td>".
					"<td style='width:200px;'>". $rows["cdesc"]   ."</td>".
					"<td style='width:50px;'>". $rows["nday"]  ."</td>".	
					"<td>".
						"<input type='button' value='Seleccionar' id='btmenu_list' name='btmenu_list' ".
						"title=" . $lcnombre . " onclick='refres_window(btmenu_list[0].id,$lcpaycode,$lcfullname)'>".
					"</td>".
				"</tr>";
		}
		echo '</table>';
	}
}

// LISTA, Genera menu de lista de proveedores.
if ($lcaccion == "LISTA"){
		//$oConn = get_coneccion("CIA");
	    $lcSqlCmd = " select * from artcas order by cdesc ";
		$lcResult = mysqli_query($oConn,$lcSqlCmd);
		echo '<select class="listas" name="cpaycode" id="cpaycode" required>';
		echo '<option value="">Elija un Registro </option>';		
		while ($rows = mysqli_fetch_assoc($lcResult)){
			echo "<option value='" . $rows["cpaycode"] ."'>"  . $rows["cdesc"]  . "</option>";
		}
		echo '</select>';
}

//Cerrando la coneccion.
mysqli_close($oConn);
?>
