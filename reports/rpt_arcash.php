<?php
	// ------------------------------------------------------------------------------------------------------------------	
	// A)- Coneccion a la base de datos.
	// ------------------------------------------------------------------------------------------------------------------	

	include("../modelo/coneccion.php");
	include("../modelo/vc_funciones.php");
	include("../modelo/pdf.php");
	vc_funciones::Star_session();
	$oConn = get_coneccion("CIA");
	//echo var_dump($_POST);
	// ------------------------------------------------------------------------------------------------------------------	
	// B- Recibiendo parametros de filtros.
	// ------------------------------------------------------------------------------------------------------------------	
	// solo facturas activas por defecto.

	$lcwhere   = " arcasm.cstatus = 'OP' ";
	$lcXsortBy = "";
	$lcDescBy  = "";
	$lcDescOrderby = "";
	
	
	// Orden de el reporte.
	switch ($_POST["corden"]){

		case "''":
			$lcXsortBy = "''";
			$lcDescBy  = "''";
			$lcDescOrderby = "";
			break;
		case "ccustno":
			$lcXsortBy = "arcasm.ccustno";
			$lcDescBy  = "arcust.cname";
			$lcDescOrderby = "Cliente: ";
			break;
		case "ctype":
			$lcXsortBy = "arcasm.ctype";
			$lcDescBy  = "arcasm.ctype";
			$lcDescOrderby = "Condicion: ";
			break;
		case "dtrndate":
			$lcXsortBy = "arcasm.dtrndate";
			$lcDescBy  = "arcasm.dtrndate";
			$lcDescOrderby = "Fecha: ";
			break;
		case "crefno":
			$lcXsortBy = "arcasm.crefno";
			$lcDescBy  = "arcasm.crefno";
			$lcDescOrderby = "Referencia Manual: ";
			break;
	}
	//--------------------------------------------------------------------------------------------------------
	// filtrando cliente.	
	$lccustno_1 = mysqli_real_escape_string($oConn,$_POST["ccustno_1"]);
	$lccustno_2 = mysqli_real_escape_string($oConn,$_POST["ccustno_2"]);
	if(!empty($lccustno_1)){
		if($lccustno_1 == $lccustno_2 or empty($lccustno_2)) {
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arcust.ccustno = '". $lccustno_1 ."' ";
		}else{
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arcust.ccustno >= '". $lccustno_1 ."' and ".
								  " arcust.ccustno <= '". $lccustno_2 ."' ";
		}
	}
	// forma de pago.
	$lctype = mysqli_real_escape_string($oConn,$_POST["ctype"]);
	if(!empty($lctype)){
		$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arcasm.ctype = '". $lctype ."' ";
	}

	// fecha de emision de recibo.
	$dtrndate_1 = mysqli_real_escape_string($oConn,$_POST["dtrndate_1"]);
	$dtrndate_2 = mysqli_real_escape_string($oConn,$_POST["dtrndate_2"]);
	if (!empty($_POST["dtrndate_1"])){
		if($dtrndate_1 == $dtrndate_2 or empty($dtrndate_2)) {
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arcasm.dtrndate = '". $dtrndate_1 ."' ";
		}else{
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arcasm.dtrndate >= '". $dtrndate_1 ."' and ".
								  " arcasm.dtrndate <= '". $dtrndate_2 ."' ";
		}
 	}
	
	// referencia manual de factura.
	$crefno = mysqli_real_escape_string($oConn,$_POST["crefno"]);
	if(!empty($crefno)){
		$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arcasm.crefno = '". $crefno ."' ";
	}
	//--------------------------------------------------------------------------------------------------------
	// armando filtro final
	//--------------------------------------------------------------------------------------------------------
	if ($lcwhere != ""){
		$lcwhere = " where " . $lcwhere;
	}
	$lcwhere_g = "";
	// A) Obteniendo agrupacion principal y por cada una generando el dato.
	$lcsqlcmd  = " select distinct $lcXsortBy as unico , $lcDescBy as cdesc 
					from arcasm
					join arcash on arcasm.ccashno = arcash.ccashno 
					join arcust on arcust.ccustno  = arcasm.ccustno
					$lcwhere order by 1 ";		

	
	$lcgrp_g = mysqli_query($oConn,$lcsqlcmd);		
	// determinando si hay datos o no en la consulta.
	// (mysqli_affected_rows($oConn)=0){
	
			
	if (mysqli_num_rows($lcgrp_g)== 0){
		echo "No hay datos para este reporte.";
		return;
	}
	// ----------------------------------------------------------------------------------------------------------------
	// INGRESANDO LA PAGINA
	// ----------------------------------------------------------------------------------------------------------------
	$ofpdf = new PDF();
	$llfirstime = true;


	// c-2 Dibujando el cuerpo de la pagina
	$lnVeces  = 0;
	$lnNewPag = 45;
	// total de ventas general de todo el reporte
	$lnsalesgeneral = 0;
	
	while($lcgrp = mysqli_fetch_assoc($lcgrp_g)){
		// complementando el filtro del grupo 
		$lcfilter = " $lcXsortBy = '" . $lcgrp["unico"] . "' ";
		
		if ($lcwhere != ""){
			$lcwhere_g = $lcwhere . " and " . $lcfilter;
		}else{
			$lcwhere_g = " where " . $lcfilter;
		}	
		// a)- Obteniendo los detalles de cada grupo 
		$lcsql  = " select $lcXsortBy as unico , $lcDescBy as cdesc ,
					arcasm.ccashno,
					arcasm.crefno,
					arcasm.dtrndate,
					arcust.cname,
					arcash.cinvno,
					arcasm.cstatus,
					arcash.namount
					from arcasm
					join arcash on arcasm.ccashno = arcash.ccashno 
					join arcust on arcust.ccustno  = arcasm.ccustno
					$lcwhere_g order by 1 ";		
				
		$lcresult = mysqli_query($oConn,$lcsql);
		
		//--------------------------------------------------------------------------------------------------------------
		// b) configurando las variables de el grupo y total
		//--------------------------------------------------------------------------------------------------------------
		$lcdesctot  = "Total para ".$lcgrp["cdesc"];
		// totales del grupo 
		$lntotamtgp = 0;
		// totales generales del reporte
		$lnsalesamt = 0;

		cabecera($ofpdf,$lcgrp["cdesc"],($llfirstime)?true:false);
		// poniendo la primera vez en falseo solo 1 vez debe ejecutarse.
		if ($llfirstime){
			$llfirstime = false;
		}
		// cargando el resto de los datos del reporte.
		while($row = mysqli_fetch_assoc($lcresult)){
			$lnVeces ++;
			if ($lnVeces == $lnNewPag){ 	
				$lnVeces = 1;
				cabecera($ofpdf,$lcgrp["cdesc"],true);
			}				

			$ofpdf->Cell(25,5, $row["ccashno"],0,0,"");   	
			$ofpdf->cell(25,5, $row["crefno"],0,0,"");   	
			$ofpdf->cell(25,5, $row["cinvno"],0,0,"");   	
			$ofpdf->cell(15,5, $row["cstatus"],0,0,"");   	
			$ofpdf->cell(20,5, $row["dtrndate"],0,0,"");   	
			$ofpdf->cell(60,5, $row["cname"],0,0,"");   
			$ofpdf->cell(25,5, $row["namount"],0,1,"R");   


			// Total del grupo en general.
			$lntotamtgp = $row["namount"]+ $lntotamtgp;
			// total de ventas general.
			$lnsalesgeneral = $lnsalesgeneral + $row["namount"];	
			
		}
		// termina el grupo y pone el total adecuado de ese grupo.
		$ofpdf->cell(15,5,"",0,1,""); 
		$ofpdf->cell(170,5,$lcdesctot,0,0,"R");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
		$ofpdf->cell(25,5, $lntotamtgp ,0,1,"R");   
		// recetiando el valor de ventas de todo el grupo
		$lntotamtgp = 0;

	}	//while($lcgrp = mysqli_fetch_assoc($lcrestgrp)){

	// ----------------------------------------------------------------------------------------------------------------
	// Final de Reporte.
	// ----------------------------------------------------------------------------------------------------------------
	// termino el reporte y pone el gran total.
	$ofpdf->cell(15,5,"",0,1,"");
	$ofpdf->Cell(170,5,"Total General del Reporte",0,0,"R");   	
	// termina el reporte y pone el total adecuado de ese reporte
	$ofpdf->cell(25,5, $lnsalesgeneral ,0,1,"R");   
	$ofpdf->output();

