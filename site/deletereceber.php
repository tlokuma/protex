<?php

    if(!empty($_GET['id']))
    {
        include_once('config.php');
        

        $id = $_GET['id'];

        $selectverificapago = "SELECT statusparcela FROM contasreceberparcelas WHERE idreceber='$id'";

        $pagoounao = $conexao->query($selectverificapago);
        $verificado = 0;
        while ($user_data = mysqli_fetch_assoc($pagoounao))
        {
        
        $status = $user_data['statusparcela'];
        if ($status>0){
            $verificado = 1;
        }
        }
        if ($verificado == 0){
        $sqlSelect = "SELECT *  FROM contasreceber WHERE idreceber=$id";

        $result = $conexao->query($sqlSelect);

        if($result->num_rows > 0)
        {
            $sqlDelete = "DELETE FROM contasreceber WHERE idreceber=$id";
            $resultDelete = $conexao->query($sqlDelete);
        }
        header('Location: lancamentosreceber.php');
     }
    }
    header('Location: lancamentosreceber.php');
   
?>
