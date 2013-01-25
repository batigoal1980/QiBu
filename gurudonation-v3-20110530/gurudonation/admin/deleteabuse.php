<?php
	session_start();
	include_once("../includes/abuseinfo.php");
	if (!isset($_SESSION['admin192839748374865']))
	{
		?><script>window.location.href="index.php";</script><?php
	}
	removeabuse($_GET['id']);
	$_SESSION['status']="Report has been removed successfully.";
	?><script>window.location.href="reportabuse.php";</script><?php
?>