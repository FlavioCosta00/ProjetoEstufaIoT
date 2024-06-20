<?php
        session_start();
        $username = array("Flavio","Simao");
        $password = array("projeto","projeto");
        $utilizadores = array
        (
            array("Flavio", "projeto", "admin"),
            array("Simao", "projeto", "mod"),
            array("User", "user", "user")
        );
        $n= 3; //Número de Utlizadores
        if (isset($_POST['username']) && isset($_POST['password'])){
            for ($i=0; $i<$n; $i++) {
                if ($_POST['username'] == $utilizadores[$i][0] && $_POST['password'] == $utilizadores[$i][1]) {
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['permissões']=$utilizadores[$i][2];
                    header('Location: dashboard.php');
                }
                else {
                    ?>
                    <script language="JavaScript">
                    alert("Credenciais Erradas");
                    window.location = 'index.php';
                    </script>';
                    <?php
                }
            }
        }
     
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="icon" type="image/png" href="imagens/favicon.png">
    <title>Estufas Pereira</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Ficheiro CSS -->
    <link rel="stylesheet" href="estilos.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>

<body>

    <div class="login">
        <div class="banner-login">
            <img src="imagens/logo.png" alt="logotipo">
        </div>
        <div class="login-form">
            <div class="login-form-wrapper">
                <h1>Painel de Login</h1>

                <form method="POST">

                    <div class="mb-3">
                        <label>Utilizador</label>
                        <input type="text" class="form-control" name="username"
                            placeholder="Insira o seu Nome de Utilizador" required>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Insira a sua Password"
                            required>
                    </div>
                    <button type="submit" class="btn">Login</button>
                </form>


            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
</body>

</html>

