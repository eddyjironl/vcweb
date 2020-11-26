function init(){
	document.getElementById("btquit").addEventListener("click",cerrar_pantalla_principal,false);
	document.getElementById("btsave").addEventListener("click",guardar,false);
	update_window();
}

function update_window(){
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","REFRESH");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_armone.php",false); 
	oRequest.send(oDatos);
	document.getElementById("detalles").innerHTML = oRequest.responseText;
	document.getElementById("dtrndate").value = "";
	document.getElementById("ntc").value = "";
}

function eliminarFila(pcuid){
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cuid",pcuid);
	oDatos.append("accion","DELETE");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_armone.php",false); 
	oRequest.send(oDatos);
	update_window();
}

function guardar(){
	var ldtrndate = document.getElementById("dtrndate").value;
	var lntc = document.getElementById("ntc").value;
	if(ldtrndate == ""){
		getmsgalert("Debe indicar una fecha");
		return ;
	}
	if(lntc == ""){
		getmsgalert("Debe indicar un Tipo de cambio ");
		return ;
	}
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("dtrndate",document.getElementById("dtrndate").value);
	oDatos.append("ntc",document.getElementById("ntc").value);
	oDatos.append("accion","NEW");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_armone.php",false); 
	oRequest.send(oDatos);
	update_window();
}

function cerrar_pantalla_principal(){
	document.getElementById("armone").style.display="none";
}

window.onload=init;