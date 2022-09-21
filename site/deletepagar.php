<?php

    if(!empty($_GET['id']))
    {
        include_once('config.php');

        $id = $_GET['id'];

        $sqlSelect = "SELECT *  FROM contaspagar WHERE idpagar=$id";

        $result = $conexao->query($sqlSelect);

        if($result->num_rows > 0)
        {
            $sqlDelete = "DELETE FROM contaspagar WHERE idpagar=$id";
            $resultDelete = $conexao->query($sqlDelete);
        }
    }
    header('Location: lancamentospagar.php');
   
?>