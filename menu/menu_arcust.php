<?php
	// incluyendo la clase de coneccion
	include("../modelo/coneccion.php");
  // creando la coneccion.
	$oConn    = get_coneccion("CIA");
	$lcSqlCmd = " select ccustno , cname from arcust order by cname ";
	$lcResult = $oConn->query($lcSqlCmd);

	echo '<select class="listas" name="ccustno" id="ccustno" required>';
	echo '<option value="">Cliente no ha sido  especificado</option>';		
	
	while ($rows = mysqli_fetch_assoc($lcResult)){
		echo "<option value='" . $rows["ccustno"] ."'>" . $rows["cname"] . "</option>";
	}
	echo '</select>';
?>