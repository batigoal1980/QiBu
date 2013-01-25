<?php
	session_start();
	include_once("../includes/func.php");
	include_once("../includes/userinfo.php");
	include_once("../includes/kapipalinfo.php");
	include_once("../includes/withdrawalinfo.php");
	include_once("../includes/admininfo.php");
	include_once("../includes/withdrawalinfo.php");
	include_once("../includes/contributioninfo.php");
	include_once("../includes/abuseinfo.php");
	include_once("../includes/cateinfo.php");
	if (!isset($_SESSION['admin192839748374865']))
	{
		?><script>window.location.href = 'loginadmin.php';</script><?php
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo siteinfo("sitetitle");?></title>
	<meta name="title" content="<?php echo siteinfo("sitetitle");?>">
	<meta name="description" content="<?php echo siteinfo("sitedesc");?>">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF8">
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<script language="javascript" src="js/validate.js"></script>
	<script language="javascript" src="js/functions.js"></script>
    <script language="javascript" src="js/jquery.js"></script>
	<script language="javascript" src="js/dropdowntab.js"></script>
	<link rel="stylesheet" href="css/heavybox.css" />
	<script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/heavybox.js"></script>
	<script type="text/javascript" src="js/ed.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript" charset="utf-8"></script>    
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js" type="text/javascript"></script>
</head>

<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="180"><img src="../img/logo.png" /></td>
    <td width="50%" valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="bodytextblack">Welcome, <strong><?php echo $_SESSION['admin192839748374865']; ?></strong></td>
      </tr>
      <tr>
        <td class="bodytextblue"><a href="logout.php" class="bluelink">Sign Out</a></td>
      </tr>
      <tr>
        <td height="10"></td>
      </tr>
      <tr>
        <td><a href="admin.php"><img src="../img/btn_home.gif" width="84" height="23" border="0" /></a></td>
      </tr>
    </table></td>
    <td width="50%" valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
			<td class="bodytextblack" align="right">&nbsp;</td>
		</tr>
    </table></td>
  </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td background="../images/img_bg.gif" align="center">
		<div id="shademenu" class="shadetabs" align="center">
			<ul>
			<li><a href="#" rel="dropmenu1" rev="testfield">Home</a></li>
           	<?php
				if ($_SESSION['admin192839748374865']=="admin")
		           echo "<li><a href='subadmin.php'>SubAdmin</a></li>";
			?>
            </li>
            <li><a href="#" rel="dropmenu2">Users</a></li>
            <li><a href="#" rel="dropmenu3">Projects</a></li>
			<li><a href="managecategories.php">Categories</a></li>
            <li><a href="managecontribute.php?search=n">Contributions</a></li>
			<li><a href="#" rel="dropmenu4">Search</a></li>
            <li><a href="reportabuse.php">Report</a></li>
            <li><a href="#" rel="dropmenu5">Settings</a></li>
			</ul>
		</div>
	</td>
  </tr>
</table>

<div id="dropmenu1" class="dropmenudiv" style="width: 150px;">
<a href="admin.php">Home</a>
<a href="changepass.php">Change Password</a>
<a href="logout.php">Logout</a>
</div>

<div id="dropmenu2" class="dropmenudiv" style="width: 150px;">
<a href="manageusers.php?search=n">User listings</a>
<a href="withdrawalrequests.php">Withdrawal Requests</a>
</div>

<div id="dropmenu3" class="dropmenudiv" style="width: 150px;">
<a href="projectlisting.php?search=n&featured=0">All Projects</a>
<a href="projectlisting.php?search=n&featured=1">Featured Projects</a>
</div>

<!--drop down menu -->                                                
<div id="dropmenu4" class="dropmenudiv" style="width: 150px;">
<a href="searchuser.php">Search users</a>
<a href="searchproject.php">Search Projects</a>
</div>

<div id="dropmenu5" class="dropmenudiv" style="width: 150px;">
<a href="paymentsetting.php">Payment Settings</a>
<a href="configure.php">Website Configure</a>
<a href="rewrite.php">Reconstruction</a></div>

<script type="text/javascript">
tabdropdown.initializetabmenu("shademenu")
tabdropdown.initializetabmenu("shademenu1")
</script>