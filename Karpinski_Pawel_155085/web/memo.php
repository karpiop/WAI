<?php
	session_start();
	unset($_SESSION['galeria']);
	if(!empty($_POST['check_list'])) {
		foreach($_POST['check_list'] as $check) {
				$_SESSION['galeria'][$check]=true;
		}
	}
	header("Location: index.php"); 
	
?>