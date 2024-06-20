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

//Sensores
//Sensor Luminosidade
$valor_luminosidade = file_get_contents("api/files/luminosidade/valor.txt");
$hora_luminosidade = file_get_contents("api/files/luminosidade/hora.txt");
$nome_luminosidade = file_get_contents("api/files/luminosidade/nome.txt");

if ($valor_luminosidade=="Dia"){
  $img_luminosidade="imagens/dia.png";
  $valor_luminosidade="Dia";
}
else {
  $img_luminosidade="imagens/noite.png";
  $valor_luminosidade="Noite";
}


//Sensor Temperatura
$valor_temperatura = file_get_contents("api/files/temperatura/valor.txt");
$hora_temperatura = file_get_contents("api/files/temperatura/hora.txt");
$nome_temperatura = file_get_contents("api/files/temperatura/nome.txt");

//Sensor Humidade

$valor_humidade = file_get_contents("api/files/humidade/valor.txt");
$hora_humidade = file_get_contents("api/files/humidade/hora.txt");
$nome_humidade = file_get_contents("api/files/humidade/nome.txt");

//Sensor Fumo

$valor_fumo = file_get_contents("api/files/fumo/valor.txt");
$hora_fumo = file_get_contents("api/files/fumo/hora.txt");
$nome_fumo = file_get_contents("api/files/fumo/nome.txt");

//Sensor Água

$valor_agua = file_get_contents("api/files/agua/valor.txt");
$hora_agua = file_get_contents("api/files/agua/hora.txt");
$nome_agua = file_get_contents("api/files/agua/nome.txt");

//Atuadores
//Alarme

$valor_alarme = file_get_contents("api/files/alarme/valor.txt");
$hora_alarme = file_get_contents("api/files/alarme/hora.txt");
$nome_alarme = file_get_contents("api/files/alarme/nome.txt");

//Speaker
$valor_speaker = file_get_contents("api/files/speaker/valor.txt");
$hora_speaker = file_get_contents("api/files/speaker/hora.txt");
$nome_speaker = file_get_contents("api/files/speaker/nome.txt");

//Regadores
$valor_regadores = file_get_contents("api/files/regadores/valor.txt");
$hora_regadores = file_get_contents("api/files/regadores/hora.txt");
$nome_regadores = file_get_contents("api/files/regadores/nome.txt");

if ($valor_regadores=="1"){
    $valor_regadores_string="Ligados";
  }
else {
    $valor_regadores_string="Desligados";
}

//Sprinkler
$valor_sprinkler = file_get_contents("api/files/sprinkler/valor.txt");
$hora_sprinkler = file_get_contents("api/files/sprinkler/hora.txt");
$nome_sprinkler = file_get_contents("api/files/sprinkler/nome.txt");

if ($valor_sprinkler=="1" && $valor_alarme=="1" && $valor_speaker=="1"){
    $valor_string="Ativado";
  }
else {
    $valor_string="Desativado";
}

//Porta

$valor_porta = file_get_contents("api/files/porta/valor.txt");
$hora_porta = file_get_contents("api/files/porta/hora.txt");
$nome_porta = file_get_contents("api/files/porta/nome.txt");

