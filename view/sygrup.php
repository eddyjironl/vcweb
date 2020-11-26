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
		<title>Configuracion Grupos y Usuarios</title>
		<link rel="stylesheet" href="../css/sygrup.css?v1">
		<link rel="stylesheet" href="../css/vc_estilos.css?v1">
		<script src="../js/vc_funciones.js?v1"></script>
		<script src="../js/sygrup.js?v1"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
		<form class="form2" id="sygrup" name="sygrup" method="post" action="../modelo/crud_sygrup.php?accion=NEW">
			<script>get_barraprinc_x("Configuracion de usuarios y grupos","Ayuda configuracion de grupos y usuarios");</script> 	
			<fieldset class="fieldset">
				<label class="labelnormal">Grupo Id</label>
				<input type="text" id="cgrpid" name="cgrpid" class="textkey" autocomplete="off" autofocus>
				<script>get_btmenu("btgrupid","Listado de Grupos");</script>
				<br>
				<label class="labelnormal">Nombre Grupo</label>
				<input type="text" id="cdesc" name="cdesc" class="textcdesc" autocomplete="off">
				<br>					
				<label class="labelnormal" >Estado </label>
				<select class="listas" id="cstatus" name="cstatus">
					<option value="">Elija un Estado</option>
					<option value="OP">Activo</option>
					<option value="CL">Anulado</option>
				</select>
				<br>
				<div class="tab">
					<button  class="tablinks" id="tbinfo1" >Usuarios </button>
					<button  class="tablinks" id="tbinfo2" >Permisos</button>
				</div>	
			</fieldset>
			<br>
			<div id="finfo1" class="tabcontent">
				<fieldset class="fieldset">
					<label class="labelsencilla"> Listado de Usuarios del Grupo</label>
					<section id="seccion_usuarios" class="area_detalles">
						<table id="tablah_usuarios"  >
							<thead>
							<tr class="table_det">
								<td width="202px">Nombre Completo</td>
								<td width="72px">Usuario </td>
								<td width="72px">Clave</td>
								<td width="72px">Estado</td>
								<td width="52px">Acciones </td>
							</tr>
							</thead>
						</table>
						<!-- Detalle de usuarios del sistema-->
						<table id="tablad_usuarios" class="table_det"></table>
					</section>
					<br>
					<script>
							get_boton("bt_add","users.ico","Nuevo");
					</script>
				</fieldset>
			</div>
			
			<div id="finfo2" class="tabcontent">
				<fieldset  class="fieldset">	
					<fieldset class="fieldset">
						<label class="labelsencilla"> Listado de Compañias del sistema</label>
						<section id="seccion_permisos" class="area_detalles">
							<table id="tablah_cias"  >
								<thead>
								<tr class="table_det">
									<td width="72px">Cia Id</td>
									<td width="202px">Descripcion</td>
									<td width="42px">Accesos</td>
								</tr>
								</thead>
							</table>
							<!-- Detalle de usuarios del sistema-->
							<table id="tablad_cias" class="table_det"></table>
						</section>
					</fieldset>
				</fieldset>
			</div>
		</form>
		
		<section class="area_bloqueo" id="area_syperm">		
			<section class="form2" id="syperm">
				<div class="barra_sencilla">
					<h1>Permisos para la Compañia</h1>
				</div>
				<fieldset class="fieldset">
				<label class="labelnormal">Compañia Id</label>
				<input type="text" id="ccompid" name="ccompid" readonly class="saykey"  >
				<br>
				<label class="labelnormal">Nombre Completo</label>
				<input type="text" id="ccompdesc" name="ccompdesc" readonly class="saytext"  >
				<section class="area_detalles">
					<table id="tablah_permisos"  >
						<thead>
						<tr class="table_det">
							<td width="42px">Id</td>
							<td width="72px">Id Menu</td>
							<td width="252px">Descripcion</td>
							<td width="42px">Acceso</td>
						</tr>
						</thead>
					</table>
					<!-- Detalle de usuarios del sistema-->
					<table id="tablad_permisos" class="table_det"></table>
				</section>
				<br>				
				<script>
					get_boton("bt_upd_permiso","buscar.ico","Cargar");
					get_boton("bt_guardar_permiso","guardar.ico","Guardar");
					get_boton("bt_fsalir_permiso","salir.ico","Salir");
					get_boton("bt_all_permiso","permisos.ico","Todos");
					get_boton("bt_nada_permiso","stop.ico","Nada");
				</script>
			</fieldset>
			</section>
		</section>
		
		<section class="area_bloqueo" id="area_syuser">
			<section id="syuser" class="form2">
				<div class="barra_sencilla">
					<h1>Registrar Nuevo Usuario</h1>
				</div>
				<br>
				<fieldset class="fieldset">
						<label class="labelnormal">Id Linea</label>
						<input type="text" readonly id="cuid" name="cuid" class="textkey">
						<br>
						<label class="labelnormal">Nombre Completo</label>
						<input type="text" id="cfullname" name="cfullname" class="textcdesc">
						<br>
						<label class="labelnormal">Usuario</label>
						<input type="text" id="cuserid" name="cuserid" class="textkey">
						<br>
						<label class="labelnormal">Clave</label>
						<input type="password" id="cpasword" name="cpasword" class="textkey">
						<br>
						<label class="labelnormal">Estado</label>
						<select id="cstatus_user" name="cstatus_user" class="listas">
							<option value ="" >Elija Estado</option>
							<option value ="OP" >Activo</option>
							<option value ="CL" >Anulado</option>
						</select>
					</fieldset>
				<br>
				<div id="fbotones">
					<script>
						get_boton("bt_fsave","save.ico","Guardar");
						get_boton("bt_fsalir","salir.ico","Salir");
					</script>
				</div>
				<br>
			</section>
		</section>

		<script>
			get_xm_menu();
			get_msg();
		</script>
	</body>
</html>