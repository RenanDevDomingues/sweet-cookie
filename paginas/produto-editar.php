<?php
include("../config/conexao.php");


if (!isset($_GET['id'])) {
    die("ID do produto não informado.");
}

$id = intval($_GET['id']);


$stmt = $conn->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Produto não encontrado!");
}

$produto = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/cadastro.css">
    <link rel="stylesheet" href="../css/responsive.css">
</head>

<body>

    <a href="dashboard.php" id="logo">
        <img src="../img/Sweet.svg" alt="Sweet Cookies" class="logo">
    </a>

    <div class="cadastro">
        <form action="../actions/ProdutoUpdate.php" id="form-editar" method="POST" enctype="multipart/form-data">
            
            <h2>Editar Produto</h2>

            <!-- ID oculto -->
            <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">

            <div class="info">
                <input type="text" name="nome"
                    value="<?php echo htmlspecialchars($produto['nome']); ?>" required>
            </div>

            <div class="info">
                <input type="text" name="descricao"
                    value="<?php echo htmlspecialchars($produto['descricao']); ?>" required>
            </div>

            <div class="info">
                <label for="tipo">Tipo</label>
                <select name="tipo" id="tipo">
                    <option value="cookie_doce" <?php if ($produto['tipo']=="cookie_doce") echo "selected"; ?>>Cookie doce</option>
                    <option value="cookie_salgado" <?php if ($produto['tipo']=="cookie_salgado") echo "selected"; ?>>Cookie salgado</option>
                    <option value="vestuario" <?php if ($produto['tipo']=="vestuario") echo "selected"; ?>>Vestuário</option>
                    <option value="utensilio" <?php if ($produto['tipo']=="utensilio") echo "selected"; ?>>Utensílio</option>
                    <option value="outro" <?php if ($produto['tipo']=="outro") echo "selected"; ?>>Outro</option>
                </select>
            </div>

            <div class="info">
                <select name="categoria" id="categoria"></select>
            </div>

            <div class="info">
                <input type="text" name="preco" id="preco"
                    value="<?php echo number_format($produto['preco'], 2, ',', '.'); ?>" required>
            </div>

            <div class="info">
                <label>Imagem atual:</label><br><br>
                <?php if ($produto['imagem']) : ?>
                    <img src="../uploads/produtos/<?php echo $produto['imagem']; ?>" width="120">
                <?php else: ?>
                    <p>Sem imagem</p>
                <?php endif; ?>
            </div>

            <div class="info">
                <input type="file" name="imagem">
            </div>

            <div class="submit">
                <button id="btn-cadastrar" type="submit">Salvar Alterações</button>
            </div>

        </form>
    </div>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>

