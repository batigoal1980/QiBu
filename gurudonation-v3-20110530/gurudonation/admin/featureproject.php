<?php
	session_start();
	if (!isset($_SESSION['admin192839748374865']))
	{
		?><script>window.location.href = 'loginadmin.php';</script><?php
	}
	include_once("../includes/kapipalinfo.php");
	setkapipaldetail($_GET['id'],"featured",$_GET['feature']);
	?><script>window.location.href="projectlisting.php?search=n&featured=1"</script><?php
?>