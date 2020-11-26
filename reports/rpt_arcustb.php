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
	$lcwhere   = " arinvc.lvoid = 0 ";
	$lcXsortBy = "";
	$lcDescBy  = "";
	$lcDescOrderby = "";
	$lctype_stado = $_POST["cformato"];
	// filtrando cliente.	
	$lccustno_1 = mysqli_real_escape_string($oConn,$_POST["ccustno_1"]);
	if(!empty($lccustno_1)){
		$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arcust.ccustno = '". $lccustno_1 ."' ";
	}
	
	if($lctype_stado == "rango"){
		// por formato de rango solo ejecuta los objetos rango	
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
	}else{
		$dtrndate_3 = mysqli_real_escape_string($oConn,$_POST["dstar_3"]);
		// por formato fecha al corte solo los objetos de ese tipo.
		if (!empty($_POST["dstar_3"])){
				$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvc.dstar <= '". $dtrndate_3 ."' ";
			}else{
				echo "No indico fecha de corte";
				return;
			}
	}

	// armando filtro final
	if ($lcwhere != ""){
		$lcwhere = " where " . $lcwhere;
	}


	//--------------------------------------------------------------------------------------------------------
	// C- Obteniendo datos segun sea el caso.
	//--------------------------------------------------------------------------------------------------------
	if($lctype_stado == "rango"){
		
	}else{
		$lcsqlcmd = " select arinvc.ccustno, 
						arcust.cname,
						arcust.ctel,
						arinvc.cinvno,  
						arinvc.crefno,
						arinvc.dstar, 
						arinvc.dend,
						datediff(arinvc.dend,now()) as nmora,
						0000000000.00 as nbalance ,
						0000000000.00 as npayamt ,
						(arinvc.nsalesamt + arinvc.ntaxamt - arinvc.ndesamt ) AS nsaldo
						from arinvc 
						left outer join arcust on arcust.ccustno  = arinvc.ccustno 
						left outer join arresp on arresp.crespno  = arcust.crespno 
						left outer join artcas on artcas.cpaycode = arinvc.cpaycode 
						$lcwhere  ";
	}
	
	//echo $lcsqlcmd;
	//return ;
	
	$lcgrp_g = mysqli_query($oConn,$lcsqlcmd);		
	// determinando si hay datos o no en la consulta.
	if (mysqli_num_rows($lcgrp_g)== 0){
		echo "<h1>No hay datos para este reporte.</h1>";
		return;
	}
	// ----------------------------------------------------------------------------------------------------------------
	// D- Generando el reporte 
	// ----------------------------------------------------------------------------------------------------------------
	$ofpdf = new PDF();
	// colores 
	$ofpdf->SetFillColor(0,255,255);
	$llfirstime = true;
	$lcpdate_1 = ($lctype_stado == "rango")?$dtrndate_1:$dtrndate_3;
	$lcpdate_2 = ($lctype_stado == "rango")?$dtrndate_2:"";
	$lncargo   = 0;
	$lncredito = 0;
	$lnsaldo   = 0;
	
	
	// c-2 Dibujando el cuerpo de la pagina
	$lnveces  = 0;
	$lnNewPag = 45;
	// total de ventas general de todo el reporte
	$lnsalesgeneral = 0;
	// poniendo la cabecera.
	$nombre = mysqli_fetch_assoc($lcgrp_g);
	
	cabecera($ofpdf,$nombre["cname"],$nombre["ctel"],$lcpdate_1,$lcpdate_2,$lctype_stado,$llfirstime);
	
	while($row = mysqli_fetch_assoc($lcgrp_g)){
		$lnveces = 1 + $lnveces;
		if ($lnveces == $lnNewPag){
			cabecera($ofpdf,$row["cname"],$row["ctel"],$lcpdate_1,$lcpdate_2,$lctype_stado,true);
			$lnveces = 0;
		}
		// a)- Obteniendo los pagos totales de cada factura.
		$lnpagado = 0;
    	$lcsql  = " SELECT arcash.cinvno,
         			SUM(arcash.namount) AS npayamt 
    				FROM arcasm  
    				join arcash on arcasm.ccashno = arcash.ccashno
    				WHERE arcasm.dtrndate <= '". $dtrndate_3 ."' and
          			arcasm.cstatus  = 'OP' AND
          			arcash.cinvno = " . $row["cinvno"] . " GROUP BY 1";
	
		// obteniendo cursor de pagos.			
		$lcpays = mysqli_query($oConn,$lcsql);				
		if (mysqli_num_rows($lcpays)<> 0){
			$lcurpago = mysqli_fetch_assoc($lcpays);
			$lnpagado = $lcurpago{"npayamt"};
		}
		// cargando datos.
		$ofpdf->cell(10,5, "Fact",0,0,"");   	
		$ofpdf->cell(20,5, $row["cinvno"],0,0,"");   	
		$ofpdf->cell(20,5, $row["crefno"],0,0,"");   	
		$ofpdf->Cell(20,5, $row["dstar"],0,0,"");   	
		$ofpdf->Cell(20,5, $row["dend"],0,0,"");   	
		$ofpdf->Cell(20,5, $row["nmora"],0,0,"C");   	
		$ofpdf->Cell(25,5, $row["nsaldo"],0,0,"R");   	
		$ofpdf->Cell(25,5, $lnpagado,0,0,"R");   	
		$ofpdf->cell(25,5, $row["nsaldo"] - $lnpagado,0,1,"R");   
		// cargando los totales del reporte a nivel general 
		$lncargo   = $lncargo + $row["nsaldo"];
		$lncredito = $lncredito + $lnpagado;
		$lnsaldo   = $lnsaldo + $row["nsaldo"] - $lnpagado;
	}	//while($lcgrp = mysqli_fetch_assoc($lcrestgrp)){

	// ----------------------------------------------------------------------------------------------------------------
	// Final de Reporte.
	// ----------------------------------------------------------------------------------------------------------------
	// termino el reporte y pone el gran total.
	$ofpdf->cell(15,5,"",0,1,"");
	$ofpdf->Cell(60,10,"",0,0,"");   	
	$ofpdf->Cell(50,10,"Total General del Reporte","LTB",0,"R",true);   	
	$ofpdf->Cell(25,10,$lncargo,"TB",0,"R",true);   	
	$ofpdf->Cell(25,10,$lncredito ,"TB",0,"R",true);   	
	$ofpdf->cell(25,10, $lnsaldo ,"TBR",1,"R",true);   
	$ofpdf->output();

