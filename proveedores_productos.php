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
	<link rel="stylesheet" type="text/css" href="style_proveedores.css">
	<script src="https://kit.fontawesome.com/57c1e4ede6.js" crossorigin="anonymous"></script>
	<title>Proveedores y productos</title>
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

	$sql = "SELECT * FROM proveedores_productos prov_prod 
	INNER JOIN proveedores prov ON prov_prod.Proveedores_idProveedores = prov.idProveedores
	INNER JOIN productos prod ON prov_prod.Productos_idProductos = prod.idProductos
	ORDER BY Nombre ASC";

	$limite = 10; //Limite de clientes por pagina
    $total_query = $conex -> query('SELECT COUNT(*) FROM proveedores_productos');
    $total_products = mysqli_fetch_row($total_query);
    $total_botones = round($total_products[0] / $limite);

    if (isset($_GET['limite'])) {
        $consulta = "SELECT * FROM proveedores_productos prov_prod 
		INNER JOIN proveedores prov ON prov_prod.Proveedores_idProveedores = prov.idProveedores
		INNER JOIN productos prod ON prov_prod.Productos_idProductos = prod.idProductos
        ORDER BY Nombre ASC LIMIT ".$_GET['limite'].",".$limite;
        $resultado = mysqli_query($conex, $consulta);
    }else{
        $consulta = "SELECT * FROM proveedores_productos prov_prod 
		INNER JOIN proveedores prov ON prov_prod.Proveedores_idProveedores = prov.idProveedores
		INNER JOIN productos prod ON prov_prod.Productos_idProductos = prod.idProductos
        ORDER BY Nombre ASC LIMIT ".$limite;
        $resultado = mysqli_query($conex, $consulta);
    }

	$resultado = mysqli_query($conex, $sql);

	if ($resultado) {

	?>

    <!-- <div>
		<center>
			<br>
			<form action="buscar_proveedores.php" method=POST>
				<i class="fa-sharp fa-solid fa-magnifying-glass"></i>
				<input type="text" placeholder="Buscar..." name="buscar">
				<input type="submit" id="boton-consultar_proveedores" value="Consultar">
			</form>
		</center>
	 </div> -->

    <div class="row-box">
		<center>
			<h1>Proveedores y sus productos</h1>
			<button onclick="window.location='formulario_proveedores_productos.php'" id="boton_registrar">
				Asignar
			</button>
		</center>
		<table class="row-box-table">
			<thead>
				<tr>
					<th>Proveedor</th>
					<th>Producto</th>
					<th>Cantidad en stock</th>
					<th>Acción</th>
				</tr>
			</thead>

			<tbody>
				<?php
					while ($row = mysqli_fetch_array($resultado)) {
				?>
				<tr>
					<td><?php echo $row['Nombre']?></td>
					<td><?php echo $row['Titulo']?></td>
					<td><?php echo $row['Cantidad_stock']?></td>
					<td>
                        <a class="accion" href='eliminar_asignacion.php?id=<?php echo $row['Productos_idProductos']?>'>
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
                                <a href="proveedores_productos.php?limite='.($_GET['limite'] - 10).'">
                                    <i class="fa-solid fa-arrow-left"></i>
                                </a>
                              </li>';
                    }
                }
                for ($k=0; $k <= $total_botones; $k++) { 
                    echo '<li><a href="proveedores_productos.php?limite='.($k*10).'">'.($k+1).'</a></li>';
                }
                if (isset($_GET['limite'])) {
                    if ($_GET['limite'] + 10 <= $total_botones * 10) {
                        echo '<li>
                                <a href="proveedores_productos.php?limite='.($_GET['limite'] + 10).'">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                              </li>';
                    }
                }else{
                    echo '<li>
                            <a href="proveedores_productos.php?limite=10">
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                          </li>';
                }
            ?>
        </ul>
    </div> 
  </body>
</html>