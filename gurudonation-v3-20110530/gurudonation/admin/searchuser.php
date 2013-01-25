<?php
	include("header.php");
?>
<table border="0" cellpadding="0" width="100%" align="center" height="100%">
	<tr>
		<td valign="top" align="center" bgcolor="#FFFFFF">
		<BR />
		<table border="0" cellpadding="0" cellspacing="1" width="95%" class="stdTableBorder" >
		<form name="frmSearchUser" action="manageusers.php" method="post" >
		<tr>
			<td valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td class="pagetitle" align="left" style="padding-left:15px" height="25" align="center">User Search Management </td>
				</tr>
			</table>
			</td>
		</tr>
        
		<tr><td class="successMsg" style="color:#FF0000;"> <h5>&nbsp; </h5></td></tr>
		<tr>
			<td valign="top" align="center" style="padding-left:20px">
			<table border="0" cellpadding="2" cellspacing="2" width="80%">
                
				<tr class="list_A">
					<td class="fieldlabelRight2" align="left">Name: </td>
					<td class="fieldlabelRight2" align="left"><input type="text" name="mem_name" class="textbox" size="40" /></td>
				</tr>
				<tr class="list_A">
					<td class="fieldlabelRight2" align="left">Email : </td>
					<td class="fieldlabelRight2" align="left"><input type="text" name="mem_email" class="textbox" size="40" /></td>
				</tr>
				<tr class="list_A">
					<td class="fieldlabelRight2" align="left">Paypal Email ID : </td>
					<td class="fieldlabelRight2" align="left"><input type="text" name="mem_paypal" class="textbox" size="40" /></td>
				</tr>
                <tr>
                      <td colspan="2" align="right">
                      <br/>
                     	 <input type="submit" name="Sumbit" value="Submit" class="stdButton">
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
