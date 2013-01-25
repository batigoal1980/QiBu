<?php
	include("header.php");

	$errorlog="";
	$oldpass="";
	$newpass1="";
	$newpass2="";
	
	if (isset($_POST['old_password']))
	{
		$oldpass=$_POST['old_password'];
		$newpass1=$_POST['new_password1'];
		$newpass2=$_POST['new_password2'];
		$user=$_SESSION['admin192839748374865'];
		
		if ($oldpass=="")
		{
			$errorlog="Please enter old password!";
		}
		else if ($newpass1=="")
		{
			$errorlog="Please enter new password!";
			$newpass2="";
		}
		else if ($newpass2=="")
		{
			$errorlog="Please enter confirm password!";
			$newpass1="";
		}else if ($newpass1!=$newpass2)
		{
			$errorlog="Please confirm your password!";
			$newpass1="";
			$newpass2="";
		}
		else if (!guru_decrypt(getadmPassword($user),$oldpass))
		{
			$errorlog="Please check your old password";
			$oldpass="";
		}else{
			updateadminPassword($user,$newpass1);
			$errorlog="Password has been changed successfully!";
			$oldpass="";
			$newpass1="";
			$newpass2="";
		}
	}
?>

<table border="0" cellpadding="0" width="100%" align="center" height="100%">
	<tr>
		<td valign="top" align="center" bgcolor="#FFFFFF">
		<BR />
		<table border="0" cellpadding="0" cellspacing="1" width="95%" class="stdTableBorder" >
        <form name="frmLogin" action="changepass.php"  method="POST">
		<tr>
			<td valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td class="pagetitle" align="left" style="padding-left:15px" height="25" align="center">Change Password </td>
				</tr>
			</table>
			</td>
		</tr>
        <tr><td class="successMsg" style="color:#FF0000;"> <h5> <?php echo $errorlog; ?></h5></td></tr>
        <tr>
			<td valign="top" align="center" style="padding-left:20px">
            <br/>
			<table border="0" cellpadding="2" cellspacing="2" width="80%">
				<tr class="list_A">
					<td class="fieldlabelRight2" align="left">Old Password </td>
					<td class="fieldlabelRight2" align="left"><input type="password"  class="textbox" size="40" name="old_password"></td>
				</tr>
				<tr class="list_A">
					<td class="fieldlabelRight2" align="left">New Password </td>
					<td class="fieldlabelRight2" align="left"><input type="password"  class="textbox"  size="40" name="new_password1"></td>
				</tr>
                <tr class="list_A">
					<td class="fieldlabelRight2" align="left">Retype Password</td>
					<td class="fieldlabelRight2" align="left"><input type="password" class="textbox"  size="40" name="new_password2"></td>
				</tr>
                
                <tr>
                      <td colspan="2" align="right">
                      <br/>
                      <input type="submit" name="Sumbit" value="Change" class="stdButton">
                      <br/>
                      </td>
                </tr>
			</table>
            <br/>
		</td>
		</tr>
        </form>
    	</table>
    	</td>
    </tr>
</table>	
<?php
	include("footer.php");
?>