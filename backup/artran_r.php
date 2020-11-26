<?php
	// ------------------------------------------------------------------------------------------------------------------	
	// A- Recibiendo parametros de filtros.
	// ------------------------------------------------------------------------------------------------------------------	
	$lcwhere = "  artran.cstatus = 'OP' ";
	// filtrando cliente.	
	if (isset($_GET["ccustno"])){
		$lccustno = $_GET["ccustno"];
		if(!$lccustno == ""){
			$lcwhere = $lcwhere . " and artran.ccustno = " . $lccustno ;		
		}
	}
	// armando filtro final
	if (!$lcwhere == ""){
		$lcwhere = " where " . $lcwhere;
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
		echo "se logro la coneccion ";
	}else{
		echo "Coneccion NO Establecida.";
	}

	if(!mysqli_error($oConn)){
		$lcsql = "select arcust.*, sum(artran.namount) as nsaldo 
					from artran 
					join arcust on arcust.ccustno = artran.ccustno";
		$lcsql = $lcsql . $lcwhere . " group by arcust.ccustno	";
	}else{
		echo "NO SE CONECTO.!!";
	}
	
	$lcresult = mysqli_query($oConn,$lcsql);
	//--------------------------------------------------------------------------------------------------------------
	// E) dibujando el reporte
	//--------------------------------------------------------------------------------------------------------------
	
	$ofpdf = new PDF();
	//$ofpdf->AliasNbPages();
	$ofpdf->AddPage();
	$ofpdf->SetFont('Times','',12);
		
	// c-1 Encabezado de la pagina.
	//----------------------------------------------------------
	//$ofpdf->RPTheader("Cuentas por Cobrar");
		
	// c-2 Dibujando el cuerpo de la pagina
	//----------------------------------------------------------
	$ofpdf->setfont("arial","B",10);
	$ofpdf->cell(35,5,"Codigo",1,0,"");   		// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(70,5,"Nombre ",1,0,"");   		// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(20,5,"Telefono",1,0,"");   	// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(20,5,"Saldo",1,1,"");   		// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	//$ofpdf->cell(40,5,"Comentarios",1,1,"");  // cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
		
	$ofpdf->setfont("arial","",10);
	$lnVeces  = 0;
	$lnNewPag = 48;
	$lnamt    = 0;
		
	// cargando el resto de los datos del reporte.
	while($row = mysqli_fetch_assoc($lcresult)){
		//echo "<br>".$row["ccustno"]." ".$row["cname"];
		$lnVeces ++;
		$ofpdf->Cell(35,5, $row["ccustno"],0,0,"");   	
		$ofpdf->cell(70,5, $row["cname"],0,0,"");   	
		$ofpdf->cell(20,5, $row["ctel"],0,0,"");   	
		$ofpdf->cell(20,5, $row["nsaldo"],0,1,"");   
		if ($lnVeces == $lnNewPag){
			//$ofpdf->AliasNbPages();
			//$ofpdf->AddPage();
			$lnVeces = 1;
		}				
		$lnamt = $lnamt + $row["nsaldo"];		   	
	}
	$ofpdf->setfont("arial","B",10);
	$ofpdf->cell(100,5,"",0,0,"");   	
	$ofpdf->cell(28,5, "Total Reporte " ,0,0,"");   	
	$ofpdf->cell(20,5, $lnamt ,0,0,"");   	
	$ofpdf->output();
?>		