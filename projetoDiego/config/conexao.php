

<?php


$servidor = "localhost";
$usuario ="root";
$senha ="";
$banco = "bdconectar";


//$conexao = mysqli_connect($servidor, $usuario, $senha, $banco) or die ("Conexão não efetuada"); 

// Create connection
$conexao = new mysqli($servidor, $usuario, $senha, $banco);
// Check connection
if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
} 


//------------->>>AQUI O PHP FAZ A CONEXÃO COM O BANCO DE DADOS<<<----------------//

  