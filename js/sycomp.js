function init(){
	document.getElementById("btguardar").addEventListener("click",guardar,false);
	document.getElementById("btquit").addEventListener("click",cerrar_sycomp,false);
	document.getElementById("btnueva").addEventListener("click",clear_view,false);
	document.getElementById("ccompid").addEventListener("change",update_window,false);
	document.getElementById("cfoto").addEventListener("change",show_foto,false);
	document.getElementById("btdelete").addEventListener("click",borrar,false);
	
	// configurando las variables de estado.
	gckeyid   = "ccompid";
	gckeydesc = "compdesc";	
	// ------------------------------------------------------------------------
	// CODIGO PARA LOS MENUS INTERACTIVOS.
	// CADA MENU
	document.getElementById("btcompid").addEventListener("click",show_menu_sycomp,false);
	//document.getElementById("bt_m_refresh").addEventListener("click",show_menu_tabla,false);
	
	// una funcion de ordenamiento segun el menu que se elija.
	// Lista de ordenamiento
	document.getElementById("mx_opc_order").addEventListener("click",get_mx_detalle,false);
	// opcion de busqueda
	document.getElementById("mx_cbuscar").addEventListener("input",get_mx_detalle,false);
	// ------------------------------------------------------------------------
	
}
function borrar(){
	if (!confirm("Esta seguro de borrar este registro")){
		return ;
	}

	getmsgalert("Funcion no Disponible");
}
function clear_view(){
	document.getElementById("cfoto1").setAttribute("src","");
	get_clear_view();
	
}
// ----------------------------------------------------------------------
// MENU DE COMPAÑIAS PARA EL CAMBIO .
// ----------------------------------------------------------------------
function show_menu_sycomp(){
	document.getElementById("xm_area_menu").style.display="inline";
	var o_mx_lista = "";
	// armando el listado
	o_mx_lista += '	<select class="listas" id="mx_opc_order"> ';
	o_mx_lista += ' 	<option value = "ccompid">Compañia Id</option> ';
	o_mx_lista += '		<option value = "compdesc">Nombre Completo</option> ';
	o_mx_lista += '	</select> ';
	// armando el encabezado 
	var o_mx_Header = "";
	o_mx_Header += ' <table id="mx_head" class="table_det"> ';
	o_mx_Header += '	<thead> ';
	o_mx_Header += '		<tr> ';
	o_mx_Header += '			<td width="100px"> Compañia Id </td> ';
	o_mx_Header += '			<td width="200px"> Nombre Completo </td> ';
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
		oRequest.open("POST","../modelo/crud_sycomp.php",false); 
		oRequest.send(oDatos);
		var odata = JSON.parse(oRequest.response);
		//cargando los valores de la pantalla.
		if (odata != null){
			var lnrows = odata.length;
			var o_mx_detalles = '<table id="mx_detalle"> ';
			o_mx_detalles += '<tbody>';
			for (var i = 0; lnrows > i; ++i){
				o_mx_detalles += '<tr class="xm_row_menu"> ';
				o_mx_detalles += '	<td width="100px"> '+ odata[i]["ccompid"]  + '</td> ';
				o_mx_detalles += '	<td width="200px">'+ odata[i]["compdesc"]+ '</td> ';
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
	document.getElementById("ccompid").value = lckey;
	cerrar_mx_view();
	update_window();
	// actualizando la compañia en que estamos.
	
}
// -----------------------------------------------------------------------
function show_foto(){
	//"../photos/"+odata.cfoto
	var lcfoto = "../photos/" + document.getElementById("cfoto").files[0].name;
	document.getElementById("cfoto1").setAttribute("src",lcfoto) ;
}
function cerrar_sycomp(){
	document.getElementById("sycomp").style.display = "none";
}
function guardar(){
	// validando
	if (document.getElementById("ccompid").value == ""){
		getmsgalert("Indique un codigo de compañia");
		return ;
	}
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","NEW");
	oDatos.append("ccompid",document.getElementById("ccompid").value);
	oDatos.append("compdesc" ,document.getElementById("compdesc").value);
	oDatos.append("cstatus",document.getElementById("cstatus").value);
	oDatos.append("ctel",document.getElementById("ctel").value);
	oDatos.append("cfax",document.getElementById("cfax").value);
	oDatos.append("mdirecc",document.getElementById("mdirecc").value);
	oDatos.append("cciudad",document.getElementById("cciudad").value);
	oDatos.append("cpais",document.getElementById("cpais").value);

	oDatos.append("nanofisc",document.getElementById("nanofisc").value);
	oDatos.append("cuserid",document.getElementById("cuserid").value);
	oDatos.append("cpasword",document.getElementById("cpasword").value);
	oDatos.append("chost",document.getElementById("chost").value);
	oDatos.append("dbname",document.getElementById("dbname").value);

	oDatos.append("lunicontdat",document.getElementById("lunicontdat").checked);
	oDatos.append("cfoto",document.getElementById("cfoto").files[0].name);

	oRequest.open("POST","../modelo/crud_sycomp.php",false); 
	oRequest.send(oDatos);
	
	update_window();
}
function update_window(){
	// ejecutando la insercion del nuevo usuario.
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","JSON");
	oDatos.append("ccompid",document.getElementById("ccompid").value);
	oRequest.open("POST","../modelo/crud_sycomp.php",false); 
	oRequest.send(oDatos);
	var odata = JSON.parse(oRequest.response);
	//cargando los valores de la pantalla.
	if (odata != null){
		document.getElementById("ccompid").value  = odata.ccompid;
		document.getElementById("compdesc").value = odata.compdesc;
		document.getElementById("cstatus").value  = odata.cstatus;
		document.getElementById("ctel").value     = odata.ctel;
		document.getElementById("cfax").value     = odata.cfax;
		document.getElementById("mdirecc").value  = odata.mdirecc;
		document.getElementById("cciudad").value  = odata.cciudad;
		document.getElementById("cpais").value    = odata.cpais;
                                 
		document.getElementById("lunicontdat").checked = (odata.lunicontdat == "1")? true:false;
		document.getElementById("cfoto1").setAttribute("src",odata.cfoto) ;

		document.getElementById("nanofisc").value = odata.nanofisc;
		document.getElementById("cuserid").value  = odata.cuserid;
		document.getElementById("cpasword").value = odata.cpasword;
		document.getElementById("chost").value    = odata.chost;
		document.getElementById("dbname").value   = odata.dbname;
		estado_key("I");
	}else{
		ck_new_key();
	}

}

window.onload=init;