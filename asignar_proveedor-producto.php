<?php

include ("conexion.php");

if (isset($_POST['registrar'])) {

	$proveedor = $_POST['asignar_proveedor'];
	$producto = $_POST['asignar_producto'];

    $sql = "INSERT INTO proveedores_productos(Proveedores_idProveedores, Productos_idProductos) 
    VALUES ('$proveedor', '$producto')";

	$resultado = mysqli_query($conex, $sql);

    if ($resultado) {
    	?>
    	<br><br>
    	<h3>¡Asignado correctamente!</h3>
       <?php
    } else {
    	?>
    	<br><br>  
    	<h3>¡Ups ha ocurrido un error!</h3>
       <?php
    }
}

?>