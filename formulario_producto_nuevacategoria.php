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
	<title>Formulario Categoria de Producto</title>
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
			<center><h2>Añadir / Eliminar Categoria </h2></center>

			<?php
			include("opcion_categoria.php");
			?>

			<p>Categorias Disponibles*</p>
			<br>
			<select name="eliminar_categoria">
				<?php
				$consulta = "SELECT * FROM categorias_productos";
				$ejecutar = mysqli_query($conex, $consulta);
				?>

				<?php
				while($row = mysqli_fetch_array($ejecutar)){
					$id_cat = $row['idCategorias_productos'];
					$desc_cat = $row['Tipo'];
					?>
						<option value="<?php echo $id_cat?>"><?php echo $desc_cat?></option>
					<?php
					}
				?>
			</select>

			<p>Tipo*</p>
			<input type="text" placeholder="Nombre de categoria" name="categoria">
			<br>

			<button type="submit" id="boton_registrar" name="registrar" onclick="window.location='opcion_categorias.php'">
					Registrar
			</button>

			<button type="submit" id="boton_registrar" name="eliminar" onclick="window.location='opcion_categoria.php'">
					Eliminar
			</button>

		</form>

		<br><br>
	</div>
	
</body>
</html>