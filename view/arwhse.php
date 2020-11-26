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
		<title>Catalogo de Bodegas</title>
		<link rel="stylesheet" href="../css/vc_estilos.css?v1">
		<script src="../js/vc_funciones.js?v1"></script>
		<script src="../js/arwhse.js?v1"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	
	<body>
		<form class="form2" id="arwhse" name="arwhse" method="post" action="../modelo/crud_arwhse.php?accion=NEW">
			<script>get_barraprinc_x("Catalogo de Bodegas","Ayuda del Catalogo de Bodegas");</script> 	
			<fieldset class="fieldset">
				<label class="labelnormal">Bodega Id</label>
				<input type="text" id="cwhseno" name="cwhseno" class="textkey" autocomplete="off" autofocus>
				<script>get_btmenu("btcwhseno","Listado de Catalogos de Bodegas");</script>
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
				<label class="labelnormal">Responsable Id</label>
				<script>get_lista_arresp();</script>
				<br>
				<label class="labelnormal">Telefono </label>
				<input type="text" id="mtel" name="mtel" class="textnormal">
				<br>
				<label class="labelsencilla">Direccion Completa</label><br>
				<textarea id="mdirecc" name="mdirecc" class="mnotas" rows=9 cols=55> </textarea>
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