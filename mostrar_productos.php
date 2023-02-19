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
</html>

<body class="row">
	
	<?php

	include("header_admin.php");

	?>

    <?php
	}else{
		header('location: login.php');
	}
	?>

	<?php

	$consulta = "SELECT * FROM productos pro INNER JOIN categorias_productos cat ON pro.Categorias_Productos_idCategorias_productos = cat.idCategorias_productos";
	$resultado = mysqli_query($conex, $consulta);

	$limite = 10; //Limite de productos por pagina
    $total_query = $conex -> query('SELECT COUNT(*) FROM productos');
    $total_products = mysqli_fetch_row($total_query);
    $total_botones = round($total_products[0] / $limite);

    if (isset($_GET['limite'])) {
        $consulta = "SELECT * FROM productos pro INNER JOIN categorias_productos cat 
        ON pro.Categorias_Productos_idCategorias_productos = cat.idCategorias_productos 
        WHERE Cantidad_stock > 0 ORDER BY Titulo ASC LIMIT ".$_GET['limite'].",".$limite;
        $resultado = mysqli_query($conex, $consulta);
    }else{
        $consulta = "SELECT * FROM productos pro INNER JOIN categorias_productos cat 
        ON pro.Categorias_Productos_idCategorias_productos = cat.idCategorias_productos 
        WHERE Cantidad_stock > 0 ORDER BY Titulo ASC LIMIT ".$limite;
        $resultado = mysqli_query($conex, $consulta);
    }

	if ($resultado) {
	?>
		<div>
			<center>
				<br>
				<form action="buscar_productos-admin.php" method=POST>
					<i class="fa-sharp fa-solid fa-magnifying-glass"></i>
					<input type="text" placeholder="Buscar..." name="buscar">
					<input type="submit" id="boton-consultar_productos" value="Consultar">
				</form>
			</center>
		</div>
		
		<div class="row-box">
			<center>
				<h1>Productos en stock</h1>
				<button onclick="window.location='formulario_nuevo_producto.php'" id="boton_registrar">Añadir Producto</button>
			</center>
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
                                <a href="mostrar_productos.php?limite='.($_GET['limite'] - 10).'">
                                    <i class="fa-solid fa-arrow-left"></i>
                                </a>
                              </li>';
                    }
                }
                for ($k=0; $k <= $total_botones; $k++) { 
                    echo '<li><a href="mostrar_productos.php?limite='.($k*10).'">'.($k+1).'</a></li>';
                }
                if (isset($_GET['limite'])) {
                    if ($_GET['limite'] + 10 <= $total_botones * 10) {
                        echo '<li>
                                <a href="mostrar_productos.php?limite='.($_GET['limite'] + 10).'">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                              </li>';
                    }
                }else{
                    echo '<li>
                            <a href="mostrar_productos.php?limite=10">
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                          </li>';
                }
            ?>
        </ul>
    </div>
</body>
