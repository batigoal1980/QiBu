<?php
	include_once("header.php");
	include("../includes/config.php");
	$log="";
	
	if (isset($_POST['Sumbit']))
	{
		if (mysql_query("Drop DATABASE $databasename"))
		{
			include("../includes/createdb.php");
			include("../includes/init.php");
			$log="Your database has successfully reconstructed";
		}else
			$log="Failed to reconstruct your databse!";
	}
?>

<table border="0" cellpadding="0" width="100%" align="center" height="100%">
	<tr>
		<td valign="top" align="center" bgcolor="#FFFFFF">
		<BR />
		<table border="0" cellpadding="0" cellspacing="1" width="95%" class="stdTableBorder" >
        <form name="frmSubadmin" action="rewrite.php" method="POST" >
		<tr>
			<td valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td class="pagetitle" align="left" style="padding-left:15px" height="25" align="center">Reconstruction </td>
				</tr>
			</table>
			</td>
		</tr>
        <tr><td class="successMsg" style="color:#FF0000;"> <h3> </h3></td></tr>
            <tr>
                <td valign="top" align="center" style="padding-left:20px">
			<table border="0" cellpadding="2" cellspacing="2" width="80%">
                        <tr>
                            <td class="varnormal"><strong>
                            <?php
								echo "<h5 style='color:red'>".$log."</h5>";
							?>
                            </strong></td>
                        </tr>
                        <tr>
                            <td width="39%" class="fieldlabelRight2">&nbsp;</td>
                        </tr>
                        <tr>
                                <td class="varnormal"><strong>Current &nbsp;Website&nbsp;Status</strong></td>
                            <td width="61%" class="fieldlabelRight2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="39%" class="fieldlabelRight2">&nbsp;</td>
                        </tr>
                        <tr class="list_A">
                            <td class="fieldlabelRight2" align="left">- Total money transferred on site </td>
                            <td class="fieldlabelRight2" align="left"><?php echo "$".siteinfo("moneytransferred");?></td>
                        </tr>
                        <tr class="list_A">
                            <td class="fieldlabelRight2" align="left">- Total money you earned </td>
                            <td class="fieldlabelRight2" align="left"><?php echo "$".siteinfo("moneyraised");?></td>
                        </tr>
                        <tr class="list_A">
                            <td class="fieldlabelRight2" align="left">- Total users </td>
                            <td class="fieldlabelRight2" align="left"><?php echo totalusers();?></td>
                        </tr>
                        <tr class="list_A">
                            <td class="fieldlabelRight2" align="left">- Total Projects</td>
                            <td class="fieldlabelRight2" align="left"><?php echo totalkapipals();?></td>
                        </tr>              
                        
                        <tr class="list_A">
                            <td class="fieldlabelRight2" align="left">- Featured Projects</td>
                            <td class="fieldlabelRight2" align="left"><?php echo totalfeaturedkapipals();?></td>
                        </tr>
						<tr class="list_A">
                            <td class="fieldlabelRight2" align="left">- Pending withdrawal requests</td>
                            <td class="fieldlabelRight2" align="left"><?php echo totalwithdrawals();?></td>
                        </tr>
                        
                        <tr>
                            <td width="39%" class="fieldlabelRight2">&nbsp;</td>
                        </tr>
                        <tr>
                                <td class="varnormal">
                                	If you click confirm button, then you'll start from scratch. <br/>
                                    All information in database will be removed.
                                </td>
                            <td width="61%" class="fieldlabelRight2">&nbsp;</td>
                        </tr>
                        <tr>
                     	 <td colspan="2" align="right">
                          <br/>
                             <input type="submit" name="Sumbit" value="Confirm" class="stdButton">
                          <br/><br/>
                          </td>
                      	 </tr>
                    </table>
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
