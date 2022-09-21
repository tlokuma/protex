<?php

    include_once('config.php');

    for ($i=0; $i<$numparcelas; $i++){

        $resultparcela =  mysqli_query($conexao, "INSERT INTO contasreceberparcelas(cliente, valorparcela, vencimentoparcela, historico)
        VALUES ('$cliente','$valorparcela','$vencimento','$historico')");
        date_modify($vencimento,"+1 month");
  
      }
?>