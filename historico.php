<?php
session_start();

if (!isset($_SESSION['username'])) {
    ?>
    <script language="JavaScript">
    alert("Acesso restrito!");
    window.location = 'index.php';
    </script>';
    <?php   
}
else {
    if ( isset( $_GET["nome"])){
        $nome=file_get_contents("api/files/".$_GET["nome"]."/nome.txt");
        $file=file("api/files/".$_GET["nome"]."/log.txt");
      }
      else {
        ?>
      <script language="JavaScript">
      alert("Faltam parametros no GET");
      window.location = 'dashboard.php';
      </script>';
      <?php     
      }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="icon" type="image/png" href="imagens/favicon.png">
    <title>Estufas Pereira</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!--Ficheiro CSS -->
    <link rel="stylesheet" href="estilos.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-success">
        <a class="navbar-brand">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="dashboard.php">Início <span class="sr-only">(current)</span></a>
                </li>
                <?php
                if ($_SESSION['permissões']=='admin' || $_SESSION['permissões']=='mod'){
                    echo '<li class="nav-item active">
                            <a class="nav-link" href="controlo_entradas.php">Portaria <span class="sr-only">(current)</span></a>
                          </li>';
                }        
                if ($_SESSION['permissões']=='admin'){
                    echo '<li class="nav-item active">
                            <a class="nav-link" href="admin.php">Administrador <span class="sr-only">(current)</span></a>
                          </li>';
                    }
                ?>
            </ul>
        </div>
        <form method="POST" action="logout.php" class="form-inline">
            <button class="btn btn-light" type="submit">Logout</button>
        </form>
    </nav>
    <div class="jumbotron center-text">

        <img src="imagens/<?php echo $nome; ?>.png" alt="imagem">
        <h1>Página de Histórico: <?php echo $nome; ?></h1>
        <h3>10 últimos registos</h3>
    </div>
    <div class="container center-text">
        <table class="table table-striped table-hover table-bordered table-sm">

            <tbody>
                <?php 
                $numero_linhas=0;
                for ($i = max(0, count($file)-10); $i < count($file); $i++) {
                   $numero_linhas=$numero_linhas+1;
                ?>
                <tr>
                    <th scope="row"><?php echo $numero_linhas  ; ?></th>
                    <td><?php echo $file[$i] ; ?></td>
                </tr>
                <?php  
                 }
                ?>
            </tbody>
        </table>
    </div>
</body>