if ($valor_porta=="1"){
  $valor_porta_string="Aberta";
}
else {
  $valor_porta_string="Fechada";
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
                    <a class="nav-link" href="#">Início <span class="sr-only">(current)</span></a>
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
        <p>Painel de visualização dos dispositivos IoT das Estufas Pereira</p>

    </div>


    <div class="container center-text">
        <h1>Destaques</h1>
        <div class="row div-margin">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <?php echo $nome_luminosidade ?>:
                        <?php echo $valor_luminosidade; ?></div>
                    <div class="card-body"><img src="<?php echo $img_luminosidade; ?>" alt="luminosidade" /></div>
                    <div class="card-footer"><?php echo $hora_luminosidade; ?><a href="historico.php?nome=luminosidade">
                            Histórico</a></div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header"><?php echo $nome_temperatura; ?>: <?php echo $valor_temperatura; ?>º</div>
                    <div class="card-body"><img src="imagens/temperatura.png" alt="temperatura" /></div>
                    <div class="card-footer"><?php echo $hora_temperatura; ?><a href="historico.php?nome=temperatura">
                            Histórico</a></div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header"><?php echo $nome_humidade; ?>: <?php echo $valor_humidade; ?>%</div>
                    <div class="card-body"><img src="imagens/humidade.png" alt="humidade" /></div>
                    <div class="card-footer"><?php echo $hora_humidade; ?><a href="historico.php?nome=humidade">
                            Histórico</a></div>
                </div>
            </div>
        </div>
        <div class="row div-margin">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header"><?php echo $nome_regadores; ?>: <?php echo $valor_regadores_string; ?></div>
                    <div class="card-body"><img src="imagens/regadores.png" alt="regadores" /></div>
                    <div class="card-footer"><?php echo $hora_regadores; ?><a href="historico.php?nome=regadores">
                            Histórico</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header"><?php echo $nome_alarme; ?>: <?php echo $valor_string; ?></div>
                    <div class="card-body"><img src="imagens/alarme.png" alt="alarme" /></div>
                    <div class="card-footer"><?php echo $hora_alarme; ?><a href="historico.php?nome=alarme">
                            Histórico</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header"><?php echo $nome_porta; ?>: <?php echo $valor_porta_string; ?></div>
                    <div class="card-body"><img src="imagens/porta.png" alt="porta" /></div>
                    <div class="card-footer"><?php echo $hora_porta; ?><a href="historico.php?nome=porta"> Histórico</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="card div-margin">
            <div class="card-header">Tabela de Sensores</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Tipo de Dipositivo IoT</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Data de Atualização</th>
                            <th scope="col">Histórico</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"><?php echo $nome_luminosidade; ?></th>
                            <td><?php echo $valor_luminosidade; ?></td>
                            <td><?php echo $hora_luminosidade; ?></td>
                            <td><span><a href="historico.php?nome=luminosidade"> Histórico</a></span></td>
                        </tr>
                        <tr>
                            <th scope="row"><?php echo $nome_temperatura; ?></th>
                            <td><?php echo $valor_temperatura; ?>º</td>
                            <td><?php echo $hora_temperatura; ?></td>
                            <td><span><a href="historico.php?nome=temperatura"> Histórico</a></span></td>
                        </tr>
                        <tr>
                            <th scope="row"><?php echo $nome_humidade; ?></th>
                            <td><?php echo $valor_humidade; ?>%</td>
                            <td><?php echo $hora_humidade; ?></td>
                            <td><span><a href="historico.php?nome=humidade"> Histórico</a></span></td>
                        </tr>
                        <tr>
                            <th scope="row"><?php echo $nome_agua; ?></th>
                            <td><?php echo $valor_agua; ?>cm</td>
                            <td><?php echo $hora_agua; ?></td>
                            <td><span><a href="historico.php?nome=agua"> Histórico</a></span></td>
                        </tr>
                        <tr>
                            <th scope="row"><?php echo $nome_fumo; ?></th>
                            <td><?php echo $valor_fumo; ?> %</td>
                            <td><?php echo $hora_fumo; ?></td>
                            <td><span><a href="historico.php?nome=fumo"> Histórico</a></span></td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>

        <div class="card div-margin">
            <div class="card-header">Tabela dos Atuadores</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Tipo de Dipositivo IoT</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Data de Atualização</th>
                            <th scope="col">Histórico</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"><?php echo $nome_alarme; ?></th>
                            <td><?php echo $valor_string; ?></td>
                            <td><?php echo $hora_alarme; ?></td>
                            <td><span><a href="historico.php?nome=alarme"> Histórico</a></span></td>
                        </tr>
                        <tr>
                            <th scope="row"><?php echo $nome_regadores; ?></th>
                            <td><?php echo $valor_regadores_string; ?></td>
                            <td><?php echo $hora_regadores; ?></td>
                            <td><span><a href="historico.php?nome=regadores"> Histórico</a></span></td>
                        </tr>
                        <tr>
                            <th scope="row"><?php echo $nome_speaker; ?></th>
                            <td><?php echo $valor_string; ?></td>
                            <td><?php echo $hora_speaker; ?></td>
                            <td><span><a href="historico.php?nome=speaker"> Histórico</a></span></td>
                        </tr>
                        <tr>
                            <th scope="row"><?php echo $nome_sprinkler; ?></th>
                            <td><?php echo $valor_string; ?></td>
                            <td><?php echo $hora_sprinkler; ?></td>
                            <td><span><a href="historico.php?nome=sprinkler"> Histórico</a></span></td>
                        </tr>
                        <tr>
                            <th scope="row"><?php echo $nome_porta; ?></th>
                            <td><?php echo $valor_porta_string; ?></td>
                            <td><?php echo $hora_porta; ?></td>
                            <td><span><a href="historico.php?nome=porta"> Histórico</a></td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
</body>

</html>