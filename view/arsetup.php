<?php
// iniciando validacion de session
include("../modelo/vc_funciones.php");
//--------------------------------------------------------------------------------------------------------------
if (vc_funciones::Star_session() == 1){
	return;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Configuracion Modulo VC2019 WEB</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/arsetup.css">
		<link   rel="stylesheet" href="../css/vc_estilos.css?v1">
		<script src="../js/vc_funciones.js"></script>
		<script src="../js/arsetup.js"></script>
	</head>
	
	<body >
		<form method="post" action="../modelo/arsetup_crud.php" name="arsetup" id= "arsetup" class="form">

			<div class="tab">
				<button  class="tablinks" id="tbinfo1" >Informacion General</button>
				<button  class="tablinks" id="tbinfo2" >Reportes</button>
			</div>		
			<div id="finfo1" class="tabcontent">
				<fieldset>
					<label class="labeltitle">Configuracion de Consecutivos</label><br>
					<label for="ninvno" class="labelnormal" >No Factura</label>
					<input class="textqty" type="number" id="ninvno" name="ninvno"></input><br>
					<label for="ncashno" class="labelnormal" >No Recibo</label>	
					<input class="textqty" type="number" id="ncashno" name="ncashno"></input><br>
					<label for="nadjno" class="labelnormal" >No de Requisa</label>	
					<input class="textqty" type="number" id="nadjno" name="nadjno"></input><br>
					<label for="nncno" class="labelnormal" >Nota de Credito</label>	
					<input class="textqty" type="number" id="nncno" name="nncno"></input><br>
					<label for="nndno" class="labelnormal" >Nota de Debito</label>	
					<input class="textqty" type="number" id="nndno" name="nndno"></input><br>
					<label for="ncotno" class="labelnormal" >No Cotizacion</label>	
					<input class="textqty" type="number" id="ncotno" name="ncotno"></input><br>
				</fieldset>	
				
				<fieldset>
						<label class="labeltitle">Configuracion predeterminada de Facturacion</label><br>
						<label class="labelnormal" >Cliente </label>	
						<script>get_lista_arcust();</script>
						<br>
						<label class="labelnormal" >Bodega de Salida</label>
						<script>get_lista_arwhse();</script>
						<br>
						<label class="labelnormal" >Forma de pago </label>	
						<script>get_lista_artcas();</script>
						<br>
						<label for="ninvlinmax" class="labelnormal" >Lineas de Factura</label>	
						<input class="textqty" type="number" id="ninvlinmax" name="ninvlinmax"></input>
						<br>
						<label for="ninvlinmax" class="labelnormal" >Monto Caja Chica</label>	
						<input class="textqty" type="number" id="ncashamt" name="ncashamt"></input>
						<br>
						
						<label class="labeltitle">Configuracion Inventarios</label>
						<br>
						<label class="labelnormal" >Codigo Compras</label>	
						<script>get_lista_arcate();</script>
						<br>
						<label class="labelnormal" >Metodo de Costeo</label>	
						<SELECT class="listas" id="ctypcost" name="ctypcost" >
							<option value="">No definido</option>
							<option value="PR">Costo Promedio</option>
							<option value="UL">Ultimo Costo Recibido</option>
						</select>
						<br>
						<label class="labelnormal" >IVA en el Costo</label>	
						<SELECT class="listas" id="ctaxproc" name="ctaxproc" >
							<option value="">No definido</option>
							<option value="IN">Incluir el IVA en Costo del Articulo</option>
							<option value="EX">No Incluir el IVA en el costo del articulo</option>
						</select>
				</fieldset>				
			</div>
			<div id="finfo2" class="tabcontent">
				<fieldset>
					<label class="labeltitle">Configuracion de Comentarios</label>
					<br>
					<input type="checkbox" id="linvno"  name="linvno">Aplicar Comentarios en Facturas</input>
					<br>
					<input type="checkbox" id="lestados" name="lestados">Aplicar Comentarios en Estados de Cuenta</input>
					<br>
					<input type="checkbox" id="lcoti"    name="lcoti">Aplicar Comentarios en Cotizaciones</input>
					<br>
					<label class="labeltitle"> Comentarios al pie de la Factura </label>
					<br>
					<textarea id="minvno" name="minvno" name="minvno" rows="5" cols="43"></textarea>
					<br>
					<label class="labeltitle"> Comentarios al pie de los Estados de Cuenta </label>
					<br>
					<textarea id="mestados" name="mestados" rows="5" cols="43"></textarea>
					<br>
					<label class="labeltitle"> Comentarios al pie de las Cotizaciones </label>
					<br>
					<textarea id="mcoti" name="mcoti" rows="5" cols="43"></textarea>
				</fieldset>
			</div>

			<div id="div_botones">
				<script>
					get_btprinc("btquit","btquit");
					get_btprinc("btsave","btsave");
					get_msg();
				</script>
			</div>
		</form>
	</body>
</html>