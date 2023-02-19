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
	<link rel="stylesheet" type="text/css" href="style_formulario_nueva-categoria.css">
	<script src="https://kit.fontawesome.com/57c1e4ede6.js" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.1.min.js" type="text/javascript"></script>
	<title>Formulario</title>
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

	<div id="caja_form">
		<center><h1><i class="fa-solid fa-file-lines"></i> Formulario</h1></center>
		
		<form id="form_entrada" method="POST" enctype="multipart/form-data">
			<br>
			<center><h2>Proveedor / Producto</h2></center>

			<?php
			include("asignar_proveedor-producto.php");
			?>

			<p>Proveedores Disponibles*</p>
			<br>
			<select name="asignar_proveedor">
				<?php
				$consulta = "SELECT * FROM proveedores";
				$ejecutar = mysqli_query($conex, $consulta);
				?>

				<?php
				while($row = mysqli_fetch_array($ejecutar)){
					$id_proveedor = $row['idProveedores'];
					$nombre_proveedor = $row['Nombre'];
					?>
						<option value="<?php echo $id_proveedor?>"><?php echo $nombre_proveedor?></option>
					<?php
					}
				?>
			</select>

			<p>Productos Disponibles*</p>
			<br>
			<select name="asignar_producto">
				<?php
				$consulta = "SELECT * FROM productos";
				$ejecutar = mysqli_query($conex, $consulta);
				?>

				<?php
				while($row = mysqli_fetch_array($ejecutar)){
					$id_producto = $row['idProductos'];
					$titulo_producto = $row['Titulo'];
					?>
						<option value="<?php echo $id_producto?>"><?php echo $titulo_producto?></option>
					<?php
					}
				?>
			</select>

			<button type="submit" id="boton_registrar" name="registrar" onclick="window.location='asignar_proveedor-producto.php'">
					Asignar
			</button>

		</form>

		<br><br>
	</div>
	
</body>
</html>