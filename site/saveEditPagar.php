<?php 
    include_once('config.php');
    
    if(isset($_POST['update']))
    {
        $id = $_POST['id'];
        $grupo = $_POST['grupopagar'];
        $subgrupo = $_POST['subgrupopagar'];
        $vencimento = $_POST['vencimentopagar'];
        $vencimentointeiro = strtotime($vencimento);
        $historico = $_POST['historicopagar'];
        $historicolongo = $_POST['historicolongopagar'];
        $valor = $_POST['valorpagar'];
        $credor = $_POST['credorpagar'];

        $sqlUpdate = "UPDATE contaspagar SET grupo='$grupo', subgrupo='$subgrupo', vencimento='$vencimentointeiro', historico='$historico',historicolongo='$historicolongo', valor='$valor', credor='$credor'
        WHERE idpagar='$id'";

        $result = $conexao->query($sqlUpdate);
        print_r($historico);
    }

  header('Location: lancamentospagar.php');
    
?> 