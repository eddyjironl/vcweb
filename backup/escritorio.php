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
		<title>Pulperia Oscarito</title>
		<link   rel="stylesheet" href="../css/escritorio.css?v1">
		<script src="../js/escritorio.js?v1"></script>
	</head>

	<body>
		<iframe id="ventana" src=""></iframe>
		<label id="pcerrar" class="lbmenu">Cerrar</label>
		<div id="info">
			<img src="../photos/portada.gif" id="portada">
			<h1 id="vc2020">Sistema Visual Control Web 2020</h1>
			<h1 id="ciadesc">Bienvenido a Portal de Pulperia Oscarito</h1>
			<nav id="bmenu">
				<ul id="menu">
					<li><a>Configuracion   </a>
						<ul>
							<li><a> modulos  </a></li>
							<li><a id="md001" href="../index.php">Salir</a></li>
						</ul>
					</li>
					<li><a>Transacciones</a>
						<ul>
							<li><a id="tr001"> Registro Diario Vtas y Cobros</a></li>
							<li><a id="tr002"> Compras y Cuentas por Pagar</a></li>
							<li><a id="tr003"> Cierre del Dia</a></li>
						</ul>
					</li>
					<li><a>Reportes</a>
						<ul>
							<li><a id="rp001"> Consulta de Saldo</a></li>
							<li><a id="rp002"> Cuentas por Cobrar</a></li>
							<li><a id="rp003"> Estado de Cuentas</a></li>
							<li><a id="rp004"> Resumen de Ventas</a></li>
							<li><a id="rp005"> Resumen de Cobros</a></li>
						</ul>
					</li>
					<li><a>Catalogos</a>
						<ul>
							<li><a id="ca001"> Clientes</a></li>
							<li><a id="ca002">Condiciones de Pago</a></li>
							<li><a id="ca003">Maestro de Inventarios</a></li>
							<li><a id="ca004">Tipos de Articulos</a></li>
							<li><a id="ca005">Proveedores</a></li>
						</ul>
					</li>
					<li><a>Modulo</a>
						<ul>
							<li><a id="mod001">Configuracion VC-2020 WEB</a></li>
							<li><a id="mod002">Administracion de Registro Diario</a></li>
						</ul>
					</li>
				</ul>
			 </nav>
		</div>
		<aside id="barralat" color:"white">
			<button id="btr001">Registrar Clientes</button><label id="lbsenal">    --></label>
			<button id="btr002">Registrar Movimientos</button>
			<button id="btr003">Reportes de CXC</button>
		</aside>
		
		
		<section id="resultado" style="display:'none'"></section>
	</body>
</html>