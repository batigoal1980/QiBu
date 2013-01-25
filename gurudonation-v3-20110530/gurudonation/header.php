<?php

	session_start();

	include_once("includes/config.php");

	include_once("includes/func.php");

	include_once("includes/resetinfo.php");

	include_once("includes/userinfo.php");

	include_once("includes/kapipalinfo.php");

	include_once("includes/contributioninfo.php");

	include_once("includes/withdrawalinfo.php");

	include_once("includes/cateinfo.php");

	include_once("captcha/captcha.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

	<title><?php echo siteinfo("sitetitle");?></title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <meta http-equiv="Cache-Control" content="no-cache"/>

    <link href="style.css" rel="stylesheet" type="text/css">

	<link href="guru.css" rel="stylesheet" type="text/css">

    <link rel="Shortcut Icon" type="image/ico" href="favicon.ico"/>

    <meta name="author" content="<?php echo siteinfo("siteauthor");?>" />

	<meta name="copyright" content="<?php echo siteinfo("copyright");?>" />

	<meta name="description" content="<?php echo siteinfo("sitedesc");?>" />

	<link rel="image_src" href="images/image_src.gif"></link>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript" charset="utf-8"></script>    

	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js" type="text/javascript"></script>

</head>

<body>
<div id="body">
	<div id="header">

		<div id="head_top">

			<div id="logo"><a href="index.php"></a></div><!--end logo-->

            <?php if (!isset($_SESSION['kapipalist12878498g94j93gj9458'])){ ?>

			<div id="menu" style="left:120px; position:relative;">

            <?php }else{ ?>

            <div id="menu">

            <?php } ?>

			<ul>

				<li><a href="new.php">START A PROJECT</a></li>

				<li><a href="learn-more.php">HOW IT WORKS</a></li>

				<li><a href="manifesto.php">READ MANUAL</a></li>

                <?php if (isset($_SESSION['kapipalist12878498g94j93gj9458'])){ ?>

                <li><a href="myaccount.php">MY ACCOUNT</a></li>

				<li><a href="logout.php">LOGOUT</a></li>

                <?php }else{ ?>

				<li><a href="login.php">LOGIN</a></li>

				<?php } ?>

			</ul>

		</div><!--end menu-->

	</div><!--end head_top-->

