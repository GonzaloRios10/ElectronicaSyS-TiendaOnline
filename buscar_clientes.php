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
	<title>Clientes</title>
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

	$consulta = "SELECT * FROM clientes clien 
	INNER JOIN localidades loca ON clien.Localidades_idLocalidades = loca.idLocalidades
	INNER JOIN codigo_postal cp ON loca.Codigo_Postal_idCodigo_Postal = cp.idCodigo_Postal
	INNER JOIN provincias provin ON loca.Provincias_idProvincias = provin.idProvincias
	WHERE Nombre LIKE '$buscar' '%' OR Apellido LIKE '$buscar' '%' OR Localidad LIKE '$buscar' '%'
	OR Desc_provincia LIKE '$buscar' '%'";
	
	$resultado = mysqli_query($conex, $consulta);

	if (mysqli_num_rows($resultado) > 0) {
		
	?>

	<div class="row-box">
		<center><h2>Resultados</h2></center>
		<table class="row-box-table">
			<thead>
				<tr>
					<th>Nombre y Apellido</th>
					<th>Usuario</th>
					<th>E-mail</th>
					<th>Telefono</th>
					<th>Localidad</th>
					<th>Codigo Postal</th>
					<th>Provincia</th>
				</tr>
			</thead>

			<tbody>
				<?php
					while ($row = mysqli_fetch_array($resultado)) {
				?>
				<tr>
					<td><?php echo $row['Nombre']?> <?php echo $row['Apellido']?></td>
					<td><?php echo $row['Usuario']?></td>
					<td><?php echo $row['Email']?></td>
					<td><?php echo $row['Telefono']?></td>
					<td><?php echo $row['Localidad']?></td>
					<td><?php echo $row['Número_CP']?></td>
					<td><?php echo $row['Desc_provincia']?></td>
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