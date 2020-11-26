<html>
	<head>
		<title>Resumen de Cobros</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/vc_estilos.css"> 
		<link rel="stylesheet" href="../css/arcash_r.css"> 
 		<script src="../js/vc_funciones.js"></script> 
 		<script src="../js/arcash_r.js"></script> 
	</head>
	<body>
		<form target="_blank" method="POST" action="../reports/rpt_arcash.php" id="arcash_r" name="arcash_r" class= "form2">
			<script> get_barraprint("Resumen de Cobros","Resumen de Cobros.");</script>
			<fieldset class="fieldset" id="area_visualizaciones">
				<label class="labelsencilla">Visualizacion</label>
				<br>
				<fieldset id="botones">
					<input type="radio" id="cgrupo" name="cgrupo" value="agrupado" checked>Detallado
    				<br>
					<input type="radio" id="cgrupo" name="cgrupo" value="subtotal">Subtotales
				</fieldset>
    			<br>
				<label class="labelnormal">Ordenamiento por </label>
				<select id="corden" name="corden" class="listas">
					<option value = "''">Listado General</option>
					<option value = "ccustno">Codigo de Cliente</option>
					<option value = "ctype">Forma de pago</option>
					<option value = "dtrndate">Fecha del pago</option>
					<option value = "crefno">Referencia Manual</option>
				</select>
			</fieldset>
			<br>
			<fieldset id="area_filtros" class="fieldset">
					<label class= "labelsencilla">Area de Filtro</label>
					<br>
						<label class = "labelfiltro">Codigo Cliente</label>
						<input type="text" id="ccustno_1"  name="ccustno_1" class="ckey">
						<script>get_btmenu("btccustno_1","Lista de clientes"); </script>
						<input type="text" id="ccustno_2"  name="ccustno_2" class="ckey">
						<script>get_btmenu("btccustno_2","Lista de clientes"); </script>
					
					<br>
						<label class="labelfiltro">Formas de pago</label>
						<select id="ctype"  name="ctype" >
							<option value="">Cualquiera</option>
							<option value="EF">Efectivo</option>
							<option value="TG">Targeta</option>
							<option value="CK">Cheque</option>
							<option value="NC">Nota Credito</option>
						</select>
					<br>
					

					<label class="labelfiltro">Referencia</label>
					<input type="text" id="crefno" name="crefno">
					<br>

					<label class="labelfiltro">Fecha Emision </label>
					<input type="date" id="dtrndate_1" name="dtrndate_1" >
					<input type="date" id="dtrndate_2" name="dtrndate_2" >
					<br>
					<!-- -->
				</fieldset>
		</form>
		
		<script>get_xm_menu();
				get_msg();
		</script>
		
	</body>
</html>