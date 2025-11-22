<?php
session_start();
$usuario = null;

if (!empty($_SESSION['logado'])) {
    $usuario = $_SESSION['usuario'];
}
?>


<?php
// Exibe header diferente conforme o nível do usuário
if ($usuario && isset($usuario['nivel']) && $usuario['nivel'] == 1) {
?>
<header>
    <div class="header-content">
        <a href="../index.php">
            <img src="../img/Sweet.svg" alt="Sweet Cookies" class="logo">
        </a>
        <div class="header-search">
            <input type="text" placeholder="O que deseja buscar?">
            <button>
                <img src="../img/lupa.svg" alt="Buscar">
                <span class="sr-only"></span>
            </button>
        </div>
        <div class="header-actions">
            <div class="darkmode">
                <div class="darkmode-toggle"></div>
            </div>
            <a href="#" class="login">
                <img src="../img/usuario.svg" alt="Usuário">
                <?php
                if ($usuario) {
                    echo '<a href="../actions/UsuarioLogout.php" class="login">Deslogar</a>';
                } else {
                    echo '<a href="../paginas/login2.php" class="login"><span>Faça login <br>ou seu cadastro</a>';
                }
                ?>
            </a>
            <!--carrinho-->
            <a href="#" class="cart-area">
                <img src="../img/carrinho.svg" alt="Carrinho de Compras" class="cart-icon">
                <span class="cart-badge">2</span>
            </a>
            <button class="menu-icon">
                <img src="../img/navbar-hero.svg" alt="Menu">
            </button>
        </div>
    </div>
</header>
<?php
} else {
?>
<header>
    <div class="header-content">
        <a href="../index.php">
            <img src="../img/Sweet.svg" alt="Sweet Cookies" class="logo">
        </a>
        <a href="#" class="login">
            <img src="../img/usuario.svg" alt="Usuário">
            <?php
            if ($usuario) {
                echo '<a href="./actions/UsuarioLogout.php" class="login">Deslogar</a>';
            } else {
                echo '<a href="./paginas/login2.php" class="login"><span>Faça login <br>ou seu cadastro</a>';
            }
            ?>
        </a>
    </div>
</header>
<?php
}
