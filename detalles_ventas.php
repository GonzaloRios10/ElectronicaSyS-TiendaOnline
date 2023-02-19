<?php

include("conexion.php");

?>

<?php

session_start();

$usuario = $_SESSION['UsuarioAdmin'];

if (isset($_SESSION['UsuarioAdmin'])) {

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style_ventas-realizadas.css">
	<script src="https://kit.fontawesome.com/57c1e4ede6.js" crossorigin="anonymous"></script>
	<title>Detalles de Ventas</title>
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

	$sql = "SELECT * FROM detalles_ventas det_vent 
	INNER JOIN ventas vent ON det_vent.Ventas_idVentas = vent.idVentas
	INNER JOIN productos prod ON det_vent.Productos_idProductos = prod.idProductos
	INNER JOIN clientes clien ON clien.idClientes = vent.Clientes_idClientes
	ORDER BY idVentas DESC";
	
	$resultado = mysqli_query($conex, $sql);

	$limite = 10; 
    $total_query = $conex -> query('SELECT COUNT(*) FROM detalles_ventas');
    $total_products = mysqli_fetch_row($total_query);
    $total_botones = round($total_products[0] / $limite);

    if (isset($_GET['limite'])) {
        $consulta = "SELECT * FROM detalles_ventas det_vent 
		INNER JOIN ventas vent ON det_vent.Ventas_idVentas = vent.idVentas
		INNER JOIN productos prod ON det_vent.Productos_idProductos = prod.idProductos
		INNER JOIN clientes clien ON clien.idClientes = vent.Clientes_idClientes
        ORDER BY idVentas DESC LIMIT ".$_GET['limite'].",".$limite;
        $resultado = mysqli_query($conex, $consulta);
    }else{
        $consulta = "SELECT * FROM detalles_ventas det_vent 
		INNER JOIN ventas vent ON det_vent.Ventas_idVentas = vent.idVentas
		INNER JOIN productos prod ON det_vent.Productos_idProductos = prod.idProductos
		INNER JOIN clientes clien ON clien.idClientes = vent.Clientes_idClientes
        ORDER BY idVentas DESC LIMIT ".$limite;
        $resultado = mysqli_query($conex, $consulta);
    }

	if ($resultado) {

	?>

    <div>
		<center>
			<br>
			<form action="buscar_detalles_ventas.php" method=POST>
				<i class="fa-sharp fa-solid fa-magnifying-glass"></i>
				<input type="text" placeholder="Buscar..." name="buscar">
				<input type="submit" class="boton-consultar_ventas" value="Consultar">
			</form>
		</center>
	 </div>

    <div class="row-box">
		<center>
			<h1>Detalles de ventas</h1>
		</center>
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
		<br>
	</div>
	<?php
		}
	?>

	<div class="row-botones">
        <ul class="botones-color">
            <?php
                if (isset($_GET['limite'])) {
                    if ($_GET['limite'] > 0) {
                        echo '<li>
                                <a href="detalles_ventas.php?limite='.($_GET['limite'] - 10).'">
                                    <i class="fa-solid fa-arrow-left"></i>
                                </a>
                              </li>';
                    }
                }
                for ($k=0; $k <= $total_botones; $k++) { 
                    echo '<li><a href="detalles_ventas.php?limite='.($k*10).'">'.($k+1).'</a></li>';
                }
                if (isset($_GET['limite'])) {
                    if ($_GET['limite'] + 10 <= $total_botones * 10) {
                        echo '<li>
                                <a href="detalles_ventas.php?limite='.($_GET['limite'] + 10).'">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                              </li>';
                    }
                }else{
                    echo '<li>
                            <a href="detalles_ventas.php?limite=10">
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                          </li>';
                }
            ?>
        </ul>
    </div>
  </body>
</html>