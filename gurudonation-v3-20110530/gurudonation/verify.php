<?php
	session_start();
	include_once("includes/userinfo.php");
	include_once("includes/kapipalinfo.php");
	if (!isset($_GET['key']))
	{
		?><script>window.location.href="index.php";</script><?php
	}else if ($_GET['key']==""){
		?><script>window.location.href="index.php";</script><?php
	}else if (!userexistbykey($_GET['key'])){
		?><script>window.location.href="index.php";</script><?php
	}else{
		$id=keytoid($_GET['key']);
		setactivation($id,"y");
		$_SESSION['kapipalist12878498g94j93gj9458']=$id;
		$kapipalid=kapipalidbyusername($id);
		
		echo "<script>window.location.href=\"project.php?id=".$kapipalid."\";</script>";
	}
?>