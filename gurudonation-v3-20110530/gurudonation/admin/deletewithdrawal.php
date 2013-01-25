<?php
	include("header.php");


$id = $_GET['id'];
include("linkmysql.php");
$query="DELETE FROM withdrawals WHERE id = '$id'";
$q=mysql_query($query,$link); ?>
<table border="0" cellpadding="0" width="100%" align="center" height="100%">
	<tr>
		<td valign="top" align="center" bgcolor="#FFFFFF">
			<BR />
			<table border="0" cellpadding="0" cellspacing="1" width="95%" class="stdTableBorder" >
			<tr>
				<td valign="top">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td class="pagetitle" align="left" style="padding-left:15px" height="25" align="center">Withdrawal Requests </td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
            	<td class="successMsg" style="color:#FF0000;">
                	<h5>
					<?php
						if (isset($_SESSION['status'])) echo $_SESSION['status'];
						$_SESSION['status']="";
					?>
					</h5>
				</td>
			</tr>
			<tr>
				<td valign="top" align="center" style="padding-left:20px">
					<table border="0" cellpadding="1" cellspacing="2" width="70%">
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td class="varnormal">
								Manage Withdrawal requests of users.
							</td>
						</tr>
					</table>
					<br/>
                    <script>
						function removewithdrawal()
						{
							if (confirm("You sure want to delete this withdrawal request? \n This action can't be undone."))
								return true;
							else
								return false;
						}
					</script>
					<table border="0" cellpadding="1" cellspacing="1" width="70%">
						<tr>
							<td class="headTitle" width="10%">No</td>
                            <td class="headTitle" width="20%">Name</td>
							<td class="headTitle" width="25%">Amount</td>
							<td class="headTitle" width="50%">Action</td>
						</tr>
						<?php
							$lists=withdrawallisting();
							echo $lists;
						?>
					</table>
					<br/>
				</td>
			</tr>
			</table>
		</td>
	</tr>
</table>
	
<?
include("footer.php");
?>
