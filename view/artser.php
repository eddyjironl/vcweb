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
		<title>Tipos de Inventarios</title>
		<link rel="stylesheet" href="../css/vc_estilos.css?v1">
		<script src="../js/vc_funciones.js?v1"></script>
		<script src="../js/artser.js?v1"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	
	<body>
		<form class="form2" id="artser" name="artser" method="post" action="../modelo/crud_artser.php?accion=NEW">
			<script>get_barraprinc_x("Tipos de Inventarios","Ayuda del Tipos de Inventarios");</script> 	
			<fieldset class="fieldset">
				<label class="labelnormal">Tipo Id</label>
				<input type="text" id="ctserno" name="ctserno" class="textkey" autocomplete="off" autofocus>
				<script>get_btmenu("btctserno","Listado de Tipos de Inventarios");</script>
				<br>
				<label class="labelnormal">Descripcion</label>
				<input type="text" id="cdesc" name="cdesc" class="textcdesc" autocomplete="off">
				<br>
				<label class="labelnormal" >Estado </label>
				<select class="listas" id="cstatus" name="cstatus">
					<option value="">Elija un Estado</option>
					<option value="OP">Activo</option>
					<option value="CL">Anulado</option>
				</select>
				<br>
				<label class="labelsencilla">Comentarios Generales</label><br>
				<textarea id="mnotas" name="mnotas" class="mnotas" rows=9 cols=55> </textarea>
			</fieldset>
		</form>
		<script>
			get_xm_menu();
			get_msg();
		</script>
	</body>
</html>