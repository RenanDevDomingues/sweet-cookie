<?php
session_start();
$usuario = null;

if (!empty($_SESSION['logado'])) {
    $usuario = $_SESSION['usuario'];
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweet Cookies</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="stylesheet" href="../css/sobre.css">
</head>

<body>
    <?php
    include("../config/header.php");
    ?>

    <!-- HERO -->
    <section class="hero">
        <div class="hero-overlay">
            <img src="../img/Chip Padrão.png" alt="Cookie Face">
            <h1><span class="highlight">Cookies</span> artesanais feitos com amor!</h1>
            <p>Feitos com ingredientes premium e muito amor</p>
        </div>
    </section>

    <!-- sobre -->
    <section class="sobre-section">
        <div class="container">
            <h2>Desenvolvedores</h2>
            <div class="sobre-lista">
                <div class="sobre-card sobre-card1">
                    <img src="../img/cokicc.svg" alt="Cookie">
                    <div class="sobre-pessoa">
                        <div class="sobre-nome">
                            <h3>Victor de Lucena</h3>
                            <a target="_blank" href="https://github.com/LucenaVicc"><img src="../img/github.jpg" alt="" class="sobre-github"></a>
                        </div>
                        <p>Design, Front-end e Back-end</p>
                    </div>
                </div>
                <div class="sobre-card sobre-card2">
                    <img src="../img/Cookie piscante.svg" alt="Cookie">
                    <div class="sobre-pessoa">
                        <div class="sobre-nome">
                            <h3>Renan Domingues</h3>
                            <a target="_blank" href="https://github.com/RenanDevDomingues"><img src="../img/github.jpg" alt="" class="sobre-github"></a>
                        </div>
                        <p>Front-end e Back-end</p>
                    </div>
                </div>
                <div class="sobre-card sobre-card1">
                    <img src="../img/cookaua.svg" alt="Cookie">
                    <div class="sobre-pessoa">
                        <div class="sobre-nome">
                            <h3>Cauã Arruda</h3>
                            <a target="_blank" href="https://github.com/rayrazer"><img src="../img/github.jpg" alt="" class="sobre-github"></a>
                        </div>
                        <p>Front-end e Back-end</p>
                    </div>
                </div>
                <div class="sobre-card sobre-card2">
                    <img src="../img/cookilherme.svg" alt="Cookie">
                    <div class="sobre-pessoa">
                        <div class="sobre-nome">
                            <h3>Guilherme Cabral</h3>
                            <a target="_blank" href="https://github.com/Gui-cs06"><img src="../img/github.jpg" alt="" class="sobre-github"></a>
                        </div>
                        <p>Front-end e Back-end</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- FOOTER -->
    <?php
    include("../config/footer.php");
    ?>
</body>

</html>