function cabecera($ofpdf,$pcgrpdesc,$lladdpage){
	if ($lladdpage){
		$ofpdf->AddPage();	
		// c-1 Encabezado de la pagina.
		//----------------------------------------------------------
		$ofpdf->RPTheader("Resumen de Cobros");
	}
	
	$ofpdf->cell(100,5,$pcgrpdesc,0,1,"");
	// c-2 Dibujando el cuerpo de la pagina
	//----------------------------------------------------------
	$ofpdf->setfont("arial","B",10);
	//$ofpdf->cell(20,5,"",0,0,"");   
				$ofpdf->cell(25,5,"Trn No",1,0,"");   		// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
				$ofpdf->cell(25,5,"Ref No",1,0,"");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
				$ofpdf->cell(25,5,"Factura #",1,0,"");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
				$ofpdf->cell(15,5,"Estado",1,0,"");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
				$ofpdf->cell(20,5,"F/Pago",1,0,"");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
				$ofpdf->cell(60,5,"Nombre Cliente",1,0,"");	// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
				$ofpdf->cell(25,5,"Pagado",1,1,"R");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	//$ofpdf->cell(15,5,"",0,1,"");   // cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->setfont("arial","",10);
}	// function cabecera($ofpdf,$ldstar,$lpname){

?>		