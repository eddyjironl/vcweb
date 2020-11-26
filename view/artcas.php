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
		<title>Condiciones de Pago</title>
		<link rel="stylesheet" href="../css/artcas.css?v1">
		<link rel="stylesheet" href="../css/vc_estilos.css?v1">
		<script src="../js/vc_funciones.js?v1"></script>
		<script src="../js/artcas.js?v1"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	
	<body>
		<form class="form2" id="artcas" name="artcas" method="post" action="../modelo/crud_artcas.php?accion=NEW">
			<script>get_barraprinc_x("Condiciones de Pago","Ayuda del Condiciones de pago");</script> 	
			<fieldset>
				<label class="labelnormal">Condicion Id</label>
				<input type="text" id="cpaycode" name="cpaycode" class="textkey" autocomplete="off" autofocus>
				<script>get_btmenu("btcpaycode","Listado de condiciones");</script>
				<br>
				<label class="labelnormal">Descripcion</label>
				<input type="text" id="cdesc" name="cdesc" class="textcdesc" autocomplete="off">
				<br>
				<label class="labelnormal">Dias Plazo</label>
				<input type="number" id="nday" name="nday" class="textqty" >
				<br>
				<label class="labelnormal" >Estado </label>
				<select class="listas" id="cstatus" name="cstatus">
					<option value="">Elija un Estado</option>
					<option value="OP">Activo</option>
					<option value="CL">Anulado</option>
				</select>
				<br>	
				<label class="labelsencilla">Configuracion Contable</label>
				<br>
				<label class="labelnormal">Credito a Ventas</label>
				<input type="text" id="cctaid1" name="cctaid1" class="textkey" >
				<br>
				<label class="labelnormal">Cargo a Descuento</label>
				<input type="text" id="cctaid2" name="cctaid2" class="textkey" >
				<br>
				<label class="labelnormal">Credito Impuesto</label>
				<input type="text" id="cctaid3" name="cctaid3" class="textkey" >
				<br>
				<label class="labelnormal">Cargo Retencion</label>
				<input type="text" id="cctaid4" name="cctaid4" class="textkey" >
				<br>
				<label class="labelnormal">Cargo Caja</label>
				<input type="text" id="cctaid5" name="cctaid5" class="textkey" >
			</fieldset>
			
			<fieldset>
				<label>Comentarios Generales</label><br>
				<textarea id="mnotas" name="mnotas" class="mnotas" rows=9 cols=43> </textarea>
				<br>
				<input type="checkbox"  id="lvalidcrd" name="lvalidcrd" >Exijir Verificacion de Limite de credito a la hora de vender</input>
				<br>
				<input type="checkbox" id="lqtypay" name="lqtypay">Proponer la cantidad a pagar en avances de facturacion</input>
			</fieldset>
		
		</form>
	
		<script>
			get_vmenu();
			get_msg();
			get_xm_menu();
		</script>
	</body>
</html>