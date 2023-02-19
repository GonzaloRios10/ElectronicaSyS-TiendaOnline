<?php

include ("conexion.php");

if (isset($_POST['eliminar'])) {
	if(isset($_POST['eliminar_categoria'])){

		$cate = $_POST['eliminar_categoria'];

	    $sql = "DELETE FROM categorias_productos WHERE idCategorias_productos = $cate";
		$resultado = mysqli_query($conex, $sql);

	    if ($resultado) {
	    	?>
	    	<br><br>
	    	<h3>¡Eliminado correctamente!</h3>
           <?php
	    } else {
	    	?>
	    	<br><br>  
	    	<h3>¡Ups ha ocurrido un error!</h3>
           <?php
	    }
	}
}else if (isset($_POST['registrar'])) {
	if(isset($_POST['categoria'])){
$cate = $_POST['categoria'];

	    $consulta = "INSERT INTO categorias_productos(Tipo) VALUES ('$cate')";

	    $resultado = mysqli_query($conex, $consulta);

	    if ($resultado) {
	    	?>
	    	<br><br>
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