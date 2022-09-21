<?php
	 date_default_timezone_set('America/Sao_Paulo');
	include_once('config.php');
	$html = "";
	$filtroinicial = $_POST['filtrartabelainicial'];
	$statusid = $_POST['statusid'];
    $filtroinicialint = strtotime($filtroinicial);
    $filtrofinal = $_POST['filtrartabelafinal'];
    $filtrofinalint = strtotime($filtrofinal);
	$datainicial = date('d/m/Y', $filtroinicialint);
	$datafinal = date('d/m/Y', $filtrofinalint);

	$totalareceber = 0;
	$totalpago = 0;
	$valorpendente = 0;
	$result_contasareceber = "SELECT * FROM contasreceber WHERE vencimento BETWEEN $filtroinicialint AND $filtrofinalint ORDER BY idreceber DESC";
	$resultado_contasareceber = mysqli_query($conexao, $result_contasareceber);
	$contasareceber = mysqli_fetch_assoc($resultado_contasareceber);
	


	
  	error_reporting(0);
    ini_set('display_errors', 0);
	include('pdf/mpdf.php');

	$html = "
	<!DOCTYPE html>
	<html>
	<head>
	<style>
		li {
	  list-style-type: none;
	  margin-left: -38 px;
	}
	body{
		font-family: 'Montserrat';


	}
	.dinheiro{
		text-align: right;
		width: 100px;

	}
	table, h2{  
		font-family: 'Montserrat';
		border-collapse: collapse;
	  }  
	#trtitulo{  
		border: 1px solid black;
		background: #288BA8;
		text-align:center;
	}   
	.pendente{
		background: RED;
	}
	.pago{
		background: #93C47D;
	}
	.tditens{

		border: 1px dotted black;
		
	}
	.ppago {
		background: #FFFF00;
	}
	.titulotabela{
		text-align: center;
	}

	</style>
	</head>
	
	<body>
		<h4>Relatório contas a receber </h4>
					<ul>
					  <li>Vencimento: {$datainicial} até {$datafinal} - Status:";
					  if($statusid == 1){
						$html = $html ."
						Todos
						";
					  }elseif($statusid == 2){
						$html = $html ."
						Recebido
						";
					  }elseif($statusid == 3){
						$html = $html ."
						Parcialmente Recebido
						";
					}elseif($statusid == 4){
						$html = $html ."
						Pendente
						";
					}
					$html = $html ."
					  </li>
					</ul>
					<td>Gerado em:</td>

					";
					$agora = date('d/m/Y H:i');
					$html = $html ."
					 {$agora}
					<hr/>
					<table  width='800' align='center'   >
				 <tr id ='trtitulo'>
			  <td class='titulotabela'>Vencimento</td>
              <td class='titulotabela'>Lançamento</td>
              <td class='titulotabela'>Histórico</td>
              <td class='titulotabela'>Parcela (s)</td>
			  <td class='titulotabela'>Valor (R$)</td>
              <td class='titulotabela'>Valor Parcela (R$)</td>
              <td class='titulotabela'>Status</td>
            	< class='titulotabela'/tr>
			<br>";
				foreach($resultado_contasareceber as $row_contasareceber){
		
	
				$vencimento = $row_contasareceber['vencimento'];
				$vencimento = date('d/m/Y', $vencimento);
				$lancamento = $row_contasareceber['lancamento'];
				$lancamento = date('d/m/Y', $lancamento);
				$historico = $row_contasareceber['historico'];
				$parcelas = $row_contasareceber['numparcelas'];
				$valortotal = $row_contasareceber['valor'];
				$vparcela = $row_contasareceber['valorparcela'];
				$status = $row_contasareceber['status'];
				$id = $row_contasareceber['idreceber'];
				$resultreceberbaixas = "SELECT * FROM contasreceberparcelas WHERE idreceber=$id ORDER BY numeroparcela ASC;";
				$requisicao = $conexao->query($resultreceberbaixas);
				$parcelaspagas = 0;
					
				foreach ($requisicao as $contasreceberbaixas){
					$pago = intval($contasreceberbaixas['statusparcela']);
							if($pago > 0){
								$parcelaspagas = $parcelaspagas+1;
							  }
				}		
				$parcelaspagasaux = $parcelaspagas;
				$parcelaspagas = 0;

					
				if($statusid == 1){
					$totalareceber = $totalareceber + $valortotal;
					foreach ($requisicao as $contasreceberbaixas){
						$pago = intval($contasreceberbaixas['statusparcela']);
								if($pago > 0){
									$totalpago = $totalpago  + $contasreceberbaixas['valorparcela'];
									$parcelaspagas = $parcelaspagas+1;
			
								  }else{
									$totalpago = $totalpago + 0;
								}
					}		
					$valorpendente = $totalareceber - $totalpago;
					$valortotal = number_format($valortotal,2,",",".");
					$vparcela = number_format($vparcela,2,",",".");
				$html = $html ."
				<tr>
				<td class='tditens'>{$vencimento}</td>
				<td class='tditens'>{$lancamento}</td>
				<td class='tditens'>{$historico}</td>
				<td class='tditens'>{$parcelaspagas}/{$parcelas}</td>
				<td class='tditens dinheiro'>{$valortotal}</td>
				<td class='tditens dinheiro'>{$vparcela}</td>
				"; 
				if($status == 0 && 	$parcelaspagas == 0){
					$html = $html ."
					<td class='pendente'>PENDENTE</td>
					 ";
				}else if($status == 1){
					$html = $html ."
					<td class='pago'>RECEBIDO</td>
					";
				}else if($status ==0 && $parcelaspagas >0){
					$html = $html ."
					<td class='ppago'>P.RECEBIDO</td>
					";
				}
			}
			elseif($statusid == 2 && $status ==1){
				$totalareceber = $totalareceber + $valortotal;
				foreach ($requisicao as $contasreceberbaixas){
					$pago = intval($contasreceberbaixas['statusparcela']);
							if($pago > 0){
								$totalpago = $totalpago  + $contasreceberbaixas['valorparcela'];
								$parcelaspagas = $parcelaspagas+1;
		
							  }else{
								$totalpago = $totalpago + 0;
							}
				}		
				$valorpendente = $totalareceber - $totalpago;
				$valortotal = number_format($valortotal,2,",",".");
				$vparcela = number_format($vparcela,2,",",".");
				$html = $html ."

				<tr>
				<td class='tditens'>{$vencimento}</td>
				<td class='tditens'>{$lancamento}</td>
				<td class='tditens'>{$historico}</td>
				<td class='tditens'>{$parcelaspagas}/{$parcelas}</td>
				<td class='tditens dinheiro'>{$valortotal}</td>
				<td class='tditens dinheiro'>{$vparcela}</td>
				<td class='pago'>RECEBIDO</td>
				"; 
			 }elseif($statusid == 3 && $status ==0 && $parcelaspagasaux > 0){
				
				$totalareceber = $totalareceber + $valortotal;
				foreach ($requisicao as $contasreceberbaixas){
					$pago = intval($contasreceberbaixas['statusparcela']);
							if($pago > 0){
								$totalpago = $totalpago  + $contasreceberbaixas['valorparcela'];
								$parcelaspagas = $parcelaspagas+1;
		
							  }else{
								$totalpago = $totalpago + 0;
							}
				}
				$valorpendente = $totalareceber - $totalpago;
				$valortotal = number_format($valortotal,2,",",".");
				$vparcela = number_format($vparcela,2,",",".");
				$html = $html ."

				<tr>
				<td class='tditens'>{$vencimento}</td>
				<td class='tditens'>{$lancamento}</td>
				<td class='tditens'>{$historico}</td>
				<td class='tditens'>{$parcelaspagas}/{$parcelas}</td>
				<td class='tditens dinheiro'>{$valortotal}</td>
				<td class='tditens dinheiro'>{$vparcela}</td>
				<td class='ppago'>P.RECEBIDO</td>
				"; 
			}elseif($statusid == 4 && $status == 0 && $parcelaspagasaux ==0){
				$totalareceber = $totalareceber + $valortotal;
				foreach ($requisicao as $contasreceberbaixas){
					$pago = intval($contasreceberbaixas['statusparcela']);
							if($pago > 0){
								$totalpago = $totalpago  + $contasreceberbaixas['valorparcela'];
								$parcelaspagas = $parcelaspagas+1;
		
							  }else{
								$totalpago = $totalpago + 0;
							}
				}		
				$valorpendente = $totalareceber - $totalpago;
				$valortotal = number_format($valortotal,2,",",".");
				$vparcela = number_format($vparcela,2,",",".");

				$html = $html ."

				<tr>
				<td class='tditens'>{$vencimento}</td>
				<td class='tditens'>{$lancamento}</td>
				<td class='tditens'>{$historico}</td>
				<td class='tditens'>{$parcelaspagas}/{$parcelas}</td>
				<td class='tditens dinheiro'>{$valortotal}</td>
				<td class='tditens dinheiro'>{$vparcela}</td>
				<td class='pendente'>PENDENTE</td>
				"; 

			}
		}
			$totalareceber = number_format($totalareceber,2,",",".");
			$totalpago = number_format($totalpago,2,",",".");
			$valorpendente = number_format($valorpendente,2,",",".");
			$html = $html ."
			}
			


		</tr>
		</table>
		<hr size=”10″>
		<td>Total a receber (R$): </td><td class='dinheiro'>{$totalareceber}</td><br>
		<td>Total recebido (R$): </td><td class='dinheiro'>{$totalpago}</td> <br>
		<td>Total pendente (R$): </td><td class='dinheiro'>{$valorpendente}</td>
			</td>
		<hr>


	</body>
	
	</html> ";


$arquivo = "relatorio.pdf";

$mpdf = new mPDF();
$mpdf->SetDisplayMode("fullpage");
$mpdf->WriteHTML($html);

$mpdf->Output($arquivo, 'I'); 
?>	