<?php 
session_start();
if(!isset($_SESSION ['login'])){                              // Não houve login ainda
	unset($_SESSION ['nao_autenticado']);
	unset($_SESSION ['mensagem_header'] ); 
	unset($_SESSION ['mensagem'] ); 
	header('location: /app-web-frontend/login.html');    // Vai para a página inicial
	exit();
}
?>