<?php
//---------------------------------------------------------------------------------------------------
// DESCRIPCION DEL PROCEDIMIENTO.
// hecho por : Eddy Jiron Guillen, 3 de junio del 2020 (Plena cuarentena.)
// este programa devuelve tres posibles cosas.
// 1- Un JSON.      = Con la informacion de cada registro para refrescar los View
// 2- Una Lista.    = con todos los datos de la tabla usado para los maestros relacionados.
// 3- Una pantalla. = lista de menu tipo las de VC2009 de escritorio.
//---------------------------------------------------------------------------------------------------
// incluyendo la clase de coneccion
include("../modelo/coneccion.php");
// creando la coneccion.
$oConn = get_coneccion("CIA");

if (isset($_POST["accion"])){
	$lcaccion = $_POST["accion"];
}else{
	return ;
}

// despliega la pantalla del menu.
if ($lcaccion == "menu"){
	if (isset($_POST["opcion"])){
		echo "<table>
			<tr id='th_menu'>
				<th style='width:100px;'>Codigo</th>
				<th style='width:200px;'>Nombre Completo</th>
				<th style='width:100px;'>Telefono</th>
				<th style='width:100px;'>Accion</th>
			</tr>	
		</table>";
	}else{
//		$oConn = get_coneccion("CIA");
		// Menu completo de lista de clie,$lcSqlCmdn;tes
		$lcSqlCmd = " select crespno , cfullname , mtels from arresp order by crespno ";
		$lcResult = mysqli_query($oConn,$lcSqlCmd); 
		// devolvera una tabla
		echo "<table>";
		while ($rows = mysqli_fetch_assoc($lcResult)){
			$lcrespno   ='"'. $rows["crespno"] .'"';
			$lcfullname ='"btcrespno"';
			$lcnombre   = " '".$rows["cfullname"] ."' ";
			echo	"<tr>".
					"<td style='width:100px;'>". $rows["crespno"] ."</td>".
					"<td style='width:200px;'>". $rows["cfullname"]   ."</td>".
					"<td style='width:100px;'>". $rows["mtels"]  ."</td>".	
					"<td>".
						"<input type='button' value='Seleccionar' id='btmenu_list' name='btmenu_list' ".
						"title=" . $lcnombre . " onclick='refres_window(btmenu_list[0].id,$lcrespno,$lcfullname)'>".
					"</td>".
				"</tr>";
		}
		echo '</table>';
	}
}S

// Genera un JSON
if ($lcaccion == "json"){

	if (isset($_POST["crespno"])){
	//	$oConn = get_coneccion("CIA");
 		// Consulta unitaria
		//$lcSqlCmd = " select * from arresp where arresp.crespno ='". $_POST["crespno"] ."'";
		$lcSqlCmd = " select arresp.*, sum(aptran.namount) as nsaldo 
				              from arresp 
							  join aptran on arresp.crespno = aptran.crespno
							  where arresp.crespno ='". $_POST["crespno"] ."'";
				
		
		
		// obteniendo datos del servidor
		//$lcResult = $oConn->query($lcSqlCmd);
		$lcResult = mysqli_query($oConn,$lcSqlCmd); // $oConn->query($lcSqlCmd);
		// convirtiendo estos datos en un array asociativo
		$ldata = mysqli_fetch_assoc($lcResult);
		// convirtiendo este array en archivo jason.
		$jsondata = json_encode($ldata,true);
		// retornando objeto json
		echo $jsondata;

	}	
}
	
if ($lcaccion == "lista"){
		//$oConn = get_coneccion("CIA");
	    $lcSqlCmd = " select * from arresp order by crespno ";
		$lcResult = mysqli_query($oConn,$lcSqlCmd);
		echo '<select class="listas" name="crespno" id="crespno" required>';
		echo '<option value="">Elija un Registro </option>';		
		while ($rows = mysqli_fetch_assoc($lcResult)){
			echo "<option value='" . $rows["crespno"] ."'>"  . $rows["cfullname"]  . "</option>";
		}
		echo '</select>';
}
mysqli_close($oConn);	
	
	
?>