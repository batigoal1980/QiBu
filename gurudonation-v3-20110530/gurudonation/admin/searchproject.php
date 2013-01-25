<?php
	include("header.php");
?>
<table border="0" cellpadding="0" width="100%" align="center" height="100%">
	<tr>
		<td valign="top" align="center" bgcolor="#FFFFFF">
		<BR />
		<table border="0" cellpadding="0" cellspacing="1" width="95%" class="stdTableBorder" >
		<form name="frmSearchUser" action="projectlisting.php" method="post" >
		<tr>
			<td valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td class="pagetitle" align="left" style="padding-left:15px" height="25" align="center">Project Search Management </td>
				</tr>
			</table>
			</td>
		</tr>
        
		<tr><td class="successMsg" style="color:#FF0000;"> <h5>&nbsp; </h5></td></tr>
		<tr>
			<td valign="top" align="center" style="padding-left:20px">
			<table border="0" cellpadding="2" cellspacing="2" width="80%">
                
				<tr class="list_A">
					<td class="fieldlabelRight2" align="left">Title: </td>
					<td class="fieldlabelRight2" align="left"><input type="text" name="kp_title" class="textbox" size="40" /></td>
				</tr>
				<tr class="list_A">
					<td class="fieldlabelRight2" align="left">Amount to raise: </td>
					<td class="fieldlabelRight2" align="left"><input type="text" name="kp_amount" class="textbox" size="40" /></td>
				</tr>
				<tr class="list_A">
					<td class="fieldlabelRight2" align="left">Duration : </td>
					<td class="fieldlabelRight2" align="left">
                    	<select name="kp_duration" class="short">
                        <option value="0" selected="selected"/>Select One</option>
						<?php
							$day_array=array("7"=>"7 days","14"=>"14 days","30"=>"1 month","60"=>"2 months","90"=>"3 months","180"=>"6 months","365"=>"1 year");
							$lists="";
							foreach ($day_array as $i=>$var)
							{
								$lists.="<option value='$i'>$var</option>";
							}
							echo $lists;
						?>
						</select>
					</td>
				</tr>
                <tr class="list_A">
					<td class="fieldlabelRight2" align="left">Description keywords(split by comma) : </td>
					<td class="fieldlabelRight2" align="left"><textarea name="description" cols="50" rows="5"></textarea></td>
				</tr>
                <tr>
                      <td colspan="2" align="right">
                      <br/>
                     	 <input type="submit" name="Search" value="Search" class="stdButton">
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
