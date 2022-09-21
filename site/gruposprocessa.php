<?php 
 session_start();
include_once("config.php");

$grupo = filter_input(INPUT_POST,'novogrupo', FILTER_SANITIZE_STRING);
// echo "Grupo: $grupo <br>"; 
$result_grupo = "INSERT INTO grupo(nome) VALUES ('$grupo')";
$resultado_grupo = mysqli_query($conexao ,$result_grupo);

if(mysqli_insert_id($conexao)){
    print "<script>alert('Grupo criado com sucesso!');</script>";

    print "<script>location.href='grupos.php';</script>";



}else{
    print "<script>alert('Erro! Tente novamente!');</script>";
    print "<script>location.href='grupos.php';</script>";


}


?>
