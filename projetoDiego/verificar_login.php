<?php

include_once 'config/conexao.php';

session_start();

$usuario=$_POST['usuario'];
$senha=$_POST['senha'];

$resultado = $conexao->query("SELECT * FROM usuario WHERE usuario='$usuario' AND senha='$senha'");

if (mysqli_num_rows($resultado) > 0){
 
	while($dados= $resultado->fetch_array()){
		$nome = $dados['nome'];  
	}

	$_SESSION ['nome'] = $nome;
	$_SESSION['acesso'] = "true";
	header('location:controle.php');
  
} else {
    
	unset($_SESSION['nome']);
    unset($_SESSION['acesso']);
    header('location:erro_login.html');
}

?>
//------------------------------------->>>REGIAO DE LOGIN(SÓ ACESSA USUARIOS CADASTRADOS NO BANCO DE DADOS)<<<-----///

 