// iniciando carga
function init(){
	var oBtnueva   = document.getElementById("btnueva");
	var obtguardar = document.getElementById("btguardar");
	var obtdelete  = document.getElementById("btdelete");
	var ocrespno   = document.getElementById("crespno");
	var ocfoto     = document.getElementById("cfoto");

	btquit.addEventListener("click",cerrar_pantalla_principal,false);
	ocfoto.addEventListener("change",show_foto,false);
	ocrespno.addEventListener("change",valid_crespno,false);
	oBtnueva.addEventListener("click",get_clear_view,false);
	obtguardar.addEventListener("click",guardar,false);
	obtdelete.addEventListener("click",borrar,false);

	// configurando las variables de estado.
	gckeyid   = "crespno";
	gckeydesc = "cfullname";
	gcbtkeyid = "btcrespno";

	// ------------------------------------------------------------------------
	// CODIGO PARA LOS MENUS INTERACTIVOS.
	// CADA MENU
	document.getElementById("btcrespno").addEventListener("click",show_menu_arresp,false);
	//document.getElementById("bt_m_refresh").addEventListener("click",show_menu_arcust,false);
	// una funcion de ordenamiento segun el menu que se elija.
	// Lista de ordenamiento
	document.getElementById("mx_opc_order").addEventListener("click",get_mx_detalle,false);
	// opcion de busqueda
	document.getElementById("mx_cbuscar").addEventListener("input",get_mx_detalle,false);
	// ------------------------------------------------------------------------	
}
// ----------------------------------------------------------------------
// MENU DE CLIENTES.
// ----------------------------------------------------------------------

