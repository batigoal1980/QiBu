<?php
	include("header.php");
?>

<table border="0" cellpadding="0" width="100%" align="center" height="100%">
	<tr>
		<td valign="top" align="center" bgcolor="#FFFFFF">
			<table border="0" cellpadding="0" cellspacing="1" width="95%" class="stdTableBorder" >
			<form name="frmSubadmin" action="subadmin.php" method="post" >
				<tr>
					<td valign="top">
						<table border="0" cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td class="pagetitle" align="left" style="padding-left:15px" width="50%" height="25">SubAdmin Management</td>
							</tr>
						</table>
					</td>
				</tr>
                
                <tr><td class="successMsg" style="color:#FF0000;"> <h5> 
					<?php 
						if (isset($_SESSION['status']))
							echo "<h5 style='color:red;' align='center'>".$_SESSION['status']."</h5>";
						$_SESSION['status']="";
					 ?>
                </h5></td></tr>
                
				<tr>
					<td valign="top" align="center" style="padding-left:20px">
						<table border="0" cellpadding="1" cellspacing="2" width="70%">
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                                <td class="varnormal">
                                    Manage SubAdmin. Add/Delete SubAdmin.
                                </td>
                            </tr>

                        </table>
						<br>
				
                		<table border="0" cellpadding="1" cellspacing="1" width="95%">
							<tr>
								<td colspan="4" align="right"><a class="actionLink" href="subadminadd.php"><img src="../img/add.gif" class="imgAction" title="Add" border="0" />
                                </a>
								</td>
                            </tr>
                            
							<tr>
								<td class="headTitle" align="center">User Name </td>
								<td class="headTitle" align="center">User Type</td>
								<td class="headTitle" width="23%" align="center">Action</td>
							</tr>
                            <script>
								function suredelete()
								{
									if (confirm("You sure want to delete this admin? \n This action can't be undone."))
										return true;
									else
										return false;
								}
							</script>
                            <?php
								$lists=adminlisting();
								echo $lists;
							?>
						</table>
						<br><br><br/>
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