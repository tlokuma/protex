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
$subgrupo = filter_input(INPUT_POST,'novogrupo', FILTER_SANITIZE_STRING);
$grupo =  $_POST['grupoprinc'];
// echo "Grupo: $grupo <br>"; 
$result_subgrupo = "INSERT INTO subgrupo(nome,id_grupo) VALUES ('$subgrupo','$grupo')";
$resultado_subgrupo = mysqli_query($conexao ,$result_subgrupo);

if(mysqli_insert_id($conexao)){
    print "<script>alert('Subgrupo criado com sucesso!');</script>";
  
    print "<script>location.href='subgrupos.php';</script>";



}else{
    print "<script>alert('Erro! Um grupo deve ser selecionado!');</script>";
    print "<script>location.href='subgrupos.php';</script>";


}

?>
