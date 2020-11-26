<?php
	// ------------------------------------------------------------------------------------------------------------------	
	// A)- Coneccion a la base de datos.
	// ------------------------------------------------------------------------------------------------------------------	

		
	include("../modelo/coneccion.php");
	include("../modelo/vc_funciones.php");
	include("../modelo/pdf.php");
	vc_funciones::Star_session();
	$oConn = get_coneccion("CIA");
	
	// ------------------------------------------------------------------------------------------------------------------	
	// B- Recibiendo parametros de filtros.
	// ------------------------------------------------------------------------------------------------------------------	
	// solo facturas activas por defecto.

	$lcwhere   = " arinvc.cstatus = 'OP' ";
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
			$lcXsortBy = "arinvc.ccustno";
			$lcDescBy  = "arcust.cname";
			$lcDescOrderby = "Cliente: ";
			break;
		case "cpaycode":
			$lcXsortBy = "arinvc.cpaycode";
			$lcDescBy  = "artcas.cdesc ";
			$lcDescOrderby = "Condicion: ";
			break;
		case "dstar":
			$lcXsortBy = "arinvc.dstar";
			$lcDescBy  = "arinvc.dstar";
			$lcDescOrderby = "Fecha: ";
			break;
		case "cwhseno":
			$lcXsortBy = "arinvc.cwhseno";
			$lcDescBy  = "arwhse.cdesc";
			$lcDescOrderby = "Bodega: ";
			break;
		case "crespno":
			$lcXsortBy = "arinvc.crespno";
			$lcDescBy  = "arresp.cfullname";
			$lcDescOrderby = "Vendedor: ";
			break;
		case "crefno":
			$lcXsortBy = "arinvc.crefno";
			$lcDescBy  = "arinvc.crefno";
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

	$lcpaycode_1 = mysqli_real_escape_string($oConn,$_POST["cpaycode_1"]);
	$lcpaycode_2 = mysqli_real_escape_string($oConn,$_POST["cpaycode_2"]);
	if(!empty($lcpaycode_1)){
		if($lcpaycode_1 == $lcpaycode_2 or empty($lcpaycode_2)) {
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvc.cpaycode = '". $lcpaycode_1 ."' ";
		}else{
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvc.cpaycode >= '". $lcpaycode_1 ."' and ".
								  " arinvc.cpaycode <= '". $lcpaycode_2 ."' ";
		}
	}
	
	$cwhseno_1 = mysqli_real_escape_string($oConn,$_POST["cwhseno_1"]);
	$cwhseno_2 = mysqli_real_escape_string($oConn,$_POST["cwhseno_2"]);
	if(!empty($cwhseno_1)){
		if($cwhseno_1 == $cwhseno_2 or empty($cwhseno_2)) {
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvc.cwhseno = '". $cwhseno_1 ."' ";
		}else{
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvc.cwhseno >= '". $cwhseno_1 ."' and ".
								  " arinvc.cwhseno <= '". $cwhseno_2 ."' ";
		}
	}
	
	$crespno_1 = mysqli_real_escape_string($oConn,$_POST["crespno_1"]);
	$crespno_2 = mysqli_real_escape_string($oConn,$_POST["crespno_2"]);
	if(!empty($crespno_1)){
		if($crespno_1 == $crespno_2 or empty($crespno_2)) {
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvc.crespno = '". $crespno_1 ."' ";
		}else{
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvc.crespno >= '". $crespno_1 ."' and ".
								  " arinvc.crespno <= '". $crespno_2 ."' ";
		}
	}
	
	// fecha de emision de factura.
	$dstar_1 = mysqli_real_escape_string($oConn,$_POST["dstar_1"]);
	$dstar_2 = mysqli_real_escape_string($oConn,$_POST["dstar_2"]);
	if (!empty($_POST["dstar_1"])){
		if($dstar_1 == $dstar_2 or empty($dstar_2)) {
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvc.dstar = '". $dstar_1 ."' ";
		}else{
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvc.dstar >= '". $dstar_1 ."' and ".
								  " arinvc.dstar <= '". $dstar_2 ."' ";
		}
 	}
	
	// referencia manual de factura.
	$crefno = mysqli_real_escape_string($oConn,$_POST["crefno"]);
	if(!empty($crefno)){
		$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvc.crefno = '". $crefno ."' ";
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
					from arinvc 
					join arcust on arcust.ccustno  = arinvc.ccustno
					join artcas on artcas.cpaycode = arinvc.cpaycode
					join arresp on arresp.crespno  = arinvc.crespno
					join arwhse on arwhse.cwhseno  = arinvc.cwhseno 
					$lcwhere order by 1 ";		

	$lcrestgrp = mysqli_query($oConn,$lcsqlcmd);			
	// determinando si hay datos o no en la consulta.
	/*
	if (mysqli_affected_rows($oConn)=0){
		echo "No hay datos para este reporte.";
		return;
	}
	*/
	// ----------------------------------------------------------------------------------------------------------------
	// INGRESANDO LA PAGINA
	// ----------------------------------------------------------------------------------------------------------------
	$ofpdf = new PDF();
	// cabecera($ofpdf);
	$ofpdf->AddPage();
	// c-1 Encabezado de la pagina.
	//----------------------------------------------------------
	$ofpdf->RPTheader("Reporte de Ventas");
	// c-2 Dibujando el cuerpo de la pagina
	$lnVeces  = 0;
	$lnNewPag = 45;
	// total de ventas general de todo el reporte
	$lnsalesgeneral = 0;
	
	// ----------------------------------------------------------------------------------------------------------------
	// B) Generrando el reporte
	// ----------------------------------------------------------------------------------------------------------------

	while($lcgrp = mysqli_fetch_assoc($lcrestgrp)){
		// complementando el filtro del grupo 
		$lcfilter = " $lcXsortBy = '" . $lcgrp["unico"] . "' ";
		if ($lcwhere != ""){
			$lcwhere_g = $lcwhere . " and " . $lcfilter;
		}else{
			$lcwhere_g = " where " . $lcfilter;
		}	

		// a)- Obteniendo los detalles de cada grupo 
		$lcsql = "select $lcXsortBy as xsortby,
						 $lcDescBy as xdescby,	
						 arinvc.dstar,
						 arcust.cname,
						 arinvc.cinvno,
						 arinvc.cstatus,
						 arinvc.crefno,
						 arinvc.nsalesamt,
						 arinvc.ndesamt,
						 arinvc.ntaxamt,
						 arinvc.ntc
				from arinvc 
				join arcust on arcust.ccustno  = arinvc.ccustno
				join artcas on artcas.cpaycode = arinvc.cpaycode
				join arresp on arresp.crespno  = arinvc.crespno 
				join arwhse on arwhse.cwhseno  = arinvc.cwhseno
				$lcwhere_g 	";		

		$lcresult = mysqli_query($oConn,$lcsql);
		//--------------------------------------------------------------------------------------------------------------
		// b) configurando las variables de el grupo y total
		//--------------------------------------------------------------------------------------------------------------
		$lcdesctot  = "Total para ".$lcgrp["cdesc"];
		// totales del grupo 
		$lntotamtgp = 0;
		// totales generales del reporte
		$lnsalesamt = 0;
		// c)- imprimiendo nombre de grupo.
		$ofpdf->cell(100,5,$lcgrp["cdesc"],0,1,"");   // cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
		
		// d)- IMPRIMIENDO LINEA DE INFORMACION DEBAJO DE CADA GRUPO.
		$ofpdf->setfont("arial","B",10);
		//$ofpdf->cell(20,5,"",0,0,"");   
		$ofpdf->cell(15,5,"Trn No",1,0,"");   // cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
		$ofpdf->cell(20,5,"Ref No",1,0,"");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
		$ofpdf->cell(20,5,"Estado",1,0,"");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
		$ofpdf->cell(50,5,"Nombre Cliente",1,0,"");	// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
		$ofpdf->cell(20,5,"Subtotal",1,0,"R");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
		$ofpdf->cell(20,5,"Descuento",1,0,"R");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
		$ofpdf->cell(20,5,"Impuesto",1,0,"R");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
		$ofpdf->cell(20,5,"Total",1,1,"R");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
		//$ofpdf->cell(15,5,"",0,1,"");   // cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)

		// cargando el resto de los datos del reporte.
		while($row = mysqli_fetch_assoc($lcresult)){
			$lnVeces ++;
			if ($lnVeces == $lnNewPag){ 	
				$lnVeces = 1;
				$ofpdf->AddPage();
				$ofpdf->RPTheader("Reporte de Ventas");

				$ofpdf->cell(100,5,$lcgrp["cdesc"],0,1,"");   // cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
				
				// d)- IMPRIMIENDO LINEA DE INFORMACION DEBAJO DE CADA GRUPO.
				$ofpdf->setfont("arial","B",10);
				//$ofpdf->cell(20,5,"",0,0,"");   
				$ofpdf->cell(15,5,"Trn No",1,0,"");   // cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
				$ofpdf->cell(20,5,"Ref No",1,0,"");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
				$ofpdf->cell(20,5,"Estado",1,0,"");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
				$ofpdf->cell(50,5,"Nombre Cliente",1,0,"");	// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
				$ofpdf->cell(20,5,"Subtotal",1,0,"R");   //125					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
				$ofpdf->cell(20,5,"Descuento",1,0,"R");  //145 					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
				$ofpdf->cell(20,5,"Impuesto",1,0,"R");   //165					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
				$ofpdf->cell(20,5,"Total",1,1,"R");   	 //185				// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
			}				

			$ofpdf->Cell(15,5, $row["cinvno"],0,0,"");   	
			$ofpdf->cell(20,5, $row["crefno"],0,0,"");   	
			$ofpdf->cell(20,5, $row["cstatus"],0,0,"");   	
			$ofpdf->cell(50,5, $row["cname"],0,0,"");   
			$ofpdf->cell(20,5, $row["nsalesamt"],0,0,"R");   
			$ofpdf->cell(20,5, $row["ndesamt"],0,0,"R");   
			$ofpdf->cell(20,5, $row["ntaxamt"],0,0,"R");   

			// total de la linea
			$lnsalesamt = ($row["nsalesamt"] + $row["ntaxamt"]) - $row["ndesamt"];
			// Total del grupo en general.
			$lntotamtgp = $lnsalesamt + $lntotamtgp;
			// poniendo total por cada linea de registro.
			$ofpdf->cell(20,5, $lnsalesamt,0,1,"R");   
			// total de ventas general.
			$lnsalesgeneral = $lnsalesgeneral + $lnsalesamt;	
			
		}
		// termina el grupo y pone el total adecuado de ese grupo.
		$ofpdf->cell(15,5,"",0,1,""); 
		$ofpdf->cell(165,5,$lcdesctot,0,0,"R");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
		$ofpdf->cell(20,5, $lntotamtgp ,0,1,"R");   
		// recetiando el valor de ventas de todo el grupo
		$lntotamtgp = 0;

	}	//while($lcgrp = mysqli_fetch_assoc($lcrestgrp)){

	// ----------------------------------------------------------------------------------------------------------------
	// Final de Reporte.
	// ----------------------------------------------------------------------------------------------------------------
	// termino el reporte y pone el gran total.
	$ofpdf->cell(15,5,"",0,1,"");
	$ofpdf->Cell(165,5,"Total General del Reporte",0,0,"R");   	
	// termina el reporte y pone el total adecuado de ese reporte
	$ofpdf->cell(20,5, $lnsalesgeneral ,0,1,"R");   
	$ofpdf->output();

function cabecera($ofpdf){
	$ofpdf->AddPage();
	// c-1 Encabezado de la pagina.
	//----------------------------------------------------------
	$ofpdf->RPTheader("Reporte de Ventas");
	// c-2 Dibujando el cuerpo de la pagina
	//----------------------------------------------------------
	$ofpdf->setfont("arial","B",10);
	//$ofpdf->cell(20,5,"",0,0,"");   
	$ofpdf->cell(15,5,"Trn No",1,0,"");   // cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(20,5,"Ref No",1,0,"");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(20,5,"Estado",1,0,"");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(50,5,"Nombre Cliente",1,0,"");	// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(20,5,"Subtotal",1,0,"R");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(20,5,"Descuento",1,0,"R");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(20,5,"Impuesto",1,0,"R");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(20,5,"Total",1,1,"R");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	//$ofpdf->cell(15,5,"",0,1,"");   // cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->setfont("arial","",10);
}	// function cabecera($ofpdf,$ldstar,$lpname){

?>		