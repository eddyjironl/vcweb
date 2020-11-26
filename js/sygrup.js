function init(){
	// ------------------------------------------------------------------------
	// Configurando los tab
	// ------------------------------------------------------------------------
	// TAB - poniendo los botones a la escucha.
	document.getElementById("tbinfo1").addEventListener("click",tabshow,false);
	document.getElementById("tbinfo2").addEventListener("click",tabshow,false);
	// poniendo visible el objeto tab del info 
	document.getElementById("finfo1").style.display = "block";
	document.getElementById("tbinfo1").setAttribute("class","active");
	// ------------------------------------------------------------------------
	document.getElementById("bt_fsalir").addEventListener("click",cerrar_syuser,false);
	document.getElementById("btguardar").addEventListener("click",guardar_sygrup,false);
	document.getElementById("btquit").addEventListener("click",cerrar_sygrup,false);
	document.getElementById("btnueva").addEventListener("click",clear_view,false);
	document.getElementById("bt_add").addEventListener("click",abrir_syuser,false);
	document.getElementById("bt_fsave").addEventListener("click",guardar_usuario,false);
	document.getElementById("cgrpid").addEventListener("change",update_window,false);
	// botones de la pantalla de permisos.
	document.getElementById("bt_upd_permiso").addEventListener("click",upd_permisos,false);
	document.getElementById("bt_fsalir_permiso").addEventListener("click",cerrar_syperm,false);
	document.getElementById("bt_guardar_permiso").addEventListener("click",save_syperm,false);
	document.getElementById("bt_all_permiso").addEventListener("click",all_syperm,false);
	document.getElementById("bt_nada_permiso").addEventListener("click",nada_syperm,false);
	// configurando las variables de estado.
	gckeyid   = "cgrpid";
	gckeydesc = "cdesc";

	// ------------------------------------------------------------------------
	// CODIGO PARA LOS MENUS INTERACTIVOS.
	// CADA MENU
	document.getElementById("btgrupid").addEventListener("click",show_menu_tabla,false);
	//document.getElementById("bt_m_refresh").addEventListener("click",show_menu_tabla,false);
	
	// una funcion de ordenamiento segun el menu que se elija.
	// Lista de ordenamiento
	document.getElementById("mx_opc_order").addEventListener("click",get_mx_detalle,false);
	// opcion de busqueda
	document.getElementById("mx_cbuscar").addEventListener("input",get_mx_detalle,false);
	// ------------------------------------------------------------------------
	
	cerrar_syuser();
	cerrar_syperm();
}

// ----------------------------------------------------------------------------------------
// CADA VIEW
function show_menu_tabla(){
	document.getElementById("xm_area_menu").style.display="inline";
	var o_mx_lista = "";
	// armando el listado
	o_mx_lista += '	<select class="listas" id="mx_opc_order"> ';
	o_mx_lista += ' 	<option value = "cgrpid">Grupo Id</option> ';
	o_mx_lista += '		<option value = "cdesc">Nombre Completo</option> ';
	o_mx_lista += '		<option value = "Estado">Estado</option> ';
	o_mx_lista += '	</select> ';
	// armando el encabezado 
	var o_mx_Header = "";
	o_mx_Header += ' <table id="mx_head" class="table_det"> ';
	o_mx_Header += '	<thead> ';
	o_mx_Header += '		<tr> ';
	o_mx_Header += '			<td width="50px"> Grupo Id </td> ';
	o_mx_Header += '			<td width="200px"> Nombre Completo </td> ';
	o_mx_Header += '			<td width="50px"> Estado </td> ';
	o_mx_Header += '		</tr> ';
	o_mx_Header += '	</thead> ';
	o_mx_Header += '</table> ';
	// armando detalle de contenidos.
	// cambiando el encabezado .
	document.getElementById("mx_head").innerHTML = o_mx_Header;
	document.getElementById("mx_opc_order").innerHTML = o_mx_lista;
	get_mx_detalle();
}
// obteniendo el detalle de menus.
function get_mx_detalle(){
		// A) filtrando y ordenando el detalle.
		// ordenamiento por default
		var lcorder = document.getElementById("mx_opc_order").value;
		document.getElementById("mx_opc_order").value = lcorder;
		// filtro de busqueda por defecto
		var lcwhere = document.getElementById("mx_cbuscar").value;
		// ejecutando la insercion del nuevo usuario.
		var oRequest = new XMLHttpRequest();
		// Creando objeto para empaquetado de datos.
		var oDatos   = new FormData();
		// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
		oDatos.append("accion","MENU");
		oDatos.append("orden", lcorder);
		oDatos.append("filtro",lcwhere);
		oRequest.open("POST","../modelo/crud_sygrup.php",false); 
		oRequest.send(oDatos);
		var odata = JSON.parse(oRequest.response);
		//cargando los valores de la pantalla.
		if (odata != null){
			var lnrows = odata.length;
			var o_mx_detalles = '<table id="mx_detalle"> ';
			o_mx_detalles += '<tbody>';
			for (var i = 0; lnrows > i; ++i){
				o_mx_detalles += '<tr class="xm_row_menu"> ';
				o_mx_detalles += '	<td width="50px"> '+ odata[i]["cgrpid"]  + '</td> ';
				o_mx_detalles += '	<td width="200px">'+ odata[i]["cdesc"]   + '</td> ';
				o_mx_detalles += '	<td width="50px">' + odata[i]["cstatus"] + '</td> ';
				o_mx_detalles += '</tr> ';
			}
			o_mx_detalles += '</tbody> ';
		}else{
			o_mx_detalles = "<h1>No hay datos en el archivo</h1>";
		}
		document.getElementById("mx_detalle").innerHTML = o_mx_detalles;
		// aplicando el llamado de la funcion de seleccion
		var oRowDet = document.querySelectorAll("#mx_detalle tr");
		lnRows = oRowDet.length;
		for (var i=0; lnRows >i; ++i){
			oRowDet[i].addEventListener("click",select_xkey,false);
		}		
	}
