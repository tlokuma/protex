<?php 
    include_once('config.php');
    
    if(isset($_POST['update']))
    {
        $id = $_POST['id'];
        $grupo = $_POST['gruporeceber'];
        $subgrupo = $_POST['subgruporeceber'];
        $vencimento = $_POST['vencimentoreceber'];
        $vencimentointeiro = strtotime($vencimento);
        $historico = $_POST['historicoreceber'];
        $historicolongo = $_POST['historicolongoreceber'];
        $valor = $_POST['valorreceber'];
        $numparcelas = $_POST['numparcelasreceber'];
        $valorparcela = $valor / $numparcelas;
        $valorparcela = number_format($valorparcela, 2, '.', '');
        $valorparcela = floatval($valorparcela);
        $cliente = $_POST['clientereceber'];

        // echo $valor;

                $sqlSelectverifica = "SELECT * FROM contasreceber WHERE idreceber=$id;";
                    
                $resultselectverifica = $conexao->query($sqlSelectverifica);

                if($resultselectverifica -> num_rows > 0)
                {
                    while($user_data = mysqli_fetch_assoc($resultselectverifica))
                    {

                    $valorbanco = $user_data['valor'];
                    $numparcelasbanco = $user_data['numparcelas'];
                    $vencimentobanco = $user_data['vencimento'];
                    // echo $valorbanco;
                    // echo $numparcelasbanco;

                    }
                }
                else{
                    header('Loocation: lancamentosreceber.php');
                }

                $sqlUpdate = "UPDATE contasreceber SET grupo='$grupo', subgrupo='$subgrupo', vencimento='$vencimentointeiro', historico='$historico',historicolongo='$historicolongo', valor='$valor', valorparcela='$valorparcela', numparcelas='$numparcelas', cliente='$cliente'
                WHERE idreceber='$id'";
                $result = $conexao->query($sqlUpdate);

        if($valorbanco != $valor || $numparcelasbanco != $numparcelas || $vencimentobanco != $vencimentointeiro ){

          $sqlselectexcluir = "SELECT * FROM contasreceberparcelas WHERE idreceber=$id";

          $resultadoselectexcluir = $conexao->query($sqlselectexcluir);
  
          if($resultadoselectexcluir->num_rows > 0)
          {
              $sqlDelete = "DELETE  FROM contasreceberparcelas WHERE idreceber=$id";
              $resultDelete = $conexao->query($sqlDelete);
          }

          for ($i = 1;$i <= $numparcelas;$i++)
          {
      
              $resultparcela = mysqli_query($conexao, "INSERT INTO contasreceberparcelas(numeroparcela,cliente, valorparcela, vencimentoparcela, historico, idreceber)
            VALUES ('$i','$cliente','$valorparcela','$vencimentointeiro','$historico','$id')");
      
              $vencimentointeiroaux3 = $vencimentointeiro;

              $vencimentointeiro = $vencimentointeiroaux3 + 2592000;
      
          }

        }
        

    }

  header('Location: lancamentosreceber.php');
    
?> 