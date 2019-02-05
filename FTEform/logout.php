<?php
	session_start();
	$_SESSION["idm"];
	$id = '';
	session_unset();
	session_destroy();
    header('Location: /FTEform/index.html');
?>