
function init(){
	// CODIGO PARA LOS MENUS INTERACTIVOS.
	// CADA MENU
	document.getElementById("bt1").addEventListener("click",show_menu_tabla,false);
	//document.getElementById("bt_m_refresh").addEventListener("click",show_menu_tabla,false);
	// una funcion de ordenamiento segun el menu que se elija.
	// Lista de ordenamiento
	document.getElementById("mx_opc_order").addEventListener("click",get_mx_detalle,false);
	// opcion de busqueda
	document.getElementById("mx_cbuscar").addEventListener("input",get_mx_detalle,false);
	// COMUM
	document.getElementById("bt_menu_salir").addEventListener("click",cerrar_mx_view,false);
}

// COMUN.	
function cerrar_mx_view(){
	document.getElementById("area_menu").style.display="none";
}

// CADA VIEW
function show_menu_tabla(){
	document.getElementById("area_menu").style.display="inline";
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
function select_xkey(e){
	var lckey  = e.currentTarget.cells[0].innerText;
	var lcdesc = e.currentTarget.cells[1].innerText;
}
window.onload=init;