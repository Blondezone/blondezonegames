<?php
//verifica se a sessão foi iniciada. Remove ou destroi a sessao 
	if(!isset($_SESSION))
	{
		session_start();
		session_unset(); 
		session_destroy(); 
	}
	unset($_SESSION["id"]);
	unset($_SESSION["adm"]);
	header("location:../views/index.php");
	die();
?>