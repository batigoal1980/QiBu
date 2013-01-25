<?php
	include("header.php");
?>
<table border="0" cellpadding="0" width="100%" align="center" height="100%">
	<tr>
		<td valign="top" align="center" bgcolor="#FFFFFF">
		<BR />
		<table border="0" cellpadding="0" cellspacing="1" width="95%" class="stdTableBorder" >
		<tr>
			<td valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td class="pagetitle" align="left" style="padding-left:15px" height="25" align="center">Home </td>
				</tr>
			</table>
			</td>
		</tr>
        <tr><td class="successMsg" style="color:#FF0000;"> <h3> </h3></td></tr>
            <tr>
                <td valign="top" align="center" style="padding-left:20px">
			<table border="0" cellpadding="2" cellspacing="2" width="80%">
                        <tr>
                            <td width="39%" class="fieldlabelRight2">&nbsp;</td>
                        </tr>
                        <tr>
                                <td class="varnormal"><strong>Website&nbsp;&nbsp;&nbsp;&nbsp;Status</strong></td>
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
                        <td>&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
			</table>
		</td>
	</tr>
</table>
<?php
	include("footer.php");
?>