<script>
    $('#preco').maskMoney({
        prefix: 'R$ ',
        allowNegative: false,
        thousands: '.',
        decimal: ',',
        affixesStay: false
    });

    const categorias = {
        cookie_doce: [
            { value: "sweet_choco_classic", text: "Sweet Choco Classic (chocolate tradicional)" },
            { value: "dark_sweet", text: "Dark Sweet (chocolate meio amargo)" },
            { value: "white_dream", text: "White Dream (chocolate branco)" },
            { value: "triple_sweet", text: "Triple Sweet (três chocolates)" },
            { value: "choco_explosion", text: "Choco Explosion (duplo chocolate)" },
            { value: "sweet_nutella_melt", text: "Sweet Nutella Melt" },
            { value: "dulce_sweet", text: "Dulce Sweet (doce de leite)" },
            { value: "sweet_brigadeirinho", text: "Sweet Brigadeirinho" },
            { value: "sweet_ninho_love", text: "Sweet Ninho Love" },
            { value: "ninho_morango_magic", text: "Ninho & Morango Magic" },
            { value: "red_sweet_velvet", text: "Red Sweet Velvet" },
            { value: "vanilla_choco_drops", text: "Vanilla Choco Drops" },
            { value: "salted_sweet_caramel", text: "Salted Sweet Caramel" },
            { value: "sweet_oreo_crush", text: "Sweet Oreo Crush" },
            { value: "sweet_mm_rainbow", text: "Sweet M&M Rainbow" },
            { value: "sweet_pacoca_boom", text: "Sweet Paçoca Boom" },
            { value: "sweet_brookie", text: "Sweet Brookie (brownie + cookie)" },
            { value: "pistachio_sweetbite", text: "Pistachio Sweetbite" },
            { value: "almond_crunch_sweet", text: "Almond Crunch Sweet" },
            { value: "sweet_castanha_power", text: "Sweet Castanha Power" },
            { value: "sweet_macadamia_gold", text: "Sweet Macadâmia Gold" },
            { value: "coco_choco_sweet", text: "Coco Choco Sweet" },
            { value: "banana_sweet_cinnamon", text: "Banana Sweet Cinnamon" },
            { value: "apple_sweet_pie", text: "Apple Sweet Pie" },
            { value: "lemon_sweet_zest", text: "Lemon Sweet Zest" },
            { value: "orange_choco_sweet", text: "Orange Choco Sweet" },
            { value: "sweet_black_coffee", text: "Sweet Black Coffee" },
            { value: "cappuccino_sweet_cream", text: "Cappuccino Sweet Cream" },
            { value: "choco_spice_heat", text: "Choco Spice Heat (chocolate + pimenta suave)" },
            { value: "sweet_pumpkin_spice", text: "Sweet Pumpkin Spice" }
        ],

        cookie_salgado: [
            { value: "sweet_cheddar_bite", text: "Sweet Cheddar Bite — cheddar amanteigado" },
            { value: "parmesao_gold", text: "Parmesão Gold — parmesão gratinado" },
            { value: "sweet_bacon_crush", text: "Sweet Bacon Crush — bacon crocante" },
            { value: "cheddar_bacon_blast", text: "Cheddar & Bacon Blast — cheddar + bacon" },
            { value: "pimenta_lovers", text: "Pimenta Lovers — levemente picante" },
            { value: "sweet_alho_toast", text: "Sweet Alho Toast — alho tostado" },
            { value: "ervas_finas_classic", text: "Ervas Finas Classic — alecrim, tomilho, orégano" },
            { value: "sweet_four_cheese", text: "Sweet Four Cheese — mix de queijos" },
            { value: "tomato_basil_fresh", text: "Tomato & Basil Fresh — tomate seco + manjericão" },
            { value: "azeitona_mediterranea", text: "Azeitona Mediterrânea — azeitona verde" },
            { value: "sweet_pepperoni_bite", text: "Sweet Pepperoni Bite — estilo pizza" },
            { value: "sweet_pizza_supreme", text: "Sweet Pizza Supreme — mozzarella + orégano" },
            { value: "sweet_cream_cheese", text: "Sweet Cream Cheese — cream cheese salgado" },
            { value: "cebola_caramel_salgada", text: "Cebola Caramel Salgada — cebola caramelizada + toque salgado" },
            { value: "sweet_calabresa_crisp", text: "Sweet Calabresa Crisp — calabresa leve" },
            { value: "lemon_pepper_crunch", text: "Lemon Pepper Crunch — limão + pimenta" },
            { value: "sweet_paprika_smoke", text: "Sweet Paprika Smoke — páprica defumada" },
            { value: "sweet_chimichurri_mix", text: "Sweet Chimichurri Mix — ervas + leve acidez" },
            { value: "herb_butter_classic", text: "Herb Butter Classic — manteiga com ervas" },
            { value: "sweet_gorgonzola_punch", text: "Sweet Gorgonzola Punch — gorgonzola forte" },
            { value: "parmesao_ervas_fine", text: "Parmesão & Ervas Fine — parmesão + alecrim" },
            { value: "sweet_cheddar_onion", text: "Sweet Cheddar Onion — cheddar + cebola roxa" },
            { value: "sweet_garlic_parmesan", text: "Sweet Garlic Parmesan — alho + parmesão" },
            { value: "provolone_crunch", text: "Provolone Crunch — provolone crocante" },
            { value: "sweet_salsa_ranch", text: "Sweet Salsa Ranch — sabor molho ranch" },
            { value: "toscana_rust", text: "Toscana Rust — linguiça toscana" },
            { value: "sweet_bacon_cheese_bomb", text: "Sweet Bacon Cheese Bomb — bacon + queijo derretido" },
            { value: "sweet_pesto_bite", text: "Sweet Pesto Bite — pesto de manjericão" },
            { value: "sweet_carbonara", text: "Sweet Carbonara — bacon + queijo + toque de pimenta" },
            { value: "sweet_nacho_spice", text: "Sweet Nacho Spice — tempero estilo nacho" }
        ],

        vestuario: [
            { value: "camisa", text: "Camisa" },
            { value: "moletom", text: "Moletom" },
            { value: "boné", text: "Boné" },
            { value: "ecobag", text: "Ecobag" },
            { value: "touca", text: "Touca" },
            { value: "meias", text: "Meias" }
        ],

        utensilio: [
            { value: "copo", text: "Copo" },
            { value: "garrafa", text: "Garrafa" },
            { value: "bloco_de_notas", text: "Bloco de notas" },
            { value: "adesivo", text: "Adesivo" },
            { value: "caneta", text: "Caneta" },
            { value: "chaveiro", text: "Chaveiro" }
        ],

        outro: [
            { value: "kit_presente", text: "Kit Presente" },
            { value: "decoracao", text: "Decoração" },
            { value: "acessorios", text: "Acessórios" },
            { value: "diversos", text: "Diversos" }
        ]
    };

    function preencherCategorias(lista) {
        const select = $("#categoria");
        select.empty();

        lista.forEach(item => {
            select.append(new Option(item.text, item.value));
        });

        
        select.val("<?php echo $produto['categoria']; ?>");
    }

    
    preencherCategorias(categorias["<?php echo $produto['tipo']; ?>"]);

    
    $("#tipo").on("change", function () {
        preencherCategorias(categorias[$(this).val()]);
    });
</script>

</body>
</html>
