<?php
session_start();

if(!isset($_SESSION['acesso'])){
  header('location:index.html');
} else {

  include("config/conexao.php");


// busca tadas as estações no banco
$consulta ="SELECT *  FROM  estacao";
$resulEstacoes = $conexao->query($consulta);


  ?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!--Da compatibilidade a internet...-->
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!--adapta a telas de dspositivos menores
   --> 
    <title>Controle</title>

    
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/><!--Chama o bootstrap-->
    <script src="Chart.min.js"></script>

  </head>
  <body>

<div class="container">
  <center><p align="justify" ><h1>Bem Vindo <?php echo $_SESSION ['nome']; ?></h1></p></center>
  <br><br>

  <div class="row">
    <div class="col-sm-12">
      <form class="form-horizontal" method="post">
            <div class="form-group">
              <div class="col-sm-3">
                <select class="form-control" name="estacoes">
                <option value="0">Selecione uma estação</option>
                  <?php
                  // options com o nome das estações e o valor ID de cada uma
                    while($rowEstacoes = $resulEstacoes->fetch_assoc()) 
                    {
                      echo '<option value='.$rowEstacoes["id"].'>'.utf8_encode($rowEstacoes["nome"]).'</option>';
                    }
                  ?>
                </select>
              </div>
              <div class=" col-sm-2">
                <button type="submit" class="btn btn-primary" name="consultar">Consultar</button>
              </div>
            </div>
      </form>
    </div>
  </div>

  <?php
    if (isset($_POST["consultar"])) {

      //Consultando os sensores da estação selecionada
      $selectEstacao = $_POST["estacoes"];
      $consulta ="SELECT *  FROM  tabelasensores WHERE idEstacao = $selectEstacao";
      $resultado = $conexao->query($consulta);
      
  ?>

  <div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered table-striped table-hover">
          <caption><h1>Tabela</h1></caption>
          <thead>  
            <tr>
              <th>ID</th><th>Data</th><th>Temperatura</th><th>Umidade</th><th>PH</th><th>Salinidade</th><th>luminosidade</th>
            </tr>       
          </thead>

          <tbody>
        
            <?php
            // Imprimindo as linhas da tabela, com os dados vindo do banco
             if ($resultado->num_rows > 0) {
                 while($row = $resultado->fetch_assoc()) {
                  echo '
                    <tr>
                      <td>'.$row["id"].'</td><td>'.$row["evento"].'</td><td>'.$row["temperatura"].'</td><td>'.$row["umidade"].'</td><td>'.$row["ph"].'</td><td>'.$row["salinidade"].'</td><td>'.$row["luminosidade"].'</td>
                    </tr>';                       
                 }
              }    
            ?>
            </tbody>
        </table>

        <!-- tag para plotar gráficos -->
        <canvas class="line-chart"></canvas>

        <script src="Chart.min.js"></script>

        <script type="text/javascript">

          // variável de contexto
          var ctx = document.getElementsByClassName("line-chart");
          
          // arrays para armazenar dados vindo do banco
          var arrayTempo        = new Array();
          var arrayTemperatura  = new Array();
          var arrayUmidade      = new Array();
          var arrayPh           = new Array();
          var arraySalinidade   = new Array();
          var arrayLuminosidade = new Array();


          <?php
            $resultado = $conexao->query($consulta);



            if ($resultado->num_rows > 0) {
                while($row = $resultado->fetch_assoc()) {

                  //preenchendo arrays com dados do banco
                  echo 'arrayTempo.push("'.$row["evento"].'");';
                  echo 'arrayTemperatura.push("'.$row["temperatura"].'");';
                  echo 'arrayUmidade.push("'.$row["umidade"].'");';
                  echo 'arrayPh.push("'.$row["ph"].'");';
                  echo 'arraySalinidade.push("'.$row["salinidade"].'");';
                  echo 'arrayLuminosidade.push("'.$row["luminosidade"].'");';
               
               }
            }

            // consulta para capturar o nome da estação selecionada
            $consultar ="SELECT *  FROM  estacao WHERE id = $selectEstacao";
            $resulEstacao = $conexao->query($consultar);

            if ($resulEstacao->num_rows > 0) {

                while($rowNomeEst = $resulEstacao->fetch_assoc()) {
                  // setando variável com o nome da estação selecionada
                  echo 'var nomeEstacao = "'.utf8_encode($rowNomeEst["nome"]).'";';

               }
            }  
          ?>

          // Definindo linhas do gráfico
          var chartGraph = new Chart(ctx, {
            type: 'line',
            data: {
              labels: arrayTempo,
              datasets: [
                {
                  label: "Temperatura",
                  data: arrayTemperatura,
                  borderwidth: 2,
                  borderColor: 'rgba(77,166,253,0.85)',
                  backgroundColor: 'transparent',
                },
                {
                  label: "Umidade",
                  data: arrayUmidade,
                  borderwidth: 2,
                  borderColor: 'rgba(215, 38, 44, 0.9)',
                  backgroundColor: 'transparent',
                },
                {
                  label: "PH",
                  data: arrayPh,
                  borderwidth: 2,
                  borderColor: 'rgba(85, 223, 0, 0.9)',
                  backgroundColor: 'transparent',
                },
                {
                  label: "Salinidade",
                  data: arraySalinidade,
                  borderwidth: 2,
                  borderColor: 'rgba(221, 17, 255, 0.9)',
                  backgroundColor: 'transparent',
                },
                {
                  label: "Luminosidade",
                  data: arrayLuminosidade,
                  borderwidth: 2,
                  borderColor: 'rgba(221, 134, 89, 0.9)',
                  backgroundColor: 'transparent',
                }
              ]
            },
            options: {
              title: {
                display: true,
                fontSize: 20,
                text: nomeEstacao
              },
              labels: {
                fontStyle: "bold"
              }
            }
            
          });
        </script>
    </div>
  </div>
  <br><br><br><br>
</div>


</body>
</html>

<?php
  }
}
?>