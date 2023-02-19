<?php
include("conexion.php");

if (isset($_POST['registrar'])) {
	if(isset($_FILES['imagen']['name'])){

		$codi = $_POST['id'];
		$titulo = $_POST['titulo'];
	    $des = $_POST['descripcion'];
		$pre = $_POST['precio'];
		$cantidad = $_POST['stock'];
		$op = $_POST['categoria'];
		
		$tipoarchivo = $_FILES['imagen']['type'];
		$nombrearchivo = $_FILES['imagen']['name'];
		$tamanoarchivo = $_FILES['imagen']['size'];

		$img = fopen($_FILES['imagen']['tmp_name'], 'r');

		$binariosimg = fread($img, $tamanoarchivo);
		$binariosimg = mysqli_escape_string($conex, $binariosimg);

		$sql = "INSERT INTO productos(idCategorias_productos) VALUES ('$op')";
        $query = mysqli_query($conex, $sql);

	    $consulta = "INSERT INTO productos(idProductos, Titulo, Descripcion, Precio, Cantidad_stock, Imagen, Categorias_Productos_idCategorias_productos) VALUES ('$codi', '$titulo', '$des', '$pre', '$cantidad', '$binariosimg', '$op')";

	    $resultado = mysqli_query($conex, $consulta);

	    if ($resultado) {
	    	?>
	    	<br><br>
	    	<h3>¡Registrado correctamente!</h3>
           <?php
	    } else {
	    	?>
	    	<br><br>
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


