<?php
	// ------------------------------------------------------------------------------------------------------------------	
	// A- Recibiendo parametros de filtros.
	// ------------------------------------------------------------------------------------------------------------------	
	$lcwhere   = "  artran.cstatus = 'OP' and artran.ctype != 'CT'  ";
	$lcwhere_i = "  artran.cstatus = 'OP' and artran.ctype != 'CT' ";
	$lcType    = "";

	// filtrando cliente.	
	if (isset($_GET["ccustno"])){
		$lccustno = $_GET["ccustno"];
		if(!$lccustno == ""){
			$lcwhere   = $lcwhere   . " and artran.ccustno = " . $lccustno ;		
			$lcwhere_i = $lcwhere_i . " and artran.ccustno = " . $lccustno ;		
		}
	}
	else{
		echo "debe enviar un codigo de cliente al menos";
		return ;
	}
	
	if (isset($_GET["dtrndate"])){
		$ldend   = $_GET["dtrndate"];
		$ldstar  = date("Y-m-d",strtotime($ldend."- 1 days")); 
		if(!$ldend == ""){
			$lcwhere = $lcwhere . " and artran.dtrndate >= '" . $ldend ."' "  ;		
		}
	}else{
		echo "Falta fecha de corte ";
		return ;
	}

	// armando filtro final
	if (!$lcwhere == ""){
		$lcwhere = " where " . $lcwhere;
		$lcwhere_i = " where " . $lcwhere_i;
	}
	
	// ------------------------------------------------------------------------------------------------------------------	
	// B)- Coneccion a la base de datos.
	// ------------------------------------------------------------------------------------------------------------------	
	include("../modelo/pdf.php");
	include("../modelo/parameters_conection.php");
	$lcDbb=$oPCia;
	$oConn = mysqli_connect($gHostId,$gUserId,$gPasWord,$lcDbb);
	if(!mysqli_error($oConn)){
		mysqli_set_charset($oConn,"utf8");
		//echo "se logro la coneccion ";
	}else{
		//echo "Coneccion NO Establecida.";
	}
	if(!mysqli_error($oConn)){
	// obteniendo saldo inicial. 
	$lcsqlini  = " select sum(artran.namount) as nsaldo 
					from artran
					$lcwhere_i and artran.dtrndate <= '". $ldstar ."' ";
	// obteniendo nombre.
	$lcsqlname = " select cname from arcust where ccustno = $lccustno " ;
	$lcsql     = "select arcust.ccustno,
							arcust.cname,
							artran.cuid,
							artran.dtrndate,
							artran.namount,
							artran.ctype,
							artran.mnotas 
					from artran 
					join arcust on arcust.ccustno = artran.ccustno
					$lcwhere order by artran.dtrndate	";		
	}
	$lcresult   = mysqli_query($oConn,$lcsql);
	$lcresname  = mysqli_query($oConn,$lcsqlname);
	// obteniendo el saldo inicial.
	$datasaldo  = mysqli_fetch_assoc(mysqli_query($oConn,$lcsqlini));
	// datos del encabezado.
	$dataperson = mysqli_fetch_assoc($lcresname);
	//--------------------------------------------------------------------------------------------------------------
	// E) dibujando el reporte
	//--------------------------------------------------------------------------------------------------------------
	$ofpdf = new PDF();
	cabecera($ofpdf,$ldstar,$dataperson["cname"]);
		
	$lnVeces  = 0;
	$lnNewPag = 45;
	$lnamt    = $datasaldo["nsaldo"];
	$lnsaldo  = 0;
	
	// cargando el saldo inicial del balance.
	$ofpdf->Cell(15,5, "SI",0,0,"");   	
	$ofpdf->cell(15,5,"SI",0,0,"");   	
	$ofpdf->cell(20,5, $ldstar,0,0,"");   	
	$ofpdf->cell(100,5,"Saldo Acumulado al $ldstar ",0,0,"");   	
	$ofpdf->cell(20,5, $datasaldo["nsaldo"],0,0,"R");   
	$ofpdf->cell(20,5, $datasaldo["nsaldo"],0,1,"R");   
	
	// cargando el resto de los datos del reporte.
	while($row = mysqli_fetch_assoc($lcresult)){
		//echo "<br>".$row["ccustno"]." ".$row["cname"];
		$lnVeces ++;
		if($row["ctype"] == "IN"){
			$lcType = "Compra";
		}else{
			$lcType = "Recibo";
		}
		$ofpdf->Cell(15,5, $row["cuid"],0,0,"");   	
		$ofpdf->cell(15,5, $lcType,0,0,"");   	
		$ofpdf->cell(20,5, $row["dtrndate"],0,0,"");   	
		$ofpdf->cell(100,5, $row["mnotas"],0,0,"");   	
		$ofpdf->cell(20,5, $row["namount"],0,0,"R");   

		$lnamt = $lnamt  + $row["namount"];		   	
		$ofpdf->cell(20,5,$lnamt,0,1,"R");   
		
		if ($lnVeces == $lnNewPag){ 	
			cabecera($ofpdf,$ldstar,$dataperson["cname"]);
			$lnVeces = 1;
		}				
	}  //while($row = mysqli_fetch_assoc($lcresult)){
	$ofpdf->output();

