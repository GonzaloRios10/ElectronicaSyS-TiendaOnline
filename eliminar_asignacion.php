<?php

include ("conexion.php");

$id = $_GET['id'];

$sql = "DELETE FROM proveedores_productos WHERE Productos_idProductos = $id";
$resultado = mysqli_query($conex, $sql);

if ($resultado) {
echo "<script> alert ('Se ha eliminado la asignación con exito'); window.location = 'proveedores_productos.php' </script>";
}else {
    echo "<script> alert ('La asignación no se ha eliminado'); window.location = 'proveedores_productos.php' </script>";
}