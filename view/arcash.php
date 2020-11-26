
<html>
	<head>
		<title>Recibos de Dinero</title>
		<link rel="stylesheet" href="../css/arcash.css?v1">
		<link rel="stylesheet" href="../css/vc_estilos.css?v1">
		<script src="../js/vc_funciones.js?v1"></script>
		<script src="../js/arcash.js?v1"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
	fieldset{
		display:inline-block;
		float:left;
		border:none;
	}
	#adetalles{
		margin-left:5%;
	}
</style>

</head>
	<body>
		
		<form id="arcash" name="arcash" method="post" action="../modelo/crud_arcash.php?accion=NEW" class="form2">
			<SCRIPT>get_barraprinc_trn_x("Recibos","Ayuda del Modulo de Recibos de Dinero");</SCRIPT> 
			<fieldset>
				<label class="labelnormal">Cliente Id</label>
				<script>get_lista_arcust();</script> 
				<br>
				<label class="labelnormal">Fecha del Pago</label>
				<input type="date" id="dtrndate" name="dtrndate" class="textdate">
				<br>
				<label class="labelnormal">Forma de Pago</label>
				<select id="ctype" name="ctype" class="listas">
					<option value="">Elija forma de pago</option>
					<option value="EF">Efectivo</option>
					<option value="TG">Targeta Credito</option>
					<option value="CK">Cheque </option>
				</select>
				<br>
				<label class="labelnormal">Tipo de Documento</label>
				<select id="ctypedoc" name="ctypedoc" class="listas">
					<option value="">Elija tipo de documento</option>
					<option value="RC">Recibo de Dinero</option>
					<option value="ND">Nota de Credito</option>
					<option value="RT">Retenciones </option>
					<option value="DC">Descuentos </option>
					<option value="OT">Otros Tipos de Movimientos </option>
				</select>
				<br>
				<label class="labelnormal">Descripcion Corta</label>
				<input type="text" id="cdesc" name="cdesc" class="textcdesc">
				<br>
				<label class="labelnormal">Referencia </label>
				<input type="text" id="crefno" name="crefno" class="textkey">
				<br>
				<label class="labelnormal">Cuenta Contable</label>
				<input type="text" id="cctaid" name="cctaid" class="textkey">
				<br>
				<label class="labelsencilla">Distribucion Automatica de pago</label>
				<br>
				<label class="labelnormal">Monto a Distribuir</label>
				<input type="number" id="ndistri" name="ndistri" class="textqty" title="Aplicar distribucion automatica del monto a pagar en facturas mas antiguas">
				
				
			</fieldset>
			
			<fieldset> 
				<label class="labelnormal">Tipo de Cambio</label>
				<input type="number" id="ntc" name="ntc" class="sayamt" readonly>
				<br>
				<label class="labelsencilla">Comentarios sobre el recibo</label><br>
				<textarea rows=6 cols=35 id="fmnotas" class="mnotas"></textarea>
			</fieldset>
			<br>
			<fieldset id="adetalles" >
				<label class="labelsencilla">Detalle de Facturas a Cancelar</label>
				<br>
				<table id="tdetalles" >
					<thead>
						<tr class="table_det">
							<th width="70px">Factura No</th>
							<th width="200px">Condiciones</th>
							<th width="75px">Original</th>
							<th width="70px">Vencimiento</th>
							<th width="90px">Saldo</th>
							<th width="90px">Abono </th>
						</tr>
					</thead>
					<tbody id="detalles" class="mx_formato_datos"></tbody>
				</table>
			</fieldset>
			<br>
			<fieldset>
				<label class="labelnormal">Saldo Actual</label>
				<input type="number" class="sayamt" id="ntotal" readonly>
				<br>
				<label class="labelnormal">Total Abonado</label>
				<input type="number" class="sayamt" id="npayto" readonly>
				<br>
				<label class="labelnormal">Saldo Pendiente</label>
				<input type="number" class="sayamt" id="nsalpe" readonly>
			</fieldset>
		</form>
		<script>
			get_msg();
		</script>
	</body>
</html>