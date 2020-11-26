<?php
include("../fpdf/fpdf.php");
class PDF extends FPDF{
	// estas son las funciones actuales.
	function RPTheader($pcdesc){
		// Logo
		//$this->Image('LOGITO1.jpg',10,8,20);
		// Arial bold 15
		$this->setfont("arial","",10);
		$this->cell(175,1,$_SESSION["compdesc"],0,1,"C");   
		
		$this->SetFont('Arial','B',11);
		// Movernos a la derecha
		$this->Cell(60);
		// Título
		$this->Cell(60,10,$pcdesc,0,0,'C');
		 // Salto de línea 25
		$this->Ln(12);
	}
	function encabezado_ec($pcname,$pctel){
		// Logo
		//$this->Image('LOGITO1.jpg',10,8,20);
		// Arial bold 15
		$this->setfont("arial","B",10);
		$this->cell(175,1,$_SESSION["compdesc"],0,1,"C");  
		$this->cell(175,10,"ESTADO DE CUENTA",0,1,"C");  

		$this->setfont("arial","",10);
		$this->cell(150,5,"Fecha:",0,0,"R");  
		$this->cell(30,5,date("d") . " del " . date("m") . " de " . date("Y"),0,1,"");  
		$this->cell(150,5,"Pagina:",0,0,"R");  
		$this->cell(30,5,$this->PageNo(),0,1,"");  

		$this->setfont("arial","B",10);
		//$this->SetFont('Arial','B',11);
		$this->Cell(60,5,"",0,1,"");
		$this->cell(35,5,"Nombre del Cliente","LTR",0,"","true");
		$this->setfont("arial","",10);
		$this->cell(75,5,$pcname,"TR",1,"L","true");
		$this->setfont("arial","B",10);
		$this->cell(35,5,"Telefono:","LBR",0,"","true");
		$this->setfont("arial","",10);
		$this->cell(75,5,$pctel,"BR",0,"","true");
		$this->Ln(12);
		/* 
		// Movernos a la derecha
		$this->Cell(60);
		// Título
		$this->Cell(60,10,$pcdesc,0,0,'C');
		 // Salto de línea 25
		$this->Ln(12); */
	}
	
	
	// Pie de página
	function Footer(){
		// Posición: a 1,5 cm del final
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		// Número de página
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
}
?>