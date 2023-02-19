<?php

include("conexion.php"); 

session_start();

$usuario = $_SESSION['UsuarioAdmin'];

if (isset($_SESSION['UsuarioAdmin'])) {

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style_mostrar-productos.css">
	<script src="https://kit.fontawesome.com/57c1e4ede6.js" crossorigin="anonymous"></script>
	<title>Stock</title>
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

	$consulta = "SELECT * FROM productos pro 
	INNER JOIN categorias_productos cat ON pro.Categorias_Productos_idCategorias_productos = cat.idCategorias_productos
	WHERE Titulo LIKE '$buscar' '%' OR Tipo LIKE '$buscar' '%'";
	
	$resultado = mysqli_query($conex, $consulta);

	if (mysqli_num_rows($resultado) > 0) {
		
	?>

	<div class="row-box">
		<center><h2>Resultados</h2></center>
		<table class="row-box-table">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Imagen</th>
					<th>Titulo</th>
					<th>Precio</th>
					<th>Cantidad en stock</th>
					<th>Categoria</th>
					<th>Acción</th>
				</tr>
			</thead>

			<tbody>
					<?php
						while ($row = mysqli_fetch_array($resultado)){
					?>
					<tr>
						<td><?php echo $row['idProductos']?></td>
						<td id="foto_producto">
							<img width="70" src="data:image/png;base64,<?php echo base64_encode($row['Imagen']);?>">
						</td>
						<td><?php echo $row['Titulo']?></td>
						<td>$ <?php echo number_format($row['Precio'])?></td>
						<td><?php echo $row['Cantidad_stock']?></td>
						<td><?php echo $row['Tipo']?></td>
						<td>
	                        <a class="accion" href='modificar_productos.php?id=<?php echo $row['idProductos']?>'>
	                        	<i class="fa-solid fa-pen-to-square"></i>
	                        </a>

	                        <a class="accion" href='eliminar_productos.php?id=<?php echo $row['idProductos']?>'>
	                        	<i class="fa-solid fa-trash"></i>
	                        </a>
                   	 	</td>
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