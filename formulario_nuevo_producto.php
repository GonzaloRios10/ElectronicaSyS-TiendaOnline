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
	<link rel="stylesheet" type="text/css" href="style_formulario_nuevo-producto.css">
	<script src="https://kit.fontawesome.com/57c1e4ede6.js" crossorigin="anonymous"></script>
	<title>Formulario Producto</title>
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
			<center><h2>Nuevo Producto </h2></center>

			<?php
			include("registro_productos.php");
			?>

			<p>Codigo*</p>
			<input type="text" placeholder="Codigo del producto" name="id">
			<br>
			<p>Titulo*</p>
			<input type="text" placeholder="Titulo del producto" name="titulo">
			<br>
			<p>Descripcion*</p>
			<textarea name="descripcion"></textarea>
			<br>
			<p>Precio*</p>
			<input type="text" placeholder="Precio del producto" name="precio">
			<br>
			<p>Stock*</p>
			<input type="text" placeholder="Stock del producto" name="stock">
			
			<p>Tipo*</p>
			<br>
			<select name="categoria">
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

			<p>Imagen*</p>
			<input type="file" REQUIRED name="imagen">

			<button type="submit" id="boton_registrar" name="registrar">Registrar</button>
		</form>

		<br><br>
	</div>
	
</body>
</html>