<?php

include("conexion.php");

session_start();

if(!isset($_SESSION['carrito'])) {
	header('location: index.php');
}else{
	$arreglo = $_SESSION['carrito'];
}

if (!isset($_SESSION['UsuarioClien'])) {
	header('location: login.php');
}else{
	$user = $_SESSION['UsuarioClien'];
}

$total = 0;

$sql = "SELECT idClientes FROM clientes WHERE Usuario = '$user'";
$query = mysqli_query($conex, $sql);

while($rows = mysqli_fetch_array($query)){
	$idcli = $rows[0];
}

for($i = 0; $i < count($arreglo); $i++){
	$total = $total + ($arreglo[$i]['Precio'] * $arreglo[$i]['Cantidad']);
}

$fecha = date('Y-m-d');
$conex -> query("INSERT INTO ventas(Clientes_idClientes, Total, Fecha, Tipos_depagos_idTipos_depagos) VALUES($idcli, $total, '$fecha', 2)");

$id_venta = $conex ->insert_id;

for($i = 0; $i < count($arreglo); $i++){
	$conex -> query("INSERT INTO detalles_ventas(Ventas_idVentas, Productos_idProductos, Cantidad, Precio, Subtotal) 
	VALUES(
	$id_venta, 
	".$arreglo[$i]['Id'].",
	".$arreglo[$i]['Cantidad'].",
	".$arreglo[$i]['Precio'].",
	".$arreglo[$i]['Cantidad'] * $arreglo[$i]['Precio']."
	)");
	$conex -> query("UPDATE productos SET Cantidad_stock =Cantidad_stock -".$arreglo[$i]['Cantidad']." WHERE idProductos=".$arreglo[$i]['Id']);
}

unset($_SESSION['carrito']);

header('location: index.php');

?>
