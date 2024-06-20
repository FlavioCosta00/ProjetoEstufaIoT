<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['permissões']!='admin') {
  ?>
    <script language="JavaScript">
    alert("Acesso restrito!");
    window.location = 'index.php';
    </script>';
    <?php   
}

$valor_regador= file_get_contents("api/files/regadores/valor.txt");

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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />
 
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-success">
    <a class="navbar-brand" >Dashboard</a>
    <button class="navbar-toggler"  type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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

    <h1>Servidor IoT Estufas Pereira</h1>
    <p>Painel de administração IoT das Estufas Pereira</p>
    
  </div>
  <div class="container center-text">
    <table class="table table-bordered center-text">
        <thead>
            <tr class="bg-success">
                <th scope="col">Ação</th> 
                <th scope="col">Atualmente</th>
            </tr>
        </thead>
        <tbody>
  <?php
echo "<tr>";
if($valor_regador == 1){ //Caso o valor da ponte seja 1 o botão apresenta uma mensagem diferente bem como o estado
  echo "<td><button onclick = \"location.href = './atualizar_valor.php?valor=regadores'\"class='btn btn btn-danger'>Desligar Regadores</button></td>"; //Redirecionação para uma pagina apenas com codigo php para alterar o valor do mesma
    echo "<td>Regadores Ligados</td>";
}elseif($valor_regador == 0){ //Caso o valor da ponte seja 0 o botão apresenta uma mensagem diferente bem como o estado
  echo "<td><button onclick = \"location.href = './atualizar_valor.php?valor=regadores'\"class='btn btn btn-success'>Ligar Regadores</button></td>"; //Redirecionação para uma pagina apenas com codigo php para alterar o valor do mesma
  echo "<td>Regadores Desligados</td>";
}
echo "</tr>";

?>
        </tbody>
    </table>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
  </script>
</body>

</html>