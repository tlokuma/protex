<?php
    session_start();
    //print_r($_SESSION);
    if((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true )){
        unset( $_SESSION['usuario']);
        unset( $_SESSION['senha']);
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

    $sql = "SELECT * FROM contaspagar WHERE vencimento BETWEEN $filtroinicialint AND $filtrofinalint ORDER BY idpagar DESC";

    $requisicao = $conexao->query($sql);

    if(isset($_POST['submit'])){

      $filtroinicial = $_POST['filtrartabelainicial'];
      $filtroinicialint = strtotime($filtroinicial);
      $filtrofinal = $_POST['filtrartabelafinal'];
      $filtrofinalint = strtotime($filtrofinal);
      $sql = "SELECT * FROM contaspagar WHERE vencimento BETWEEN $filtroinicialint AND $filtrofinalint ORDER BY idpagar DESC";
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
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">

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
          <a class="nav-link" href="index.php">P??gina Inicial <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Novo Lan??amento
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="contasapagar.php">Contas a Pagar</a>
            <a class="dropdown-item" href="contasareceber.php">Contas a Receber</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Gerenciar Lan??amentos
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
            Relat??rios
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
                        text: "Bem vindo ao sistema PROTEX, voc?? esta no GERENCIAR LAN??AMENTO DO CONTAS A PAGAR, onde voc?? pode gerenciar os seus lan??amentos do contas a pagar (editar, excluir, dar baixa). Atrav??s da barra de navega????o situada na parte superior do site, voc?? pode realizar lan??amentos, gerenciar os seus lan??amentos, dar baixas (na se????o de gerenciar) cadastrar e gerenciar os seus grupos. Al??m disso sempre que quiser voltar para a p??gina inicial voc?? pode clicar em P??gina Inicial ou em PROTEX!",
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK',
                      })
                    });                 
  </script>

  <div class= "containerlan??amentos">
      <div class="titulolancamentos">
        <p><b>Contas a Pagar - Gerenciar Lan??amentos</b></p>
      </div>
  </div>

  <div class="filtrodata">
    <form action="lancamentospagar.php" method="POST">
    <div class="textofiltrar">
       <p>
        Mostrando registros com vencimento entre <b> <?php
          $mostraintervalo = date('d/m/Y',$filtroinicialint);
          echo $mostraintervalo;
        ?> </b>
        e<b> <?php
          $mostraintervalofuturo = date('d/m/Y',$filtrofinalint);
          echo $mostraintervalofuturo;
        ?></b>

       </p>
    </div>
    <div class="textofiltrar">
      <p>
        Filtrar pelo vencimento
      </p>
    </div>
    <div class="form-row">
    <div class="form-group col-md-12">
            <label for="vencimentopagar">Come??ando em</label>
            <input type="date" class="form-control" id="filtrartabelainicial" name="filtrartabelainicial" required>
    </div>
    <div class="form-group col-md-12">
            <label for="vencimentopagar">Terminando em</label>
            <input type="date" class="form-control" id="filtrartabelafinal" name="filtrartabelafinal" required>
    </div>
    </div>
    <div class="form-group col-md-12">
    <button type="submit" name="submit" id="submit" class="btncentro btn btn-secondary">Filtrar</button>
    </div>
    </form>
  </div>


  <div class="tabelalancamentos">
<table id="tabela_receber" class="table-light table-striped">
          <thead>
            <tr>
              <!-- <th>ID</th> -->
              <th>Cliente</th>
              <th>Lan??amento</th>
              <th>Grupo</th>
              <th>Subgrupo</th>
              <th>Vencimento</th>
              <th>Hist??rico</th>
              <th>Hit??rico Longo</th>
              <th>Valor</th>
              <th>Status</th>
              <th>...</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($requisicao as $contaspagar){ ?>
            <tr>
              <!-- <td><?php //echo $contasreceber['idreceber'] ?></td> -->
              <td><?php echo $contaspagar['credor'] ?></td>
              <td><?php
                                          $mostralancamentoaux = $contaspagar['lancamento'];
                                          $mostralancamento = date('d/m/Y', $mostralancamentoaux);
                                          echo $mostralancamento;
              ?></td>
              <td><?php echo $contaspagar['grupo'] ?></td>
              <td><?php echo $contaspagar['subgrupo'] ?></td>
              <td><?php
                      $mostravencimentoaux = $contaspagar['vencimento'];
                      $mostravencimento = date('d/m/Y', $mostravencimentoaux);
                      echo $mostravencimento;
              ?></td>
              <td><?php echo $contaspagar['historico'] ?></td>
              <td><?php echo $contaspagar['historicolongo'] ?></td>
              <td><?php echo $contaspagar['valor'] ?></td>
              <td><?php 
                    $pago = intval($contaspagar['status']);
                    if($pago > 0){
                        echo "<b class=pago>PAGO</b>";
                    }else{
                        echo "<b class=pendente>PENDENTE</b>";
                    }
                 ?></td>
              <td>
                  <a class='btn btn-sm btn-danger botaoexcluir deletar' href='deletepagar.php?id=<?php echo $contaspagar['idpagar']?>'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor'
                      class='bi bi-trash' viewBox='0 0 16 16'>
                      <path
                        d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z' />
                      <path fill-rule='evenodd'
                        d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z' />
                    </svg>
                  </a>
                  <script>
                       $(".deletar" ).click(function(e) {
                        e.preventDefault();
                        var self = $(this);
                        console.log(self.data('title'));
                        Swal.fire({
                        title: 'Voce tem certeza que deseja deletar esse item?',
                        text: "N??o ser?? poss??vel reverter a a????o!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Deletar',
                        cancelButtonText: 'Cancelar'
                      }).then((result) => {
                        if (result.isConfirmed) {
                         
                          location.href = self.attr('href');
                        }
                      })
                    });                 
                    </script>
                <a class='status btn btn-sm btn-warning botaobaixas' href='processabaixapagar.php?id=<?php echo $contaspagar['idpagar']?>'>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                  <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
                </svg>
                </a>
                <script>
                $(".status" ).click(function(e) {
                        e.preventDefault();
                        var self = $(this);
                        console.log(self.data('title'));
                        Swal.fire({
                        title: 'Tem certeza que deseja mudar o status da parcela?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sim',
                        cancelButtonText: 'N??o'
                      }).then((result) => {
                        if (result.isConfirmed) {
                         
                          location.href = self.attr('href');
                        }
                      })
                    });                 
                </script>
                <?php if($pago == 0){?>  
              <a class='btn btn-sm btn-primary botaoeditar' href='editpagar.php?id=<?php echo $contaspagar['idpagar']?>'>
                  <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor'
                    class='bi bi-pencil-square' viewBox='0 0 16 16'>
                    <path
                      d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z' />
                    <path fill-rule='evenodd'
                      d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z' />
                  </svg>
                  </a>
                  <?php }?>
                </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
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

  <script>
    $(document).ready(function () {
      $('#tabela_receber').DataTable({
        "language": {
          "lengthMenu": "Mostrando _MENU_ registros por p??gina",
          "zeroRecords": "N??o foram encontrados resultados",
          "info": "P??gina _PAGE_ de _PAGES_",
          "infoEmpty": "Nenhum registro encontrado",
          "infoFiltered": "(filtrando de _MAX_ registros no total)",
          "search": "Procurar:",
          "processing": "A processar...",
          "emptyTable": "Sem dados dispon??veis",
          "paginate": {
            "first": "Primeiro",
            "last": "??ltimo",
            "next": "Seguinte",
            "previous": "Anterior"
          }
        }
      });
    });
  </script>

</body>

</html>
