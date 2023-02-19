<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style_header.css">
</head>
<body>
	<nav>
        <img id="logo_sys" src="SSPNG-03.png">
        <ul>
            <li>
                <a href="index.php"><i class="fa-solid fa-house"></i> Inicio</a>
            </li>
            <li>
                <a href="productos.php"><i class="fa-solid fa-bag-shopping"></i> Productos</a>
            </li>
            <li>
                <a href="#footer-contact"><i class="fa-solid fa-envelope"></i> Contacto</a>
            </li>
            <li>
                <a href="#">
                    <?php
                    if (isset($_SESSION['UsuarioClien'])) {
                        ?>
                        <a href="#">
                            <?php echo $_SESSION['UsuarioClien']?> <i class="fa-sharp fa-solid fa-caret-down"></i>
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
            <li>
                <a href="carrito.php" class="nav-items"> 
                    <i class="fa-solid fa-cart-shopping"></i>
                    <?php
                    if (isset($_SESSION['carrito'])) {
                        echo count($_SESSION['carrito']);
                    }else{
                        echo 0;
                    }
                    ?>
                </a> 
            </li>
        </ul> 
	</nav>
</body>
</html>


