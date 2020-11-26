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
		<title>Configuracion de Compañia</title>
		<link rel="stylesheet" href="../css/vc_estilos.css?v1">
		<script src="../js/vc_funciones.js?v1"></script>
		<script src="../js/sycomp.js?v1"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	
	<body>
		<form class="form2" id="sycomp" name="sycomp" method="post" action="../modelo/crud_sycomp.php?accion=NEW">
			<script>get_barraprinc_x("Configuracion de la Compañia","Ayuda configuracion de la Compañia");</script> 	
			<fieldset class="fieldset">
				<label class="labelnormal">Compañia Id</label>
				<input type="text" id="ccompid" name="ccompid" class="textkey" autocomplete="off" autofocus>
				<script>get_btmenu("btcompid","Listado de Compañias");</script>
				<br>
				<label class="labelnormal">Nombre Compañia</label>
				<input type="text" id="compdesc" name="compdesc" class="textcdesc" autocomplete="off">
				<br>
				<label class="labelnormal" >Estado </label>
				<select class="listas" id="cstatus" name="cstatus">
					<option value="">Elija un Estado</option>
					<option value="OP">Activo</option>
					<option value="CL">Anulado</option>
				</select>
				<br>
				<label class="labelnormal">Telefono</label>
				<input type="text" id="ctel" name="ctel" class="" >
				<br>
				<label class="labelnormal">Fax</label>
				<input type="text" id="cfax" name="cfax" class="" >
				<br>
				<label class="labelnormal">Direccion del Negocio</label>
				<input type="text" id="mdirecc" name="mdirecc" class="textcdesc" >
				<br>
				<label class="labelnormal">Pais</label>
				<input type="text" id="cpais" name="cpais" class="textcdesc" >
				<br>
				<label class="labelnormal">Ciudad</label>
				<input type="text" id="cciudad" name="cciudad" class="textcdesc" >
				<br>
				<label class="labelsencilla">Configuracion Contable</label>
				<br>
				<label class="labelnormal">No de Periodos Fiscales</label>
				<input type="number" id="nanofisc" name="nanofisc" class="nqtytext" >
				<br>
				<input type="checkbox" id="lunicontdat" name="lunicontdat">Compañia de Unificacion Contable</input>
				<br>
				<label class="labelsencilla">Parametros de Coneccion</label>
				<br>
				<label class="labelnormal">Usuario</label>
				<input type="text" id="cuserid" name="cuserid" class="textcdesc" >
				<br>
				<label class="labelnormal">Clave</label>
				<input type="text" id="cpasword" name="cpasword" class="textcdesc" >
				<br>
				<label class="labelnormal">Hosting Name</label>
				<input type="text" id="chost" name="chost" class="textcdesc" >
				<br>
				<label class="labelnormal">DB Name</label>
				<input type="text" id="dbname" name="dbname" class="textcdesc" >
			</fieldset>
			<fieldset class="fieldset">
				<label class="labeltitle" align="center">Logo</label><br>
				<img align= "center" id="cfoto1" name="cfoto1" src="" width="292" height="292" alt="Foto no especificada"><br>
				<input type="file"	name="cfoto" id="cfoto" >
			</fieldset>
		</form>
	
		<script>
			get_xm_menu();
			get_msg();
		</script>
	</body>
</html>