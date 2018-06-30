<?php

require_once("config/conexao.php");

/* @var $_GET type */
$temperatura = $_POST['temperatura'];
$umidade = $_POST['umidade'];
$ph = $_POST['ph'];
$salinidade = $_POST['salinidade'];
$luminosidade = $_POST['luminosidade'];
$idEstacao = $_POST['idEstacao'];

//$mysqli_select_db = mysqli_select_db($conexao, "bdconectar");
$sql = "INSERT INTO tabelasensores( temperatura, umidade, ph, salinidade, luminosidade, idEstacao) VALUES ('$temperatura','$umidade','$ph','$salinidade','$luminosidade','$idEstacao')";

if ($conexao->query($sql) === TRUE) {
    echo "Salvo com sucesso!";
} else {
    echo "Error: " . $sql . "<br>" . $conexao->error;
}

$conexao->close();

?>

//------------------->>>AQUI VAI SER RECEBIDO OS DADOS DO ARDUINO E SALVO NO BANCO DE DADOS<<<--------------///



