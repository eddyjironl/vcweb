/*
DESCRIPCION.
-------------------------------------------------
Informacion:

Desarrollado por: Eddy Jiron
Fecha: 7/5/2020.
Lugar: Honduras, Olancho Salama.
--------------------------------------------------

El objetivo es colocar las funciones y funcionalidades comunes 
para la aplicacion Visual Control Web V2020.

*/
// inicializando variables necesarias.
var oBoxMsg   = "";
var oTexMsg   = "";
var oBtCerrar = "";
var gckeyid   = "";
var gckeydesc = "";
var gcbtkeyid = "";
//-------------------------------------------------------
// A)- listados de catalogos.
//-------------------------------------------------------
function get_lista_artran(){
	var oRequest = new XMLHttpRequest();
	oRequest.open("GET","../menu/menu_artran.php",false); // Genera una lista de clientes.
	oRequest.send();
	document.write(oRequest.responseText);
}
function get_lista_arresp(){
	var oRequest = new XMLHttpRequest();
	oRequest.open("POST","../modelo/crud_arresp.php",false); // Genera una lista de clientes.
	var oDatos = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","LISTA");
	oRequest.send(oDatos);
	document.write(oRequest.responseText);
}
function get_lista_artser(){
	var oRequest = new XMLHttpRequest();
	oRequest.open("POST","../modelo/crud_artser.php",false); 
	var oDatos = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","LISTA");
	oRequest.send(oDatos);
	document.write(oRequest.responseText);
}
function get_lista_arserv(){
	var oRequest = new XMLHttpRequest();
	oRequest.open("POST","../menu/menu_arresp.php",false); // Genera una lista de clientes.
	var oDatos = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","lista");
	oRequest.send(oDatos);
	document.write(oRequest.responseText);
}
function get_lista_arwhse(){
	var oRequest = new XMLHttpRequest();
	oRequest.open("GET","../menu/menu_arwhse.php",false); // Genera una lista de clientes.
	oRequest.send();
	document.write(oRequest.responseText);
}
function get_lista_arcate(pcwhere){
	var oRequest = new XMLHttpRequest();
	var oDatos   = new FormData();
	// determinando si vienen una condicion de filtro
	if (pcwhere != undefined){
		oDatos.append("where",pcwhere);
	}
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","LISTA");
	oRequest.open("POST","../modelo/crud_arcate.php",false); // Genera una lista de clientes.
	oRequest.send(oDatos);
	document.write(oRequest.responseText);
}
function get_lista_artcas(){
	var oRequest = new XMLHttpRequest();
	oRequest.open("GET","../menu/menu_artcas.php",false); // Genera una lista de clientes.
	oRequest.send();
	document.write(oRequest.responseText);
}
function get_lista_arcust(){
	var oRequest = new XMLHttpRequest();
	oRequest.open("GET","../menu/menu_arcust.php",false); // Genera una lista de clientes.
	oRequest.send();
	document.write(oRequest.responseText);
}


