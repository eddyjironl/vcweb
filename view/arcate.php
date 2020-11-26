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
		<script src="../js/vc_funciones.js?v1"></script>
		<script src="../js/arcate.js?v1"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	
	<body>
		<form class="form2" id="arcate" name="arcate" method="post" action="../modelo/crud_arcate.php?accion=NEW">
			<script>get_barraprinc_x("Tipos de Requisas / Entradas y Salidas","Ayuda de Tipos de Requisas");</script> 	
			<fieldset class="fieldset">
				<label class="labelnormal">Categoria Id</label>
				<input type="text" id="ccateno" name="ccateno" class="textkey" autocomplete="off" autofocus>
				<script>get_btmenu("btccateno","Listado de Categorias");</script>
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
				<label class="labelnormal" >Tipo de Categoria </label>
				<select class="listas" id="ctypecate" name="ctypecate">
					<option value="">Elija un Tipo Categoria</option>
					<option value="A">Ajustes de Inventarios</option>
					<option value="P">Proveedores</option>
					<option value="C">Clientes</option>
				</select>
				<br>
				<label class="labelnormal" >Comportamiento </label>
				<select class="listas" id="ctypeadj" name="ctypeadj" title="Si la Categoria es Ajuste de inventario Elija un Comportamiento">
					<option value="">Elija un Comportamiento</option>
					<option value="E">Entrada</option>
					<option value="S">Salida</option>
				</select>
				<br>
				<label class="labelnormal" >Cuenta Contable</label>
				<input type="text" id="cctaid" name="cctaid" class="textkey" autocomplete="off">
				<input type="checkbox" id="lctaresp" name="lctaresp">Usar Cuenta del Proveedor</input>
				<br>
				<label class="labelnormal" >Cuenta Impuesto</label>
				<input type="text" id="cctaid_tax" name="cctaid_tax" class="textkey" autocomplete="off">
				<br>
				<input type="checkbox" id="lexpcont" name="lexpcont">Incluir en movimientos exportables a Contabilidad</input>
				<br>
				<input type="checkbox" id="lupdcost" name="lupdcost">Actualizar el Costo cuando el movimiento sea una Compra</input>
				
				<br>
				<label class="labelsencilla">Comentarios Generales</label><br>
				<textarea id="mnotas" name="mnotas" class="mnotas" rows=9 cols=55> </textarea>
			</fieldset>
		</form>
		<script>
			get_vmenu();
			get_xm_menu();
			get_msg();
		</script>
	</body>
</html>