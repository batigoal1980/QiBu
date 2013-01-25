<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>GuruDonation.com</title>
	<meta name="title" 			content="GuruDonation.com">
	<meta name="description" 	content="GuruDonation.com">
	<meta name="keywords" 		content="Kapipal clone">
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<script language="javascript" src="js/validate.js"></script>
	<script language="javascript" src="js/functions.js"></script>
    <script language="javascript" src="js/login.js"></script>
</head>
<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="30%" height="199" class="norepet">&nbsp;</td>
    <td width="30%" align="center" valign="bottom" class="norepet"></td>
    <td width="30%" align="right" class="norepet"></td>
  </tr>
  <tr>
    <td height="199" class="norepet">&nbsp;</td>
    <td align="center" class="norepet"><table width="267" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="49" background="../img/login_bg01.gif" class="border1"><table width="231" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="38"><img src="../img/administrator_icon.gif" width="38" height="38"></td>
            <td align="right"><img src="../img/administrator_hed.gif" width="184" height="14"></td>
          </tr>
        </table></td>
      </tr>
    </table>
      <table width="267" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="167" style="background:url(../img/login_bg01.gif); background-repeat:repeat-y;" class="border">
		<form name="frmLogin" action="loginadminprocess.php"  method="POST">
		<table width="95%" border="0" align="center" cellpadding="6" cellspacing="0">
              <tr>
		      <td colspan="2">    
              <h5 style="color:#FF0000;"> 
			  	<?php 
					if (isset($_SESSION['status']))
						echo $_SESSION['status'];
					$_SESSION['status']="";
				?>
                </h5> 
              </td>
		      </tr>
          <tr>
            <td width="40%" align="right" class="bodytextgray"><strong>USERNAME:</strong></td>
            <td width="60%"><input type="text" class="text"  name="adminname" size="18" maxlength="25" tabindex="1"></td>
          </tr>
          <tr>
            <td width="40%" align="right" class="bodytextgray"><strong>PASSWORD:</strong></td>
            <td width="60%"><input  type="password" class="text" name="passwd"  maxlength="15" size="18" tabindex="2"></td>
          </tr>
			<tr><td class="bodytextgray" colspan="2" height="5"></td></tr>
          <tr>
            <td align="center" class="bodytextgray" colspan="2">
			<input  type="submit" name="Submit" value="Login" class="button" tabindex="3">
				<br>
				<br>
			</td>
          </tr>
        </table>
		</form>
		</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
