<?php 

include("conexion.php");

$provincia=$_POST['provincia'];

	$sql="SELECT idLocalidades,
			Provincias_idProvincias,
			Localidad 
			FROM localidades 
			WHERE Provincias_idProvincias='$provincia'";

	$result=mysqli_query($conex, $sql);

	$cadena="<select id='lista2' name='lista2'>";

	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.($ver[2]).'</option>';
	}

	echo  $cadena."</select>";
	

?>