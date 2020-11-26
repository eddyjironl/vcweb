var ninvlinmax = 0;
function init(){
	// cargando numero de transsaccion para esta factura temporal
	document.getElementById("xtrnno").value = get_trnno();
	// identificando algunos elementos.
	document.getElementById("ccustno").addEventListener("change",upd_config_invoice,false);
	document.getElementById("bt_fsalir").addEventListener("click",cerrar_fupdt,false);
	document.getElementById("bt_fupd").addEventListener("click",save_upd,false)
	// poniendo el text de articulo a la escucha.
	document.getElementById("cservno1").addEventListener("change",upddet,false);
	// pantalla de actualizacion de regisrto de venta.
	document.getElementById("pantalla_actualiza_linea").style.display="none";
	var obtguardar = document.getElementById("btguardar");
	// pone la pantalla lista para la proxima con los defaults de la pantalla de facturacion.
	document.getElementById("btnueva").addEventListener("click",clear_view,false);
	btguardar.addEventListener("click",call_pantalla_pago,false);
	btquit.addEventListener("click",cerrar_arinvc,false);
	// combo de pantalla de pago sobre el tipo de pago
    ctype.addEventListener("change",upd_desctype,false);
	dstardate.addEventListener("change",get_tc_rate,false);
	// Pantalla de guardar factura.   pantalla_actualiza_linea
	// -----------------------------------------------------------------
	efectivo.addEventListener("change",ck_vuelto,false);
	// ocultando la pantalla de pago 
	pantalla_pago.style.display="none";
	// poniendo boton de cerrar pantallas.
	btsalir.addEventListener("click",cerrar_pantalla_pago,false);
	btsalvar.addEventListener("click",guardar,false);
	btVer.style.display    = "none";
	btnuevaf.style.display = "none";
	btsalvar.style.display = "inline";
	btsalir.style.display  = "inline";
	btnuevaf.addEventListener("click",nueva_factura,false);
	btVer.addEventListener("click",print_invoice,false);
	// -----------------------------------------------------------------
	// CODIGO PARA LOS MENUS INTERACTIVOS.
	// CADA MENU
	document.getElementById("btcservno").addEventListener("click",show_menu_arserm,false);
	//document.getElementById("bt_m_refresh").addEventListener("click",show_menu_arcust,false);
	
	// una funcion de ordenamiento segun el menu que se elija.
	// Lista de ordenamiento
	document.getElementById("mx_opc_order").addEventListener("click",get_mx_detalle,false);
	// opcion de busqueda
	document.getElementById("mx_cbuscar").addEventListener("input",get_mx_detalle,false);
	// ------------------------------------------------------------------------
	clear_view();
}

