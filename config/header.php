<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($path)) {
    $path = "../"; 
}

$usuario = null;
if (!empty($_SESSION['logado'])) {
    $usuario = $_SESSION['usuario'];
}

$cart_count = 0;
if (isset($_SESSION['carrinho'])) {
    foreach ($_SESSION['carrinho'] as $item) {
        $cart_count += $item['quantidade'];
    }
}
?>

<link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700,800&display=swap" rel="stylesheet">

<header>
    <div class="header-content">
        <a href="<?php echo $path; ?>index.php">
            <img src="<?php echo $path; ?>img/Sweet.svg" alt="Sweet Cookies" class="logo">
        </a>
        
        <div class="header-search">
            <input type="text" placeholder="O que deseja buscar?">
            <button>
                <img src="<?php echo $path; ?>img/lupa.svg" alt="Buscar">
            </button>
        </div>

        <div class="header-actions">
            <div class="darkmode">
                <div class="darkmode-toggle"></div>
            </div>
            
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

            <a href="<?php echo $path; ?>paginas/carrinho.php" class="cart-area">
                <img src="<?php echo $path; ?>img/carrinho.svg" alt="Carrinho" class="cart-icon">
                <span class="cart-badge"><?= $cart_count ?></span>
            </a>
            
            <button class="menu-icon">
                <img src="<?php echo $path; ?>img/navbar-hero.svg" alt="Menu">
            </button>
        </div>
    </div>
</header>

<script src="../js/navbar.js"></script>
<script src="../js/darkmode.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>