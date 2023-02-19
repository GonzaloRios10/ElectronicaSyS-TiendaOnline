<?php

include("conexion.php"); 

session_start();

$usuario = $_SESSION['UsuarioAdmin'];

if (isset($_SESSION['UsuarioAdmin'])) {

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style_clientes.css">
	<script src="https://kit.fontawesome.com/57c1e4ede6.js" crossorigin="anonymous"></script>
	<title>Ventas</title>
</head>

<body>
	
	<?php

	include("header_admin.php");

	?>

    <?php
	}else{
		header('location: login.php');
	}

	?>

	<?php

	$buscar = $_POST['buscar'];

	$consulta = "SELECT * FROM detalles_ventas det_vent 
	INNER JOIN ventas vent ON det_vent.Ventas_idVentas = vent.idVentas
	INNER JOIN productos prod ON det_vent.Productos_idProductos = prod.idProductos
	INNER JOIN clientes clien ON clien.idClientes = vent.Clientes_idClientes
	INNER JOIN categorias_productos cate ON prod.Categorias_Productos_idCategorias_productos = cate.idCategorias_productos 
	WHERE idVentas LIKE '$buscar' '%' OR Nombre LIKE '$buscar' '%' OR Titulo LIKE '$buscar' '%' 
	OR Tipo LIKE '$buscar' '%' ORDER BY idVentas DESC";
	
	$resultado = mysqli_query($conex, $consulta);

	if (mysqli_num_rows($resultado) > 0) {
		
	?>

	<div class="row-box">
		<center><h2>Resultados</h2></center>
		<table class="row-box-table">
			<thead>
				<tr>
					<th>Codigo de venta</th>
					<th>Cliente</th>
					<th>Producto</th>
					<th>Cantidad</th>
					<th>Precio</th>
					<th>Subtotal</th>
				</tr>
			</thead>

			<tbody>
				<?php
					while ($row = mysqli_fetch_array($resultado)) {
				?>
				<tr>
					<td><?php echo $row['idVentas']?></td>
					<td><?php echo $row['Nombre']?> <?php echo $row['Apellido']?></td>
					<td><?php echo $row['Titulo']?></td>
					<td><?php echo $row['Cantidad']?></td>
					<td>$ <?php echo number_format($row['Precio'])?></td>
					<td>$ <?php echo number_format($row['Subtotal'])?></td>
				<?php
				}
				?>
				</tr>
			</tbody>
		</table>
		<br><br>
	</div>
	<?php
	}else{
		echo "<br>";
        echo "<center><br><h2>Sin resultados</h2></center>";
    }
	?>
</body>
</html>