<?php
require_once '../config/header.php';
require_once '../config/conexao.php';

// Exemplo de consulta ao banco para dashboard
$usuarios = mysqli_query($conn, "SELECT nome, email FROM usuarios LIMIT 10");
$totalUsuarios = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM usuarios"))['total'];
$ativosOnline = "0";
$cadastrosSemana = "$totalUsuarios";

// ===============================
// EXPORTAR CSV
// ===============================
if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=produtos.csv');
    $output = fopen('php://output', 'w');

	fputcsv($output, ['ID', 'Nome', 'Descrição', 'Preço']);
	$result = $conn->query('SELECT id, nome, descricao, preco FROM produtos');
	while ($row = $result->fetch_assoc()) {
		fputcsv($output, $row);
	}

    fclose($output);
    exit;
}

// ===============================
// EXPORTAR PDF
// ===============================
if (isset($_GET['export']) && $_GET['export'] === 'pdf') {

    class PDF extends FPDF {
        function Header() {
            $this->SetFont('Arial','B',16);
            $this->Cell(0,10,'Relatorio de Produtos',0,1,'C');
            $this->Ln(5);
        }
    }

    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',12);


	$pdf->Cell(10,10,'ID',1);
	$pdf->Cell(50,10,'Nome',1);
	$pdf->Cell(60,10,'Descricao',1);
	$pdf->Cell(25,10,'Preco',1);
	$pdf->Ln();

	$pdf->SetFont('Arial','',10);
	$result = $conn->query('SELECT id, nome, descricao, preco FROM produtos');

	while ($row = $result->fetch_assoc()) {
		$pdf->Cell(10,10,$row['id'],1);
		$pdf->Cell(50,10,utf8_decode($row['nome']),1);
		$pdf->Cell(60,10,utf8_decode(substr($row['descricao'],0,30)),1);
		$pdf->Cell(25,10,'R$ '.number_format($row['preco'],2,',','.'),1);
		$pdf->Ln();
	}

    $pdf->Output('I', 'produtos.pdf');
    exit;
}

