<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){ //Verifica se o metodo que foi feito é um POST
    $i=file_get_contents("api/files/webcam/valor.txt");
    if ($i==0){
        $i=1;
    }
    }
        $imagem=getimagesize($_FILES['imagem']["tmp_name"]); //Variavel que existe apenas para assegurar que se tratar de uma imagem a ser enviada
        if(isset($_FILES["imagem"]) && ($imagem != false)){ //Verifica se a variavel imagem vem vazia e se a variavel que server apenas para verificar se é uma imagem é diferente de false 
            
            if(($_FILES["imagem"]["size"]) <= 1000000){ //Verifica se o tamanho da imagem é inferior ou igual a 1000KB
            print_r($_FILES["imagem"]["name"]);
            printf("<br>");
            print_r($_FILES["imagem"]["size"]);
            echo("<br>");
            print_r($_FILES["imagem"]["type"]);
            move_uploaded_file($_FILES["imagem"]['tmp_name'], "img/webcam".$i.".png"); //move a imagem que foi uplodada para a pasta das imagens, a que o parametro das funcionalidades vai buscar
            }else{
                echo "O tamanho da imagem tem de ser inferior a 1000KB e do tipo .png ou .jpg";
                print_r($_FILES["imagem"]["size"]);
                print_r($_FILES["imagem"]["type"]);

            }
        }else{
            echo "Ficheiro Inválido";
        }
    
}else{

    echo "Método não permitido";
    http_response_code(403);
}
?>