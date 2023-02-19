<?php

include("conexion.php");

session_start();

if (isset($_GET['id'])) {
	$consulta = $conex ->query("SELECT * FROM productos WHERE idProductos=".$_GET['id']);
	if(mysqli_num_rows($consulta) > 0) {
		$fila = mysqli_fetch_row($consulta);
	}else{
		header("Location: productos.php");
	}
}else{
	header("Location: productos.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style_detalles-productos.css">
	<script src="https://kit.fontawesome.com/57c1e4ede6.js" crossorigin="anonymous"></script>
	<title><?php echo $fila[1];?> - Detalles</title>
</head>
<body>
	<?php
    
    include("header.php");

    ?>

    <a href="https://api.whatsapp.com/send?phone=+54 9 376 511-3779&text=Hola, Necesito más información!" class="btn-wsp" target="_BLANK">
		<i class="fa fa-whatsapp icono"></i>
	</a>

	<div id="container-article">
		<div id="box-img-article">
			<img src="data:image/png;base64,<?php echo base64_encode($fila[5]);?>">
		</div>
		<div id="box-details-article">
			<h2 id="title">
				<?php echo $fila[1];?>
			</h2>
			<p id="description">
				<?php echo $fila[2];?>
			<p>
			<p id="stock">
				<strong>Cantidad disponible: </strong> <?php echo $fila[4];?>
			</p>
			<p id="price">
				$ <?php echo number_format($fila[3])?>
			</p>
			<br>
			<a href="carrito.php?id=<?php echo $fila[0];?>">
				<button class="carrito">
					<i class="fa-solid fa-cart-shopping"></i> Añadir
				</button>
			</a>
		</div>
	</div>
	<br>
</body>
</html>

