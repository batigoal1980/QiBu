<?php
	include("header.php");
	$user_login_id="";
	$user_passwd="";
	$errorlog="";
	
	if (isset($_POST['Submit']))
	{
		$user_login=$_POST['user_login'];
		$user_passwd=$_POST['user_passwd'];

		if ($_POST['Submit']=="Cancel")
		{
			?><script>window.location.href="subadmin.php";</script><?php
		}else if ($user_login=="")
		{
			$errorlog="Please enter user login id";
		}
		else if ($user_passwd=="")
		{
			$errorlog="Please enter password";
		}
		else if (getPassword($user_login))
		{
			$errorlog="UserName Duplicate Error!";
		}
		else
		{
			if (newadmin($user_login,$user_passwd))
			{
				$_SESSION['status']="SubAdmin added successfully";
			}
			else
			{
				$_SESSION['status']="Cannot add SubAdmin";
			}
			?><script>window.location.href="subadmin.php";</script><?php
		}
	}
?>

<table border="0" cellpadding="0" width="100%" align="center" height="100%">
	<tr>
		<td valign="top" align="center" bgcolor="#FFFFFF">

		<table border="0" cellpadding="0" cellspacing="1" width="95%" class="stdTableBorder" >
			<form name="frmSubadmin" action="subadminadd.php" method="POST" >
				<tr>
                    <td valign="top">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td class="pagetitle" align="left" style="padding-left:15px" height="25" align="center">SubAdmin Management [Add]</td>
                        </tr>
                    </table>
                    </td>
                </tr>
                
                <tr>
                <td class="successMsg" style="color:#FF0000;">
                <h5>
					<?php 
						echo $errorlog;
					 ?>
                     <br/>
				</h5>
                </td></tr>
                
                <tr>
					<td valign="top" align="center" style="padding-left:20px">
						<table border="0" cellpadding="2" cellspacing="2" width="80%">
                    
                        <tr class="list_A">
                            <td class="fieldlabelRight2" align="left">Login Name :</td>
                            <td  class="fieldlabelRight2" align="left">
                                <input type="text" name="user_login" size="40" maxlength="50" class="textbox" value="<?php echo $user_login_id; ?>">
                            </td>
                        </tr>
                        <tr class="list_A">
                            <td  class="fieldlabelRight2" align="left">Password :</td>
                            <td  class="fieldlabelRight2" align="left">
                                <input type="password" name="user_passwd" size="40" maxlength="50" class="textbox"  value="<?php echo $user_passwd; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                     	 <td colspan="2" align="right">
                          <br/>
                             <input type="submit" name="Submit" value="Save" class="stdButton">
                             &nbsp;&nbsp;&nbsp;
                             <input type="submit" name="Submit" value="Cancel" class="stdButton">
                          <br/><br/><br/>
                          </td>
                      	 </tr>
	                    </table>
                    </td>
                  </tr>
	</form>
</table>		</td>
	</tr>
</table>

<?php
	include("footer.php");
?>