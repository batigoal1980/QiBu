<?php
	include("header.php");
	
	$errorlog="";
	
	if (isset($_POST['Submit']))
	{
		if ($_POST['Submit']=='Update')
		{
			$email=trim($_POST['mem_email']);
			$fixed=$_POST['mem_fixedfee'];
			$feepercent=$_POST['mem_feepercent'];
			
			if ($email=="")
			{
				$errorlog="Please enter Paypal Email ID";
			}else if (!ereg("^([a-zA-Z0-9_\.-]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$", $email))
			{
				$errorlog="Invalid Paypal Email ID!";
			}else if (!is_numeric($fixed))
			{
				$errorlog="Fixed fee should be numeric";			
			}else if (!is_numeric($feepercent)){
				$errorlog="Fee percentage should be numeric";			
			}else{
				newsett("adminpaypal",$email);
				newsett("feepercent",$feepercent);
				newsett("fixedfee",$fixed);
				$errorlog="Updated successfully!";
			}
		}
	}

?>

<table border="0" cellpadding="0" width="100%" align="center" height="100%">
	<tr>
		<td valign="top" align="center" bgcolor="#FFFFFF">
		<BR />
		<table border="0" cellpadding="0" cellspacing="1" width="95%" class="stdTableBorder" >
		<form name="frmSearchUser" action="paymentsetting.php" method="post" >
		<tr>
			<td valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td class="pagetitle" align="left" style="padding-left:15px" height="25" align="center">Paypal Management </td>
				</tr>
			</table>
			</td>
		</tr>
        
		 <tr><td class="successMsg" style="color:#FF0000;"> <h5> <?php echo $errorlog; ?></h5></td></tr>
		<tr>
			<td valign="top" align="center" style="padding-left:20px">
			<table border="0" cellpadding="2" cellspacing="2" width="80%">
            	<tr class="list_A">
					<td  class="fieldlabelRight2" align="left">PayPal Email ID: </td>
					<td  class="fieldlabelRight2" align="left"><input type="text" name="mem_email" class="textbox" size="40" value="<?php echo siteinfo("adminpaypal");?>"/>
                    </td>
				</tr>
				<tr class="list_A">
					<td  class="fieldlabelRight2" align="left">Fixed Fee($) : </td>
					<td  class="fieldlabelRight2" align="left"><input type="text" name="mem_fixedfee" class="textbox" size="40"  value="<?php echo siteinfo("fixedfee");?>"/>
                    </td>
				</tr>
                <tr class="list_A">
					<td  class="fieldlabelRight2" align="left">Fee Percentage(%) : </td>
					<td  class="fieldlabelRight2" align="left"><input type="text" name="mem_feepercent" class="textbox" size="40"  value="<?php echo siteinfo("feepercent");?>"/>
                    </td>
				</tr>
				<tr>
                      <td colspan="2" align="right">
                      <br/>
                     	 <input type="submit" name="Submit" value="Update" class="stdButton">
                      <br/>
                      </td>
                </tr>
			</table>
			<br>
		</td>
	</tr>
	</form>
</table>		</td>
	</tr>
</table>

<?php
	include("footer.php");
?>
