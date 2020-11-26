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
		<title>Modulo Facturacion</title>
		<link rel="stylesheet" href="../css/arinvc.css?v1">
		<link rel="stylesheet" href="../css/vc_estilos.css?v1">
		<script src="../js/vc_funciones.js?v1"></script>
		<script src="../js/arinvc.js?v1"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>

	<body>
		<form class="form2" name="arinvc" id="arinvc" method="post" action="../modelo/crud_arinvc.php?accion=SAVE">
			<SCRIPT>get_barraprinc_trn_x("Facturacion","Ayuda del Modulo de Facturacion");</SCRIPT> 
			<section>
				<fieldset id="set1">
					<label class="labelnormal">Cliente </label> 
					<script>get_lista_arcust();</script> 
					<br>
					<label class="labelnormal">Bodega </label>
					<script>get_lista_arwhse();</script>&nbsp &nbsp &nbsp &nbsp
					<br>
					<label class="labelnormal">Condiciones </label> 
					<script>get_lista_artcas();</script>
					<br>
					<label class="labelnormal">Vendedor </label> 
					<script>get_lista_arresp();</script>
					<br>
					<label class="labelnormal">Fecha Emision </label> 
					<input type="date" name="dstardate" id="dstardate" class="textdate">
					<br>
					<label class="labelnormal">Fecha Vencimiento </label>
					<input type="date" name="denddate" id="denddate" class="textdate">
					<br>
					<label class="labelnormal">No. Factura</label> 
					<input type="text" class="textnormal" id="crefno" name="crefno"  >
					<br>
					<label class="labelnormal">Nombre</label> 
					<input type="text" class="textnormal" id="cdesc" name="cdesc"  >
				</fieldset>
				<br>
				<fieldset id="set2">
					<label class="labelnormal">Referencia No. </label> 
					<input type="text" class="sayamt" id="xtrnno" name="xtrnno" readonly  >
					<br>
					<label class="labelnormal">Tipo Cambio </label> 
					<input type="number" class="sayamt" id="ntc" name="ntc" readonly  >
					<br>
					<label class="labelnormal">Limite Credito</label> 
					<input type="number" class="sayamt" id="nlimcrd" name="nlimcrd" readonly  >
					<br>
					<label class="labelnormal">Credito Disponible </label> 
					<input type="number" class="sayamt" id="nsalecust" name="nsalecust" readonly  >
					<br>
					<label class="labelsencilla">Comentarios generales de la factura</label><br>
					<textarea id="mnotas" name="mnotas"  class="mnotas" rows=3 cols=34></textarea>
				</fieldset>
			</section>
			
			<fieldset id="set3">
				<label class="labelnormal">Codigo de Articulo </label>
				<input type="text" class="textnormal" id="cservno1" name="cservno1" >
				<script>get_btmenu("btcservno","Listado de articulos");</script>
				<br>
				<br>
			</fieldset>

			<section id="pantalla_actualiza_linea">
				<section id="fupdfield" class="form2">
					<div id="div11">
						<h1>Actualizacion de Linea</h1>
					</div>
					<br>
					<fieldset>
						<label class="labelnormal">Id Linea</label>
						<input type="text" readonly id="idline" name="idline" class="saytext">
						<br>
						<label class="labelnormal">Articulo</label>
						<input type="text" readonly id="fcservno" name="fcservno" class="saytext">
						<br>
						<label class="labelnormal">Precio</label>
						<input type="number" id="fnprice" name="fnprice" class="textqty">
						<br>
						<label class="labelnormal">% Impuesto</label>
						<input type="number" id="fntax" name="fntax" class="textqty">
						<br>
						<label class="labelnormal">Descuento</label>
						<input type="number" id="fndesc" name="fndesc" class="textqty">
						<br>
						<label class="labelnormal">Cantidad</label>
						<input type="number" id="fnqty" name="fnqty" class="textqty">
						<br><br>
						<label>Comentarios en linea de producto</label><br>
						<textarea rows=3 cols=49 id="fmnotas" class="mnotas"></textarea>
					</fieldset>
					<br>
					<div id="fbotones">
						<script>
							get_boton("bt_fupd","save.ico","Guardar");
							get_boton("bt_fsalir","salir.ico","Salir");
						</script>
					</div>
					<br>
				</section>
			</section>

			<section id="adetalles">
				<table id="tdetalles">
					<thead>
						<tr class="table_det">
							<th width="90px">Codigo</th>
							<th width="220px">Descripcion de Producto</th>
							<th width="75px">Precio</th>
							<th width="75px">Cantidad</th>
							<th width="50px">Desc %</th>
							<th width="50px">IVA %</th>
							<th width="75px">Monto</th>
							<th width="75px">Acciones</th>
						</tr>
					</thead>
					<tbody id="articulos"></tbody>
				</table>
			</section>
		
			<fieldset id="set4">
				<label class="labelnormal">Sub Total</label>
				<input type="text" id="nsubamt" name="nsubamt" class="sayamt" readonly>
				<br>
				<label class="labelnormal">Descuento</label>
				<input type="text" id="ndescamt"  class="sayamt" readonly>
				<br>
				<label class="labelnormal">Impuesto</label>
				<input type="text" id="ntaxamt"  class="sayamt" readonly>
				<br>	
				<label class="labelnormal">Total General</label>
				<input type="text" name="ntotamt" id="ntotamt" class="sayamt" readonly >
			</fieldset>


			<section id="pantalla_pago">	
				<section id="fpago" class="form2"  name="fpago">
					<div id="div1">
						<h1>Creacion de Factura</h1>
					</div>
					<br>

					<fieldset id="set7">
						<label class="labelnormal">Trans No</label>
						<input type="text" class="saytext" id="ctrnno1" readonly>
						<br>
						<label class="labelnormal">Fecha de recibo</label>
						<input type="date" name="dpay" id="dpay" class="textdate">
						<br>
						<label class="labelnormal">Forma de Pago</label>
						<select id="ctype" name="ctype" class="listas">
							<option value="EF">Efectivo</option>
							<option value="TG">Targeta Credito</option>
							<option value="CK">Cheque </option>
						</select>
						<br>
						<label class="labelnormal">Referencia # </label>
						<input type="text" name="cref" id="cref" class="textnormal">
						<br>
						<label class="labelnormal">Descripcion</label>
						<input type="text" name="cdescpay" id="cdescpay" class="textnormal">
						<br><br>
						<label>Comentarios del recibo</label><br>
						<textarea class="mnotas" id="mnotasr" name="mnotasr"  rows=3 cols=49></textarea>
						<br>
					</fieldset>
					<br>
					<fieldset id="set5">
						<label id="set51">Monto Total</label>
						<input type="text" class="sayamt" id="topay" readonly>
						<br>
						<label id="set52">Abono</label>
						<input type="number" id="efectivo" name="efectivo" class="textqty">
						<br>
						<label id="set53">Cambio</label>
						<input type="number" class="sayamt" id="vuelto" readonly>
						<br>
						<br>
					</fieldset>
					<BR>
					<div id="set6">
						<script>
							get_boton("btsalvar","guardar.ico","Pagado");
							get_boton("btsalir","anular.gif","Volver");
							get_boton("btVer","printer.gif","Factura");
							get_boton("btnuevaf","nueva.ico","Nueva");
						</script>
					</div>
					<br>
				</section>
			</section>	
		</form>
		<script>
			get_msg();
			get_xm_menu();
		</script>
	</body>
</html>