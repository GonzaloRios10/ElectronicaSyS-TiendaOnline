<?php

include("conexion.php");

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style_productos.css">
    <script src="https://kit.fontawesome.com/57c1e4ede6.js" crossorigin="anonymous"></script>
    <title>Productos</title>
</head>

<body>
	<div class="nomelacontainer">
	    <?php
	        $tipo = $_POST['tipo'];

			$sql = "SELECT * FROM productos pro INNER JOIN categorias_productos cat 
	        ON pro.Categorias_Productos_idCategorias_productos = cat.idCategorias_productos 
	        WHERE idCategorias_productos = '$tipo'";

			$result = mysqli_query($conex, $sql);

			if (mysqli_num_rows($result) > 0) {
	            while($consulta = mysqli_fetch_array($result)){
	        ?>
	        <div class="card">
	            <figure>
	                <a href="detalles_productos.php?id=<?php echo $consulta['idProductos']?>">
	                    <img src="data:image/png;base64,<?php echo base64_encode($consulta['Imagen']);?>">
	                 </a>
	            </figure>
	            <div class="contenido">
	                <h3><?php echo $consulta['Titulo']?></h3>
	                <p>
	                    <strong>$ <?php echo number_format($consulta['Precio'])?></strong> 
	                </p> 
	                <a href="detalles_productos.php?id=<?php echo $consulta['idProductos']?>"> Ver Más</a>
	            </div>
	            <br>
	        </div>
	        <?php
	    		}
	        }
	        // else{
         //    	echo "<br><h2>Sin resultados</h2>";
        	// }
	        ?>
    </div>
</body>