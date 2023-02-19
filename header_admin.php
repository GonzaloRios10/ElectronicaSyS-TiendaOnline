<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style_header_admin.css">
</head>
<body>
	<nav>
        <img id="logo_sys" src="SSPNG-03.png">
        <ul>
            <li>
                <a href="proveedores.php">
                    <i class="fa-solid fa-truck-field"></i> 
                        Proveedores 
                    <i class="fa-sharp fa-solid fa-caret-down"></i>
                </a>
                <ul>
                    <li>
                        <a href="proveedores_productos.php">
                            <i class="fa-solid fa-boxes-packing"></i> Productos / Proveedores
                        </a>
                    </li>
                    <!-- <li>
                        <a href="#">Compras</a>
                    </li> -->
                </ul>
            </li>
            <li>
                <a href="clientes.php">
                    <i class="fa-solid fa-users"></i> 
                        Usuarios 
                    <i class="fa-sharp fa-solid fa-caret-down"></i>
                </a>
                <ul>
                    <li>
                        <a href="ventas_realizadas.php">
                            <i class="fa-sharp fa-solid fa-chart-simple"></i> Ventas realizadas
                        </a>
                    </li>
                    <li>
                        <a href="detalles_ventas.php">
                            <i class="fa-solid fa-circle-dollar-to-slot"></i> Detalles de ventas
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="mostrar_productos.php">
                    <i class="fa-solid fa-bag-shopping"></i> 
                        Productos
                    <i class="fa-sharp fa-solid fa-caret-down"></i>
                </a>
                <ul>
                    <li>
                        <a href="formulario_producto_nuevacategoria.php">
                            <i class="fa-solid fa-list"></i> Categorias
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <?php
                    if (isset($_SESSION['UsuarioAdmin'])) {
                        ?>
                        <a href="#">
                            <?php echo $_SESSION['UsuarioAdmin']?> <i class="fa-sharp fa-solid fa-caret-down"></i>
                        </a>  
                        <ul>
                            <li>
                                <a href="#">
                                    <i class="fa-solid fa-user"></i> Mi perfil
                                </a>
                            </li>
                            <li>
                                <a href="cerrar_sesion.php">
                                    <i class="fa-solid fa-right-from-bracket"></i> Cerrar sesion
                                </a>
                            </li>
                        </ul>
                        <?php
                    }else{
                        ?>
                        <a href="login.php">
                            <i class="fa-solid fa-user"></i>
                        </a>
                        <?php
                    }
                    ?>
                </a> 
            </li>
        </ul> 
	</nav>
</body>
</html>


