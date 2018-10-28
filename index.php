<?php
	require("functions/filter.php");
	if(!isset($_GET['route'])){
		$_GET['route'] = "";
	}
	session_start();
	switch (filter($_GET['route'])) {
		case '':
			require("view/a_login.php");
			break;
		case 'login':
			require("view/a_login.php");
			break;
		// case 'dashboard':
		// 	require("view/a_dashboard.php");
		// 	break;
		case 'apartment':
			require("view/a_apartment.php");
			break;
		// case 'rooms':
		// 	require("view/a_rooms.php");
		// 	break;
		case 'roomstable':
			require("view/a_roomstable.php");
			break;
		case 'applicants':
			require("view/a_applicants.php");
			break;
		case 'tenants':
			require("view/a_tenants.php");
			break;
		case 'payments':
			require("view/a_payments.php");
			break;
		case 'trequests':
			require("view/a_trequests.php");
			break;
		case 'crequests':
			require("view/a_crequests.php");
			break;
		case 'complaints':
			require("view/a_complaints.php");
			break;
		case 'tncs':
			require("view/a_tncs.php");
			break;
		// case 'utilitybills':
		// 	require("view/a_utilitybills.php");
		// 	break;
		// case 'notifications':
		// 	require("view/a_notifications.php");
		// 	break;
		case 'bill_type':
			require("view/a_bill_type.php");
			break;
		case 'register':
			require("view/a_register.php");
			break;
		case 'logout':
			require("view/logout.php");
			break;
		default:
			require("view/a_error404.php");
			break;
	}
?>