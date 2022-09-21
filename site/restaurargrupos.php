<?php
    session_start();
    //print_r($_SESSION);
    if((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true )){
        unset( $_SESSION['login']);
        unset( $_SESSION['senha']);
        header('Location: login.php');
    }
    $logado = $_SESSION['login'];

    include_once('config.php');
    $aux = 0;
    // $sql = "SELECT grp.nome, grp.id_grupo, sub.id_grupo, sub.nome FROM grupo grp 
    // LEFT JOIN subgrupo AS sub ON sub.id_grupo=grp.id_grupo ORDER BY sub.id_grupo DESC";

    // $requisicao = $conexao->query($sql);
    // var_dump($requisicao);
 
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

  <a class='btn btn-sm btn-info help botaohelp' href='#'>
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-lg" viewBox="0 0 16 16">
<path fill-rule="evenodd" d="M4.475 5.458c-.284 0-.514-.237-.47-.517C4.28 3.24 5.576 2 7.825 2c2.25 0 3.767 1.36 3.767 3.215 0 1.344-.665 2.288-1.79 2.973-1.1.659-1.414 1.118-1.414 2.01v.03a.5.5 0 0 1-.5.5h-.77a.5.5 0 0 1-.5-.495l-.003-.2c-.043-1.221.477-2.001 1.645-2.712 1.03-.632 1.397-1.135 1.397-2.028 0-.979-.758-1.698-1.926-1.698-1.009 0-1.71.529-1.938 1.402-.066.254-.278.461-.54.461h-.777ZM7.496 14c.622 0 1.095-.474 1.095-1.09 0-.618-.473-1.092-1.095-1.092-.606 0-1.087.474-1.087 1.091S6.89 14 7.496 14Z"/>
</svg>
</a>
<script>  
                       $(".help" ).click(function(e) {
                        e.preventDefault();
                        var self = $(this);
                        console.log(self.data('title'));
                        Swal.fire({
                        title: 'Menu de Ajuda',
                        text: "Bem vindo ao sistema PROTEX, você esta no GERENCIAR GRUPOS/SUBGRUPOS, onde você pode visualizar e gerenicar um grupo ou subgrupo previamente cadastrado. Através da barra de navegação situada na parte superior do site, você pode realizar lançamentos, gerenciar os seus lançamentos, dar baixas (na seção de gerenciar) cadastrar e gerenciar os seus grupos. Além disso sempre que quiser voltar para a página inicial você pode clicar em Página Inicial ou em PROTEX!",
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK',
                      })
                    });                 
  </script>

  <div class=gruposcadastradostitulo><b><p>Grupos Ocultados</p></b></div>
  <div class=gruposcadastrados>
  <?php
             $result_grupos = "SELECT * FROM grupo";
             $resultado_grupos = mysqli_query($conexao, $result_grupos);
             $grupos = mysqli_fetch_assoc($resultado_grupos);
        
              foreach($resultado_grupos as $row_grupo){             ?>

                <div class = grupos> 
                  <?php 
                  if($row_grupo['status'] == 0){
                  $id_grupo = $row_grupo['id_grupo'];
                  $result_subgrupos = "SELECT nome, id_subgrupo  FROM subgrupo WHERE id_grupo ='$id_grupo'";
                  $resultado_subgrupos = mysqli_query($conexao, $result_subgrupos);
                  $result = mysqli_fetch_assoc($resultado_subgrupos);
                
               echo "<class='grupos'><b>{$row_grupo['nome']}</b><br>";
                echo "<td>
                   <a class='botaoeditgrupos btn btn-sm btn-primary botaoeditargrupo' href='editgrupos.php?id=$row_grupo[id_grupo]' >
                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                     <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                       <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                   </svg>
                   <a class='botaodeletegrupos deletar btn btn-sm btn-danger botaoexcluirgrupo' href='deletegrupos.php?id=$row_grupo[id_grupo]''data-confirm ='Tem certeza que deseja excluir o item selecionado?'>
                   <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-slash' viewBox='0 0 16 16'>
                   <path d='M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z'/>
                   <path d='M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z'/>
                   <path d='M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z'/>
                 </svg>
                   </a>
                 </td> ";
                 echo "<tr>";
                    
                  }?> <script>
                  $(".botaodeletegrupos" ).click(function(e) {
                   e.preventDefault();
                   var self = $(this);
                   console.log(self.data('title'));
                   Swal.fire({
                   title: 'Voce tem certeza que deseja ocultar esse grupo?',
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
               </script> </div> 
                <?php
               ?><script>
              $(".ocultarsubgrupo" ).click(function(e) {
               e.preventDefault();
               var self = $(this);
               console.log(self.data('title'));
               Swal.fire({
               title: 'Voce tem certeza que deseja ocultar esse subgrupo?',
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
            
              <br/>
              <br/>
              <?php
            }
          ?>

            
            
        </div>
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
  </script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

</body>
</html>