$total_produtos = $conn->query('SELECT COUNT(*) FROM produtos')->fetch_row()[0];
// $total_estoque = $conn->query('SELECT SUM(quantidade) FROM produtos')->fetch_row()[0]; // Removido pois não existe coluna quantidade
$total_logs = $conn->query('SELECT COUNT(*) FROM logs')->fetch_row()[0];
$total_usuarios = $conn->query('SELECT COUNT(*) FROM usuarios')->fetch_row()[0];

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard | Sweet Cookies</title>
	<link rel="stylesheet" href="../css/dashboard.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<div class="dashboard-header">
		<img src="../img/Chip Padrão.png" alt="Sweet Cookies Logo" style="height:48px; width:auto; margin-right:18px;">
		<span class="dashboard-title">DASHBOARD</span>
		<span style="margin-left:auto; color:#fff; font-size:1rem;"><i class="fa fa-user"></i> Área ADM</span>
	</div>
	<div class="dashboard-main">
		<aside class="dashboard-sidebar">
			<h3>ADMINISTRATIVO</h3>
			<ul>
				<li class="dashboard-tab" data-tab="usuarios"><i class="fa fa-users"></i> Usuários</li>
				<li class="dashboard-tab" data-tab="logs"><i class="fa fa-file-text"></i> Logs</li>
				<li class="dashboard-tab" data-tab="produtos"><i class="fa fa-cube"></i> Produtos</li>
				<!-- <li class="dashboard-tab" data-tab="area1">area1</li>
                <li class="dashboard-tab" data-tab="area2">area2</li> -->
			</ul>
		</aside>
		<main class="dashboard-content">
			<section id="tab-usuarios">
				<h2 style="color:#bdbdbd; font-size:1.3rem; margin-bottom:18px;"><i class="fa fa-users"></i> Gerenciamento de Usuários</h2>
				<div class="dashboard-filters">
					<select>
						<option>Inativo</option>
						<option>Ativo</option>
					</select>
					<select>
						<option>Tipo de Usuário</option>
						<option>Admin</option>
						<option>Usuário</option>
					</select>
					<select>
						<option>Ordenar por</option>
						<option>Nome</option>
						<option>Status</option>
					</select>
					<button id="export-csv">Exportar CSV</button>
					<button id="export-pdf">Exportar PDF</button>
					<input type="text" id="search-user" placeholder="Buscar usuário..." style="margin-left:auto;">
					
				</div>
				<table class="dashboard-table" id="usuarios-table">
					<thead>
						<tr>
							<th>Nome</th>
							<th>E-mail</th>
							<th>Role</th>
							<th>Ações</th>
						</tr>
					</thead>
					<tbody>
						<?php
						// Exemplo: role fictício
						while($u = mysqli_fetch_assoc($usuarios)):
						?>
						<tr>
							<td><?php echo htmlspecialchars($u['nome']); ?></td>
							<td><?php echo htmlspecialchars($u['email']); ?></td>
							<td><?php echo isset($u['role']) ? htmlspecialchars($u['role']) : 'Usuário'; ?></td>
							<td class="actions">
								<button class="btn-editar-usuario" data-nome="<?php echo htmlspecialchars($u['nome']); ?>" data-email="<?php echo htmlspecialchars($u['email']); ?>" data-role="<?php echo isset($u['role']) ? htmlspecialchars($u['role']) : 'Usuário'; ?>"><i class="fa fa-pencil"></i></button>
								<button class="btn-excluir-usuario"><i class="fa fa-trash"></i></button>
							</td>
						</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
					<!-- Modal Novo Usuário -->
					<div id="modal-novo-usuario" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.5); justify-content:center; align-items:center; z-index:999;">
						<form method="POST" action="../actions/UsuarioCreate.php" style="background:#393939; padding:30px; border-radius:10px; min-width:320px; display:flex; flex-direction:column; gap:15px;">
							<h3 style="color:#fff;">Novo Usuário</h3>
							<input type="text" name="nome" placeholder="Nome" required>
							<input type="email" name="email" placeholder="E-mail" required>
							<select name="role">
								<option value="Usuario">Usuário</option>
								<option value="Admin">Admin</option>
							</select>
							<input type="password" name="senha" placeholder="Senha" required>
							<div style="display:flex; gap:10px;">
								<button type="submit" style="background:#d32f2f; color:#fff; border:none; padding:8px 18px; border-radius:5px;">Criar</button>
								<button type="button" id="fechar-modal-novo" style="background:#444; color:#fff; border:none; padding:8px 18px; border-radius:5px;">Cancelar</button>
							</div>
						</form>
					</div>
					<!-- Modal Editar Usuário -->
					<div id="modal-editar-usuario" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.5); justify-content:center; align-items:center; z-index:999;">
						<form method="POST" action="usuario_edit.php" style="background:#393939; padding:30px; border-radius:10px; min-width:320px; display:flex; flex-direction:column; gap:15px;">
							<h3 style="color:#fff;">Editar Usuário</h3>
							<input type="hidden" name="id" id="edit-id">
							<input type="text" name="nome" id="edit-nome" placeholder="Nome" required>
							<input type="email" name="email" id="edit-email" placeholder="E-mail" required>
							<select name="role" id="edit-role">
								<option value="Usuario">Usuário</option>
								<option value="Admin">Admin</option>
							</select>
							<div style="display:flex; gap:10px;">
								<button type="submit" style="background:#d32f2f; color:#fff; border:none; padding:8px 18px; border-radius:5px;">Salvar</button>
								<button type="button" id="fechar-modal-editar" style="background:#444; color:#fff; border:none; padding:8px 18px; border-radius:5px;">Cancelar</button>
							</div>
						</form>
					</div>
				<div class="dashboard-pagination">
					<button class="active">1</button>
					<button>2</button>
					<button>3</button>
				</div>
				<div style="margin-top:10px; color:#bdbdbd; font-size:0.95rem;">
					Exibindo 1-10 de <?php echo $totalUsuarios; ?> usuários
				</div>
			</section>
			<section id="tab-logs" style="display:none;">
				<h2 style="color:#bdbdbd; font-size:1.3rem; margin-bottom:18px;"><i class="fa fa-file-text"></i> Logs do Sistema</h2>
				<table class="dashboard-table">
					<thead>
						<tr>
							<th>Data</th>
							<th>Usuário</th>
							<th>Ação</th>
						</tr>
					</thead>
				</table>
			</section>
			<section id="tab-produtos" style="display:none;">
				<h2 style="color:#bdbdbd; font-size:1.3rem; margin-bottom:18px;"><i class="fa fa-cube"></i> Produtos</h2>
				<?php
				// Consulta produtos reais
				$produtos = mysqli_query($conn, "SELECT id, nome, categoria, preco FROM produtos LIMIT 10");
				?>
				<table class="dashboard-table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nome</th>
							<th>Categoria</th>
							<th>Preço</th>
						</tr>
					</thead>
					<tbody>
						<?php if ($produtos && mysqli_num_rows($produtos) > 0): ?>
							<?php while($p = mysqli_fetch_assoc($produtos)): ?>
							<tr>
								<td><?php echo $p['id']; ?></td>
								<td><?php echo htmlspecialchars($p['nome']); ?></td>
								<td><?php echo htmlspecialchars($p['categoria']); ?></td>
								<td>R$ <?php echo number_format($p['preco'], 2, ',', '.'); ?></td>
							</tr>
							<?php endwhile; ?>
						<?php else: ?>
							<tr><td colspan="4">Nenhum produto cadastrado.</td></tr>
						<?php endif; ?>
					</tbody>
				</table>
			</section>
		</main>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
	<script src="../js/dashboard.js"></script>
</body>
</html>
