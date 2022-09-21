<?php

    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'protexbanco';

    $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
/*
    if($conexao->connect_errno)
    {
       echo "Erro";
    }
else
    {
        echo "Conexao Efetuada Com Sucesso";
    }
*/
function formatoData ($data){
	$array = explode("-", $data);
	// $data = 2016-04-14
	// $array[0] = 2016, $array[1] = 04 e $array[2] = 14;
	$novaData = $array[2]."/".$array["1"]."/".$array[0];
	return $novaData;
}
?>