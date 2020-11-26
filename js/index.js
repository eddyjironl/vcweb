function init(){
	var oBoton = document.getElementById("entrar");
	oBoton.addEventListener("click",validar_usuario,false);
}

function validar_usuario(){
	// datos a guardar 
	lcuserid  = document.getElementById("cuserid").value;
	lcpasword = document.getElementById("cpasword").value;
	var oForm = document.getElementById("sysinit");
	
	if (lcuserid == "" ){
		getmsgalert("El Usuario esta vacio");
		return false ;
	}
			
	if (lcpasword ==""){
		getmsgalert("La clave de usuario esta vacio");
	  	return false;
	}
	// enviando el formulario.
	oForm.submit();
}


window.addEventListener("load",init,false);
//window.load=init;



