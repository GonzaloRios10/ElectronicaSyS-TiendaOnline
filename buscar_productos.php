<?php

include("conexion.php");

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style_buscar-productos.css">
    <script src="https://kit.fontawesome.com/57c1e4ede6.js" crossorigin="anonymous"></script>
    <title>Productos</title>
</head>

<body>

    <?php
    
    include("header.php");

    ?>

    <div class="nomelacontainer">
        <?php

            $consulta = "SELECT * FROM productos
            INNER JOIN categorias_productos ON productos.Categorias_Productos_idCategorias_productos = categorias_productos.idCategorias_productos 
            WHERE productos.Titulo LIKE '%".$_GET['buscar']."%' OR
            categorias_productos.Tipo LIKE '%".$_GET['buscar']."%'";
            
            $resultado = mysqli_query($conex, $consulta);

            if (mysqli_num_rows($resultado) > 0) {
            
        ?>
        <br>
        <h2>Resultados de <?php echo $_GET['buscar']?></h2>
        <?php
            while($consulta = mysqli_fetch_array($resultado)){
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
        }else{
            echo "<br><h2>Sin resultados</h2>";
        }
        ?>
    </div>

</body>
</html>