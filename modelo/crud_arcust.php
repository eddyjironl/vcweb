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
if (isset($_POST["ccustno"])){
	$lccustno = $_POST["ccustno"];	
}	

// ------------------------------------------------------------------------------------------------
// Borrando los datos.
// ------------------------------------------------------------------------------------------------
if($lcAccion=="DELETE"){
	
	// verificando si hay transacciones para este cliente.	
	$lcsql = " select cinvno from arinvc where ccustno = '$lccustno' ";	
	$lcresult = mysqli_query($oConn,$lcsql);
	$lnRecnos = mysqli_num_rows($lcresult);
	
	// si hay registros incluidos no puede borrar
	if ($lnRecnos > 0){
		echo "Hay historial para este registro y no puede ser borrado";
	}else{
		// procediendo a borrar datos ya que no ha sido utilizado el codigo en nada.
		$lcsqlcmd = " delete from arcust where ccustno = '" . $lccustno . "' ";
		mysqli_query($oConn,$lcsqlcmd);
	}	
}

// ------------------------------------------------------------------------------------------------
// guardando datos. INSERT / UPDATE
// ------------------------------------------------------------------------------------------------
if($lcAccion=="NEW"){
	// haciendo la coneccion.
	$oConn = get_coneccion("CIA");
	if (isset($_POST["ccustno"])){
		$ldstar   = $_POST["dstar"];
		$lcname   = $_POST["cname"];
		$lcstatus = $_POST["cstatus"];
		$lctel    = $_POST["ctel"];
		$lcemail  = $_POST["cemail"];
		$lcweb    = $_POST["cweb"];
		$lcubino  = $_POST["cubino"];
		$lccateno = $_POST["ccateno"];
		$lcwhseno = $_POST["cwhseno"];
		$lcrespno = $_POST["crespno"];
		$lcpaycode = $_POST["cpaycode"];
		$lcctaid   = $_POST["cctaid"];
		$lcpasword = $_POST["cpasword"];
		$lnlimcrd  = ($_POST["nlimcrd"] == "")?0:$_POST["nlimcrd"];
		$lmnotas   = $_POST["mnotas"];
		$lmdirecc  = $_POST["mdirecc"];
		if(!empty($_POST["cfoto"])){
			$lcfoto  = 'cfoto = "../photos/otras/' . $_POST["cfoto"]. '",'; 	
			$lcfotoI = '../photos/otras/' . $_POST["cfoto"]; 	
		}else{
			$lcfoto  = "";
			$lcfotoI = "";
		}		
	
		// verificando que el codigo exista o no 
		$lcsql   = "select ccustno from arcust where ccustno ='" . $lccustno . "' ";
		$lresult = mysqli_query($oConn,$lcsql);	
		$lnCount = mysqli_num_rows($lresult);
		if ($lnCount == 0){
			//echo "Insert";
			// este codigo de cliente no existe por tanto lo crea	
			// ejecutando el insert para la tabla de clientes.
			$lcsqlcmd = " insert into arcust (ccustno,cname,dstar,cstatus,ctel,cemail,cweb,cubino,ccateno,
												cwhseno,crespno,cpaycode,cctaid,cpasword,nlimcrd,cfoto,mnotas,mdirecc)
							values('$lccustno','$lcname','$ldstar','$lcstatus','$lctel','$lcemail','$lcweb','$lcubino','$lccateno',
								    '$lcwhseno','$lcrespno','$lcpaycode','$lcctaid','$lcpasword',$lnlimcrd,'$lcfotoI','$lmnotas','$lmdirecc')";
		}else{
			//echo "Update <br>";
			// el codigo existe lo que hace es actualizarlo.	
			$lcsqlcmd = " update arcust set cname = '$lcname',dstar = '$ldstar',cstatus = '$lcstatus',
											ctel = '$lctel',cemail = '$lcemail',cweb = '$lcweb',cubino = '$lcubino',ccateno = '$lccateno',
											cwhseno = '$lcwhseno',crespno = '$lcrespno' ,cpaycode = '$lcpaycode',cctaid = '$lcctaid',
											cpasword = '$lcpasword',nlimcrd = $lnlimcrd,$lcfoto mnotas = '$lmnotas' ,mdirecc = '$lmdirecc'
						where ccustno = '$lccustno'	";
		}
		// ------------------------------------------------------------------------------------------------
		// Generando coneccion y procesando el comando.
		// ------------------------------------------------------------------------------------------------
		$lresultF = mysqli_query($oConn,$lcsqlcmd);	
		//mysqli_query($oConn,$lcsqlcmd);
		$lnRowsAfect = mysqli_affected_rows($oConn);
		mysqli_close($oConn);
		header("location:../view/arcust.php?msg='Estamos bien.!!'");		

	}  // if (isset($_POST["ccustno"])){
}  //if($lcAccion=="NEW"){

// ------------------------------------------------------------------------------------------------
// genera un listado de todos los datos de un cliente especifico.
// ------------------------------------------------------------------------------------------------
if($lcAccion=="LIST"){
	$lcsql    = "select * from arcust where ccustno = '$lccustno'";
	$lcresult = mysqli_query($oConn,$lcsql);
	$ldata    = mysqli_fetch_assoc($lcresult);
	// enviando en formato json.	
	$jsondata = json_encode($ldata,true);
	// retornando objeto json
	echo $jsondata;		
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
	$lcsql    = " select * from arcust ". $lcwhere . $lcorder;
	
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
		$ojson = $ojson . $lcSpace .'{"ccustno":"' .$ldata["ccustno"] .'","cname":"'. $ldata["cname"] .'","ctel":"'. $ldata["ctel"] .'","cemail":"'. $ldata["cemail"] .'"}';	
	}
	$ojson = $ojson . ']';
	// enviando variable json.
	echo $ojson;		
}


if($lcAccion == "KARDEX"){
	$lccustno = $_POST["ccustno"];
	$lcsql    = " select arinvc.cinvno,
						 arinvc.dstar,
						 arinvc.crefno,
						 arinvc.cinvno as ctrnno,
						 artcas.cdesc,
	   				     arinvc.nsalesamt,
 						 arinvc.ndesamt,
						 arinvc.ntaxamt,
						 arinvc.nbalance
					from arinvc 
					left outer join artcas on artcas.cpaycode = arinvc.cpaycode
					where arinvc.ccustno = '$lccustno' order by 1
				";	
	
	
	$lcresult  = mysqli_query($oConn,$lcsql);
	echo '<tbody>';
	while($row = mysqli_fetch_assoc($lcresult)){
		echo '<tr class = "listados">';
		echo '<td  width="70px">'  . $row["cinvno"]   .'</td>';
		echo '<td  width="70px">'  . $row["crefno"]   .'</td>';
		echo '<td  width="70px">'  . $row["dstar"]    .'</td>';
		echo '<td  width="200px">' . $row["cdesc"]    .'</td>';
		echo '<td  width="70px">'  . $row["ctrnno"]   .'</td>';
		echo '<td  width="70px">'   . $row["nsalesamt"].'</td>';
		echo '<td   width="70px">'  . $row["ndesamt"]  .'</td>';
		echo '<td   width="70px">'  . $row["ntaxamt"]  .'</td>';
		echo '<td class="sayamtd_link"  width="70px" title="Dar click para ver detalle de pagos" id="'. $row["cinvno"] .'" onclick="get_pagos(this)" >'  . $row["nbalance"] ;
		//echo 	'<input type="buttom" id="'. $row["cinvno"] .'" onclick="get_pagos(this)" value="Ver"> ';
		echo '</td>';
		echo '</tr>';
	}
	echo '</tbody>';
}
?>
