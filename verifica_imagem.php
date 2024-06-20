<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){ //Verifica se o metodo que foi feito é um POST
        $i=file_get_contents("api/files/webcam/valor.txt");
        $imagem=getimagesize($_FILES['imagem']["tmp_name"]); //Variavel que existe apenas para assegurar que se tratar de uma imagem a ser enviada
        if(isset($_FILES["imagem"])){ //Verifica se a variavel imagem vem vazia

            if(($_FILES["imagem"]["size"]) <= 1000000  && (exif_imagetype($imagem) == IMAGETYPE_PNG  || exif_imagetype($imagem) == IMAGETYPE_JPEG)){ 
                //Verifica se o tamanho da imagem é inferior ou igual a 1000KB
                print_r($_FILES["imagem"]["name"]);
                echo("<br>");
                print_r($_FILES["imagem"]["size"]);
                echo("<br>");
                print_r($_FILES["imagem"]["type"]);
            }else{
                echo "O tamanho da imagem tem de ser inferior a 1000KB e do tipo .png ou .jpg";
                print_r($_FILES["imagem"]["size"]);
                print_r($_FILES["imagem"]["type"]);
                unlink("img/webcam".$i.".png");
                $i=$i-1;
                file_put_contents("api/files/webcam/valor.txt", $i);
            }

        }
        else{
            echo "Ficheiro Inválido";
        }
}
else{
    echo "Método não permitido";
    http_response_code(403);
}
?>