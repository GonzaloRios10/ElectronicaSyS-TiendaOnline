<?php

include("conexion.php");

if (isset($_POST['registrar'])) {
	if(isset($_POST['nombre'])){

		$nom = $_POST['nombre'];
		$tel = $_POST['telefono'];
		$ciudad = $_POST['localidad_provincia'];

	    $consulta = "INSERT INTO proveedores(Nombre, Telefono, Localidades_idLocalidades) VALUES ('$nom', 	    	'$tel', '$ciudad')";

	    $resultado = mysqli_query($conex, $consulta);

	    if ($resultado) {
	    	?>
	    	<br> 
	    	<h3>¡Registrado correctamente!</h3>
           <?php
	    } else {
	    	?>
	    	<br>  
	    	<h3>¡Ups ha ocurrido un error!</h3>
           <?php
	    }
    } else {
	    	?>
	    	<br>  
	    	<h3>¡Por favor complete los campos!</h3>
           <?php
    }
}

?>