//-------------------------------------------------------
// B)- funciones numericas y de modulos
//-------------------------------------------------------
function get_trnno(){
	var lctrnno = Math.floor(Math.random() * 100000000);
	return lctrnno; 
}
//obtiene el monto de ventas y saldo de un cliente
function get_sales_amount(pccustno){
	var oRequest = new XMLHttpRequest();
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("program","get_sales_amount");
	oDatos.append("ccustno",pccustno);
	// obteniendo el menu
	oRequest.open("POST","../modelo/armodule.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var odata = JSON.parse(oRequest.response);
	return odata;
}
function get_inventory_onhand(pcservno){
	var oRequest = new XMLHttpRequest();
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("program","get_inventory_onhand");
	oDatos.append("cservno",pcservno);
	// obteniendo el menu
	oRequest.open("POST","../modelo/armodule.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var odata = JSON.parse(oRequest.response);
	return odata;
}

function doform(pcmenuid){
	var oRequest = new XMLHttpRequest();
	var oDatos   = new FormData();
	oDatos.append("program","permiso_de_acceso");
	oDatos.append("cmenuid",pcmenuid);
	oRequest.open("POST","../modelo/symodule.php",false); 
	oRequest.send(oDatos);
	var llcont = (oRequest.response == "1")? true:false;
	return llcont;	
}
function get_date_comp(){
	var odate  = new Date();
	var lcday  = get_real_day(odate.getDate());
	var lcMont = get_real_mont(odate.getMonth());
	var lcYear = odate.getFullYear();
	var lcDateReturn = lcYear + "-" + lcMont + "-" + lcday;
	
	return lcDateReturn;
}
function get_real_day(pdayc){
	var lcreturn = "";
	pday = parseInt(pdayc);
	if (pday == 1){
		lcreturn = "01";
	}
	if (pday == 2){
		lcreturn = "02";
	}
	if (pday == 3){
		lcreturn = "03";
	}
	if (pday == 4){
		lcreturn = "04";
	}
	if (pday == 5){
		lcreturn = "05";
	}
	if (pday == 6){
		lcreturn = "06";
	}
	if (pday == 7){
		lcreturn = "07";
	}
	if (pday == 8){
		lcreturn = "08";
	}
	if (pday == 9){
		lcreturn = "09";
	}
	if (pday > 9){
		lcreturn = pdayc;
	}
	return lcreturn;
}
function get_real_mont(pcmont){
	var lcreturn = "";
	if (pcmont == "0"){
		lcreturn = "01";
	}
	if (pcmont == "1"){
		lcreturn = "02";
	}
	if (pcmont == "2"){
		lcreturn = "03";
	}
	if (pcmont == "3"){
		lcreturn = "04";
	}
	if (pcmont == "4"){
		lcreturn = "05";
	}
	if (pcmont == "5"){
		lcreturn = "06";
	}
	if (pcmont == "6"){
		lcreturn = "07";
	}
	if (pcmont == "7"){
		lcreturn = "08";
	}
	if (pcmont == "8"){
		lcreturn = "09";
	}
	if (pcmont == "9"){
		lcreturn = "10";
	}
	if (pcmont == "10"){
		lcreturn = "11";
	}
	if (pcmont == "11"){
		lcreturn = "12";
	}
	return lcreturn;
}


//-------------------------------------------------------
// Dibuja pantallas base 
// mensajes instantaneos "MESSAGE()"
//-------------------------------------------------------

function get_msg(){
	var window_msg = "";
		window_msg  = '<section class="getmsgalert" id="getmsgalert">';
		window_msg += '		<section id="stitle">';
		window_msg += '			<STRONG>SISTEMA VISUAL CONTROL</STRONG>';
		window_msg += '		</section>';
		window_msg += '		<p id="msgerror"></p>';
		window_msg += '		<br>';
		window_msg += '<script>get_btprinc("btquit","msgquit")</script> ';
		window_msg += '	</section>';
	// escribiendo la pantalla.
	document.write(window_msg);
	// definiendo los objetos del menu.
	oBoxMsg    = document.getElementById("getmsgalert");
	oTexMsg    = document.getElementById("msgerror");
	oBtCerrar  = document.getElementById("msgquit");
	// Poniendo a la escucha los botones.
	//oBoxMsg.addEventListener("click",cerrar,false);
	oBoxMsg.style.display = "none";						  //	$(oMsgAlert).hide();
	oBtCerrar.addEventListener("click",cerrar_msg,false); //	$("#cerrar").click(cerrar);
}
// esta funcion se usa para enviar mensajes en la ventana msg 
function getmsgalert(pcTextMsg){
	oTexMsg.innerHTML = pcTextMsg;
	oBoxMsg.style.display = "block";
}
// Dibuja la Ventana de Lista de menu , la oculta por defecto y pone a la escucha el boton de cerrar.
function get_vmenu(){
	var ventana_menu  = "";
		ventana_menu  = "<div id='vmenu'>";
		ventana_menu += "	<div id='vheader' class='btbarra'>";
		ventana_menu += "		<script>get_bthelp('MENU GENERAL');</script>";
		ventana_menu += "		<strong id='titulo'>Listado de Contenidos de la tabla</strong>";
		ventana_menu += "		<br><br>";
		ventana_menu += "		<script>get_btprinc('btquit','btcerrar');</script>";
		ventana_menu += "	</div>";
		ventana_menu += "	<div id='vcolumnas'></div>";
		ventana_menu += "	<div id='vlista'></div>";
		ventana_menu += "</div>";

	document.write(ventana_menu);
	// poniendo a la escucha el boton de cierre.
	var oMenu   = document.getElementById("vmenu");
	var bcerrar = document.getElementById("btcerrar");
	bcerrar.addEventListener("click",cerrar,false);
	oMenu.style.display="none";
}	
// funcion para dibujar menu vista.
function get_xm_menu(){
	// dibujando pantalla de menu.
	var oMenu = '<section class="mx_area_bloqueo" id="xm_area_menu">';
		oMenu +='	<section class="form2" id="form_menu">';
		oMenu +='		<div class="mx_barra_sencilla" id="mx_barra_sencilla">';
		oMenu +='			<strong id="mx_titulo">Listado de Tabla</strong>';
		oMenu +='			<br>';
		oMenu +='			<label class="labelnormal">Ordenado por </label>';
		oMenu +='			<select class="listas" id="mx_opc_order"></select>';
		oMenu +='			<br>';					
		oMenu +='			<label class="labelnormal">Buscar</label>';
		oMenu +='			<input type="text" id="mx_cbuscar" name="mx_cbuscar" class="textnormal">';
		oMenu +='		</div>';
		oMenu +='		<br>';
		oMenu +='		<div class="mx_area_encabezado">';
		oMenu +='			<table id="mx_head" class="mx_formato_datos"></table>';
		oMenu +='		</div>';
		oMenu +='		<br>'; 
		oMenu +='		<div class="mx_area_detalles">';
		oMenu +='			<table id="mx_detalle" class="mx_formato_datos"></table>';
		oMenu +='		</div>';
		oMenu +='		<div class= "mx_area_encabezado">';
		oMenu +='			<script>';
		oMenu +='				get_boton("bt_menu_salir","salir.ico","Cerrar");';	
		oMenu +='			</script>';
		oMenu +='		</div>';
		oMenu +='	</section>';
		oMenu +='</section>';
	// escribiendo la ventana.
	document.write(oMenu);
	document.getElementById("bt_menu_salir").addEventListener("click",cerrar_mx_view,false);
	document.getElementById("xm_area_menu").style.display="none";
}
// Cerrando ventana de menu.
function cerrar_mx_view(){
	document.getElementById("xm_area_menu").style.display="none";
}





// BOTONES.
function set_url(pcobj,pcurl){
	document.getElementById(pcobj).setAttribute("href",pcurl);
}
// boton de ver transacciones.
function get_btdtrn(pcIdMenu,pcDesc, pcurl){
	/*
		DESCRIPCION.
		----------------
		1) pcIdMenu = Este parametro indica de que tabla debera sacar los datos asociado con el ID del boton que llama.
		El procedimiento estandar, la convencion sera:
		Ejemplo para el caso de tabla de clientes arcust.
								PREVIFIJO   : bt
								LLAVE TABLA : ccustno
								Resultado   :	btccustno
		2) pcDesc   = Descripcion que saldra en el listado al pasar el raton por defecto.
	*/
	var oBtMenu = "";
	var lcDesc  = "Listas - Sistema Visual Control Web";
	
	if(pcIdMenu == ""){
		alert("no ha indicado el menu que conecta al boton");
		return ;
	}
	if(pcDesc != ""){
		lcDesc = pcDesc;
	}
	
	// desidiendo que tipo de boton se construira 
	if (pcurl == undefined){
		oBtMenu += "<img  src='../photos/vertran.bmp' title='" + lcDesc + "' class='btmenu' alt='x'  id='" + pcIdMenu + "' name= '" + pcIdMenu + "' />";
	}else{
		//../photos/buscar.bmp
		oBtMenu =  "<a href='"+ pcurl + "'  id='" + pcIdMenu +"' name='" + pcIdMenu + "' >";
		oBtMenu += "<img  src='../photos/vertran.bmp' title='" + lcDesc + "' class='btmenu' alt='x'/>";
		oBtMenu += "</a>";
	}
  	document.write(oBtMenu);
}
// boton de menu.			
function get_btmenu(pcIdMenu,pcDesc){
	/*
		DESCRIPCION.
		----------------
		1) pcIdMenu = Este parametro indica de que tabla debera sacar los datos asociado con el ID del boton que llama.
		El procedimiento estandar, la convencion sera:
		Ejemplo para el caso de tabla de clientes arcust.
								PREVIFIJO   : bt
								LLAVE TABLA : ccustno
								Resultado   :	btccustno
		2) pcDesc   = Descripcion que saldra en el listado al pasar el raton por defecto.
	*/
	var oBtMenu = "";
	var lcDesc  = "Listas - Sistema Visual Control Web";
	
	if(pcIdMenu == ""){
		alert("no ha indicado el menu que conecta al boton");
		return ;
	}
	
	if(pcDesc != ""){
		lcDesc = pcDesc;
	}
	
	//../photos/buscar.bmp
  oBtMenu = "<img id='" + pcIdMenu +"' name='" + pcIdMenu + "' src='../photos/buscar.bmp' title='" + lcDesc + "' class='btmenu' alt='x'/>";
  document.write(oBtMenu);
}
// boton de ayuda para la barra de navegacion.
function get_bthelp(pcDesc){
	/*
		DESCRIPCION.
		----------------
		2) pcDesc   = Descripcion que saldra en el listado al pasar el raton por defecto.
	*/
	var oBtMenu = "";
	var lcDesc  = "Documentacion Sistema Visual Control Web";

	if(pcDesc != ""){
		lcDesc = pcDesc;
	}
	//../photos/buscar.bmp
  	oBtMenu = "<img id='helpview' name='helpview' src='../photos/vc2009.ico' title='" + lcDesc + "' class='bthelp' alt='x'/>";
	document.write(oBtMenu);
}

function get_clear_view(){
	var oinput = document.querySelectorAll("input");
	var olista = document.querySelectorAll("select");
	var oTexta = document.querySelectorAll("Textarea");
	var oImg   = document.querySelectorAll("img");
		for (var i=0; i<oinput.length; i++){
			oinput[i].value = "";
		}
		// limpiando las listas.
		for (var i=0; i<olista.length; i++){
			olista[i].value = "";
		}
		// limpiando las campos textarea.
		for (var i=0; i<oTexta.length; i++){
			oTexta[i].value = "";
		}
		estado_key("A");
}

// habilita o desabilita el objeto key ID de cada catalogo master.
function estado_key(pcaction){
	// obteniendo el estado de 
	var lcestado = document.getElementById(gckeyid).getAttribute("class");
	// cambiando el estado segun este el objeto principal
	if (pcaction == "A"){
		// estado de activo
		document.getElementById(gckeyid).setAttribute("class","textkey");
		document.getElementById(gckeyid).focus();
		document.getElementById(gckeyid).readOnly   = false;
		document.getElementById(gcbtkeyid).disabled = false; //.readOnly = false;
	}else{
		// estado inactivo
		document.getElementById(gckeyid).setAttribute("class","textkey_inactivo");
		document.getElementById(gckeyid).readOnly   = true;
		document.getElementById(gcbtkeyid).disabled = true; //.readOnly = true;
		document.getElementById(gckeydesc).focus();
	}
}

// hace la pregunta de si se quiere adicionar un nuevo registro de no encontrar
// el codigo escrito en el keyid
function ck_new_key() {
	var msg   = "El Codigo no se encuentra en el archivo desea incluirlo? ";
	var lckey = document.getElementById(gckeyid).value ;
	// desidiendo que hace el codigo
	if (confirm(msg)){
		// limpiando todos los datos.
		get_clear_view();
		// colocando en estado inactivo porque hay un valor que procesar
		estado_key("I");
	}else{
		// limpiando todos los datos.
		get_clear_view();
		lckey = "";
	}
	document.getElementById(gckeyid).value = lckey;
}

// cierra la pantalla del menu de forma general.
// pasar objeto e para que identifiquemos el ID 
// Y segun ese id saber si es la pantalla de menu o boxmsg
// y cerrar ambass desde el mismo.
function cerrar(e){
	document.getElementById("vmenu").style.display = "none";	
}

// cerrar la ventana de mensajes del sistema.
function cerrar_msg(){
	document.getElementById("getmsgalert").style.display = "none";	
}

// manda a refrescar la pantalla principal del menu.
function refres_window(e,pckeyid,pcmenuid){
	cerrar(e);
	// esta funcion se debe crear en la pantalla local
	update_window(pckeyid,pcmenuid);
}

// barra de botones Standar para catalogos.
// Existen tres tipos de botones en Visual Control 
function get_btprinc(pcboton_name,pcid){
	// si el ID esta vacio entonces coloca el nombre del boton por el tipo de boton
	var lcid = "";
	if (pcid == ""){
		lcid = pcboton_name;
	}else{
		lcid = pcid;
	}
	
	var lcbt  = '<button class="btbarra" ';
		lcbt +=	'style="width:60px; height:60px" ';
		lcbt +=	'type="button" ';
	// boton de guardar		
	if(pcboton_name == "btsave"){
			lcbt +=	'name="' + lcid + '" id="' + lcid + '" ';
			lcbt +=	'title="Guarda la informacion de la pantalla" ';
			lcbt +=	'accesskey="g"> ';
			lcbt +=	'<img style="width:30px; height:30px" src="../photos/save.ico" alt="x" /> '
			lcbt +=	'<br>Guardar ';
	}
	// boton new para limpieza de formulario
	if(pcboton_name == "btnew"){
			lcbt +=	'name="' + lcid + '" id="' + lcid + '" ';
			lcbt +=	'title="Limpia la pantalla para escribir nuevos registros" ';
			lcbt +=	'accesskey="g"> ';
			lcbt +=	'<img style="width:30px; height:30px" src="../photos/nueva.ico" alt="x" /> '
			lcbt +=	'<br>Nueva ';
	}		
	// boton salir para cerrar algunos formularios.
	if(pcboton_name == "btquit"){
			lcbt +=	'name="' + lcid + '" id="' + lcid + '" ';
			lcbt +=	'title="Cierra la pantalla" ';
			lcbt +=	'accesskey="s"> ';
			lcbt +=	'<img style="width:30px; height:30px" src="../photos/salir.ico" alt="x" /> '
			lcbt +=	'<br>Salir ';
	}							
	// boton para borrar registros en la base de datos.
	if(pcboton_name == "btdelete"){
			lcbt +=	'name="' + lcid + '" id="' + lcid + '" ';
			lcbt +=	'title="Elimina registros de la base de datos" ';
			lcbt +=	'accesskey="d"> ';
			lcbt +=	'<img style="width:30px; height:30px" src="../photos/e_borrar.gif" alt="x" /> '
			lcbt +=	'<br>Borrar ';
	}							
	// boton para imprimir
	if(pcboton_name == "btprint"){
			lcbt +=	'name="' + lcid + '" id="' + lcid + '" ';
			lcbt +=	'title="Visualizar reporte en pantalla" ';
			lcbt +=	'accesskey="d"> ';
			lcbt +=	'<img style="width:30px; height:30px" src="../photos/printer.gif" alt="x" /> '
			lcbt +=	'<br>Reporte';
	}	
	// cerrando la construccion del boton
	lcbt +=	'</button>';
  	// mostrando el boton 
	document.write(lcbt);
}
//formato standar de botones del sistema.
function get_boton(pcboton_name,pcpicture,pcDescShort){
	//-----------------------------------------------------------------------------------------
	// Descripcion.
	// pcboton_name: 	ID del boton.
	// pcpicture:		Foto del boton que se creara
	// pcDescShort:		Descripcion corta del boton o Label del boton.
	//-----------------------------------------------------------------------------------------
	// si el ID esta vacio entonces coloca el nombre del boton por el tipo de boton
	var lcid = pcboton_name;
	pcpicture = "../photos/" + pcpicture;
	
	var lcbt  = '<button class="btbarra" ';
		lcbt +=	'style="width:60px; height:60px" ';
		lcbt +=	'type="button" ';
		lcbt +=	'name="' + lcid + '" id="' + lcid + '" ';
		lcbt +=	'title="" ';
		lcbt +=	'accesskey="g"> ';
		lcbt +=	'<img style="width:30px; height:30px" src="' + pcpicture + '" alt="x" /> '
		lcbt +=	'<br>' + pcDescShort;
	    lcbt +=	'</button>';
  	// mostrando el boton 
	document.write(lcbt);
}



//-------------------------------------------------------------------------------------
/* BARRAS DE NAVEGACION */
//-------------------------------------------------------------------------------------
// A}- Barra de catalogos
function get_barraprinc(pcWindowTitle,pcHelpDesc,pnAncho){
	lcHelpDesc = pcHelpDesc; //"Click para ver documentacion del Sistema" ;
	// barra principal
	var oBarPrinc  = '<div id="barra_princ" style="width:' + pnAncho + 'px;">';
		oBarPrinc += '	<script>get_bthelp("'+ lcHelpDesc +'");</script> ';
		oBarPrinc += '	<strong>' + pcWindowTitle + '</strong>	';
		oBarPrinc += '	<br>';
		oBarPrinc += '	<script>';
		oBarPrinc += '	get_btprinc("btsave","btguardar");'; 
		oBarPrinc += '		get_btprinc("btnew","btnueva");';
		oBarPrinc += '		get_btprinc("btdelete","btdelete");';
		oBarPrinc += '	</script>';
		oBarPrinc += '</div>';
	
	document.write(oBarPrinc);	
}
function get_barraprinc_x(pcWindowTitle,pcHelpDesc,pnAncho){
	lcHelpDesc = pcHelpDesc; //"Click para ver documentacion del Sistema" ;
	// barra principal
	var oBarPrinc  = '<div id="barra_princ" class="barra_princ" >';
		oBarPrinc += '	<script>get_bthelp("'+ lcHelpDesc +'");</script> ';
		oBarPrinc += '	<strong>' + pcWindowTitle + '</strong>	';
		oBarPrinc += '	<br>';
		oBarPrinc += '	<script>';
		oBarPrinc += '	get_btprinc("btsave","btguardar");'; 
		oBarPrinc += '		get_btprinc("btnew","btnueva");';
		oBarPrinc += '		get_btprinc("btdelete","btdelete");';
		oBarPrinc += '		get_btprinc("btquit","btquit");';
		oBarPrinc += '	</script>';
		oBarPrinc += '</div>';
	
	document.write(oBarPrinc);	
}

// B)- Barra de Transacciones.
function get_barraprinc_trn(pcWindowTitle,pcHelpDesc,pnAncho){
	lcHelpDesc = pcHelpDesc; //"Click para ver documentacion del Sistema" ;
	// barra principal
	var oBarPrinc  = '<div id="barra_princ" style="width:' + pnAncho + 'px;">';
		oBarPrinc += '	<script>get_bthelp("'+ lcHelpDesc +'");</script> ';
		oBarPrinc += '	<strong>' + pcWindowTitle + '</strong>	';
		oBarPrinc += '	<br>';
		oBarPrinc += '	<script>';
		oBarPrinc += '	get_btprinc("btsave","btguardar");'; 
		oBarPrinc += '		get_btprinc("btnew","btnueva");';
		oBarPrinc += '	</script>';
		oBarPrinc += '</div>';

	document.write(oBarPrinc);	
}
function get_barraprinc_trn_x(pcWindowTitle,pcHelpDesc,pnAncho){
	lcHelpDesc = pcHelpDesc; //"Click para ver documentacion del Sistema" ;
	// barra principal
	var oBarPrinc  = '<div id="barra_princ" class="barra_princ">';
		oBarPrinc += '	<script>get_bthelp("'+ lcHelpDesc +'");</script> ';
		oBarPrinc += '	<strong>' + pcWindowTitle + '</strong>	';
		oBarPrinc += '	<br>';
		oBarPrinc += '	<script>';
		oBarPrinc += '	    get_btprinc("btsave","btguardar");'; 
		oBarPrinc += '		get_btprinc("btnew","btnueva");';
		oBarPrinc += '		get_btprinc("btquit","btquit");';
		oBarPrinc += '	</script>';
		oBarPrinc += '</div>';

	document.write(oBarPrinc);	
}

// C)- Barra de Impresion
function get_barraprint(pcWindowTitle,pcHelpDesc,pnAncho,pcurl){
	lcHelpDesc = pcHelpDesc; //"Click para ver documentacion del Sistema" ;
	// barra principal
	var oBarPrinc  = '<div id="barra_princ" style="width:' + pnAncho + 'px;">';
		oBarPrinc += '	<script>get_bthelp("'+ lcHelpDesc +'");</script> ';
		oBarPrinc += '	<strong>' + pcWindowTitle + '</strong>	';
		oBarPrinc += '	<br>';
		oBarPrinc += '	<a target="_blank" id="btprint_url" name="btprint_url">';
		oBarPrinc += '		<script>';
		oBarPrinc += '			get_btprinc("btprint","btprint");';
		oBarPrinc += '			get_btprinc("btquit","btquit");';
		oBarPrinc += '			get_btprinc("btnew","btnueva");';
		oBarPrinc += '		</script>';
		oBarPrinc += '	</a>';
		oBarPrinc += '</div>';
//		oBarPrinc += '	<a href="' + pcurl + '" target="_blank" id="btprint_url" name="btprint_url">';
	document.write(oBarPrinc);	
}

//-------------------------------------------------------------------------------------
