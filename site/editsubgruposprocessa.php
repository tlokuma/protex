<!DOCTYPE html>
<html lang="en">
<head>
<script src="js/jquery.js"></script>
<script src="sweetalert/sweetalert2.all.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript">


</script>
</head>
<body>
    
</body>
</html>
<?php 
 session_start();
include_once("config.php");
if(isset($_POST['update'])){
    $idgrupoantigo = $_POST['idgrupoantigo']; // id do grupo antigo
    $novogrupo = $_POST['idgrupo']; //id do novo grupo escolhido

    $idsubgrupo = $_POST['id']; // id do subgrupo


    $novosubgrupo = $_POST['novosubgrupo']; // nome do novo subgrupo

  

    $sqlUpdate = "UPDATE subgrupo  SET nome = '$novosubgrupo' WHERE id_subgrupo = '$idsubgrupo'";
    $result = $conexao->query($sqlUpdate);

    $sqlUpdate2 = "UPDATE subgrupo  SET id_grupo = '$novogrupo' WHERE id_grupo = '$idgrupoantigo' AND id_subgrupo ='$idsubgrupo'";
    $result2 = $conexao->query($sqlUpdate2);

    print_r($idgrupoantigo);
    print_r($novogrupo);

    header('Location: visualizargrupos.php'); 
}



?>
