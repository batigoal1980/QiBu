<?php
	session_start();
	include("../includes/contributioninfo.php");
		
	$id=$_GET['id'];
	if (!removecontribution($id))
	{
		$_SESSION['status']="Cannot remove contribution! Error has occured!";
	}else{
		$_SESSION['status']="Contribution has removed successfully.";
	}
	?><script> window.location.href="managecontribute.php";</script><?php
?>