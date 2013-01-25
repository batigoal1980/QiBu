<?php
	include("header.php");
	$_SESSION['manageuser_id']="";
	
	if (isset($_GET['search']))
	{
		$_SESSION['mem_name']="";
		$_SESSION['mem_email']="";
		$_SESSION['mem_paypal']="";
	}
	if (isset($_POST['Sumbit']))
	{
		$_SESSION['mem_name']=$_POST['mem_name'];
		$_SESSION['mem_email']=$_POST['mem_email'];
		$_SESSION['mem_paypal']=$_POST['mem_paypal'];
	}
?>

<table border="0" cellpadding="0" width="100%" align="center" height="100%">
	<tr>
		<td valign="top" align="center" bgcolor="#FFFFFF">
		<BR />
			<table border="0" cellpadding="0" cellspacing="1" width="95%" class="stdTableBorder" >
			<form name="frmUsers" action="manageusers.php" action="POST">
			<tr>
			<td valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td class="pagetitle" align="left" style="padding-left:15px" height="25" align="center">User Manager </td>
				</tr>
			</table>
			</td>
		</tr>
        <tr><td class="successMsg" style="color:#FF0000;"> <h5> <?php
				if (isset($_SESSION['status']))
					echo $_SESSION['status'];
				$_SESSION['status']="";
			?></h5></td></tr>
		<tr>
			<td valign="top" align="center" style="padding-left:20px">
            <table border="0" cellpadding="1" cellspacing="2" width="70%">
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="varnormal">
						Manage Users. Add/Edit/Delete Users.
					</td>
				</tr>
			</table>
            <br/>
            
			<table border="0" cellpadding="1" cellspacing="1" width="95%">
	            <tr>
					<td colspan="9" align="right"><a class="actionLink" href="addaccount.php"><img src="../img/add.gif" class="imgAction" title="Add" border="0" />
                     </a>
					</td>
    			</tr>
				<tr>
					<td class="headTitle" width="5%">User ID</td>
					<td class="headTitle" width="15%">Name</td>
   					<td class="headTitle" width="20%">Email</td>
					<td class="headTitle" width="20%">Paypal Email ID</td>
					<td class="headTitle" width="10%">Balance</td>
					<td class="headTitle" width="25%">Action</td>
				</tr>
				<script>
					function suredelete()
					{
						if (confirm("You sure want to delete this user? \n This action can't be undone."))
							return true;
						else
							return false;
					}
				</script>
				<?php
					$lists=userlisting($_SESSION['mem_name'],$_SESSION['mem_email'],$_SESSION['mem_paypal']);
					echo $lists;
				?>
			</table>
            <br/>
		</td>
	</tr>			

	</form>
</table>		</td>
	</tr>
</table>

<?php
	include("footer.php");
?>