function cabecera($ofpdf,$pcname,$pctel,$pcdate1,$pcdate2,$pctype,$lladdpage){
	if ($lladdpage){
		$ofpdf->AddPage();	
		// c-1 Encabezado de la pagina.
		//----------------------------------------------------------
		$ofpdf->encabezado_ec($pcname,$pctel);
	}
	// c-2 Dibujando el cuerpo de la pagina
	//----------------------------------------------------------
	$ofpdf->setfont("arial","B",10);
	// poniendo descripcion del estado financiero segun el caso.
	if ($pctype=="corte"){
		$ofpdf->cell(190,5,"Fecha de Corte al " . $pcdate1,0,1,"C");   					
	}else{
		$ofpdf->cell(200,5,"Del " . $pcdate1 ." al ".$pcdate2 ,0,1,"C");   					
	}
	
	$ofpdf->cell(10,5,"Tipo",1,0,"",true);   					
	$ofpdf->cell(20,5,"Factura #",1,0,"",true);   	// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(20,5,"Ref No",1,0,"",true);   		// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(20,5,"Facturada",1,0,"",true);   	// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(20,5,"Vence",1,0,"",true);   		// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(20,5,"Mora",1,0,"C",true);   		// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(25,5,"Cargo",1,0,"R",true);   		// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(25,5,"Credito",1,0,"R",true);   		// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(25,5,"Saldo",1,1,"R",true);   		// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)

	//$ofpdf->cell(15,5,"",0,1,"");   // cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->setfont("arial","",10);
}	// function cabecera($ofpdf,$ldstar,$lpname){

?>		