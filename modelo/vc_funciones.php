<?PHP
CLASS vc_funciones{
		
	public static function Star_session(){
		// iniciando session
		session_start();
		// Verificando la session.
		IF (isset($_SESSION["cuserid"])) {
			//session_start();
			return false;
		}else{
			//echo "<SPAN STYLE='COLOR:YELLOW'> NO HA INICIADO SESSION </SPAN>";
			header("location:../index.php");
			return true;
		}
	}
	
	public static function End_session(){
		// iniciando session
		session_start();
		// cerrando sesion.
		session_destroy();
		//llamando el login.
		header("location:index.php");
	}
	public static function init_index(){
		session_start();
		// cerrando sesion.
		session_destroy();
	}

		
}
?>