function select_xkey(e){
	var lckey  = e.currentTarget.cells[0].innerText;
	var lcdesc = e.currentTarget.cells[1].innerText;
	document.getElementById("cgrpid").value = lckey;
	cerrar_mx_view();
	update_window();
}
// ----------------------------------------------------------------------------------------


// refrescando tabla de permisos. 
function guardar_sygrup(){
	// validando
	if (document.getElementById("cgrpid").value == ""){
		getmsgalert("Indique un codigo de grupo");
		return ;
	}
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","NEW");
	oDatos.append("cgrpid",document.getElementById("cgrpid").value);
	oDatos.append("cdesc" ,document.getElementById("cdesc").value);
	oDatos.append("cstatus",document.getElementById("cstatus").value);
	oRequest.open("POST","../modelo/crud_sygrup.php",false); 
	oRequest.send(oDatos);
	update_window();
}

function save_syperm(){
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos = new FormData();
	var ojson  = "";
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","NEW_SYPERM");
	oDatos.append("cgrpid",document.getElementById("cgrpid").value);
	oDatos.append("ccompid",document.getElementById("ccompid").value);
	// armando detalle de permisos.
	var otable = document.getElementById("tablad_permisos");
	var lnrows = otable.rows.length;
	var lcuid  = "", lallow = 0, lnveces = 1;
	// depende de que tenga lista de permisos.
	if (lnrows > 0){
		ojson = '{"permisos":[';
		// recorriendo la tabla de permisos.	
		for (var i = 0; i< lnrows; ++i){
			// id de la linea a buscar
			lcuid  = otable.rows[i].cells[0].innerText;
			lallow = otable.rows[i].cells[3].children["allow"].checked;
			if (lnveces == 1){
				ojson += '{"cuid":"' + lcuid + '","allow":'+lallow+'}' ;
				lnveces = 2;
			}else{
				ojson += ',{"cuid":"' + lcuid + '","allow":'+lallow+'}' ;
			}// if (lnveces == 1){
		}//for (var i = 0; i<= lnrows; ++i){
		ojson += "]}";
	}
	// enviando el JSON
	oDatos.append("json" ,ojson);
	oRequest.open("POST","../modelo/crud_sygrup.php",false); 
	oRequest.send(oDatos);
	update_window();
}

function all_syperm(){
	
}

function nada_syperm(){
	
}

