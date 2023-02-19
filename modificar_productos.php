<?php

include("conexion.php");

?>

<?php

session_start();

$usuario = $_SESSION['UsuarioAdmin'];

if (isset($_SESSION['UsuarioAdmin'])) {

	$id = $_GET['id'];

	$consulta = "SELECT * FROM productos prod INNER JOIN categorias_productos categoria ON prod.Categorias_Productos_idCategorias_productos = categoria.idCategorias_productos 
		WHERE idProductos ='".$id."'";
	$resultado = mysqli_query($conex, $consulta);
		while ($registro = mysqli_fetch_assoc($resultado)) {	
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style_modificar-productos.css">
	<script src="https://kit.fontawesome.com/57c1e4ede6.js" crossorigin="anonymous"></script>
	<title>Formulario Producto</title>
</head>
<body>
	
	<?php

	include("header_admin.php");

	?>

	<div id="caja_form">
		<center><h1><i class="fa-solid fa-file-lines"></i> Formulario</h1></center>
		<form action="update_producto.php" id="form_entrada" method="POST" enctype="multipart/form-data">
			<input placeholder="Codigo" name="id" style="visibility:hidden;" value="<?php echo $registro['idProductos']?>">
			<center><h2><?php echo $registro['Titulo']?></h2></center>

			<p>Nuevo titulo*</p>
			<input type="text" placeholder="Precio" name="titulo" value="<?php echo $registro['Titulo']?>">
			<br>
			<p>Nueva descripcion del producto*</p>
			<textarea name="descripcion"><?php echo $registro['Descripcion']?></textarea>
			<br>
			<p>Nuevo precio del producto*</p>
			<input type="text" placeholder="Precio" name="precio" value="<?php echo $registro['Precio']?>">
			<br>
			<p>Nuevo stock del producto*</p>
			<input type="text" placeholder="Stock" name="stock" value="<?php echo $registro['Cantidad_stock']?>">
			<br>
			<p>Nuevo tipo de categoria*</p>
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
						<option value="<?php echo $row['idCategorias_productos']?>">
							<?php echo $desc_cat?>		
						</option>
					<?php
					}
				?>
				<option selected="true" value="<?php echo $registro['Categorias_Productos_idCategorias_productos']?>">
					<?php echo $registro['Tipo']?>		
				</option>
			</select>

			<p>Nueva imagen del producto*</p>
			<br>
			<center>
				<img width="70" src="data:image/png;base64,<?php echo base64_encode($registro['Imagen'])?>">
			</center>	
			<br>
			<input type="file" REQUIRED name="imagen">
			<button type="submit" id="boton_modificar" name="">Actualizar</button>
		</form>
		<br><br>
	</div>
<?php
} 

}else{
	header('location: login.php');
}

?>
</body>
</html>