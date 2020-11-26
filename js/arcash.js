function init(){
	document.getElementById("btquit").addEventListener("click",cerrar_pantalla_principal,false);
	document.getElementById("btguardar").addEventListener("click",guardar,false);
	document.getElementById("btnueva").addEventListener("click",clear_view,false);
	document.getElementById("ccustno").addEventListener("change",update_window,false);
	document.getElementById("ndistri").addEventListener("change",distribucion,false);
	document.getElementById("dtrndate").addEventListener("change",get_tc_rate,false);
}

function distribucion(){
	var lnamtdt = document.getElementById("ndistri").value;
	var lntotal = 0.00;
	var lnabono = 0.00;
	var otabla  = document.getElementById("tdetalles");
	var lnrows  = otabla.rows.length - 1;

	// verificando que haya un monto a distribuir
	
	if (lnrows <= 0){
		getmsgalert("No hay saldos para distribuir");
		return;
	}

	if (lnamtdt == ""){
		getmsgalert("No ha indicado monto a distribuir");
		return;
	}else{
		lnamtdt = parseFloat(lnamtdt);
	}
	
	// limpiando cada campo de abono para dejar solo lo que se piensa distribuir
	for (var i=1; lnrows >= i ; i++){
		value = lnclearvalue = 0;
		otabla.rows[i].cells[5].children["saldo"].value = "";  //lnclearvalue.toFixed(2);
	}
	// aplicando distribucion
	for (var i=1; lnrows >= i ; i++){
		// monto de la deuda.
		lntotal = parseFloat(otabla.rows[i].cells[4].innerText);
		// desidiendo si aplica solo una parte o el total del monto a una factura.
		if (lnamtdt > lntotal){
			otabla.rows[i].cells[5].children["saldo"].value = lntotal.toFixed(2);	
			lnamtdt = lnamtdt - lntotal;
		}else{
			if (lnamtdt == 0){
				otabla.rows[i].cells[5].children["saldo"].value ="";		
			}else{
				otabla.rows[i].cells[5].children["saldo"].value = lnamtdt.toFixed(2);		
			}
			lnamtdt = 0;
			break;
		}
	}
	// mostrando mensaje que indica que sobro dinero para distribuir y que no se 
	//usara en nada.
	if (lnamtdt > 0){
		getmsgalert("Exedente a distribuir de "+ lnamtdt.toFixed(2) + " no sera usado en nada");
	}
	cksum();
	
}

// cerrar pantalla principal
function cerrar_pantalla_principal(){
	document.getElementById("arcash").style.display="none";
}
// guardar registro principal
function guardar(){
	var llcont = false, lnveces = 1,lnpayamt = 0, lnvalue = 0,lcinvno, odata = "" ;
	
	// a)- validaciones de campos obligatorios.
	if(document.getElementById("ccustno").value ==""){
		getmsgalert("Indique Cliente");
		return ;
	}
	if(document.getElementById("dtrndate").value ==""){
		getmsgalert("Indique Fecha de pago");
		return ;
	}
	if(document.getElementById("cdesc").value ==""){
		getmsgalert("Falta la descripcion del pago");
		return ;
	}
	if(document.getElementById("ctype").value ==""){
		getmsgalert("No indico Forma de pago");
		return ;
	}
	if(document.getElementById("ctypedoc").value ==""){
		getmsgalert("No indico Tipo de Documento");
		return ;
	}
	// b)- Validando que hayan detalles a procesar.
	var otabla = document.getElementById("tdetalles");
	var lnrows = otabla.rows.length - 1;
	if(lnrows == 0){
		getmsgalert("No hay detalle de facturas cliente no tiene cuentas pendientes");
		return ;
	}
	// verificando que haya colocado algun valor en el detalle de pago.
	for (var i = 1; i<=lnrows; ++i){
		// obteniendo valor de celdas en cada fila
		lnvalue = parseFloat(otabla.rows[i].cells[5].children["saldo"].value);
    	// si hay algo en el monto a aplicar en cualquier fila, procesara el pago y continua.
		if (!isNaN(lnvalue)){
			llcont = true;
			lnpayamt += lnvalue; 
		}		
	}
	if(!llcont){
		getmsgalert("No hay pagos que procesar");
		return;
	}
	// b)- armando JSON.
	// b.1)- Armando el encabezado.
	odata += '{"ccustno":"'  + document.getElementById("ccustno").value  + '",';
	odata += ' "dtrndate":"' + document.getElementById("dtrndate").value + '",';
	odata += ' "cdesc":"'    + document.getElementById("cdesc").value    + '",';
	odata += ' "ctype":"'    + document.getElementById("ctype").value    + '",';
	odata += ' "ctypedoc":"' + document.getElementById("ctypedoc").value + '",';
	odata += ' "ntc":'       + document.getElementById("ntc").value   	 + ',';
	odata += ' "cctaid":"'   + document.getElementById("cctaid").value   + '",';
	odata += ' "mnotas":"'   + document.getElementById("fmnotas").value  + '",';
	odata += ' "crefno":"'   + document.getElementById("crefno").value   + '",';
	odata += ' "cdesc":"'    + document.getElementById("cdesc").value    + '",';
	odata += ' "npayamt":'   + lnpayamt + ',';
	// b.2)- Armando el detalle
	odata += ' "pagos":[' ;
	// recorriendo la tabla en busca de abono y factura.
	for (var i = 1; i<=lnrows; ++i){
		// obteniendo valor de celdas en cada fila
		lnvalue = parseFloat(otabla.rows[i].cells[5].children["saldo"].value);
		lcinvno = otabla.rows[i].cells[0].innerText;
    	// si hay algo en el monto a aplicar en cualquier fila, procesara el pago y continua.
		if (!isNaN(lnvalue)){
			// si es la primera vez
			if (lnveces == 1){
				odata += '{"cinvno":"' + lcinvno + '","npay":' + lnvalue + '}' ;
				lnveces = 2;
			}else{
				odata += ',{"cinvno":"'  + lcinvno + '","npay":' + lnvalue + '}' ;
			} // if (lnveces == 1){
		} // if (!isNaN(lnvalue)){		
	} // for (var i = 1; i<lnrows; ++i){
	odata += ']}' ;
	// codigo request para enviar al crud de php
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("json",odata);
	oDatos.append("accion","NEW");
	oRequest.open("POST","../modelo/crud_arcash.php",false); 
	oRequest.send(oDatos);
	clear_view();
	//getmsgalert(oRequest.responseText);
}

