<?php
require_once('tcpdf-main/tcpdf.php');

// Criar nova instância TCPDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Define as informações do documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Seu Nome');
$pdf->SetTitle('Certificado');
$pdf->SetSubject('Certificado');
$pdf->SetKeywords('TCPDF, PDF, certificado');

// Define o cabeçalho e o rodapé
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Define a margem
$pdf->SetMargins(15, 15, 15);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Define a fonte
$pdf->SetFont('helvetica', '', 12);

// Adiciona uma página
$pdf->AddPage();

$largura_pagina_mm = $pdf->getPageWidth();

// Calcula a largura das células em milímetros com base na porcentagem desejada
$largura_coluna1 = $largura_pagina_mm * 0.3; // 30%
$largura_coluna2 = $largura_pagina_mm * 0.4; // 40%
$largura_coluna3 = $largura_pagina_mm * 0.3; // 30%

// HTML da tabela
$html = '<table border="1">';
$html .= '<tr>';
$html .= '<th width="'.$largura_coluna1.'">Coluna 1</th>';
$html .= '<th width="'.$largura_coluna2.'">Coluna 2</th>';
$html .= '<th width="'.$largura_coluna3.'">Coluna 3</th>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<th>Valor 1</th>';
$html .= '<th>Valor 2</th>';
$html .= '<th>Valor 3</th>';
$html .= '</tr>';
$html .= '</table>';

// Escreve a tabela no PDF
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, false, true, 'C', true);


// Saída do PDF
$pdf->Output('certificado.pdf', 'I');
?>
