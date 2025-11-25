<?php
include('../config/conexao.php');

$nome_arquivo = 'usuarios_' . date('Ymd_His') . '.csv';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $nome_arquivo . '"');

$output = fopen('php://output', 'w');

$sql = "SELECT id, nome, email, cpf, cep, endereco, numero, bairro, complemento, nivel, created_at FROM usuarios";
$result = $conn->query($sql);

$cabecalhos = [
    'ID', 
    'Nome', 
    'Email', 
    'CPF', 
    'CEP', 
    utf8_decode('Endereço'), 
    utf8_decode('N°'), 
    'Bairro', 
    'Complemento', 
    'Nivel', 
    'Criado Em'
];

fputcsv($output, $cabecalhos, ';');

// --- 2. Escreve os Dados ---
if ($result && $result->num_rows > 0) {
    while ($linha = $result->fetch_assoc()) 
    {
        $dados_linha = [
            $linha['id'],
            utf8_decode($linha['nome']),
            utf8_decode($linha['email']),
            $linha['cpf'],
            $linha['cep'],
            utf8_decode($linha['endereco']),
            $linha['numero'],
            utf8_decode($linha['bairro']),
            utf8_decode($linha['complemento']),
            $linha['nivel'],
            $linha['created_at']
        ];
        
        fputcsv($output, $dados_linha, ';');
    }
}

fclose($output);
exit();
?>