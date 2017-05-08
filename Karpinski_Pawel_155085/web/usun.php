<?php
	session_start();
	if(!empty($_POST['check_list'])) {
		foreach($_POST['check_list'] as $check) {
				unset($_SESSION['galeria'][$check]);
		}
	}
	header("Location: index.php"); 
	
?>