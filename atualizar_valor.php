<?php
session_start();

if (!isset($_SESSION['username'])){ //Verifica se a variavel de sessão do username vem vazia, para não conseguirem aceder ao website sem darem login 
	header('refresh:5;url=index.php'); //Caso o cargo sjea igual a user não deixa aceder ao painel de admins e são redirecionados para o index
die( "<h3>Acesso restrito.</h3> <title>Acesso Restrito</title>");
}

//Declaração de variaveis

$valor_regadores = file_get_contents("api/files/regadores/valor.txt");
date_default_timezone_set('Europe/Lisbon');#Define o fuso-horário para a zona de Portugal
$log_regadores = date('Y-m-d H:i');#Vai buscar a data corrente e a hora

if($valor_regadores == 1){ //Se o valor dos regadores for 1 muda para 0
		file_put_contents("api/files/regadores/valor.txt", 0);
		file_put_contents("api/files/regadores/log.txt","Data:".$log_regadores." Valor:Desligados".PHP_EOL,FILE_APPEND);
}
elseif($valor_regadores == 0){ //Se o valor dos regadores for 0 muda para 1
    file_put_contents("api/files/regadores/valor.txt", 1);
	file_put_contents("api/files/regadores/log.txt","Data:".$log_regadores." Valor:Ligados".PHP_EOL,FILE_APPEND);
        
	}	
else{
    http_response_code(400);
    echo "<a style= \"color: white\">Faltam parâmetros no GET</a>";
}
	header("Location: admin.php");
?>