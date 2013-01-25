<?php
	session_start();
	include_once("../includes/cateinfo.php");
	if (!isset($_SESSION['admin192839748374865']))
	{
		?><script>window.location.href="index.php";</script><?php
	}
	removecate($_GET['id']);
	$_SESSION['status']="Category has been removed successfully.";
	?><script>window.location.href="managecategories.php";</script><?php
?>