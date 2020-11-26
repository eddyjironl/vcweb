var xMenuId = "";
function init(){
	document.getElementById("btquit").addEventListener("click",cerrar_pantalla,false);
	document.getElementById("btprint").addEventListener("click",print,false);
	document.getElementById("btnueva").addEventListener("click",nueva,false);
	// ------------------------------------------------------------------------
	// CODIGO PARA LOS MENUS INTERACTIVOS.
	// CADA MENU
	// clientes
	document.getElementById("btccustno_1").addEventListener("click",show_menu_arcust,false);
	document.getElementById("btccustno_2").addEventListener("click",show_menu_arcust,false);
	// tipos de pago
	document.getElementById("btcpaycode_1").addEventListener("click",show_menu_artcas,false);
	document.getElementById("btcpaycode_2").addEventListener("click",show_menu_artcas,false);
	// bodega
	document.getElementById("btcwhseno_1").addEventListener("click",show_menu_arwhse,false);
	document.getElementById("btcwhseno_2").addEventListener("click",show_menu_arwhse,false);
	// responsables o vendedores.
	document.getElementById("btcrespno_1").addEventListener("click",show_menu_arresp,false);
	document.getElementById("btcrespno_2").addEventListener("click",show_menu_arresp,false);
	
	// una funcion de ordenamiento segun el menu que se elija.
	// Lista de ordenamiento
	document.getElementById("mx_opc_order").addEventListener("click",get_mx_detalle,false);
	// opcion de busqueda
	document.getElementById("mx_cbuscar").addEventListener("input",get_mx_detalle,false);
	// ------------------------------------------------------------------------
}
function nueva(){
	var objects = document.querySelectorAll("input");
	var olista = document.querySelectorAll("select");
	for (var i=0; i<objects.length; i++){
		objects[i].value = "";
	}
	
	// setiando los selects
	for (var i= 0; i<olista.length; i++){
		olista[i].value = "''";
	}
	
	
}

function cerrar_pantalla(){
	document.getElementById("arcash1_r").style.display="none";
}
function print(){
 document.getElementById("arcash1_r").submit();
}


// ----------------------------------------------------------------------
// MENU DE CLIENTES.
// ----------------------------------------------------------------------
function get_mx_detalle(){
	if (xMenuId == "btccustno_1" ){get_mx_detalle_arcust();}
	if (xMenuId == "btcpaycode_1"){get_mx_detalle_artcas();}
	if (xMenuId == "btcwhseno_1") {get_mx_detalle_arwhse();}
	if (xMenuId == "btcrespno_1") {get_mx_detalle_arresp();}
}
function select_xkey(e){
	var lckey  = e.currentTarget.cells[0].innerText;
	var lcdesc = e.currentTarget.cells[1].innerText;
	//document.getElementById("ccustno").value = lckey;
	cerrar_mx_view();
	// refrescando el valor.
	
	if (xMenuId == "btccustno_1"){document.getElementById("ccustno_1").value = lckey;}
	if (xMenuId == "btccustno_2"){document.getElementById("ccustno_2").value = lckey;}

	if (xMenuId == "btcpaycode_1"){document.getElementById("cpaycode_1").value = lckey;}
	if (xMenuId == "btcpaycode_2"){document.getElementById("cpaycode_2").value = lckey;}

	if (xMenuId == "btcwhseno_1"){document.getElementById("cwhseno_1").value = lckey;}
	if (xMenuId == "btcwhseno_2"){document.getElementById("cwhseno_2").value = lckey;}

	if (xMenuId == "btcrespno_1"){document.getElementById("crespno_1").value = lckey;}
	if (xMenuId == "btcrespno_2"){document.getElementById("crespno_2").value = lckey;}
	
}