function clear_view(){
	document.getElementById("detalles").innerHTML = "";
	get_clear_view();
	cksum();
}

function update_window(){
	// colocando todos los datos del encabezado por default
	// -----------------------------------------------------
	document.getElementById("dtrndate").value = get_date_comp();
	document.getElementById("ctype").value    = "EF";
	document.getElementById("ctypedoc").value ="RC";
	document.getElementById("cdesc").value = "Pago en Efectivo";

	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("ccustno",document.getElementById("ccustno").value);
	oDatos.append("accion","REFRESH");
	oRequest.open("POST","../modelo/crud_arcash.php",false); 
	oRequest.send(oDatos);
	document.getElementById("detalles").innerHTML = oRequest.response;
	set_validation_table();
	get_tc_rate();
	cksum();
}

function set_validation_table(){
	var oinput = document.querySelectorAll("#saldo");
	for (var i=0; i<oinput.length; i++){
		// poniendo a la escucha del evento ONCHANGE cada objeto
		oinput[i].onchange = valid_pay;
		//oinput[i].valueAsNumber = 0;
	}
}

function valid_pay(e){
	// monto que esta pagando
	var lntpago = parseFloat(e.target.value);
	var lnsaldo = parseFloat(e.path[2].cells[4].innerText);
    // verificando que no se pague mas de lo que es.
	if (lntpago > lnsaldo){
		var lcmsg = "Esta aplicando " + lntpago + " y la factura es por " + lnsaldo+ "<br> la Cantidad no puede ser mayor que el saldo ";
		getmsgalert(lcmsg);
		e.target.value = "";
	}
	if (lntpago <= 0){
		var lcmsg = "No puede hacer un pago por un valor invalido";
		getmsgalert(lcmsg);
		e.target.value = "";
	}
	cksum();
}

function cksum(){
	var lntotal = 0.00,lnpayto = 0.00;
	var otabla = document.getElementById("tdetalles");
	var lnrows = otabla.rows.length - 1;
	var xvalue = 0;
	for (var i=1; lnrows >= i ; i++){
         lntotal += parseFloat(otabla.rows[i].cells[4].innerText);
		 xvalue = parseFloat(otabla.rows[i].cells[5].children["saldo"].value);
		 // determinando si lo que viene es un valor vasio por tanto es 0
		 if (isNaN(xvalue)){
			xvalue = 0; 
		 }
		 lnpayto += parseFloat(xvalue);
	}
	document.getElementById("ntotal").value= lntotal.toFixed(2);
	document.getElementById("npayto").value= lnpayto.toFixed(2);
	document.getElementById("nsalpe").value= (lntotal - lnpayto).toFixed(2);
}
// obteniendo el tipo de cambio.
function get_tc_rate(){
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("dtrndate",document.getElementById("dtrndate").value);
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
window.onload=init;