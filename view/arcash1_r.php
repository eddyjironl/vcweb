<html>
	<head>
		<title>Resumen de Cuentas por cobrar</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/vc_estilos.css"> 
		<link rel="stylesheet" href="../css/arcash1_r.css"> 
 		<script src="../js/vc_funciones.js"></script> 
 		<script src="../js/arcash1_r.js"></script> 
	</head>
	<body>
		<form target="_blank" method="POST" action="../reports/rpt_arcash1.php" id="arcash1_r" name="arcash1_r" class= "form2">
			<script> get_barraprint("Resumen Cuentas por cobrar","Ayuda resumen de Cuentas por cobrar.");</script>
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
					<option value = "cpaycode">Condiciones</option>
					<option value = "dstar">Fecha</option>
					<option value = "cwhseno">Bodega</option>
					<option value = "crespno">Vendedor</option>
					<option value = "crefno">Referencia Manual</option>
				</select>
			</fieldset>
			<br>
			<fieldset id="area_filtros" class="fieldset">
					<label class= "labelsencilla">Area de Filtro</label>
					<br>
						<label class = "labelfiltro">Codigo Cliente</label>
						<input type="text" id="ccustno_1" name="ccustno_1" class="ckey">
						<script>get_btmenu("btccustno_1","Lista de clientes"); </script>
						<input type="text" id="ccustno_2" name="ccustno_2" class="ckey">
						<script>get_btmenu("btccustno_2","Lista de clientes"); </script>
					
					<br>
						<label class="labelfiltro">Formas de pago</label>
						<input type="text" id="cpaycode_1" name="cpaycode_1" class="ckey">
						<script>get_btmenu("btcpaycode_1","Lista de Condiciones de pago"); </script>
						<input type="text" id="cpaycode_2" name="cpaycode_2" class="ckey">
						<script>get_btmenu("btcpaycode_2","Lista de Condiciones de pago"); </script>
					
					<br>
					
					<label class="labelfiltro">Bodega id</label>
					<input type="text" id="cwhseno_1" name="cwhseno_1"  class="ckey">
					<script>get_btmenu("btcwhseno_1","Lista de Bodegas"); </script>
					<input type="text" id="cwhseno_2" name="cwhseno_2"  class="ckey">
					<script>get_btmenu("btcwhseno_2","Lista de Bodegas"); </script>
					<br>

					<label class="labelfiltro">Vendedor id</label>
					<input type="text" id="crespno_1" name="crespno_1"  class="ckey">
					<script>get_btmenu("btcrespno_1","Lista de Responsables / Vendedores"); </script>
					<input type="text" id="crespno_2" name="crespno_2" class="ckey">
					<script>get_btmenu("btcrespno_2","Lista de Responsables / Vendedores"); </script>
					<br>

					<label class="labelfiltro">Referencia</label>
					<input type="text" id="crefno" name="crefno">
					<br>

					<label class="labelfiltro">Fecha Emision </label>
					<input type="date" id="dstar_1" name="dstar_1">
					<input type="date" id="dstar_2" name="dstar_2" >
					<br>
					<!-- -->
				</fieldset>
		</form>
		
		<script>
				get_xm_menu();
				get_msg();
				//get_btdtrn("btprint2","Imprimiendo reporte", "../reports/rpt_arinvc.php");
		</script>
		
	</body>
</html>