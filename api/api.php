<?php
    header('Content-Type: text/html; charset=utf-8');
	if($_SERVER['REQUEST_METHOD'] == "POST") {
	    print_r($_POST);
		file_put_contents("files/".$_POST["nome"]."/valor.txt",$_POST["valor"]);
		file_put_contents("files/".$_POST["nome"]."/hora.txt",$_POST["hora"]);
		isset ( $nome,$valor,$hora );
		if ($_POST["nome"]=="porta"){
			if ($_POST["valor"]=="1"){
				file_put_contents("files/".$_POST["nome"]."/log.txt","Data: ".$_POST["hora"]." Valor:Aberta".PHP_EOL,FILE_APPEND);
			}
			else{
				file_put_contents("files/".$_POST["nome"]."/log.txt","Data: ".$_POST["hora"]." Valor:Fechada".PHP_EOL,FILE_APPEND);
			}
		}
		elseif ($_POST["nome"]=="alarme" || $_POST["nome"]=="speaker" || $_POST["nome"]=="sprinkler"){
			if ($_POST["valor"]=="1"){
				file_put_contents("files/".$_POST["nome"]."/log.txt","Data: ".$_POST["hora"]." Valor:Ativado".PHP_EOL,FILE_APPEND);
			}
			else{
				file_put_contents("files/".$_POST["nome"]."/log.txt","Data: ".$_POST["hora"]." Valor:Desativado".PHP_EOL,FILE_APPEND);
			}
		}
		else {
			file_put_contents("files/".$_POST["nome"]."/log.txt","Data: ".$_POST["hora"]." Valor:".$_POST["valor"].PHP_EOL,FILE_APPEND);
		}
			
		
	}
	
	else {
		if($_SERVER['REQUEST_METHOD'] == "GET") {
			if ( isset( $_GET["nome"]) ){
				echo file_get_contents("files/".$_GET["nome"]."/valor.txt");
			}
			else {
				echo "faltam parametros no GET";
			}
		}
		else {
			echo "metodo nao permitido";
		}
	}
  
  ?>
  
