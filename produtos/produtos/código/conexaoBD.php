<?php
  $bdhost = "localhost";
  $bdusuario = "root";
  $bdsenha = "";
  $baseDados = "sicoe";

  // Cria a conex�o
  //mySQLi, ORIENTADA A OBJETOS
  $conn = new mysqli($bdhost, $bdusuario, $bdsenha, $baseDados);
  $conn->set_charset('utf8');
  // Verifica conex�o
  if ($conn->connect_error) {
    die("Conex�o ao MySQL falhou: " . $conn->connect_error);	
  }
  
?>
