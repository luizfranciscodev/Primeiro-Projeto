<?php

// Inclui o arquivo de autoload da biblioteca Dompdf
require "vendor/autoload.php";

// Importa o namespace Dompdf
use Dompdf\Dompdf;

// Instancia a classe Dompdf
$dompdf = new Dompdf();

// Inicia o buffer de saída e requer o conteúdo HTML do arquivo "conteudo-pdf.php"
ob_start();
require "conteudo-pdf.php";
$html = ob_get_clean();

// Carrega o HTML na instância do Dompdf
$dompdf->loadHtml($html);

// (Opcional) Configura o tamanho do papel e a orientação
$dompdf->setPaper('A4');

// Renderiza o HTML como PDF
$dompdf->render();

// Exibe o PDF gerado no navegador
$dompdf->stream();
