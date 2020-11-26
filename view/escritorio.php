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
		<title>Sistema Visual Control v2020</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">		
		<link   rel="stylesheet" href="../css/escritorio.css?v1"> 
		<link   rel="stylesheet" href="../css/vc_estilos.css?v1">
		<script src="../js/vc_funciones.js?v1"></script>
		<script src="../js/escritorio.js?v1" ></script>
	</head>
	<body>
		<iframe id="ventana"></iframe>
		<section id="barra_screen">
			<fieldset class="fieldset_scren">
				<img src="../photos/logito1.jpg" id="logo">
			</fieldset>
			<fieldset class="fieldset_scren" id="labels">
				<p id="system_name">Sistema Visual Control Web 2020</p>
			</fieldset>
			
			<fieldset class="fieldset_scren" id="area_menu">
				<label class="labelnormal">Compañia</label>
				<!-- <label class="labeltitle">Compañia de pruebas</label> -->
				<input type="text" id="cia_desc"  readonly>
				<script>get_btmenu("btcias","Listado de Compañias");</script>
				<br>
				<label class="labelnormal">Sistema</label>
				<select class="listas" id="cmodule_select">
					<option value=""> Elija un Modulo de trabajo</option>
					<option value="SY"> Administracion</option>
					<option value="AR"> Facturacion y Cuentas por cobrar</option>
					<option value="IN"> Control de inventario y Cuentas por pagar</option>
					<option value="CT"> Contabilidad General</option>
				</select>
				<nav id="bmenu"></nav>
			</fieldset>
		</section>
		<?php
			include("introduccion.php");
		?>

		<img src="../photos/VC2009-AUM.gif" id="fondo">

		<script>
			get_xm_menu();
			get_msg();

		</script>
	</body>
</html>