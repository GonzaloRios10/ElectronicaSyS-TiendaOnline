<?php

include ("conexion.php");

$id = $_GET['id'];

$sql = "DELETE FROM proveedores_productos WHERE Proveedores_idProveedores = $id";
$resultado = mysqli_query($conex, $sql);

$sql = "DELETE FROM proveedores WHERE idProveedores = $id";
$resultado = mysqli_query($conex, $sql);

if ($resultado) {
echo "<script> alert ('Se ha eliminado el proveedor con exito'); window.location = 'proveedores.php' </script>";
}else {
    echo "<script> alert ('El proveedor no se ha eliminado'); window.location = 'proveedores.php' </script>";
}

?>