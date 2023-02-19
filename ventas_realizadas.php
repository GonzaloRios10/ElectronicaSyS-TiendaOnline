<?php

include("conexion.php");

session_start();

$usuario = $_SESSION['UsuarioAdmin'];

if (isset($_SESSION['UsuarioAdmin'])) {

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style_ventas-realizadas.css">
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

	$sql = "SELECT * FROM ventas vent 
	INNER JOIN clientes clien ON vent.Clientes_idClientes = clien.idClientes 
	INNER JOIN tipos_depagos pago ON vent.Tipos_depagos_idTipos_depagos = pago.idTipos_depagos
	INNER JOIN localidades loca ON clien.Localidades_idLocalidades = loca.idLocalidades
	INNER JOIN provincias prov ON loca.Provincias_idProvincias = prov.idProvincias
	ORDER BY Fecha DESC";
	$resultado = mysqli_query($conex, $sql);

	$limite = 10; 
    $total_query = $conex -> query('SELECT COUNT(*) FROM ventas');
    $total_products = mysqli_fetch_row($total_query);
    $total_botones = round($total_products[0] / $limite);

    if (isset($_GET['limite'])) {
        $consulta = "SELECT * FROM ventas vent INNER JOIN clientes clien 
		ON vent.Clientes_idClientes = clien.idClientes 
		INNER JOIN tipos_depagos pago ON vent.Tipos_depagos_idTipos_depagos = pago.idTipos_depagos
		INNER JOIN localidades loca ON clien.Localidades_idLocalidades = loca.idLocalidades
		INNER JOIN provincias prov ON loca.Provincias_idProvincias = prov.idProvincias
        ORDER BY Fecha DESC LIMIT ".$_GET['limite'].",".$limite;
        $resultado = mysqli_query($conex, $consulta);
    }else{
        $consulta = "SELECT * FROM ventas vent INNER JOIN clientes clien 
		ON vent.Clientes_idClientes = clien.idClientes 
		INNER JOIN tipos_depagos pago ON vent.Tipos_depagos_idTipos_depagos = pago.idTipos_depagos
		INNER JOIN localidades loca ON clien.Localidades_idLocalidades = loca.idLocalidades
		INNER JOIN provincias prov ON loca.Provincias_idProvincias = prov.idProvincias
        ORDER BY Fecha DESC LIMIT ".$limite;
        $resultado = mysqli_query($conex, $consulta);
    }

	if ($resultado) {

	?>

    <div>
		<center>
			<br>
			<form action="buscar_ventas.php" method=POST>
				<i class="fa-sharp fa-solid fa-magnifying-glass"></i>
				<input type="text" placeholder="Buscar..." name="buscar">
				<input type="submit" class="boton-consultar_ventas" value="Consultar">
			</form>
		</center>
	</div>

	<div>
		<center>
			<br>
			<form action="buscar_ventasXfecha.php" method=POST>
				<div id="fecha_desde">
                    <label><b>Desde</b></label>
                    <input type="date" name="desde" 
                    value="<?php if(isset($_POST['desde'])){echo $_POST['desde'];}?>">
                </div>
                <br>
                <div id="fecha_hasta">
                    <label><b>Hasta</b></label>
                    <input type="date" name="hasta" 
                    value="<?php if(isset($_POST['hasta'])){echo $_POST['hasta'];}?>">
                </div>

	            <br>
                <button type="submit" class="boton-consultar_ventas">Filtrar</button>
			</form>
		</center>
	</div>

    <div class="row-box">
		<center>
			<h1>Listado de ventas</h1>
		</center>
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
                                <a href="ventas_realizadas.php?limite='.($_GET['limite'] - 10).'">
                                    <i class="fa-solid fa-arrow-left"></i>
                                </a>
                              </li>';
                    }
                }
                for ($k=0; $k <= $total_botones; $k++) { 
                    echo '<li><a href="ventas_realizadas.php?limite='.($k*10).'">'.($k+1).'</a></li>';
                }
                if (isset($_GET['limite'])) {
                    if ($_GET['limite'] + 10 <= $total_botones * 10) {
                        echo '<li>
                                <a href="ventas_realizadas.php?limite='.($_GET['limite'] + 10).'">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                              </li>';
                    }
                }else{
                    echo '<li>
                            <a href="ventas_realizadas.php?limite=10">
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                          </li>';
                }
            ?>
        </ul>
    </div>
  </body>
</html>