<?php
	include("header.php");
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
					<td class="pagetitle" align="left" style="padding-left:15px" height="25" align="center">Contribution Manager </td>
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
						Manage Contributions.
					</td>
				</tr>
			</table>
            <br/>
            
			<table border="0" cellpadding="1" cellspacing="1" width="95%">
				<tr>
					<td class="headTitle" width="5%">No</td>
					<td class="headTitle" width="15%">Project</td>
   					<td class="headTitle" width="20%">Amount</td>
					<td class="headTitle" width="20%">Message</td>
					<td class="headTitle" width="25%">Action</td>
				</tr>
				<script>
					function suredelete()
					{
						if (confirm("You sure want to delete this contribution? \n This action can't be undone."))
							return true;
						else
							return false;
					}
				</script>
				<?php
					$lists=contributionlisting();
					if ($lists=="")
						echo "<td colspan='3' align='left'> No Contributions</td>";
					else
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
