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
		<title>Categorias Varias</title>
		<link rel="stylesheet" href="../css/vc_estilos.css?v1">
		<link rel="stylesheet" href="../css/armone.css?v1">
		
		<script src="../js/vc_funciones.js?v1"></script>
		<script src="../js/armone.js?v1"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>

	<body>	
		<form id="armone" name="armone" class="form2" method="post" action="../modelo/crud_armone.php">
			<div id="barra_encabezado">
				<h3>Modulo de Tipos de Cambio </h3>
			</div>
			<br>
			<fieldset class="fieldset">
				<table>
					<thead>
						<tr class="table_det">
							<th width="100px">Fecha</th>
							<th width="70px">T/C</th>
							<th width="75px">Acciones</th>
						</tr>
					</thead>
				</table>
			</fieldset>
			<br>
			<fieldset class="fieldset" id="adetalles">
				<table id="tdetalles">
					<tbody id="detalles"></tbody>
				</table>
			</fieldset>
			<br>
			<fieldset class="fieldset" id="insertar">
				<label class="labelnormal">Fecha</label>
				<input type="date" class="textdate" id="dtrndate" name="dtrndate" >
				<br>
				<label class="labelnormal">Taza de Cambio  </label>
				<input type="number" class="textqty" id="ntc" name="ntc" >
				<br><br>
				<script>
					get_boton("btsave","save.ico","Guardar");
					get_boton("btquit","salir.ico","Salir");
				</script>
			</fieldset>
		</form>
		<script>
			get_vmenu();
			get_msg();
		</script>
	</body>
</html>