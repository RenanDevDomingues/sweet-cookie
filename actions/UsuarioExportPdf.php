<?php
require('../fpdf/fpdf.php');
include('../config/conexao.php');

$sql = "
SELECT * from usuarios";

$result = $conn->query($sql);

$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, utf8_decode('Lista de Usuários Cadastrados'), 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(10, 8, 'ID', 1);
$pdf->Cell(45, 8, 'Nome', 1);
$pdf->Cell(60, 8, 'Email', 1);
$pdf->Cell(30, 8, 'CPF', 1);
$pdf->Cell(15, 8, 'CEP', 1);
$pdf->Cell(40, 8, utf8_decode('Endereço'), 1);
$pdf->Cell(15, 8, utf8_decode('N°'), 1);
$pdf->Cell(30, 8, 'Nivel', 1);
$pdf->Cell(30, 8, 'Criado Em', 1);
$pdf->Ln();

$pdf->SetFont('Arial', '', 8);

while ($linha = $result->fetch_assoc()) 
{
    $pdf->Cell(10, 8, $linha['id'], 1);
    $pdf->Cell(45, 8, utf8_decode($linha['nome']), 1);
    $pdf->Cell(60, 8, utf8_decode($linha['email']), 1);
    $pdf->Cell(30, 8, $linha['cpf'], 1);
    $pdf->Cell(15, 8, $linha['cep'], 1);
    $pdf->Cell(40, 8, utf8_decode($linha['endereco']), 1);
    $pdf->Cell(15, 8, $linha['numero'], 1);
    $pdf->Cell(30, 8, $linha['nivel'], 1); 
    $createdAt = date('Y-m-d', strtotime($linha['created_at']));
    $pdf->Cell(30, 8, $createdAt, 1);
    $pdf->Ln();
}

$pdf->Output();
exit;
?>