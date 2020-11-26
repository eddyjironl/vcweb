0<html>
	<head>
		<title>Resumen de Ventas</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/vc_estilos.css"> 
		<link rel="stylesheet" href="../css/arcustb_r.css"> 
 		<script src="../js/vc_funciones.js"></script> 
 		<script src="../js/arcustb_r.js"></script> 
	</head>
	<body>
		<form target="_blank" method="POST" action="../reports/rpt_arcustb.php" id="arcustb_r" name="arcustb_r" class= "form2">
			<script> get_barraprint("Estado de cuenta","Ayuda Estado de Cuentas");</script>
		
			
			<fieldset id="area_filtros" class="fieldset">
				<br>
				<label class = "labelnormal">Codigo Cliente</label>
				<input type="text" id="ccustno_1" name="ccustno_1" class="ckey">
				<script>get_btmenu("btccustno_1","Lista de clientes"); </script>
				<input type="text" id="cname" name="cname" class="saytext">

				<br>
				<label class="labelnormal">Estilo de Presentacion </label>
				<select class="listas" id= "cformato" name="cformato">
					<option value="rango">Rango de Fechas</option>
					<option value="corte">Fecha de Corte</option>
				</select>

				<br>
				<label class="labelnormal" id="ldstar1">Rango de fechas del </label>
				<input type="date" id="dstar_1" name="dstar_1">
				<label id="ldstar11"> al </label>
				<input type="date" id="dstar_2" name="dstar_2" >

				<br>
				<label class="labelnormal" id="ldstar2" >Fecha de Corte </label>
				<input type="date" id="dstar_3" name="dstar_3">
					
				<br>
				<input type="checkbox" id="lvencidas" name="lvencidas">Solo Mostrar Facturas Vencidas unicamente </input>
				<br>
				<input type="checkbox" id="lexmoney" name="lexmoney">Mostrar en Moneda Extrangera </input>
					
			</fieldset>
		</form>
		
		<script>
				get_xm_menu();
				get_msg();
				//get_btdtrn("btprint2","Imprimiendo reporte", "../reports/rpt_arinvc.php");
		</script>
		
	</body>
</html>