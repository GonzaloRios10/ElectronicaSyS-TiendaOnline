<?php

include("conexion.php");

session_start(); 

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style_productos.css">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" type="text/javascript"></script>
	<script src="https://kit.fontawesome.com/57c1e4ede6.js" crossorigin="anonymous"></script>
	<title>Productos</title>
</head>

<body>
	
    <?php
    
    include("header.php");

    ?>

    <a href="https://api.whatsapp.com/send?phone=+54 9 376 511-3779&text=Hola, Necesito más información!" class="btn-wsp" target="_BLANK">
        <i class="fa fa-whatsapp icono"></i>
    </a>

    <div>
        <center>
            <br>
            <form action="buscar_productos.php" method=GET>
                <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Buscar..." name="buscar">
                <input type="submit" id="boton-buscar_productos" value="Buscar">
            </form>
        </center>
    </div>

    <br>

    <div class="nomelacontainer">
        <div class="categorias">
            <h3>Categorias</h3>
            <select id="categorias_lista">
                <?php
                $consulta = "SELECT * FROM categorias_productos";
                $ejecutar = mysqli_query($conex, $consulta);

                while($row = mysqli_fetch_array($ejecutar)){
                    ?>
                        <option value="<?php echo $row['idCategorias_productos']?>">
                            <?php echo $row['Tipo']?>
                        </option>
                    <?php
                    }
                ?>
                <option disabled="true" selected="true" value="0">Seleccione tipo</option>
            </select>

                <!-- <ul>
                    <?php
                        $consulta = "SELECT * FROM categorias_productos";
                        $ejecutar = mysqli_query($conex, $consulta);
                        
                        while($row = mysqli_fetch_array($ejecutar)){
                    ?>
                    <li>
                        <a href="buscar_productos.php?buscar=<?php echo $row['Tipo']?>">
                            <span style="color: black;">
                                <?php echo $row['Tipo']?>        
                            </span>
                            <span style="color: black;">
                            <?php

                                $consulta2 = "SELECT COUNT(*) FROM productos WHERE Categorias_Productos_idCategorias_productos = ".$row['idCategorias_productos'];
                                $ejecutar2 = mysqli_query($conex, $consulta2);
                                $f = mysqli_fetch_row($ejecutar2);
                                if ($f[0] > 0) {
                                    echo "($f[0])";
                                }else{
                                    echo "(Sin stock)";
                                }
                            ?>
                            </span>
                        </a>
                    </li>
                    <?php
                }
                    ?>
                </ul>      -->

            <script type="text/javascript">
                $(document).ready(function(){
                    $('#categorias_lista').val(0);
                    recargarLista();

                    $('#categorias_lista').change(function(){
                        recargarLista();
                    });
                })
            </script>
            <script type="text/javascript">
                function recargarLista(){
                    $.ajax({
                        type:"POST",
                        url:"datos_productos.php",
                        data:"tipo=" + $('#categorias_lista').val(),
                        success:function(r){
                            $('.productos_Xcategoria').html(r);
                        }
                    });
                }
            </script>
        </div>

        <div class="productos_Xcategoria"></div>

        <?php
            // for ($i=0; $i < 50; $i++) { 
            //     $conex->query ("INSERT INTO productos (idProductos, Titulo, Descripcion, Precio, Cantidad_stock, Categorias_Productos_idCategorias_productos) 
            //         VALUES (".rand(1000,5000).",'Producto $i', 'nashe', ".rand(100, 1000).", ".rand(1, 50).", 5)");
            // }

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

        ?>

        <?php
            while($row = mysqli_fetch_array($resultado)){
        ?>
    	<div class="card">
            <figure>
                <a href="detalles_productos.php?id=<?php echo $row['idProductos']?>">
                    <img src="data:image/png;base64,<?php echo base64_encode($row['Imagen']);?>">
                 </a>
            </figure>
            <div class="contenido">
                <h3><?php echo $row['Titulo']?></h3>
                <p>
                    <strong>$ <?php echo number_format($row['Precio'])?></strong> 
                </p> 
                <a href="detalles_productos.php?id=<?php echo $row['idProductos']?>"> Ver Más</a>
            </div>
            <br>
        </div>
        <?php
            }
        ?>
    </div>

    <br>

    <div class="row-botones">
        <ul class="botones-color">
            <?php
                if (isset($_GET['limite'])) {
                    if ($_GET['limite'] > 0) {
                        echo '<li>
                                <a href="productos.php?limite='.($_GET['limite'] - 10).'">
                                    <i class="fa-solid fa-arrow-left"></i>
                                </a>
                              </li>';
                    }
                }
                for ($k=0; $k <= $total_botones; $k++) { 
                    echo '<li><a href="productos.php?limite='.($k*10).'">'.($k+1).'</a></li>';
                }
                if (isset($_GET['limite'])) {
                    if ($_GET['limite'] + 10 <= $total_botones * 10) {
                        echo '<li>
                                <a href="productos.php?limite='.($_GET['limite'] + 10).'" class="nashe">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                              </li>';
                    }
                }else{
                    echo '<li>
                            <a href="productos.php?limite=10">
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                          </li>';
                }
            ?>
        </ul>
    </div>

    <?php
    
    include("footer.php");

    ?>
</body>
</html>