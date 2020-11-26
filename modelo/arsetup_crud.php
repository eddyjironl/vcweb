<?php
include("coneccion.php");

// ------------------------------------------------------------------------------------------------
// Desidiendo que hara si UPDATE o INSERT
// ------------------------------------------------------------------------------------------------
$oConn = get_coneccion("CIA");
$lcsqlcmd  = " select * from arsetup ";
$lresult_t = mysqli_query($oConn,$lcsqlcmd);
$lnupd     = mysqli_num_rows($lresult_t);

// ------------------------------------------------------------------------------------------------
// campos necesarios del formulario.
// ------------------------------------------------------------------------------------------------
$lninvno   = $_POST["ninvno"]  == ""? 1:$_POST["ninvno"];
$lncashno  = $_POST["ncashno"] == ""? 1:$_POST["ncashno"];
$lnadjno   = $_POST["nadjno"]  == ""? 1:$_POST["nadjno"];
$lnncno    = $_POST["nncno"]   == ""? 1:$_POST["nncno"];
$lnndno    = $_POST["nndno"]   == ""? 1:$_POST["nndno"];
$lncotno   = $_POST["ncotno"]  == ""? 1:$_POST["ncotno"];
$lccustno  = $_POST["ccustno"];
$lcwhseno  = $_POST["cwhseno"];
$lcpaycode = $_POST["cpaycode"];
$lccateno  = $_POST["ccateno"];
$lctypcost = $_POST["ctypcost"];
$lctaxproc = $_POST["ctaxproc"];
$llinvno   = isset($_POST["linvno"])  ? 1:0;
$llestados = isset($_POST["lestados"])? 1:0;
$llcoti    = isset($_POST["lcoti"])   ? 1:0;
$lminvno   = $_POST["minvno"];
$lmestados = $_POST["mestados"];
$lmcoti    = $_POST["mcoti"];
$lncashamt = $_POST["ncashamt"];
$lninvlinmax = $_POST["ninvlinmax"] ==""? 20:$_POST["ninvlinmax"];
// ------------------------------------------------------------------------------------------------
// armando la sentencia adecuada.
// ------------------------------------------------------------------------------------------------

if($lnupd == 0){
  $lcsql = " insert into arsetup(ninvno,ncashno,nadjno,nncno,nndno,ncotno,ninvlinmax,
  								ccustno,cpaycode,cwhseno,ccateno,carsetup,ctypcost,ctaxproc,
								 linvno,lestados,lcoti,minvno,mestados,mcoti,ncashamt)
						 values($lninvno,$lncashno,$lnadjno,$lnncno,$lnndno,$lncotno,$lninvlinmax,
  								'$lccustno','$lcpaycode','$lcwhseno','$lccateno','C','$lctypcost','$lctaxproc',
								 $llinvno,$llestados,$llcoti,'$lminvno','$lmestados','$lmcoti',$lncashamt)";
}else{
  $lcsql = " update arsetup set ninvno = $lninvno,ncashno=$lncashno, nadjno=$lnadjno,
								  nncno=$lnncno, nndno=$lnndno, ncotno=$lncotno,
									 ninvlinmax=$lninvlinmax, ccustno='$lccustno',cpaycode='$lcpaycode',
								  cwhseno='$lcwhseno', ccateno='$lccateno', 
									 ctypcost='$lctypcost', ctaxproc='$lctaxproc', linvno=$llinvno,
								  lestados=$llestados, lcoti=$llcoti, minvno='$lminvno',
									 mestados='$lmestados', mcoti= '$lmcoti', ncashamt = $lncashamt ";
}

// ------------------------------------------------------------------------------------------------
// Generando coneccion.
// ------------------------------------------------------------------------------------------------
mysqli_query($oConn,$lcsql);
mysqli_close($oConn);
header("location:../view/arsetup.php");

?>
