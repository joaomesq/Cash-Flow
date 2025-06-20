<?php
ob_start();
//Carrregando a biblioteca TCPDF
require_once __DIR__.'/tcpdf/tcpdf.php';


function gerarPdf($dados){
		$users = $dados;
        
		if($dados->fetchArray(SQLITE3_NUM) > 0){
            //inicializar o PDF
            $pdf = new TCPDF();
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('João Mesquita');
            $pdf->SetTitle('Lista Transações');
            $pdf->SetKeywords('TCPDF, PDF, exemplo, teste, guia');

            //configurar cabeçalho
            $pdf->SetPrintHeader(false);
            $pdf->SetPrintFooter(false);

            //Add page
            $pdf->AddPage();

            //config fonte
            $pdf->SetFont('', '', 12);

            //Add titulo
            $pdf->Cell(0, 10, 'Histótrico', 0, 1, 'C');

            //Adicionar Cabeçalho da tabela
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetDrawColor(0, 0, 255);
            $pdf->SetLineWidth(0.3);
            $pdf->SetFont('', 'B');

            //Cabeçalhos da tabela
            $header = array('Id', 'Descrição', 'Categoria', 'Data', 'Valor', 'Tipo');
            $nume_header = count($header);
            foreach($header as $col):
            	$pdf->Cell(63, 7, $col, 1, 0, 'C', 1);
            endforeach;
            $pdf->Ln();

            //Restaurar fonte e cores para o conteúdo da tabela
            $pdf->SetFont('');
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetTextColor(0);

            //Preencher a tabela com os dados
            while($row = $dados->fetchArray(SQLITE3_ASSOC)):
            	$pdf->Cell(63, 6, $row['id_transacao'], 'LR', 0, 'L', $fill);
            	$pdf->Cell(63, 6, $row['descricao'], 'LR', 0, 'L', $fill);
            	$pdf->Cell(63, 6, $row['categoria'], 'LR', 0, 'L', $fill);
            	$pdf->Cell(63, 6, $row['ano-mes-dia'], 'LR', 0, 'L', $fill);
                $pdf->Cell(63, 6, $row['valor'], 'LR', 0, 'L', $fill);
                $pdf->Cell(63, 6, $row['tipo'], 'LR', 0, 'L', $fill);

            	$fill = !$fill;
            endwhile;
            $pdf->Cell(189, 0, '', 'T');

            ob_end_clean();

            //fechar e salvar o pdf
            $pdf->Output('Dados_usuarios.pdf', 'I');
            echo "PDF gerado com sucesso";
            var_dump($users->fetchArray(SQLITE3_ASSOC));
        }else{
        	echo "Nenhum dado encontrado";
        }

	}