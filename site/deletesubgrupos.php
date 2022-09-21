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
if(!empty($_GET['id'])){
  
    $id = $_GET['id'];
    $sqlSelect = "SELECT * FROM subgrupo WHERE id_subgrupo = $id";
    
    $result = $conexao->query($sqlSelect);
    if($result -> num_rows > 0){
        $sqlUpdate = "UPDATE subgrupo SET status = 0 WHERE id_subgrupo = $id";
        $resultUpdate= $conexao ->query($sqlUpdate);
        print "<script>alert('Subgrupo deletado com sucesso!');</script>";

        print "<script>location.href='visualizargrupos.php';</script>";
    


    }
   
    print "<script>alert('Erro, tente novamente!');</script>";

    print "<script>location.href='visualizargrupos.php';</script>";
}



?>