// Los diferentes menus
function show_menu_arcust(e){
	// menu que llamo el comando.
	xMenuId = e.target.id;
	
	document.getElementById("xm_area_menu").style.display="inline";
	var o_mx_lista = "";
	// armando el listado
	o_mx_lista += '	<select class="listas" id="mx_opc_order"> ';
	o_mx_lista += ' 	<option value = "ccustno">Cliente Id</option> ';
	o_mx_lista += '		<option value = "cname">Nombre Completo</option> ';
	o_mx_lista += '		<option value = "ctel">Telefono</option> ';
	o_mx_lista += '		<option value = "cemail">Correo Electronico</option> ';
	o_mx_lista += '	</select> ';
	// armando el encabezado 
	var o_mx_Header = "";
	o_mx_Header += ' <table id="mx_head" class="table_det"> ';
	o_mx_Header += '	<thead> ';
	o_mx_Header += '		<tr> ';
	o_mx_Header += '			<td width="70px"> Cliente Id </td> ';
	o_mx_Header += '			<td width="200px"> Nombre Completo </td> ';
	o_mx_Header += '			<td width="50px"> Telefono </td> ';
	o_mx_Header += '			<td width="100px"> Correo Electronico </td> ';
	o_mx_Header += '		</tr> ';
	o_mx_Header += '	</thead> ';
	o_mx_Header += '</table> ';
	// armando detalle de contenidos.
	// cambiando el encabezado .
	document.getElementById("mx_head").innerHTML      = o_mx_Header;
	document.getElementById("mx_opc_order").innerHTML = o_mx_lista;
	get_mx_detalle_arcust();
}
function get_mx_detalle_arcust(){
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
		oRequest.open("POST","../modelo/crud_arcust.php",false); 
		oRequest.send(oDatos);
		var odata = JSON.parse(oRequest.response);
		//cargando los valores de la pantalla.
		if (odata != null){
			var lnrows = odata.length;
			var o_mx_detalles = '<table id="mx_detalle"> ';
			o_mx_detalles += '<tbody>';
			for (var i = 0; lnrows > i; ++i){
				o_mx_detalles += '<tr class="xm_row_menu"> ';
				o_mx_detalles += '	<td width="70px"> '+ odata[i]["ccustno"]  + '</td> ';
				o_mx_detalles += '	<td width="200px">'+ odata[i]["cname"]+ '</td> ';
				o_mx_detalles += '	<td width="50px">'+ odata[i]["ctel"]+ '</td> ';
				o_mx_detalles += '	<td width="100px">'+ odata[i]["cemail"]+ '</td> ';
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

function show_menu_artcas(e){
	// menu que llamo el comando.
	xMenuId = e.target.id;
	
	document.getElementById("xm_area_menu").style.display="inline";
	var o_mx_lista = "";
	// armando el listado
	o_mx_lista += '	<select class="listas" id="mx_opc_order"> ';
	o_mx_lista += ' 	<option value = "cpaycode">Codigo Id</option> ';
	o_mx_lista += '		<option value = "cdesc">Descripcion</option> ';
	o_mx_lista += '	</select> ';
	// armando el encabezado 
	var o_mx_Header = "";
	o_mx_Header += ' <table id="mx_head" class="table_det"> ';
	o_mx_Header += '	<thead> ';
	o_mx_Header += '		<tr> ';
	o_mx_Header += '			<td width="70px"> Codigo Id </td> ';
	o_mx_Header += '			<td width="200px"> Descripcion </td> ';
	o_mx_Header += '		</tr> ';
	o_mx_Header += '	</thead> ';
	o_mx_Header += '</table> ';
	// armando detalle de contenidos.
	// cambiando el encabezado .
	document.getElementById("mx_head").innerHTML      = o_mx_Header;
	document.getElementById("mx_opc_order").innerHTML = o_mx_lista;
	get_mx_detalle_artcas();
}
function get_mx_detalle_artcas(){
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
		oRequest.open("POST","../modelo/crud_artcas.php",false); 
		oRequest.send(oDatos);
		var odata = JSON.parse(oRequest.response);
		//cargando los valores de la pantalla.
		if (odata != null){
			var lnrows = odata.length;
			var o_mx_detalles = '<table id="mx_detalle"> ';
			o_mx_detalles += '<tbody>';
			for (var i = 0; lnrows > i; ++i){
				o_mx_detalles += '<tr class="xm_row_menu"> ';
				o_mx_detalles += '	<td width="70px"> '+ odata[i]["cpaycode"]  + '</td> ';
				o_mx_detalles += '	<td width="200px">'+ odata[i]["cdesc"]+ '</td> ';
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

function show_menu_arwhse(e){
	// menu que llamo el comando.
	xMenuId = e.target.id;
	
	document.getElementById("xm_area_menu").style.display="inline";
	var o_mx_lista = "";
	// armando el listado
	o_mx_lista += '	<select class="listas" id="mx_opc_order"> ';
	o_mx_lista += ' 	<option value = "cwhseno">Bodega Id</option> ';
	o_mx_lista += '		<option value = "cdesc">Descripcion</option> ';
	o_mx_lista += '	</select> ';
	// armando el encabezado 
	var o_mx_Header = "";
	o_mx_Header += ' <table id="mx_head" class="table_det"> ';
	o_mx_Header += '	<thead> ';
	o_mx_Header += '		<tr> ';
	o_mx_Header += '			<td width="70px">Bodega Id </td> ';
	o_mx_Header += '			<td width="200px">Descripcion </td> ';
	o_mx_Header += '		</tr> ';
	o_mx_Header += '	</thead> ';
	o_mx_Header += '</table> ';
	// armando detalle de contenidos.
	// cambiando el encabezado .
	document.getElementById("mx_head").innerHTML      = o_mx_Header;
	document.getElementById("mx_opc_order").innerHTML = o_mx_lista;
	get_mx_detalle_arwhse();
}
function get_mx_detalle_arwhse(){
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
		oRequest.open("POST","../modelo/crud_arwhse.php",false); 
		oRequest.send(oDatos);
		var odata = JSON.parse(oRequest.response);
		//cargando los valores de la pantalla.
		if (odata != null){
			var lnrows = odata.length;
			var o_mx_detalles = '<table id="mx_detalle"> ';
			o_mx_detalles += '<tbody>';
			for (var i = 0; lnrows > i; ++i){
				o_mx_detalles += '<tr class="xm_row_menu"> ';
				o_mx_detalles += '	<td width="70px"> '+ odata[i]["cwhseno"]  + '</td> ';
				o_mx_detalles += '	<td width="200px">'+ odata[i]["cdesc"]+ '</td> ';
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

function show_menu_arresp(e){
	// menu que llamo el comando.
	xMenuId = e.target.id;
	
	document.getElementById("xm_area_menu").style.display="inline";
	var o_mx_lista = "";
	// armando el listado
	o_mx_lista += '	<select class="listas" id="mx_opc_order"> ';
	o_mx_lista += ' 	<option value = "crespno">Responsable Id</option> ';
	o_mx_lista += '		<option value = "cfullname">Nombre Completo</option> ';
	o_mx_lista += '	</select> ';
	// armando el encabezado 
	var o_mx_Header = "";
	o_mx_Header += ' <table id="mx_head" class="table_det"> ';
	o_mx_Header += '	<thead> ';
	o_mx_Header += '		<tr> ';
	o_mx_Header += '			<td width="70px">Responsable Id</td> ';
	o_mx_Header += '			<td width="200px">Nombre Completo</td> ';
	o_mx_Header += '		</tr> ';
	o_mx_Header += '	</thead> ';
	o_mx_Header += '</table> ';
	// armando detalle de contenidos.
	// cambiando el encabezado .
	document.getElementById("mx_head").innerHTML      = o_mx_Header;
	document.getElementById("mx_opc_order").innerHTML = o_mx_lista;
	get_mx_detalle_arresp();
}
function get_mx_detalle_arresp(){
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
				o_mx_detalles += '	<td width="70px"> '+ odata[i]["crespno"]  + '</td> ';
				o_mx_detalles += '	<td width="200px">'+ odata[i]["cfullname"]+ '</td> ';
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
// ----------------------------------------------------------------------

window.onload=init;