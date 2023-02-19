<?php

include("conexion.php");

$id = $_POST['id'];
$nom = $_POST['nombre'];
$tel = $_POST['telefono'];
$ciudad = $_POST['localidad_provincia'];

$actualizar = "UPDATE proveedores SET Nombre='$nom', Telefono='$tel', Localidades_idLocalidades='$ciudad' WHERE idProveedores = '$id'";

$resultado = mysqli_query($conex, $actualizar);

echo "<script> alert('Se ha actualizado el proveedor con exito'); window.location = 'proveedores.php' </script>";
?>