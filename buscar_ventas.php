<?php

include("conexion.php"); 

session_start();

$usuario = $_SESSION['UsuarioAdmin'];

if (isset($_SESSION['UsuarioAdmin'])) {

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style_ventas.css">
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

	$consulta = "SELECT * FROM ventas vent 
		INNER JOIN clientes clien ON vent.Clientes_idClientes = clien.idClientes 
		INNER JOIN tipos_depagos pago ON vent.Tipos_depagos_idTipos_depagos = pago.idTipos_depagos
		INNER JOIN localidades loca ON clien.Localidades_idLocalidades = loca.idLocalidades
		INNER JOIN provincias prov ON loca.Provincias_idProvincias = prov.idProvincias
		WHERE Nombre LIKE '$buscar' '%' OR Apellido LIKE '$buscar' '%' OR Usuario LIKE '$buscar' '%' 
		OR Localidad LIKE '$buscar' '%' OR Desc_provincia LIKE '$buscar' '%' 
		ORDER BY Fecha DESC";
	
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
					while ($row = mysqli_fetch_array($resultado)) {
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
    ?>
</body>
</html>