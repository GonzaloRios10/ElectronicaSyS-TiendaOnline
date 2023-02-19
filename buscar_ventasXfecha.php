<?php

include("conexion.php"); 

session_start();

$usuario = $_SESSION['UsuarioAdmin'];

if (isset($_SESSION['UsuarioAdmin'])) {

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style_ventas-realizadas.css">
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

	if(isset($_POST['desde']) && isset($_POST['hasta'])){
    
    $fecha_desde = $_POST['desde'];
    $fecha_hasta = $_POST['hasta'];

    $query = "SELECT * FROM ventas vent INNER JOIN clientes clien 
		ON vent.Clientes_idClientes = clien.idClientes 
		INNER JOIN tipos_depagos pago ON vent.Tipos_depagos_idTipos_depagos = pago.idTipos_depagos
		INNER JOIN localidades loca ON clien.Localidades_idLocalidades = loca.idLocalidades
		INNER JOIN provincias prov ON loca.Provincias_idProvincias = prov.idProvincias
		WHERE fecha BETWEEN '$fecha_desde' AND '$fecha_hasta' ORDER BY Fecha DESC";

	$query_run = mysqli_query($conex, $query);

	if(mysqli_num_rows($query_run) > 0){
		
	?>

	<div class="row-box">
		<center><h2>Resultados</h2></center>
		<table class="row-box-table">
			<thead>
				<tr>
					<th>Codigo de venta</th>
					<th>Cliente</th>
					<th>Usuario</th>
					<th>Localidad</th>
					<th>Provincia</th>
					<th>Total</th>
					<th>Fecha</th>
					<th>Tipo de pago</th>
				</tr>
			</thead>

			<tbody>
				<?php
					foreach($query_run as $row){
				?>
				<tr>
					<td><?php echo $row['idVentas']?></td>
					<td><?php echo $row['Nombre']?> <?php echo $row['Apellido']?></td>
					<td><?php echo $row['Usuario']?></td>
					<td><?php echo $row['Localidad']?></td>
					<td><?php echo $row['Desc_provincia']?></td>
					<td>$ <?php echo number_format($row['Total'])?></td>
					<td><?php echo $row['Fecha']?></td>
					<td><?php echo $row['Tipo']?></td>
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
}
    ?>