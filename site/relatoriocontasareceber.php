<?php

      session_start();
      if ((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true))
      {
          unset($_SESSION['login']);
          unset($_SESSION['senha']);
          header('Location: login.php');
      }
      $logado = $_SESSION['login'];

      include_once ('config.php');

      date_default_timezone_set('America/Sao_Paulo');
      $lancamento = date('d-m-Y');
      $lancamentoint = strtotime($lancamento);
      $intervalo = $lancamentoint - 5184000;
      $filtroinicialint = $intervalo;
      $filtrofinalint = $intervalo +7776000;
  
      $sql = "SELECT * FROM contasreceber WHERE vencimento BETWEEN $filtroinicialint AND $filtrofinalint ORDER BY idreceber DESC";
  
      $requisicao = $conexao->query($sql);
  
      if(isset($_POST['submit'])){
  
        $filtroinicial = $_POST['filtrartabelainicial'];
        $filtroinicialint = strtotime($filtroinicial);
        $filtrofinal = $_POST['filtrartabelafinal'];
        $filtrofinalint = strtotime($filtrofinal);
        $sql = "SELECT * FROM contasreceber WHERE vencimento BETWEEN $filtroinicialint AND $filtrofinalint ORDER BY idreceber DESC";
        $requisicao = $conexao->query($sql);
      }
      
  
  
?>

<!doctype html>
<html lang="pt-br">

<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

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
                        text: "Bem vindo ao sistema PROTEX, você esta no RELATÓRIOS do contas a receber, onde você pode filtrar seus relatórios através de intervalo de datas e status. Através da barra de navegação situada na parte superior do site, você pode realizar lançamentos, gerenciar os seus lançamentos, dar baixas (na seção de gerenciar) cadastrar e gerenciar os seus grupos. Além disso sempre que quiser voltar para a página inicial você pode clicar em Página Inicial ou em PROTEX!",
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK',
                      })
                    });                 
  </script>

  <div class= "containerlançamentos">
      <div class="titulolancamentos">
        <p><b>Contas a Receber - Relatórios</b></p>
      </div>
  </div>

  <div class="filtrodata">
    <form action="pdfreceber.php" target="_blank" method="POST">
    <div class="textofiltrar">
      <p>
        Filtrar pelo vencimento
      </p>
    </div>
    <div class="form-row">
    <div class="form-group col-md-12">
            <label for="vencimentopagar">Começando em</label>
            <input type="date" class="form-control" id="filtrartabelainicial" name="filtrartabelainicial" required>
    </div>
    <div class="form-group col-md-12">
            <label for="vencimentopagar">Terminando em</label>
            <input type="date" class="form-control" id="filtrartabelafinal" name="filtrartabelafinal" required>
    </div>
    </div>
    <label for="selectgrupo">Status</label>
        <select  name="statusid" id="statusid" class="form-control" required>
                <option value="1">Todos</option>
                <option value="2">Recebido</option>
                <option value="3">Parcialmente Recebido</option>
                <option value="4">Pendente</option>
              </select>
    <div class="form-group col-md-12 gerar">
    <button type="submit" name="submit" id="submit" class="btncentro btn btn-secondary">Gerar Relatório</button>

    </div>
    </form>
    
    </div>
  </div>

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
