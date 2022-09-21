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


	$result_contasapagar = "SELECT * FROM contaspagar WHERE vencimento BETWEEN $filtroinicialint AND $filtrofinalint ORDER BY idpagar DESC";
	$resultado_contasapagar = mysqli_query($conexao, $result_contasapagar);
	$contasapagar = mysqli_fetch_assoc($resultado_contasapagar);
	


	
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
    text-align:right;
  }
	table, h2{  
		font-family: 'Montserrat';
		border-collapse: collapse;
	  }  
	#trtitulo{  
		border: 1px solid black;
		background: #288BA8;
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
  .titulotabela{
    text-align:center
  }

	</style>
	</head>
	
	<body>
		<h4>Relatório contas a pagar </h4>
					<ul>
					  <li>Vencimento: {$datainicial} até {$datafinal} - Status:";
					  if($statusid == 1){
						$html = $html ."
						Todos
						";
					  }elseif($statusid == 2){
						$html = $html ."
						Pago
						";
					  }elseif($statusid == 3){
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
			    <td class='titulotabela'>Valor (R$)</td>
          <td class='titulotabela'>Status</td>
            	</tr>
			<br>";
		
				if($statusid == 1){
          $valortot = 0;
          $valorpago = 0;
          $valorpendente =0;
                        foreach($resultado_contasapagar as $row_contasapagar){
                        $vencimento = $row_contasapagar['vencimento'];
                        $vencimento = date('d/m/Y', $vencimento);
                        $lancamento = $row_contasapagar['lancamento'];
                        $lancamento = date('d/m/Y', $lancamento);
                        $historico = $row_contasapagar['historico'];
                        $valortotal = $row_contasapagar['valor'];
                        $status = $row_contasapagar['status'];
                        $id = $row_contasapagar['idpagar'];

                        if($status == 0){
                            $valorpendente =   $valorpendente + $valortotal;
                        }else if($status ==1){
                            $valorpago = $valorpago + $valortotal;
                        }
                        $valortot = $valorpago + $valorpendente;
                        $valortotal = number_format($valortotal,2,",",".");

                        $html = $html ."

                        <tr>
                        <td class='tditens'>{$vencimento}</td>
                        <td class='tditens'>{$lancamento}</td>
                        <td class='tditens'>{$historico}</td>
                        <td class='tditens dinheiro'>{$valortotal}</td>
                        ";
                        if($status == 0){
                            $html = $html ."
                            <td class='pendente'>PENDENTE</td>
                             ";
                        }else if($status == 1){
                            $html = $html ."
                            <td class='pago'>PAGO</td>
                            ";
                        }
                    }
					
				}elseif($statusid == 2){
          $valortot = 0;
          $valorpago = 0;
          $valorpendente =0;
                    foreach($resultado_contasapagar as $row_contasapagar){
                        $vencimento = $row_contasapagar['vencimento'];
                        $vencimento = date('d/m/Y', $vencimento);
                        $lancamento = $row_contasapagar['lancamento'];
                        $lancamento = date('d/m/Y', $lancamento);
                        $historico = $row_contasapagar['historico'];
                        $valortotal = $row_contasapagar['valor'];
                        $status = $row_contasapagar['status'];
                        $id = $row_contasapagar['idpagar'];
                        if($status == 1){
                            $valorpendente = 0;
                            $valorpago = $valorpago + $valortotal;
                            $valortot = $valorpago + $valorpendente;
                            $valortotal = number_format($valortotal,2,",",".");


                            $html = $html ."
                            <tr>
                            <td class='tditens'>{$vencimento}</td>
                            <td class='tditens'>{$lancamento}</td>
                            <td class='tditens'>{$historico}</td>
                            <td class='tditens dinheiro'>{$valortotal}</td>
                            <td class='pago'>PAGO</td>
                            </tr>

                            ";
                        }
                    }

                 }elseif($statusid == 3){
                  $valortot = 0;
                  $valorpago = 0;
                  $valorpendente =0;
                    foreach($resultado_contasapagar as $row_contasapagar){
                        $vencimento = $row_contasapagar['vencimento'];
                        $vencimento = date('d/m/Y', $vencimento);
                        $lancamento = $row_contasapagar['lancamento'];
                        $lancamento = date('d/m/Y', $lancamento);
                        $historico = $row_contasapagar['historico'];
                        $valortotal = $row_contasapagar['valor'];
                        $status = $row_contasapagar['status'];
                        $id = $row_contasapagar['idpagar'];
                        if($status == 0){
                            $valorpago = 0;
                            $valorpendente =   $valorpendente + $valortotal;
                            $valortot = $valorpago + $valorpendente;
                            $valortotal = number_format($valortotal,2,",",".");


                            $html = $html ."
                            <tr>
                            <td class='tditens'>{$vencimento}</td>
                            <td class='tditens'>{$lancamento}</td>
                            <td class='tditens'>{$historico}</td>
                            <td class='tditens dinheiro'>{$valortotal}</td>
                            <td class='pendente'>PENDENTE</td>
                            </tr>
                            ";
                        }
                    }
                }
                $valortot = number_format($valortot,2,",",".");
                $valorpago = number_format($valorpago,2,",",".");
                $valorpendente = number_format($valorpendente,2,",",".");
                $html = $html ."
            }



		</table>
		<hr size=”10″>
 

		<td>Valor total (R$):</td><td class='dinheiro'>{$valortot}</td><br>
		<td>Valor pago (R$):</td><td class='dinheiro'>{$valorpago}</td> <br>
		<td>Valor pendente (R$):</td><td class='dinheiro'>{$valorpendente}</td> 
		<hr>


	</body>
	
	</html> ";


$arquivo = "relatorio.pdf";

$mpdf = new mPDF();
$mpdf->SetDisplayMode("fullpage");
$mpdf->WriteHTML($html);

$mpdf->Output($arquivo, 'I'); 
?>	