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

	$consulta = "SELECT * FROM clientes clien INNER JOIN localidades loca 
	ON clien.Localidades_idLocalidades = loca.idLocalidades
	INNER JOIN codigo_postal cp ON loca.Codigo_Postal_idCodigo_Postal = cp.idCodigo_Postal
	INNER JOIN provincias provin ON loca.Provincias_idProvincias = provin.idProvincias";
	$resultado = mysqli_query($conex, $consulta);

	$limite = 10; //Limite de clientes por pagina
    $total_query = $conex -> query('SELECT COUNT(*) FROM clientes');
    $total_products = mysqli_fetch_row($total_query);
    $total_botones = round($total_products[0] / $limite);

    if (isset($_GET['limite'])) {
        $consulta = "SELECT * FROM clientes clien INNER JOIN localidades loca 
		ON clien.Localidades_idLocalidades = loca.idLocalidades
		INNER JOIN codigo_postal cp ON loca.Codigo_Postal_idCodigo_Postal = cp.idCodigo_Postal
		INNER JOIN provincias provin ON loca.Provincias_idProvincias = provin.idProvincias
        ORDER BY Nombre ASC LIMIT ".$_GET['limite'].",".$limite;
        $resultado = mysqli_query($conex, $consulta);
    }else{
        $consulta = "SELECT * FROM clientes clien INNER JOIN localidades loca 
		ON clien.Localidades_idLocalidades = loca.idLocalidades
		INNER JOIN codigo_postal cp ON loca.Codigo_Postal_idCodigo_Postal = cp.idCodigo_Postal
		INNER JOIN provincias provin ON loca.Provincias_idProvincias = provin.idProvincias
        ORDER BY Nombre ASC LIMIT ".$limite;
        $resultado = mysqli_query($conex, $consulta);
    }

	if ($resultado) {
		
	?>

	<div>
		<center>
			<br>
			<form action="buscar_clientes.php" method=POST>
				<i class="fa-sharp fa-solid fa-magnifying-glass"></i>
				<input type="text" placeholder="Buscar..." name="buscar">
				<input type="submit" id="boton-consultar_clientes" value="Consultar">
			</form>
		</center>
	</div>

	<div class="row-box">
		<center><h1>Usuarios registrados</h1></center>
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
                                <a href="clientes.php?limite='.($_GET['limite'] - 10).'">
                                    <i class="fa-solid fa-arrow-left"></i>
                                </a>
                              </li>';
                    }
                }
                for ($k=0; $k <= $total_botones; $k++) { 
                    echo '<li><a href="clientes.php?limite='.($k*10).'">'.($k+1).'</a></li>';
                }
                if (isset($_GET['limite'])) {
                    if ($_GET['limite'] + 10 <= $total_botones * 10) {
                        echo '<li>
                                <a href="clientes.php?limite='.($_GET['limite'] + 10).'">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                              </li>';
                    }
                }else{
                    echo '<li>
                            <a href="clientes.php?limite=10">
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                          </li>';
                }
            ?>
        </ul>
    </div>
</body>
</html>