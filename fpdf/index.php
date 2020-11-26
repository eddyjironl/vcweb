<?php 
	include("fpdf.php");
	$oPdf = new fpdf();
	$lchtml = " <html> 
					<body>
						<h1>Lista de precios</h1>
						
						<table>
							<TH>CODIGO</TH>
							<TH>DESCRIPCION </TH>
							<TR>
								<TD>0001</TD>
								<TD>la chucha perucha</TD>
							</TR>
							<TR>
								<TD>0002</TD>
								<TD>la picachu</TD>
							</TR>
							<TR>
								<TD>0003</TD>
								<TD>Rambito</TD>
							</TR>
						</table>
					</body>
				</html>";
	
	//echo $lchtml;
	
	$oPdf->addpage();
	
	//$oPdf->setfont("arial","b",19);
	//$oPdf->cell(19,1,"Hola mundo con php ",1,"C","");
	
	
	
	$oPdf->output();
	//$oPdf->output("edito.pdf","f");
	
	

?>