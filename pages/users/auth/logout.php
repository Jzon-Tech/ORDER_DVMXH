<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

	session_start();
	session_destroy();
	header("Location: /auth/login");
	exit;
?>