// ----------------------------------------------------------------------
// MENU DE articulos
// ----------------------------------------------------------------------
function show_menu_arserm(){
	document.getElementById("xm_area_menu").style.display="inline";
	var o_mx_lista = "";
	// armando el listado
	o_mx_lista += '	<select class="listas" id="mx_opc_order"> ';
	o_mx_lista += ' 	<option value = "cservno">Articulo Id</option> ';
	o_mx_lista += '		<option value = "cdesc">Descripcion </option> ';
	o_mx_lista += '		<option value = "nprice">Precio </option> ';
	o_mx_lista += '		<option value = "nonhand">Existencia</option> ';
	o_mx_lista += '	</select> ';
	// armando el encabezado 
	var o_mx_Header = "";
	o_mx_Header += ' <table id="mx_head" class="table_det"> ';
	o_mx_Header += '	<thead> ';
	o_mx_Header += '		<tr> ';
	o_mx_Header += '			<td width="70px">Articulo Id </td> ';
	o_mx_Header += '			<td width="200px">Descripcion</td> ';
	o_mx_Header += '			<td width="50px">Precio</td> ';
	o_mx_Header += '			<td width="50px">Existencia</td> ';
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
		oRequest.open("POST","../modelo/crud_arserm.php",false); 
		oRequest.send(oDatos);
		var odata = JSON.parse(oRequest.response);
		//cargando los valores de la pantalla.
		if (odata != null){
			var lnrows = odata.length;
			var o_mx_detalles = '<table id="mx_detalle"> ';
			o_mx_detalles += '<tbody>';
			for (var i = 0; lnrows > i; ++i){
				o_mx_detalles += '<tr class="xm_row_menu"> ';
				o_mx_detalles += '	<td width="70px"> '+ odata[i]["cservno"] + '</td> ';
				o_mx_detalles += '	<td width="200px">'+ odata[i]["cdesc"]   + '</td> ';
				o_mx_detalles += '	<td width="50px"> '+ odata[i]["nprice"]  + '</td> ';
				o_mx_detalles += '	<td width="50px"> '+ odata[i]["nonhand"] + '</td> ';
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
	document.getElementById("cservno1").value = lckey;
	cerrar_mx_view();
	upddet();
	
}
// -----------------------------------------------------------------------


function get_tc_rate(){
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("dtrndate",document.getElementById("dstardate").value);
	oDatos.append("program","get_tc_rate");
	// obteniendo el menu
	oRequest.open("POST","../modelo/armodule.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var odata = JSON.parse(oRequest.response);
	//cargando los valores de la pantalla.
	if (odata != null){	
		document.getElementById("ntc").value = parseFloat(odata.ntc).toFixed(2);
	}else{
		document.getElementById("ntc").value = 1;
		getmsgalert("tipo de cambio no definido para esta fecha.");
	}
}
//obteniendo tipo de cambio 
// actualiza los parametros de facturacion del cliente al cambiar los terminos de facturacion.
function upd_config_invoice(){
	// haciendo request que devuelva el contenido de la fila en formato JSON.
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","LIST");
	oDatos.append("ccustno",document.getElementById("ccustno").value);
	// enviando el request.
	oRequest.open("POST","../modelo/crud_arcust.php",false); 
	oRequest.send(oDatos);
	// recibiendo el json.
	var odata = JSON.parse(oRequest.response); 
	// mostrando pantalla de edicion de archivo
	document.getElementById("cwhseno").value  = odata.cwhseno;
	document.getElementById("cpaycode").value = odata.cpaycode;
	document.getElementById("crespno").value  = odata.crespno;
	document.getElementById("nlimcrd").value  = odata.nlimcrd;
	document.getElementById("nsalecust").value = odata.nlimcrd - odata.nbbalance;
}

function cerrar_arinvc(){
	arinvc.style.display = "none";
}
// funcion para calcular el vuelto 
function ck_vuelto(){
	if (parseFloat(efectivo.value) >= parseFloat(topay.value)){
		vuelto.value = parseFloat(efectivo.value - topay.value);	
	}else{
		vuelto.value = 0;	
	}
}
// imprime una factura 
function print_invoice(){
	alert("Imprimiendo factura....");
}
// nueva factura despues de que se guardo la que se estaba haciendo.
function nueva_factura(){
	// oculta el boton de ver factura.
	btVer.style.display    = "none";
	// oculta boton de nueva para proxima factura.
	btnuevaf.style.display = "none";
	// oculta boton de guardar factura cuando ya se guardo.
	btsalvar.style.display = "inline";
	btsalir.style.display  = "inline";
	// cierra pantalla de pago
	cerrar_pantalla_pago();
	// recetea a default la pantalla principal de facturacion
	clear_view();
}
// guarda la factura finalmente
function guardar(){
	// ---------------------------------------------------------------------
	// A)- verificando integridad de datos antes de guardar definitivamente.
	// ---------------------------------------------------------------------
	var llcont = isvalidentry();
	if (!llcont){
		return ;
	}

	// ---------------------------------------------------------------------
	// B)- Guardando factura
	// ---------------------------------------------------------------------
	// haciendo request que devuelva el contenido de la fila en formato JSON.
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos = new FormData();
	var lntc = 1;
	
	if (ntc.value != ""){
		lntc = ntc.value;
	}
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","SAVE");
	oDatos.append("xtrnno",document.getElementById("xtrnno").value);
	oDatos.append("ccustno",ccustno.value);
	oDatos.append("cwhseno",cwhseno.value);
	oDatos.append("cpaycode",cpaycode.value);
	oDatos.append("crespno",crespno.value);
	oDatos.append("dstardate",dstardate.value);
	oDatos.append("denddate",denddate.value);
	oDatos.append("mnotas",mnotas.value);
	oDatos.append("efectivo",efectivo.value);
	oDatos.append("dpay",dpay.value);
	oDatos.append("mnotasr",mnotasr.value);
	oDatos.append("cdesc",cdesc.value);
	oDatos.append("crefno",crefno.value);
	oDatos.append("ntc",lntc);
	// enviando el request.
	oRequest.open("POST","../modelo/crud_arinvc.php",false); 
	oRequest.send(oDatos);

	// ---------------------------------------------------------------------
	// C)- Cerrando proceso
	// ---------------------------------------------------------------------
	var odata = oRequest.responseText; 
	// mostrando el boton de imprimir factura
	btVer.style.display    ="inline";
	// mostrando el boton de nueva factura continua trabajando.
	btnuevaf.style.display ="inline";
	// ocultando boton de salir simple ocultar pantalla.
	btsalvar.style.display ="none";
	btsalir.style.display  ="none";

	// mostrando el nuevo numero de factura.
	ctrnno1.value = odata;
}
// actualiza el valor de la descripcion en el pago segun el tipo.
function upd_desctype(){
	if(ctype.value == "EF"){
		cdescpay.value="Pago en Efectivo";
	}
	if(ctype.value == "TG"){
		cdescpay.value="Targeta de Credito # ?";
	}
	if(ctype.value == "CK"){
		cdescpay.value="Cheque No ?";
	}
}
// llamando la pantalla de pago para guardar finalmente la factura.
function call_pantalla_pago(){
	var lnqtyelement = tdetalles.rows.length - 1;
	if (lnqtyelement == 0){
		getmsgalert("No hay detalle en esta factura.");
		return false;
	}
	pantalla_pago.style.display="inline";
	ctrnno1.value  = xtrnno.value ;
	topay.value    = ntotamt.value;
	dpay.value     = dstardate.value;
	cdescpay.value = "Pago en efectivo";
	efectivo.focus();
}

function cerrar_pantalla_pago(){
	pantalla_pago.style.display="none";
	efectivo.value="";
	ck_vuelto();
}

function clear_view(){
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	oRequest.open("POST","../menu/menu_arsetup.php",false); 
	oRequest.send();
	// desplegando pantalla de menu con su informacion.
	var odata = JSON.parse(oRequest.response);
	// campos por defecto para el encabezado	
	document.getElementById("ccustno").value   = odata.ccustno;
	document.getElementById("cwhseno").value   = odata.cwhseno;
	document.getElementById("cpaycode").value  = odata.cpaycode;
	document.getElementById("dstardate").value = get_date_comp();
	document.getElementById("denddate").value  = get_date_comp();
	get_tc_rate();
	// detalle de la factura poniendolo en blanco
	articulos.innerHTML= "";	
	// cargando numero de transsaccion para esta factura temporal
	document.getElementById("xtrnno").value = get_trnno();
	// cargando valor de variables usadas en el proceso 
	ninvlinmax = odata.ninvlinmax;
	// poniendo en cero el pago recibido
	efectivo.value = "";
	nsubamt.value = "";
	ntaxamt.value = "";
	ntotamt.value = "";
	nlimcrd.value = "";
	nsalecust.value = "";
	//poniendo foco en la barra de codigo para lectura del scanner.
	cservno1.focus();
}

function isvalidentry(){
	var lnqtyelement = tdetalles.rows.length - 1;
	// Validando el numero de lineas en el detalle de factura.
	if (lnqtyelement >= ninvlinmax){
		getmsgalert("Maximo de lineas por factura es " + ninvlinmax +" lleva "+lnqtyelement);
		return false;
	}
	// validando el cliente
	if (ccustno.value == ""){
		getmsgalert("Indique un cliente");
		ccustno.focus();
		return false;
	}
	// validando el bodega
	if (cwhseno.value == ""){
		getmsgalert("Indique un Bodega");
		cwhseno.focus();
		return false;
	}
	// validando el vendedor
	if (crespno.value == ""){
		getmsgalert("Indique un Vendedor");
		crespno.focus();
		return false;
	}
	// validando condiciones
	if (cpaycode.value == ""){
		getmsgalert("Indique un Vendedor");
		cpaycode.focus();
		return false;
	}
	// validando fecha de inicio
	if (dstardate.value == ""){
		getmsgalert("Indique fecha de facturacion");
		dstardate.focus();
		return false;
	}
	if (denddate.value == ""){
		getmsgalert("Indique fecha de facturacion");
		ddenddate.focus();
		return false;
	}
	
	return true;
}

function cerrar_fupdt(){
	document.getElementById("pantalla_actualiza_linea").style.display="none";
}
// funcion de la cuadricula detalle productos
function editarFila(pcuid){
	// haciendo request que devuelva el contenido de la fila en formato JSON.
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cuid",pcuid);
	oDatos.append("accion","LIST");
	oDatos.append("xtrnno",document.getElementById("xtrnno").value);
	// enviando el request.
	oRequest.open("POST","../modelo/crud_arinvc.php",false); 
	oRequest.send(oDatos);
	// recibiendo el json.
	var odata = JSON.parse(oRequest.response); 
	// mostrando pantalla de edicion de archivo
	document.getElementById("pantalla_actualiza_linea").style.display="block";
	document.getElementById("idline").value   = pcuid;
	document.getElementById("fcservno").value = odata.cdesc;
	document.getElementById("fnqty").value    = odata.nqty;
	document.getElementById("fnprice").value  = odata.nprice;
	document.getElementById("fntax").value    = odata.ntax;
	document.getElementById("fndesc").value   = odata.ndesc;
	document.getElementById("fmnotas").value  = odata.mnotas;
}

function save_upd(){
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cuid",document.getElementById("idline").value);
	oDatos.append("accion","UPDATE");
	oDatos.append("xtrnno",document.getElementById("xtrnno").value);
	oDatos.append("nqty",document.getElementById("fnqty").value);
	oDatos.append("nprice",document.getElementById("fnprice").value);
	oDatos.append("ntax",document.getElementById("fntax").value);
	oDatos.append("ndesc",document.getElementById("fndesc").value);
	oDatos.append("mnotas",document.getElementById("fmnotas").value);
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_arinvc.php",false); 
	oRequest.send(oDatos);
	cerrar_fupdt();
	document.getElementById("articulos").innerHTML=oRequest.response;
	cksum();
}

function eliminarFila(pcuid){
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cuid",pcuid);
	oDatos.append("accion","DELETE");
	oDatos.append("xtrnno",document.getElementById("xtrnno").value);
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_arinvc.php",false); 
	oRequest.send(oDatos);
	document.getElementById("articulos").innerHTML=oRequest.response;
	cksum();
}
// inserta en el detalle este articulo
function upddet(){
	
	var llcont = isvalidentry();
	if (!llcont){
		document.getElementById("cservno1").value="";
		return ;
	}
	
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cservno1",document.getElementById("cservno1").value);
	oDatos.append("accion","INSERT");
	oDatos.append("xtrnno",document.getElementById("xtrnno").value);
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_arinvc.php",false); 
	oRequest.send(oDatos);
	// cargando el detalle.
	document.getElementById("cservno1").value="";
	document.getElementById("articulos").innerHTML=oRequest.response;
	cksum();
}
//refresca el valor de los totales de la tabla.
function cksum(){
	var otabla = document.getElementById("tdetalles");
	var lnsalesamt = 00, lntaxamt = 0,lndescamt = 0;
	var lnsalesamt_u = 00, lntaxamt_u = 0,lndescamt_u = 0;
	var lnveces = otabla.rows.length - 1;
	
	for (var i = 1; i <= lnveces; ++i){
		lnsalesamt_u = parseFloat(otabla.rows[i].cells[6].innerText);
		lndescamt_u  = parseFloat(otabla.rows[i].cells[4].innerText);
		lntaxamt_u   = parseFloat(lnsalesamt_u - lndescamt_u) * parseFloat(parseFloat(otabla.rows[i].cells[5].innerText)/100);
		// totales
		lnsalesamt += lnsalesamt_u;
		lndescamt  += lndescamt_u;
		lntaxamt   += lntaxamt_u;
	}
	// cargando los valores del total.
	nsubamt.value  = parseFloat(lnsalesamt);
	ndescamt.value = parseFloat(lndescamt);
	ntaxamt.value  = parseFloat(lntaxamt);
	ntotamt.value  = parseFloat((lnsalesamt + lntaxamt )- lndescamt);
}

window.onload=init;