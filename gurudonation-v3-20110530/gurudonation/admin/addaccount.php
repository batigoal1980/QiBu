<?php
	include("header.php");
	$username="";
	$password="";
	$email="";
	$paypal="";
	$balance=0;
	$log="";
	
	if (isset($_POST['Submit'])){
		if ($_POST['Submit']=="Add")
		{
			$username=$_POST['mem_name'];
			$password=$_POST['mem_password'];
			$email=$_POST['mem_email'];
			$paypal=$_POST['mem_paypal'];
			$balance=$_POST['mem_balance'];
			if ($username=="")
			{
				$log="User name can't be blank!";
			}else if (userexistbyname($username))
			{
				$log="Duplicate name error!";
			}else if ($password=="")
			{
				$log="Password can't be blank!";
			}else if (strlen($password)<4)
			{
				$log="Password is too short(minimum character 's 4!)";
			}else if (!ereg("^([a-zA-Z0-9_\.-]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$", $email))
			{
				$log="Email is invalid!";
			}else if (userexistbyemail($email)){
				$log="Duplicate Email error!";
			}else if (!ereg("^([a-zA-Z0-9_\.-]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$", $paypal))
			{
				$log="Paypal Email is invalid!";
			}else if (!is_numeric($balance))
			{
				$log="Balance should be numeric!";
			}else{
				$_SESSION['status']="New user has added successfully.";
				newuser($username,$email,$password,generatecode(),"y",$paypal);
				setbalance(nametoid($username),$balance);
				?><script>window.location.href="manageusers.php";</script><?php
			}
		}else{
			?><script>window.location.href="manageusers.php";</script><?php
		}
	}
?>

<table border="0" cellpadding="0" width="100%" align="center" height="100%">
	<tr>
		<td valign="top" align="center" bgcolor="#FFFFFF">
		<BR />
		<table border="0" cellpadding="0" cellspacing="1" width="95%" class="stdTableBorder" >
	<form name="frmUsers" action="addaccount.php" method="post" >
	<tr>
			<td valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td class="pagetitle" align="left" style="padding-left:15px" height="25" align="center">User Manager [Edit] </td>
				</tr>
			</table>
			</td>
		</tr>
        <tr><td class="successMsg" style="color:#FF0000;"> <h5> <?php
				if ($log!="")
					echo $log;
			?></h5></td></tr>
		<tr>
			<td valign="top" align="center" style="padding-left:20px">
			<table border="0" cellpadding="2" cellspacing="2" width="80%">
				<tr class="list_A">
					<td class="fieldlabelRight2" align="left">Name :</td>
					<td class="fieldlabelRight2" align="left"><input type="text" name="mem_name" class="textbox" size="40" value="<?php echo $username;?>" /></td>
					<td class="fieldlabelRight2" align="left">Password :</td>
					<td class="fieldlabelRight2" align="left"><input type="text" name="mem_password" class="textbox" size="40" value="<?php echo $password;?>" /></td>
				</tr>
				<tr class="list_A">
					<td class="fieldlabelRight2" align="left">Email ID :</td>
					<td class="fieldlabelRight2" align="left"><input type="text" name="mem_email" class="textbox" size="40" value="<?php echo $email;?>" /></td>
   					<td class="fieldlabelRight2" align="left">Paypal Email ID :</td>
					<td class="fieldlabelRight2" align="left"><input type="text" name="mem_paypal" class="textbox" size="40" value="<?php echo $paypal;?>" /></td>
				</tr>
				<tr class="list_A">
					<td class="fieldlabelRight2" align="left">Balance :</td>
					<td class="fieldlabelRight2" align="left"><input type="text" name="mem_balance" class="textbox" size="40" value="<?php echo $balance;?>" /></td>
				</tr>
                <tr>
					<td colspan="4" align="right">
					<br/>
						<input type="submit" name="Submit" value="Add" class="stdButton">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="submit" name="Submit" value="Cancel" class="stdButton">
					<br/>
					</td>
                </tr>
			</table>
            <br/>
			</span>
		</td>
	</tr>
	</form>
</table>		</td>
	</tr>
</table>

<?php
	include("footer.php");
?>
