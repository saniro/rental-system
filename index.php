<?php
	require("functions/filter.php");
	if(!isset($_GET['route'])){
		$_GET['route'] = "";
	}
	switch (filter($_GET['route'])) {
		case '':
			require("view/a_login.php");
			break;
		case 'login':
			require("view/a_login.php");
			break;
		case 'dashboard':
			require("view/a_dashboard.php");
			break;
		case 'bill_type':
			require("view/a_bill_type.php");
			break;
		case 'register':
			require("view/a_register.php");
			break;
		default:
			echo '<br>'.$_GET['route'];
			break;
	}
?>