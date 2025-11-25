<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($path)) {
    $path = "../"; 
}

$usuario = null;
$nivel_usuario = '1'; 

if (!empty($_SESSION['logado'])) 
{
    $usuario = $_SESSION['usuario'];
    
    if (isset($usuario['nivel'])){
        $nivel_usuario = $usuario['nivel'];
    }
}

$cart_count = 0;
if (isset($_SESSION['carrinho'])) 
{
    foreach ($_SESSION['carrinho'] as $item){
        $cart_count += $item['quantidade'];
    }
}
?>
<link rel="stylesheet" href="<?php echo $path; ?>css/style.css">
<header>
    
    <div class="header-content">
        <a href="<?php echo $path; ?>index.php">
            <img src="<?php echo $path; ?>img/Sweet.svg" alt="Sweet Cookies" class="logo">
        </a>
        
        <?php if ($nivel_usuario != '2'): ?>
            <div class="header-search">
                <input type="text" placeholder="O que deseja buscar?">
                <button>
                    <img src="<?php echo $path; ?>img/lupa.svg" alt="Buscar">
                </button>
            </div>
        <?php endif; ?>

        <div class="header-actions">
            
            <?php if ($nivel_usuario != '2'): ?>
                <div class="darkmode">
                    <div class="darkmode-toggle"></div>
                </div>
            <?php endif; ?>
            
            <div class="login-area">
                <?php if ($usuario): ?>
                    <a href="<?php echo $path; ?>actions/UsuarioLogout.php" class="login">
                        <img src="<?php echo $path; ?>img/usuario.svg" alt="Usuário">
                        <span>Deslogar</span>
                    </a>
                <?php else: ?>
                    <a href="<?php echo $path; ?>paginas/login.php" class="login">
                        <img src="<?php echo $path; ?>img/usuario.svg" alt="Login">
                        <span>Faça login <br>ou cadastro</span>
                    </a>
                <?php endif; ?>
            </div>

            <?php if ($nivel_usuario != '2'): ?>
                <a href="<?php echo $path; ?>paginas/carrinho.php" class="cart-area">
                    <img src="<?php echo $path; ?>img/carrinho.svg" alt="Carrinho" class="cart-icon">
                    <span class="cart-badge"><?= $cart_count ?></span>
                </a>
                
                <button class="menu-icon">
                    <img src="<?php echo $path; ?>img/navbar-hero.svg" alt="Menu">
                </button>
            <?php endif; ?>
            
        </div>
    </div>
</header>
<div class="nav-menu">
    <div class="menu">
        <div class="option" id="close-menu">
            <img src="<?php echo $path; ?>img/navbar-hero.svg" alt="Menu">
            <h2>Menu</h2>
        </div>
        
        <div class="option">
            <img src="<?php echo $path; ?>img/casa.svg" alt="home">
            <a href="<?php echo $path; ?>index.php">
                <h2>Inicio</h2>
            </a>
        </div>
        <div class="option">
            <img src="<?php echo $path; ?>img/cookie.svg" alt="Cardapio">
            <a href="<?php echo $path; ?>paginas/cardapio.php">
            <h2>Cardapio</h2>
        </a>
        </div>
        <div class="option">
            <img src="<?php echo $path; ?>img/presente.svg" alt="Kits e Presentes">
            <a href="<?php echo $path; ?>paginas/merchan.php">
            <h2>Kits e Presentes</h2>
        </a>
        </div>
        <div class="option">
            <img src="<?php echo $path; ?>img/contato.svg" alt="home">
            <a href="<?php echo $path; ?>paginas/usuario.php">
                <h2>Perfil</h2>
            </a>
        </div>
        <div class="option">
            <img src="<?php echo $path; ?>img/contato.svg" alt="home">
            <a href="<?php echo $path; ?>paginas/sobre.php">
                <h2>Sobre Nós</h2>
            </a>
        </div>
        <div class="promododia">
            <img src="<?php echo $path; ?>img/navbar-hero.svg" alt="Promoção do Dia">
            <a href="<?php echo $path; ?>index.php">
            <h2>Promoção do Dia</h2>
        </a>
        </div>
    </div>
</div>
<div class="sombra"></div>

<script src="<?php echo $path; ?>js/navbar.js"></script>
<script src="<?php echo $path; ?>js/darkmode.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>