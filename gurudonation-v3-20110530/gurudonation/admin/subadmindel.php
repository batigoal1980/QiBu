<?php
	session_start();
	include("../includes/admininfo.php");
			
	if (isset($_GET['id']))
	{
		$id=$_GET['id'];

		if (deladmin($id))
			$_SESSION['status']="SubAdmin removed successfully";
		else
			$_SESSION['status']="Cannot remove subadmin!";
	}
	?><script>window.location.href="subadmin.php";</script><?php
?>