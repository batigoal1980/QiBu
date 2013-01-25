<?php
	session_start();
	include("../includes/userinfo.php");
		
	$id=$_GET['user_id'];
	if (!removeuser($id))
	{
		$_SESSION['status']="Cannot remove user! Error has occured!";
	}else{
		$_SESSION['status']="User has removed successfully.";
	}
	?><script> window.location.href="manageusers.php";</script><?php
?>