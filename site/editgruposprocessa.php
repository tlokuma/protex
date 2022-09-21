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
    $id = $_POST['idgrupo'];
    $novonome = $_POST['novogrupo'];

  

    $sqlUpdate = "UPDATE grupo SET nome = '$novonome' WHERE id_grupo = '$id'";
    $result = $conexao->query($sqlUpdate);

 

    header('Location: visualizargrupos.php'); 
}



?>
