<?php
// iniciando validacion de session
include("modelo/vc_funciones.php");
//--------------------------------------------------------------------------------------------------------------
vc_funciones::init_index();
?>

<!DOCTYPEHTLM>
<html>
	<head>
		<title>Login de usuarios</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/vc_estilos.css">
		<link rel="stylesheet" href="css/index.css">
		<script src="js/vc_funciones.js"></script>
		<script src="js/index.js"></script>
	</head>
	<body>

		<form id="sysinit" action="modelo/uservalid.php" method="POST">
				<h3>INICIO DE SESION</h3>
				<section id="fsinfo">
					<label>Usuario</label>
						<input type="text" id="cuserid" name="cuserid" required autofocus autocomplete="off"><br><br><br>
					<label>Clave</label>
					<input type="password" id="cpasword" name="cpasword" required autocomplete="off">
					<br><br>
					<input type="button" id="entrar" name="entrar" value="Ingresar">
				</section>
				<section>
				<img id="logo" src="photos/0000.jpg" width="80px" />
				</section>
				<br>
				<section id="fslogo2">
					<strong>Contactenos al correo:</strong><br>
					infovisualcontrol@gmail.com<br>
				</section>
		</form>
			
		<script>get_msg();</script>
	</body>
	<?php
	if (isset($_GET["opcmsj"])){
		$lopcmsg = $_GET["opcmsj"];
		if ($lopcmsg ==1 ){
	?>
	<script>getmsgalert("Usuario o la Contraseña no existen o Estan equivocadas.");</script>
	<?php
	}}
	?>

</html>