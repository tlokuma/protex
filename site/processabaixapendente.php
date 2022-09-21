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
        $idparcela = $_GET['idparcela'];
        $sqlUpdate = "UPDATE contasreceberparcelas SET statusparcela='0' WHERE idcontasreceberparcelas='$idparcela'";

        $result = $conexao->query($sqlUpdate);

        $sqlUpdatestatus = "UPDATE contasreceber SET status='0' WHERE idreceber='$id'";
        $resultupdatestatus = $conexao->query($sqlUpdatestatus);

        header("Location: baixasreceber.php?id=$id");
    
    }else{
        header("Location: lancamentosreceber.php");
    }

    ?>