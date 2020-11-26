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
		<title>Catalogo de Inventario</title>
		<link rel="stylesheet" href="../css/arserm.css?v1">
		<link rel="stylesheet" href="../css/vc_estilos.css?v1">
		<script src="../js/vc_funciones.js?v1"></script>
		<script src="../js/arserm.js?v1"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
		<form class="form2" id="arserm" name="arserm" method="post" action="../modelo/crud_arserm.php?accion=NEW">
			<SCRIPT>get_barraprinc_x("Catalogo de Inventario","Ayuda del Catalogo de Inventario");</SCRIPT> 
			<fieldset class = "fieldset">
				<label class="labelnormal">Articulo No</label>
				<input type="text" id="cservno" name="cservno" class="textkey" autocomplete="off" autofocus>
				<script>get_btmenu("btcservno","Listado de Articulos");</script>
				&nbsp &nbsp &nbsp
				<label class="labelnormal">Descripcion</label>
				<input type="text" id="cdesc" name="cdesc" class="textcdesc" autocomplete="off" >
				<br><br>
				<div class="tab">
					<button  class="tablinks" id="tbinfo1" >Informacion General</button>
					<button  class="tablinks" id="tbinfo2" >Configuracion de Componentes</button>
				</div>	

			</fieldset>	
			<div id="finfo1" class="tabcontent">
				<fieldset class= "fieldset">
					<label class="labelnormal">Descripcion Secundaria </label>
					<input type="text" id="cdesc2" name="cdesc2" class="textcdesc" autocomplete="off" >
					<br>
					<label class="labelnormal" >Estado </label>
						<select class="listas" id="cstatus" name="cstatus">
							<option value="">Elija un Estado</option>
							<option value="OP">Activo</option>
							<option value="CL">Anulado</option>
						</select>
					<br>	
					<label class="labelnormal">Categoria de Articulo</label>
					<select class="listas" id="citemtype" name="citemtype">
						<option value="">Elija un Tipo articulo</option>
						<option value="SV">Servicios</option>
						<option value="PT">Bienes / Productos Terminados</option>
						<option value="MP">Materia Prima / Insumo</option>
						<option value="AC">Acticulo Compuesto</option>
					</select>
					<br>
					<label class="labelnormal">Proveedor Id</label>
					<script> get_lista_arresp();</script>
					<br>
					<label class="labelnormal">Tipo de Articulo</label>
					<script> get_lista_artser();</script>
					<br>
					<label class="labelnormal">Ultimo Costo </label>
					<input type="number" id="nlastcost" name="nlastcost" class="sayamt" readonly>
					<br>
					<label class="labelnormal">Costo </label>
					<input type="number" id="ncost" name="ncost" class="textqty" readonly>
					<br>
					<label class="labelnormal">Impuesto % </label>
					<input type="number" id="ntax" name="ntax" class="textqty">
					<br>
					<label class="labelnormal">Descuento Maximo </label>
					<input type="number" id="ndesc" name="ndesc" class="textqty">
					<br>
					<label class="labelnormal">Precio Vta </label>
					<input type="number" id="nprice" name="nprice" class="textqty">
					<br>
					<label class="labelnormal">Existencia Minima </label>
					<input type="number" id="nminonhand" name="nminonhand" class="textqty">
					<br>			
					<label class="labelnormal" >Existencia Global </label>
					<input type="number" class="sayamt" id="nbuyamt" name="nbuyamt" readonly>
					<script>get_btdtrn("cdetcta","Kardex del Articulo");</script>

					<br>
					<label>Configuracion Contable</label>
					<br>
					<label class="labelnormal">Cuenta de Inventario </label>
					<input type="text" id="cctaid" name="cctaid" class="textnormal">
					<br>
					<label class="labelnormal">Cuenta de Costo </label>
					<input type="text" id="cctaid_c" name="cctaid_c" class="textnormal">
					<br>
					<label class="labelnormal">Cuenta de Ingreso </label>
					<input type="text" id="cctaid_i" name="cctaid_i" class="textnormal">
					<br>
					<input type="checkbox" id="lallowneg" name="lallowneg">Permitir Negativos</input>
					<br>
					<input type="checkbox" id="lupdateonhand"  name="lupdateonhand">Actualizar Existencia</input>
				</fieldset>
			
				<fieldset class= "fieldset" id="set2">
					<label class="labeltitle" align="center">Fotografia del Articulo</label><br>
					<img align= "center" id="cfoto1" name="cfoto1" src="" width="292" height="292" alt="Foto no especificada"><br>
					<input type="file"	name="cfoto" id="cfoto" >
					<br>
					<label>Comentarios Generales</label><br>
					<textarea id="mnotas" name="mnotas" class="mnotas" rows=3 cols=43> </textarea>
				</fieldset>			
			</div>
			<br>
			<div id="finfo2" class="tabcontent">
			
				<fieldset  class= "fieldset" id="codigo">
					<label class="labelnormal">Codigo de Articulo </label>
					<input type="text" class="textnormal" id="cservno1" name="cservno1" >
					<script>get_btmenu("btcservno1","Listado de Articulos");</script>
					<br>
					<br>
					<label>Detalle de Componentes del Articulo</label>
				</fieldset>
				<br>
				<fieldset class= "fieldset" id="adetalles">
					<table id="tdetalles">
						<thead>
							<tr class="table_det">
								<th width="90px">Codigo</th>
								<th width="270px">Descripcion de los Componentes</th>
								<th width="75px">Cantidad</th>
								<th width="50px">Costo</th>
								<th width="50px">Total Costo</th>
								<th width="75px">Acciones</th>
							</tr>
						</thead>
						<tbody id="articulos" class="table_det"></tbody>
					</table>
				</fieldset>
				
			</div>
			</form>
		
			<section id="pantalla_actualiza_linea">
				<section id="fupdfield" class="form2">
					<div id="div11">
						<h1>Actualizacion de Linea</h1>
					</div>
					<br>
					<fieldset>
						<label class="labelnormal">Id Linea</label>
						<input type="text" readonly id="idline" name="idline" class="saytext">
						<br>
						<label class="labelnormal">Articulo</label>
						<input type="text" readonly id="fcservno" name="fcservno" class="saytext">
						<br>
						<label class="labelnormal">Cantidad</label>
						<input type="number" id="fnqty" name="fnqty" class="textqty">
						<br><br>
						<label>Comentarios en linea de producto</label><br>
						<textarea rows=3 cols=49 id="fmnotas" class="mnotas"></textarea>
					</fieldset>
					<br>
					<div id="fbotones">
						<script>
							get_boton("bt_fupd","save.ico","Guardar");
							get_boton("bt_fsalir","salir.ico","Salir");
						</script>
					</div>
					<br>
				</section>
			</section>
			
			<!-- Detalle de kardex  -->
			<section id="area_bloqueo">	
				<section id="pantalla" class="form2"  name="pantalla">
					<div id="barra_sencilla">
						<h1>Detalle de Movimientos de Articulo</h1>
					</div>
					<br>
					<fieldset class="fieldset" id="area_info">
						<label class="labelnormal">Articulo </label>
						<input  type="text" class="saytext" id="cservnodesc" readonly>
						<br>
						<label class="labelnormal">Existencia Global </label>
						<input  type="number" class="sayamt" id="nonhand1" readonly>
						<br>
						<label class="labelnormal">Transacciones Totales </label>
						<input  type="number" class="sayamt" id="ntrntot" readonly>
					</fieldset>
					<br>

					<fieldset class="fieldset" id="aencabezado">
						<label class="labelsencilla">Movimientos Generales</label>
						<table id="tencabezado">
							<thead>
								<tr class="table_det">
									<th width="72px">Bodega Id</th>
									<th width="72px">Origen</th>
									<th width="72px">Trans No</th>
									<th width="72px">Referencia</th>
									<th width="72px">Fecha </th>
									<th width="182px">Descripcion Movimiento</th>
									<th width="72px">Cantidad </th>
									<th width="72px">Costo </th>
								</tr>
							</thead>
						</table>
					</fieldset>
					<br>
					<fieldset class="fieldset" id="adetalles2">
						<table class="table_det" id="tdetalles2">
							<tbody id="kardex"></tbody>
						</table>
					</fieldset>
		  	        <br>
					
					<fieldset class="fieldset" id="bodegas_encabezado">
						<label class="labelsencilla">Existencias por Bodega</label>
						<table id="bodega_tabla_header">
							<thead>
								<tr class="table_det">
									<th width="72px">Bodega Id</th>
									<th width="202px">Descripcion Bodega</th>
									<th width="72px">Cantidad </th>
								</tr>
							</thead>
						</table>
					</fieldset>
					<br>
					<fieldset class="fieldset" id="adetalles3">
						<table class="table_det" id="tdetalles3">
							<tbody id="kardex_bodega"></tbody>
						</table>
					</fieldset>
					<br>
					<fieldset class="fieldset" id="btopciones">
						<script>
							get_boton("btsalir2","salir.ico","Cerrar");
						</script>
					</fieldset>
				   
				</section>
			</section>	
		
		<script>
			get_msg();
			get_xm_menu();
			//get_vmenu();
		</script>
	</body>
</html>