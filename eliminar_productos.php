<?php

include ("conexion.php");

$id = $_GET['id'];

$sql = "DELETE FROM detalles_ventas WHERE Productos_idProductos = $id";
$resultado = mysqli_query($conex, $sql);

$sql = "DELETE FROM proveedores_productos WHERE Productos_idProductos = $id";
$resultado = mysqli_query($conex, $sql);

$sql = "DELETE FROM productos WHERE idProductos = $id";
$resultado = mysqli_query($conex, $sql);

if ($resultado) {
echo "<script> alert ('Se ha eliminado el producto con exito'); window.location = 'mostrar_productos.php' </script>";
}else {
    echo "<script> alert ('El producto no se ha eliminado'); window.location = 'mostrar_productos.php' </script>";
}

?>