function cabecera($ofpdf,$ldstar,$lpname){
	$ofpdf->AddPage();
	// c-1 Encabezado de la pagina.
	//----------------------------------------------------------
	$ofpdf->RPTheader("ESTADO DE CUENTA");
	$ofpdf->setfont("arial","B",10);
	$ofpdf->cell(20,5,"Periodo:",0,0,""); 
	$ofpdf->setfont("arial","",10);
	$ofpdf->cell(20,5,"Rango del $ldstar a la Fecha.",0,1,"");  
	$ofpdf->setfont("arial","B",10);
	$ofpdf->cell(20,5,"Nombre:",0,0,"");   						
	$ofpdf->setfont("arial","",10);
	$ofpdf->cell(25,5,$lpname,0,1,"");   			
	$ofpdf->cell(15,5,"",0,1,"");
	
	// c-2 Dibujando el cuerpo de la pagina
	//----------------------------------------------------------
	$ofpdf->setfont("arial","B",10);
	//$ofpdf->cell(20,5,"",0,0,"");   
	$ofpdf->cell(15,5,"Trn No",1,0,"");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(15,5,"Tipo",1,0,"");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(20,5,"Fecha ",1,0,"");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(100,5,"Descripcion Movimiento",1,0,"");	// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(20,5,"Monto",1,0,"");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(20,5,"Saldo",1,1,"R");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->setfont("arial","",10);
}	// function cabecera($ofpdf,$ldstar,$lpname){
	
/*
	$ofpdf->AddPage();
	// c-1 Encabezado de la pagina.
	//----------------------------------------------------------
	$ofpdf->RPTheader("ESTADO DE CUENTA");
	$ofpdf->setfont("arial","B",10);
	$ofpdf->cell(20,5,"Periodo:",0,0,""); 
	$ofpdf->setfont("arial","",10);
	$ofpdf->cell(20,5,"Rango del $ldstar a la Fecha.",0,1,"");  
	$ofpdf->setfont("arial","B",10);
	$ofpdf->cell(20,5,"Nombre:",0,0,"");   						
	$ofpdf->setfont("arial","",10);
	$ofpdf->cell(25,5,$dataperson["cname"],0,1,"");   			
	$ofpdf->cell(15,5,"",0,1,"");
	
	// c-2 Dibujando el cuerpo de la pagina
	//----------------------------------------------------------
	$ofpdf->setfont("arial","B",10);
	//$ofpdf->cell(20,5,"",0,0,"");   
	$ofpdf->cell(15,5,"Trn No",1,0,"");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(15,5,"Tipo",1,0,"");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(20,5,"Fecha ",1,0,"");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(100,5,"Descripcion Movimiento",1,0,"");	// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(20,5,"Monto",1,0,"");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(20,5,"Saldo",1,1,"R");   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->setfont("arial","",10);
	*/
	
	
?>		