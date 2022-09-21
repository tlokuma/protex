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

    if(!empty($_GET['id']))
    {
        
        $id = $_GET['id'];

        $sqlSelect = "SELECT status FROM contaspagar WHERE idpagar='$id'";

        $select = $conexao->query($sqlSelect);

        foreach($select as $atribui){
            $status= $atribui['status'];
        }
        if($status>0){
            $sqlUpdate = "UPDATE contaspagar SET status='0' WHERE idpagar='$id'";

            $result = $conexao->query($sqlUpdate);

            header("Location: lancamentospagar.php?id=$id");
        }else{

            $sqlUpdate = "UPDATE contaspagar SET status='1' WHERE idpagar='$id'";

            $result = $conexao->query($sqlUpdate);
            header("Location: lancamentospagar.php?id=$id");

        }

    
    }else{
        header("Location: lancamentospagar.php");
    }

    ?>