<?php
// iniciando validacion de session
include("../modelo/vc_funciones.php");
//--------------------------------------------------------------------------------------------------------------
if (vc_funciones::Star_session() == 1){
	return;
}
?>

<html>
	<head>
		<title>Maestro de Clientes</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
 		<link rel="stylesheet" href="../css/arcust.css">
		<link rel="stylesheet" href="../css/vc_estilos.css"> 
 		<script src="../js/vc_funciones.js"></script> 
		<script src="../js/arcust.js"></script> 
	</head>
	<body>
			<form class="form2" id="arcust" method="post" action="../modelo/crud_arcust.php?accion=NEW">
				<SCRIPT>get_barraprinc_x("Catalogo de Clientes","Ayuda del Catalogo de Clientes",770);</SCRIPT> 	
				<div id="informacion_1">				
					<fieldset class="fieldset">
						<label class="labelnormal">Codigo Cliente </label>
						<input type="text" class="textkey" id="ccustno" name="ccustno">
						<script>get_btmenu("btcustno","Listado de Clientes");</script>
						<br>
						<label class="labelnormal">Fecha de Ingreso</label>
						<input type="date" class="textdate" id="dstar" name="dstar">
						<br>
						<label class="labelnormal">Nombre Completo</label>
						<input type="text" class="textcdesc" id="cname" name ="cname">
						<br>
						<label class="labelnormal">Estado</label>
						<select class="listas" id="cstatus" name="cstatus">
							<option value="">Indique Estado</option>
							<option value="OP">Activo</option>
							<option value="CL">Inactivo</option>
						</select>
						<br>
						<label class="labelnormal">Telefonos</label>
						<input type="tel" id="ctel" name="ctel"  >
						
						<br>
						<label class="labelnormal">Correo Electronico</label>
						<input type="email" id="cemail"  name="cemail" >
						<br>
						<label class="labelnormal">Pagina Web</label>
						<input type="url" id="cweb"  name="cweb"  >
						<br>
						<label class="labelnormal">Ubicacion Id</label>
						<input type="text" id="cubino"  name="cubino" class="textnormal" >
						
						<br>
						<label class="labelnormal">Categoria Id</label>
						<script>get_lista_arcate();</script>
					</fieldset>
					<br>
					<fieldset class="fieldset">
						<label>Configuracion para Facturacion</label>
						<br>
						<label class="labelnormal">Bodega Id</label>
						<script>get_lista_arwhse();</script>
						<br>
						<label class="labelnormal">Vendedor Id </label>
						<script>get_lista_arresp();</script>
						<br>
						<label class="labelnormal">Condicion de Pago</label>
						<script>get_lista_artcas();</script>
						<br>
						<label class="labelnormal">Cuenta Contable</label>
						<input type="text" id="cctaid" name="cctaid">
						<br>
						<label class="labelnormal" >Pasword de RSCTA</label>
						<input type="pasword" id="cpasword" name="cpasword" >
						<br>
						<label class="labelnormal" >Limite de Credito</label>
						<input type="number" id="nlimcrd" name="nlimcrd" class="textqty">

					</fieldset>
					<br>
					<fieldset class="fieldset">
						<label>Direccion Completa</label><br>
						<textarea id="mdirecc" name="mdirecc"  rows=3 cols=43></textarea>
						<br>
						<label>Comentarios Generales</label>
						<br>
						<textarea id="mnotas" name="mnotas"  rows=3 cols=43></textarea>

					</fieldset>
				</div>
				<div id="informacion_2">
					<fieldset class="fieldset">
						<label class="labeltitle" align="center">Fotografia del cliente</label><br>
						<figure>
							<img align= "center" id="cfoto1" name="cfoto1" src="" width="292" height="292" alt="Foto no especificada"><br>
						</figure>
						<br>
						<input type="file"	name="cfoto" id="cfoto" >
					</fieldset>
					<br>
					<fieldset class="fieldset">
						<label class="labelnormal">Ventas Brutas</label>
						<input type="number" class="sayamt" id="nsalesamt" name="nsalesamt">
						<script>get_btdtrn("bnsalesamt","Historial de Ventas");</script>
						<br>
						<label class="labelnormal">Saldo Actual</label>
						<input type="number" class="sayamt" id="nbbalance" name="nbbalance">
					</fieldset>
				</div>
			</form>
			
			<!-- Detalle de ventas  -->
			<section class="area_bloqueo" id="area_bloqueo">	
				<section id="pantalla" class="form2"  name="pantalla">
					<div class= "barra_sencilla" >
						<h1>Historial de Ventas del cliente</h1>
					</div>
					<br>
					<fieldset class="fieldset" id="area_info">
						<label class="labelnormal">Cliente Id </label>
						<input  type="text" class="saytext" id="ccustnodesc" readonly>
						<br>
						<label class="labelnormal">Compras Netas </label>
						<input  type="number" class="sayamt" id="nbsalesamt" readonly>
						<br>
						<label class="labelnormal">Saldo Actual </label>
						<input  type="number" class="sayamt" id="nbbalance2" readonly>
					</fieldset>
					<br>
					<!-- Cuadricula de movimientos de ventas-->
					<fieldset class="fieldset">
						<label class="labelsencilla">Movimientos Generales</label>
						<table id="tencabezado">
							<thead>
								<tr class="table_det">
									<th width="72px">Factura No</th>
									<th width="72px">Referencia</th>
									<th width="72px">Fecha </th>
									<th width="202px">Descripcion Movimiento</th>
									<th width="72px">Partida Cont</th>
									<th width="72px">Venta Bruta </th>
									<th width="72px">Descuento </th>
									<th width="72px">Impuesto </th>
									<th width="72px">Saldo </th>
								</tr>
							</thead>
						</table>
					</fieldset>
					
					
					
					
					<br>
					<fieldset class="fieldset" id="invoice_detail">
						<table class="table_det" id="tdetalles2">
							<tbody id="kardex"></tbody>
						</table>
					</fieldset>
		

             		<br>
					<!-- Botones de la pantalla-->
					<fieldset class="fieldset" id="btopciones">
						<script>
							get_boton("btsalir2","salir.ico","Cerrar");
						</script>
					</fieldset>
				</section>
			</section>	
          
		  <!-- Detalle de recibos  -->
			<section class="area_bloqueo" id="area_bloqueo2">	
				<section id="pantalla2" class="form2"  name="pantalla2">
					<div class="barra_sencilla">
						<h1>Detalle de pagos de Facturas</h1>
					</div>
					<br>
					<fieldset class="fieldset" id="area_info2">
						<label class="labelnormal">Cliente Id </label>
						<input  type="text" class="saytext" id="ccustnodesc2" readonly>
						<br>
						<label class="labelnormal">Factura No </label>
						<input type="text" class="saytext" id="cinvodesc" readonly>
						<br>
						<label class="labelnormal">Monto Total Facturado </label>
						<input type="number" class="sayamt" id="nsalesamt_r" readonly>
						<br>
						<label class="labelnormal">Monto pagos Recibidos </label>
						<input  type="number" class="sayamt" id="npayamt" readonly>
						<br>
						<label class="labelnormal">Saldo Actual  </label>
						<input type="number" class="sayamt" id="nbalance_r" readonly>
					</fieldset>
					<br>

					<fieldset class="fieldset" id="aencabezado2">
						<label class="labelsencilla">Movimientos Generales</label>
						<table id="tencabezado2">
							<thead>
								<tr class="table_det">
									<th width="72px">Recibo No</th>
									<th width="72px">Referencia</th>
									<th width="72px">Fecha </th>
									<th width="152px">Descripcion Movimiento</th>
									<th width="72px">Partida Cont</th>
									<th width="72px">Pago </th>
								</tr>
							</thead>
						</table>
					</fieldset>
					
					<br>
	
					<fieldset class="fieldset" id="recibos_tabla">
						<table class="table_det" id="trecibos">
							<tbody id="recibos_det"></tbody>
						</table>
					</fieldset>


					<br>
					<fieldset class="fieldset" id="btopciones2">
						<script>
							get_boton("btsalir3","salir.ico","Cerrar");
						</script>
					</fieldset>
				</section>
			</section>	
	
		<!-- Presentacion del menu -->
		<script>get_xm_menu();</script>
		<script>get_msg();</script>
	</body>
</html>