<?php
	// Haciendo la coneccion.
	include("modelo/Coneccion.php");
	// Definiendo si se mando un menu 
	if (isset($_POST["idmenu"])){
		// creando la coneccion.
		$oConn = Coneccion::get_coneccion("CIA");
		// Decidiendo que menu ejecutara si la consulta completa  o solo un registro.
		// A)- Menu de Clientes.
		if ($_POST["idmenu"]=="btcustno"){
			if (isset($_POST["ccustno"])){
    		// Consulta unitaria
				$lcSqlCmd = " select * from arcust where ccustno ='". $_POST["ccustno"] ."'";
				// obteniendo datos del servidor
				$lcResult = $oConn->query($lcSqlCmd);
				// convirtiendo estos datos en un array asociativo
				$ldata = mysqli_fetch_assoc($lcResult);
				// convirtiendo este array en archivo jason.
				$jsondata =json_encode($ldata,true);
				// retornando objeto json
				echo $jsondata;

			}else{		
				// Menu completo de lista de clientes
				$lcSqlCmd = " select ccustno , cname , nlimcrd, ctel from arcust order by cname ";
				$lcResult = $oConn->query($lcSqlCmd);
				// devolvera una tabla
				echo "<table>
							<tr>
								<th>Codigo</th>
								<th>Nombre Completo</th>
								<th>Limite Credito</th>
								<th>Telefono</th>
								<th>Accion</th>
							</tr>	";
			
				while ($rows = mysqli_fetch_assoc($lcResult)){
					$lccustno   ='"'. $rows["ccustno"] .'"';
					$lcfullname ='"btcustno"';
					echo	"<tr>".
								"<td>". $rows["ccustno"] ."</td>".
								"<td>". $rows["cname"]   ."</td>".
								"<td>". $rows["nlimcrd"]  ."</td>".	
								"<td>". $rows["ctel"]  ."</td>".	
								"<td>".
									"<input type='button' value='Seleccionar' onclick='refres_window($lccustno,$lcfullname)'>".
								"</td>".
								"</tr>";
				}
				echo '</table>';
			}
		}
	}
?>
