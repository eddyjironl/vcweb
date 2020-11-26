<?php
// ------------------------------------------------------------------------------------------------
// Descripcion.
// 	Definiendo funciones que se realizaran .
//	$lcAccion = isset($_POST["accion"])? $_POST["accion"],$_GET["accion"];
// ------------------------------------------------------------------------------------------------

include("../modelo/armodule.php");
include("../modelo/vc_funciones.php");
vc_funciones::Star_session();
$oConn = get_coneccion("CIA");

if(isset($_POST["accion"])){
	$lcAccion=$_POST["accion"]; 	
}else{
	$lcAccion=$_GET["accion"]; 	
}
if (isset($_POST["crespno"])){
	$lcrespno    = $_POST["crespno"];
}
$lnRowsAfect = 0;
 
// ------------------------------------------------------------------------------------------------
// DELETE, Borrando los datos.
// ------------------------------------------------------------------------------------------------
if($lcAccion=="DELETE"){
	$oConn = get_coneccion("CIA");
	$lcsqlcmd = " delete from arresp where crespno = '" . $lcrespno . "' ";
	$lresultF = mysqli_query($oConn,$lcsqlcmd);	
}

// ------------------------------------------------------------------------------------------------
// INSERT / UPDATE, guardando datos existentes o nuevos.
// ------------------------------------------------------------------------------------------------
if($lcAccion=="NEW"){
	// haciendo la coneccion.
	$oConn = get_coneccion("CIA");
	if (isset($_POST["crespno"])){
		$lcfullname = $_POST["cfullname"];
		$lcruc      = $_POST["cruc"];
		$lmtel      = $_POST["mtel"];
		$lcstatus   = $_POST["cstatus"];
		$lcctaid    = $_POST["cctaid"];
		$lmdirecc   = $_POST["mdirecc"];
		$lmnotas    = $_POST["mnotas"];
		//$lndays    	 = isset($_POST["ndays"]) ? $_POST["ndays"]:0;
		$lndays    	 = empty($_POST["ndays"])?0:$_POST["ndays"];
		
		$lllunes     = isset($_POST["llunes"]) ? 1:0; //$_POST["llunes"];
		$llmartes    = isset($_POST["lmartes"]) ? 1:0; //$_POST["lmartes"];
		$llmiercoles = isset($_POST["lmiercoles"]) ? 1:0; //$_POST["lmiercoles"];
		$lljueves    = isset($_POST["ljueves"]) ? 1:0; //$_POST["ljueves"];
		$llviernes   = isset($_POST["lviernes"]) ? 1:0; //$_POST["lviernes"];
		$llsabado    = isset($_POST["lsabado"]) ? 1:0; //$_POST["lsabado"];
		$lldomingo   = isset($_POST["ldomingo"]) ? 1:0; //$_POST["ldomingo"];
		
		if(!empty($_POST["cfoto"])){
			$lcfoto  = 'cfoto = "../photos/otras/' . $_POST["cfoto"]. '",'; 	
			$lcfotoI = '../photos/otras/' . $_POST["cfoto"]; 	
		}else{
			$lcfoto  = "";
			$lcfotoI = "";
		}		
		
		// verificando que el codigo exista o no 
		$lcsql   = " select crespno from arresp where crespno ='$lcrespno' ";
		$lresult = mysqli_query($oConn,$lcsql);	
		$lnCount = mysqli_num_rows($lresult);
		if ($lnCount == 0){
			// este codigo de cliente no existe por tanto lo crea	
			// ejecutando el insert para la tabla de clientes.
			$lcsqlcmd = " insert into arresp (crespno,cfullname,cstatus,cctaid,cruc, mtels,mdirecc,mnotas,cfoto,
												llunes,lmartes,lmiercoles,ljueves,lviernes,lsabado,ldomingo,ndays)
		                   values('$lcrespno','$lcfullname','$lcstatus','$lcctaid','$lcruc','$lmtel','$lmdirecc','$lmnotas','$lcfotoI',
						          $lllunes,$llmartes,$llmiercoles,$lljueves,$llviernes,$llsabado,$lldomingo,$lndays)";
		}else{
			// el codigo existe lo que hace es actualizarlo.	
			//cfoto = '$lcfoto', este campo no se actualizara en el update tendra que ser mediante otra pantalla
			
			$lcsqlcmd = " update arresp set cfullname = '$lcfullname', cstatus = '$lcstatus', cctaid = '$lcctaid',
							cruc = '$lcruc' , mtels = '$lmtel', mdirecc = '$lmdirecc', mnotas = '$lmnotas', $lcfoto
							llunes = $lllunes, lmartes = $llmartes, lmiercoles = $llmiercoles, ljueves = $lljueves, lviernes = $llviernes,
							lsabado = $llsabado, ldomingo = $lldomingo, ndays = $lndays
							where crespno = '$lcrespno' ";
		}
		
		// ------------------------------------------------------------------------------------------------
		// Generando coneccion y procesando el comando.
		// ------------------------------------------------------------------------------------------------
		$lresultF = mysqli_query($oConn,$lcsqlcmd);	
		//mysqli_query($oConn,$lcsqlcmd);
		$lnRowsAfect = mysqli_affected_rows($oConn);
	}  	// if (isset($_POST["crespno"])){
	header("location:../view/arresp.php");		
}  		//if($lcAccion=="NEW")
// ------------------------------------------------------------------------------------------------
// JSON, - Informacion detallada de un solo registro.
// ------------------------------------------------------------------------------------------------
if ($lcAccion == "JSON"){
	if (isset($_POST["crespno"])){
	//	$oConn = get_coneccion("CIA");
 		// Consulta unitaria
		//$lcSqlCmd = " select * from arresp where arresp.crespno ='". $_POST["crespno"] ."'";
		$lcSqlCmd = " select * from arresp 
					where arresp.crespno ='". $_POST["crespno"] ."'";
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


if($lcAccion=="MENU"){
	// el where no siempre viene incluido
	$lcwhere  = "";
	if (!empty($_POST["filtro"])){
		$lcwhere  = " where ". $_POST["orden"]. " like '%". $_POST["filtro"] ."%' ";
	}
	// ordenamiento del reporte siempre debe estar lleno.	
	$lcorder  = " order by ". $_POST["orden"];
	// sentencia sql filtrada.
	$lcsql    = " select * from arresp ". $lcwhere . $lcorder;
	
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
		$ojson = $ojson . $lcSpace .'{"crespno":"' .$ldata["crespno"] .'","cfullname":"'. $ldata["cfullname"] .'","mtels":"'. $ldata["mtels"] .'"}';	
	}
	$ojson = $ojson . ']';
	// enviando variable json.
	echo $ojson;		
}

if ($lcAccion == "PANTALLA_MENU"){
	if (isset($_POST["opcion"])){
		echo "<table>
			<tr id='th_menu'>
				<th style='width:70px;'>Codigo</th>
				<th style='width:200px;'>Nombre Completo</th>
				<th style='width:70px;'>Telefono</th>
				<th style='width:100px;'>Accion</th>
			</tr>	
		</table>";
	}else{
		// Menu completo de lista de clie,$lcSqlCmdn;tes
		$lcSqlCmd = " select crespno , cfullname , mtels from arresp order by crespno ";
		$lcResult = mysqli_query($oConn,$lcSqlCmd); 
		// devolvera una tabla
		echo "<table>";
		while ($rows = mysqli_fetch_assoc($lcResult)){
			$lcrespno   ='"'. $rows["crespno"] .'"';
			$lcfullname ='"btcrespno"';
			$lcnombre   = " '".$rows["cfullname"] ."' ";
			echo	"<tr>".
					"<td style='width:70px;'>". $rows["crespno"] ."</td>".
					"<td style='width:200px;'>". $rows["cfullname"]   ."</td>".
					"<td style='width:70px;'>". $rows["mtels"]  ."</td>".	
					"<td>".
						"<input type='button' value='Seleccionar' id='btmenu_list' name='btmenu_list' ".
						"title=" . $lcnombre . " onclick='refres_window(btmenu_list[0].id,$lcrespno,$lcfullname)'>".
					"</td>".
				"</tr>";
		}
		echo '</table>';
	}
}
// LISTA, Genera menu de lista de proveedores.
if ($lcAccion == "LISTA"){
		//$oConn = get_coneccion("CIA");
	    $lcSqlCmd = " select * from arresp order by crespno ";
		$lcResult = mysqli_query($oConn,$lcSqlCmd);
		echo '<select class="listas" name="crespno" id="crespno" required>';
		echo '<option value="">Elija un Registro </option>';		
		while ($rows = mysqli_fetch_assoc($lcResult)){
			echo "<option value='" . $rows["crespno"] ."'>"  . $rows["cfullname"]  . "</option>";
		}
		echo '</select>';
}

//Cerrando la coneccion.
mysqli_close($oConn);


?>
