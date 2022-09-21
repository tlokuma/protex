<?php
session_start();
//print_r($_SESSION);
if ((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true))
{
    unset($_SESSION['login']);
    unset($_SESSION['senha']);
    header('Location: login.php');
}
$logado = $_SESSION['login'];

date_default_timezone_set('America/Sao_Paulo');
$lancamento = date('d-m-Y');
$lancamentoint = strtotime($lancamento);

include_once ('config.php');
if (isset($_POST['submit']))
{

  $data = $lancamentoint;
  $grupo = $_POST['gruporeceber'];
  $subgrupo = $_POST['subgruporeceber'];
  $vencimento = $_POST['vencimentoreceber'];
  $vencimentointeiro = strtotime($vencimento) + 2592000;
  $vencimentodatainput = date('Y-m-01', $vencimentointeiro);
  $vencimentointeiroexato = strtotime($vencimento);
  $vencimentodata = date('d-m-Y', $vencimentointeiro);
    //  print_r($vencimentodata);
    // die;
    $historico = $_POST['historicoreceber'];
    $historicolongo = $_POST['historicolongoreceber'];
    $valor = $_POST['valorreceber'];
    $numparcelas = $_POST['numparcelasreceber'];
    $cliente = $_POST['clientereceber'];
    if ($numparcelas > 0)
    {
        $valorparcela = $valor / $numparcelas;
        $valorparcela = number_format($valorparcela, 2, '.', '');
        $valorparcela = floatval($valorparcela);
    }
    else
    {
        header('Location: contasareceber.php');
    }

    $result = mysqli_query($conexao, "INSERT INTO contasreceber(lancamento,grupo,subgrupo,vencimento,historico,historicolongo,valor,numparcelas,valorparcela,cliente)
    VALUES ('$data','$grupo','$subgrupo','$vencimentointeiroexato','$historico','$historicolongo','$valor','$numparcelas','$valorparcela','$cliente')");

    $selectidreceber = "SELECT MAX(idreceber) AS id_recente FROM contasreceber";

    $idreceber = $conexao->query($selectidreceber);

    foreach($idreceber as $testando){

     $idreceberestrangeiro = $testando['id_recente'];

    }

    for ($i = 1;$i <= $numparcelas;$i++)
    {

      $resultparcela = mysqli_query($conexao, "INSERT INTO contasreceberparcelas(numeroparcela,cliente, valorparcela, vencimentoparcela, historico, idreceber)
      VALUES ('$i','$cliente','$valorparcela','$vencimentointeiroexato','$historico','$idreceberestrangeiro')");

      $vencimentointeiroaux3 = $vencimentointeiroexato;

      $datanova = date('Y-m-01', $vencimentointeiroaux3);

      $dataprimeirodia = strtotime($datanova);

      $vencimentoparcelaprimeirodia = $dataprimeirodia + 2765000;

      $vencimentoparcelaprimeirodiadata = date('Y-m-01',$vencimentoparcelaprimeirodia);

      $vencimentointeiroexato = strtotime($vencimentoparcelaprimeirodiadata);

      // echo $vencimentoparcelaprimeirodiadata;
      // echo "///";
      // echo $vencimentointeiroexato;
      // echo "///";
      // $vencimentoparcela = date('d-m-Y', $vencimentoparcela);

      // print_r($vencimentoparcela);
      // die;


    }
    $selectidprimeiraparcela = "SELECT MIN(idcontasreceberparcelas) AS idprimeiraparcela FROM contasreceberparcelas WHERE idreceber=$idreceberestrangeiro";
    $resultselectidprimeiraparcela = $conexao->query($selectidprimeiraparcela);

    foreach($resultselectidprimeiraparcela as $iddaparcela){
      $idparcela = $iddaparcela['idprimeiraparcela'];
    }

    $selectverificadizima = "SELECT * FROM contasreceberparcelas WHERE idreceber='$idreceberestrangeiro'";
    $verificadizima = $conexao->query($selectverificadizima);
    $somandoparcelas = 0;

    foreach($verificadizima as $verificando){
      $somandoparcelas = $somandoparcelas + $verificando['valorparcela'];
    }
    // echo $somandoparcelas;
    // echo "-";
    // echo $valor;
    // die;
    $valorsomadodepois=0;
    if($somandoparcelas < $valor){
      $diferenca = $valor - $somandoparcelas;
      $valorprimeiraparcela = $valorparcela + $diferenca;
      // var_dump( $valorprimeiraparcela);
      // echo "-";
      // echo $idparcela;
      $valorprimeiraparcela = number_format($valorprimeiraparcela, 2, '.', '');
      $valorprimeiraparcela = floatval($valorprimeiraparcela);

      // echo $valorsomadodepois;
      // die;

      $sqlUpdate = "UPDATE contasreceberparcelas SET valorparcela='$valorprimeiraparcela'
      WHERE idcontasreceberparcelas='$idparcela'";
      $result = $conexao->query($sqlUpdate);
      // var_dump($result);
      // die;
    }
    if($somandoparcelas> $valor){
      $diferenca = $valor - $somandoparcelas;
      $diferenca = abs($diferenca);
      $diferenca = number_format($diferenca, 2, '.', '');
      $diferenca = floatval($diferenca);
      $valorprimeiraparcela = $valorparcela - $diferenca;

      $sqlUpdate = "UPDATE contasreceberparcelas SET valorparcela='$valorprimeiraparcela'
      WHERE idcontasreceberparcelas='$idparcela'";
      $result = $conexao->query($sqlUpdate);
    }

}

$sql = "SELECT * FROM contasreceber ORDER BY idreceber DESC";

$requisicao = $conexao->query($sql);

?>

<!doctype html>
<html lang="pt-br">

<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="sweetalert/jquery-3.6.0.min.js"></script>
<script src="js/jquery.mask.js"></script>
<script src="js/jquery.maskMoney.min.js"></script>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">

  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

</head>

<body class="bg-cinza">
<script src="sweetalert/jquery-3.6.0.min.js"></script>
<script src="sweetalert/sweetalert2.all.min"></script>

<nav class="navbar navbar-expand-md navbar-dark bgprotex">
    <a class="navbar-brand" href="#">PROTEX</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Página Inicial <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Novo Lançamento
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="contasapagar.php">Contas a Pagar</a>
            <a class="dropdown-item" href="contasareceber.php">Contas a Receber</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Gerenciar Lançamentos
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="lancamentospagar.php">Contas a Pagar</a>
            <a class="dropdown-item" href="lancamentosreceber.php">Contas a Receber</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Grupos
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="grupos.php">Novo Grupo</a>
            <a class="dropdown-item" href="subgrupos.php">Novo Subgrupo</a>
            <a class="dropdown-item" href="visualizargrupos.php">Gerenciar Grupos/Subgrupos</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Relatórios
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="relatoriocontasapagar.php">Contas a Pagar</a>
            <a class="dropdown-item" href="relatoriocontasareceber.php">Contas a Receber</a>
          </div>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="sair.php">Sair</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class=botaohelp>
  <a class='btn btn-sm btn-info help' href='#'>
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-lg" viewBox="0 0 16 16">
<path fill-rule="evenodd" d="M4.475 5.458c-.284 0-.514-.237-.47-.517C4.28 3.24 5.576 2 7.825 2c2.25 0 3.767 1.36 3.767 3.215 0 1.344-.665 2.288-1.79 2.973-1.1.659-1.414 1.118-1.414 2.01v.03a.5.5 0 0 1-.5.5h-.77a.5.5 0 0 1-.5-.495l-.003-.2c-.043-1.221.477-2.001 1.645-2.712 1.03-.632 1.397-1.135 1.397-2.028 0-.979-.758-1.698-1.926-1.698-1.009 0-1.71.529-1.938 1.402-.066.254-.278.461-.54.461h-.777ZM7.496 14c.622 0 1.095-.474 1.095-1.09 0-.618-.473-1.092-1.095-1.092-.606 0-1.087.474-1.087 1.091S6.89 14 7.496 14Z"/>
</svg>
</a>
</div>
<script>  
                       $(".help" ).click(function(e) {
                        e.preventDefault();
                        var self = $(this);
                        console.log(self.data('title'));
                        Swal.fire({
                        title: 'Menu de Ajuda',
                        text: "Bem vindo ao sistema PROTEX, você esta no CONTAS A RECEBER , através da barra de navegação situada na parte superior do site, você pode realizar lançamentos, gerenciar os seus lançamentos, dar baixas (na seção de gerenciar) cadastrar e gerenciar os seus grupos. Além disso sempre que quiser voltar para a página inicial você pode clicar em Página Inicial ou em PROTEX!",
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK',
                      })
                    });                 
  </script>



    <div class="formpagar">
    <form action="contasareceber.php" method="POST">
          <div class = "titulolancamento"><p><b>Novo Lançamento - Contas a Receber</b></p></div>
          <div class="form-group">
            <label for="clientereceber">Nome do Cliente</label>
            <input type="text" class="form-control" maxlength="45" id="clientereber" name="clientereceber" placeholder="Nome do Cliente" required>
          </div>
          <div class="form-row">
          <div class="form-group col-md-6">
              <label for="gruporeceber">Grupo</label>
              <select id="gruporeceber" name="gruporeceber" class="form-control" required>
              <?php
              
              $result_grupos = "SELECT * FROM grupo";
              $resultado_grupos = mysqli_query($conexao, $result_grupos);
              $result = mysqli_fetch_assoc($resultado_grupos);
              if($result != 0){
                foreach($resultado_grupos as $resug ){?>
               

                  <option><?php
                  
                   echo $resug['nome']; ?>
                  
                    </option> <?php 
                    
                  }
              }else{ ?>
                <option>Nenhum grupo existente</option><?php

              }
             ?>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="subgruporeceber">Subgrupo</label>
              <select id="subgruporeceber" name="subgruporeceber" class="form-control" required>
              <?php
            
              
            $result_subgrupos = "SELECT * FROM subgrupo";
            $resultado_subgrupos = mysqli_query($conexao, $result_subgrupos);
            $result = mysqli_fetch_assoc($resultado_subgrupos);
            if($result != 0){
              foreach($resultado_subgrupos as $resug ){?>
             

                <option><?php
                
                 echo $resug['nome']; ?>
                
                  </option> <?php 
                  
                }
            }else{ ?>
              <option>Nenhum subgrupo existente</option><?php

            }
           ?>
              </select>
            </div>
          </div>
          <div class = "form-row">
          <div class="form-group col-md-2">
            <label for="vencimentoreceber">Vencimento da 1ª Parcela</label>
            <input type="date" class="form-control" id="vencimentoreceber" name="vencimentoreceber" placeholder="" required>
          </div>
          <div class="form-group col-md-2">
            <label for="valorrceber">Valor (R$)</label>
            <input type="number" min ="1"  step="0.01"  oninput="validity.valid||(value='');" class="form-control mascara" id="valorreceber" name="valorreceber" placeholder="" required>
          </div>
      
          <div class="form-group col-md-2">
            <label for="numparcelasreceber">Número de Parcelas</label>
            <input type="number" min="1"  oninput="validity.valid||(value='');" class="form-control" id="numparcelasreceber" name="numparcelasreceber" placeholder="" required>
          </div>
          <div class="form-group col-md-6">
            <label for="historicoreceber">Histórico</label>
            <input type="text" class="form-control" maxlength="20" id="historicoreceber" name="historicoreceber" placeholder="Digite o Histórico" required>
          </div>
          </div>
          <div class="form-group">
          <label for="historicolongoreceber">Histórico Longo</label>
          <input type="text" class="form-control" maxlength="100" id="historicolongoreceber" name="historicolongoreceber" placeholder="Digite o Histórico Longo">
          </div>
          <button type="submit" name="submit" id="submit" class="btn btn-success">Gravar</button>
    </form>
    </div> 
    <script>
            $(".caracteres").on("input", function(){
              var regexp = /[^a-zA-Z]/g;
              if(this.value.match(regexp)){
                $(this).val(this.value.replace(regexp,''));
              }
            })            
          </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
  </script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

  </body>
</html>