function show_menu_arresp(){
	document.getElementById("xm_area_menu").style.display="inline";
	var o_mx_lista = "";
	// armando el listado
	o_mx_lista += '	<select class="listas" id="mx_opc_order"> ';
	o_mx_lista += ' 	<option value = "crespno">Responsable Id</option> ';
	o_mx_lista += '		<option value = "cfullname">Nombre Completo</option> ';
	o_mx_lista += '		<option value = "mtels">Telefono</option> ';
	o_mx_lista += '	</select> ';
	// armando el encabezado 
	var o_mx_Header = "";
	o_mx_Header += ' <table id="mx_head" class="table_det"> ';
	o_mx_Header += '	<thead> ';
	o_mx_Header += '		<tr> ';
	o_mx_Header += '			<td width="100px"> Responsable Id </td> ';
	o_mx_Header += '			<td width="200px"> Nombre Completo </td> ';
	o_mx_Header += '			<td width="100px"> Telefono </td> ';
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
		oRequest.open("POST","../modelo/crud_arresp.php",false); 
		oRequest.send(oDatos);
		var odata = JSON.parse(oRequest.response);
		//cargando los valores de la pantalla.
		if (odata != null){
			var lnrows = odata.length;
			var o_mx_detalles = '<table id="mx_detalle"> ';
			o_mx_detalles += '<tbody>';
			for (var i = 0; lnrows > i; ++i){
				o_mx_detalles += '<tr class="xm_row_menu"> ';
				o_mx_detalles += '	<td width="100px"> '+ odata[i]["crespno"]  + '</td> ';
				o_mx_detalles += '	<td width="200px">'+ odata[i]["cfullname"]+ '</td> ';
				o_mx_detalles += '	<td width="100px"> '+ odata[i]["mtels"]    + '</td> ';
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
	document.getElementById("crespno").value = lckey;
	cerrar_mx_view();
	update_window(lckey);
}
// -----------------------------------------------------------------------



function cerrar_pantalla_principal(){
	arresp.style.display="none";
}

function show_foto(){
	//"../photos/"+odata.cfoto
	var lcfoto = document.getElementById("cfoto").value;
	document.getElementById("cfoto1").setAttribute("src",lcfoto) ;
}

function guardar(){
	var oform = document.getElementById("arresp");
	// validaciones de campos obligatorios.
	if(document.getElementById("crespno").value ==""){
		getmsgalert("Falta el codigo de Proveedor");
		return ;
	}
	if(document.getElementById("cfullname").value ==""){
		getmsgalert("Falta el Nombre del Proveedor");
		return ;
	}
	if(document.getElementById("cstatus").value ==""){
		getmsgalert("No indico Estado del proveedor");
		return ;
	}
	if(document.getElementById("mtel").value ==""){
		getmsgalert("Indique un telefono de contacto");
		return ;
	}

	oform.submit();
}

function borrar(){
	var xkeyid = document.getElementById("crespno").value;
	if(xkeyid != ""){
		if (!confirm("Esta seguro de borrar este registro")){
			return ;
		}
		var oRequest = new XMLHttpRequest();
		// Creando objeto para empaquetado de datos.
		var oDatos   = new FormData();
		// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
		oDatos.append("crespno",xkeyid);
		oDatos.append("accion","DELETE");
		// obteniendo el menu
		oRequest.open("POST","../modelo/crud_arresp.php",false); 
		oRequest.send(oDatos);
		get_clear_view();
	}else{
		getmsgalert("No ha indicado un codigo de proveedor para borrar");
	}
}
	// este procedimiento utiliza la vupdate_window(pckeyid,pcmenuid)entana de menu y la despliega y rellena los contenidos con el request.		;
function getmenulist(pcmenuid){
	var menuid  = pcmenuid.target.id;
	var oMenu   = document.getElementById("vmenu");
	var oLista  = document.getElementById("vlista");
	var oMhead  = document.getElementById("vcolumnas");
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","PANTALLA_MENU");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_arresp.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	oLista.innerHTML = oRequest.responseText;
	oRequest.open("POST","../modelo/crud_arresp.php",false); 
	oDatos.append("opcion","H");
	oRequest.send(oDatos);
	oMhead.innerHTML = oRequest.responseText;
	// habriendo el menu con los datos requeridos.
	oMenu.style.display = "block";
}
	
function valid_crespno(){
	var lcrespno = document.getElementById("crespno").value;
	update_window(lcrespno,"btcrespno");
}
			
function update_window(pckeyid){
	// --------------------------------------------------------------------------------------
	// Con esta funcion se hace una peticion al servidor para obtener un JSON, con los 
	// datos de la persona un solo objeto json que sera el cliente.
	// --------------------------------------------------------------------------------------
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("crespno",pckeyid);
	oDatos.append("accion","JSON");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_arresp.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var odata = JSON.parse(oRequest.response);
	//cargando los valores de la pantalla.
	if (odata != null){
		document.getElementById("crespno").value = odata.crespno;
		document.getElementById("cstatus").value = odata.cstatus;
		document.getElementById("cctaid").value  = odata.cctaid;
		document.getElementById("cruc").value    = odata.cruc;
		document.getElementById("mtel").value    = odata.mtels;
		document.getElementById("mdirecc").value = odata.mdirecc;
		document.getElementById("mnotas").value  = odata.mnotas;
		document.getElementById("cfoto1").setAttribute("src",odata.cfoto) ;
		document.getElementById("cfullname").value = odata.cfullname;
		document.getElementById("ndays").value   = odata.ndays;
		// configurando los dias de la semana
		document.getElementById("llunes").checked = (odata.llunes == "1")? true:false;
		document.getElementById("lmartes").checked = (odata.lmartes == "1")? true:false;
		document.getElementById("lmiercoles").checked = (odata.lmiercoles == "1")? true:false;
		document.getElementById("ljueves").checked = (odata.ljueves == "1")? true:false;
		document.getElementById("lviernes").checked = (odata.lviernes == "1")? true:false;
		document.getElementById("lsabado").checked = (odata.lsabado == "1")? true:false;
		document.getElementById("ldomingo").checked = (odata.ldomingo == "1")? true:false;
		estado_key("I");
	}else{
		ck_new_key();
	}
}
			
window.onload=init;
