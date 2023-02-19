<?php

include("conexion.php");

$id = $_POST['id'];
$title = $_POST['titulo'];
$des = $_POST['descripcion'];
$pre = $_POST['precio'];
$stock = $_POST['stock'];
$cat = $_POST['categoria'];

$tipoarchivo = $_FILES['imagen']['type'];
$nombrearchivo = $_FILES['imagen']['name'];
$tamanoarchivo = $_FILES['imagen']['size'];

$img = fopen($_FILES['imagen']['tmp_name'], 'r');

$binariosimg = fread($img, $tamanoarchivo);
$binariosimg = mysqli_escape_string($conex, $binariosimg);

$actualizar = "UPDATE productos SET Titulo='$title', Descripcion='$des', Precio='$pre', Cantidad_stock='$stock', Imagen='$binariosimg', Categorias_Productos_idCategorias_productos='$cat' WHERE idProductos = '$id'";

$resultado = mysqli_query($conex, $actualizar);

echo "<script> alert('Se ha actualizado el producto con exito'); window.location = 'mostrar_productos.php' </script>";
?>