function permisos(pcia){
	var lccia = pcia.parentElement.parentElement.cells[0].innerText;
    var lcciadesc = pcia.parentElement.parentElement.cells[1].innerText;
    refresh_permisos_list(lccia);
	document.getElementById("ccompid").value = lccia;
	document.getElementById("ccompdesc").value = lcciadesc;
	document.getElementById("area_syperm").style.display = "inline";
}
function cerrar_syperm(){
	document.getElementById("area_syperm").style.display = "none";
}
function upd_cias(){
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	oDatos.append("accion","REFRESH_CIAS");
	oRequest.open("POST","../modelo/crud_sygrup.php",false); 
	oRequest.send(oDatos);
	document.getElementById("tablad_cias").innerHTML = oRequest.response;
}
function upd_permisos(){
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","UPD_PERMISOS");
	oDatos.append("ccompid",document.getElementById("ccompid").value);
	oDatos.append("cgrpid",document.getElementById("cgrpid").value);
	oRequest.open("POST","../modelo/crud_sygrup.php",false); 
	oRequest.send(oDatos);
	document.getElementById("tablad_permisos").innerHTML = oRequest.response;
}
function refresh_permisos_list(pcia){
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","REFRESH_PERMISOS");
	oDatos.append("ccompid",pcia);
	oDatos.append("cgrpid",document.getElementById("cgrpid").value);
	oRequest.open("POST","../modelo/crud_sygrup.php",false); 
	oRequest.send(oDatos);
	document.getElementById("tablad_permisos").innerHTML = oRequest.response;
}
// Verificando los permisos en la base de datos
function upd_lista_permisos(){
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","REFRESH_PERMISOS");
	oDatos.append("cgrpid",document.getElementById("cgrpid").value);
	oRequest.open("POST","../modelo/crud_sygrup.php",false); 
	oRequest.send(oDatos);
	refresh_permisos_list();	
}
function tabshow(e){
	// evitando que el tipo de boton haga un submit por defecto y recargue la pagina.
	e.preventDefault();
	var oTabFormBoton = e.target.id;
	// poniendo ocultos todos los div pantallas ocultos
	var oTabForm = document.getElementsByClassName("tabcontent");
	for (i = 0; i < oTabForm.length; i++) {
		oTabForm[i].style.display = "none";
	}
	if(oTabFormBoton == "tbinfo1"){
		document.getElementById("finfo1").style.display = "block";
		document.getElementById("tbinfo2").setAttribute("class","")
	}
	
	if(oTabFormBoton == "tbinfo2"){
		document.getElementById("finfo2").style.display = "block";
		document.getElementById("tbinfo1").setAttribute("class","")
	}
	document.getElementById(oTabFormBoton).setAttribute("class","active");
}
function clear_view(){
	get_clear_view();
	document.getElementById("tablad_usuarios").innerHTML = "";
	document.getElementById("tablad_permisos").innerHTML = "";
	document.getElementById("tablad_cias").innerHTML = "";
}
function update_window(){
	// ejecutando la insercion del nuevo usuario.
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","JSON");
	oDatos.append("cgrpid",document.getElementById("cgrpid").value);
	oRequest.open("POST","../modelo/crud_sygrup.php",false); 
	oRequest.send(oDatos);
	var odata = JSON.parse(oRequest.response);
	//cargando los valores de la pantalla.
	if (odata != null){
		document.getElementById("cgrpid").value  = odata.cgrpid;
		document.getElementById("cdesc").value 	 = odata.cdesc;
		document.getElementById("cstatus").value = odata.cstatus;
		refresh_user_list();
		upd_cias();
		estado_key("I");
	}else{
		ck_new_key();
	}
}
function edit_userid(pcid,pthis){
	// abre la pantalla de edicion de usuario
	// seleccionando el detalle de usuarios.
	var otable = pthis.parentElement.parentElement;
	// refrescando la pantalla.
	document.getElementById("cuid").value = pcid;
	document.getElementById("cfullname").value = otable.cells[0].innerText;
	document.getElementById("cuserid").value   = otable.cells[1].innerText;
	document.getElementById("cpasword").value  = otable.cells[2].innerText;
	document.getElementById("cstatus_user").value = otable.cells[3].innerText;
	document.getElementById("area_syuser").style.display = "inline";
}
function refresh_user_list(){
	// ejecutando la insercion del nuevo usuario.
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","REFRESH");
	oDatos.append("cgrpid",document.getElementById("cgrpid").value);
	oRequest.open("POST","../modelo/crud_sygrup.php",false); 
	oRequest.send(oDatos);
	document.getElementById("tablad_usuarios").innerHTML = oRequest.response;
}
function guardar_usuario(){
	// verificando que el codigo de grupo este lleno.
	if (document.getElementById("cgrpid").value == ""){
		getmsgalert("Indique el codigo del grupo ");
		return ;
	}
	if(document.getElementById("cfullname").value == ""){
		getmsgalert("Indique el Nombre ");
		return ;
	}
	if(document.getElementById("cuserid").value == ""){
		getmsgalert("Indique el Usuario ");
		return ;
	}
	if(document.getElementById("cpasword").value == ""){
		getmsgalert("Indique el Pasword ");
		return ;
	}
	if(document.getElementById("cstatus_user").value == ""){
		getmsgalert("Indique el Estado ");
		return ;
	}

	// ejecutando la insercion del nuevo usuario.
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","NEW_USER");
	oDatos.append("cuid",document.getElementById("cuid").value);
	oDatos.append("cfullname",document.getElementById("cfullname").value);
	oDatos.append("cstatus",document.getElementById("cstatus_user").value);
	oDatos.append("cuserid",document.getElementById("cuserid").value);
	oDatos.append("cpasword",document.getElementById("cpasword").value);
	oDatos.append("cgrpid",document.getElementById("cgrpid").value);
	oRequest.open("POST","../modelo/crud_sygrup.php",false); 
	oRequest.send(oDatos);
	refresh_user_list();
	cerrar_syuser();
}
function abrir_syuser(){
	document.getElementById("area_syuser").style.display = "inline";
	document.getElementById("cuid").value = "";
	document.getElementById("cfullname").value = "";
	document.getElementById("cuserid").value   = "";
	document.getElementById("cpasword").value  = "";
	document.getElementById("cstatus_user").value = "";
	
}
function cerrar_syuser(){
	document.getElementById("area_syuser").style.display = "none";
}
function cerrar_sygrup(){
	document.getElementById("sygrup").style.display = "none";
}
window.onload=init;