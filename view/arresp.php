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
		<title>Catalogo de Proveedores</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/arresp.css?v1">
		<link rel="stylesheet" href="../css/vc_estilos.css?v1">
		<script src="../js/vc_funciones.js?v1"></script>
		<script src="../js/arresp.js?v1"></script>
	</head>
	<body>
			<!--barra principal de navegacion-->
			<form class="form2" id="arresp" method="post" action="../modelo/crud_arresp.php?accion=NEW">
				<SCRIPT>get_barraprinc_x("Catalogo de Proveedores","Ayuda del Catalogo de Proveedores",800);</SCRIPT> 
				<fieldset id="set1">
					<label class="labelnormal" >Proveedor Id </label>
					<input type="text" class="textkey" id="crespno" name="crespno"  autocomplete="off" autofocus>
					<script>get_btmenu("btcrespno","Listado de Proveedores");</script>
					<br>
					<label class="labelnormal" >Nombre </label>
					<input type="text" id="cfullname" name="cfullname" class="textcdesc">
					<br>
					<label class="labelnormal" >RUC </label>
					<input type="text" id="cruc" name="cruc" class="textnormal">
					<br>
					<label class="labelnormal" >Telefono</label>
					<input type="text" id="mtel" name="mtel" class="textnormal">
					<br>
					<label class="labelnormal" >Dias de credito</label>
					<input type="number" id="ndays" name="ndays" class="textqty">
					<br>
					<label class="labelnormal" >Estado </label>
					<select class="listas" id="cstatus" name="cstatus">
						<option value=""></option>
						<option value="">Elija un Estado</option>
						<option value="OP">Activo</option>
						<option value="CL">Anulado</option>
					</select>
					<br>
					<label class="labelnormal" >Cuenta por Pagar </label>
					<select class="listas" id="cctaid" name="cctaid">
						<option value="  ">Sin Cuenta Especificada</option>
						<option value="OP">Activo</option>
						<option value="CL">Anulado</option>
					</select>
					<br>
					<label>Direccion Completa </label><br>
					<textarea id="mdirecc" name="mdirecc" class="mnotas" rows=3 cols=43> </textarea>
					<br>
					<label>Comentarios Generales</label><br>
					<textarea id="mnotas" name="mnotas" class="mnotas" rows=3 cols=43> </textarea>
					<br>
					<label class="labeltitle"  align="center">Configuracion Dias de Visita</label><br>
					<input type="checkbox" id="llunes"     name="llunes">Lunes</input>
					<input type="checkbox" id="lmartes"    name="lmartes">Martes</input>
					<input type="checkbox" id="lmiercoles" name="lmiercoles">Miercoles</input>
					<br>
					<input type="checkbox" id="ljueves"    name="ljueves">Jueves</input>
					<input type="checkbox" id="lviernes"   name="lviernes">Viernes</input>
					<input type="checkbox" id="lsabado"    name="lsabado">sabado</input>
					<input type="checkbox" id="ldomingo"   name="ldomingo">Domingo</input>
				</fieldset>
				
				<fieldset id="set2">
					<label class="labeltitle" align="center">Fotografia del Proveedor</label><br>
					<img align= "center" id="cfoto1" name="cfoto1" src="" width="292" height="292" alt="Foto no especificada"><br>
					<input type="file"	name="cfoto" id="cfoto" >
					<br>			
					<label class="labelnormal" >Compras Netas</label>
					<input class="sayamt" id="nbuyamt" name="nbuyamt">
					<script>get_btdtrn("cdetcta","Estado de cuenta");</script>
					<br>
					<label class="labelnormal" >Por Pagar</label>
					<input class="sayamt" id="nsaldo" name="nsaldo">
					<script>get_btdtrn("cdetcta","Estado de cuenta");</script>
				</fieldset>			

			</form>
		<!-- Presentacion del menu -->
		<script>
			get_vmenu();
			get_xm_menu();
			get_msg();
		</script>
	</body>
</html>