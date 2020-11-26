		<title>Modulo Cotizaciones</title>
		<link rel="stylesheet" href="../css/mx_menu.css?v1">
		<script src="../js/mx_menu.js?v1"></script>
		<script src="../js/vc_funciones.js"></script>
		<link rel="stylesheet" href="../css/vc_estilos.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">


		<input type="button" id="bt1" value="cargar menu">

		<!-- Pantalla de menu -->
		<section class="mx_area_bloqueo" id="area_menu">
			<section class="form2" id="form_menu">
				<!-- Barra de la vista de menu-->
				<fieldset class="mx_barra_sencilla" id="mx_barra_sencilla">
					<strong id="mx_titulo">Registrar Nuevo Usuario</strong>
					<br>
					<label class="labelnormal">Ordenado por </label>
					<select class="listas" id="mx_opc_order"></select>
					<br>					
					<label class="labelnormal">Buscar</label>
					<input type="text" id="mx_cbuscar" name="mx_cbuscar" class="textnormal">
				</fieldset>
				<br>

				<div class="mx_area_encabezado">
					<table id="mx_head" class="mx_formato_datos"></table>
				</div>
				<br> 
				
				<div class="mx_area_detalles">
					<table id="mx_detalle" class="mx_formato_datos"></table>
				</div>
				
				<div class= "mx_area_encabezado">
					<script>
						get_boton("bt_menu_salir","salir.ico","Cerrar");	
					</script>
				</div>
			</section>
		</section>
		