<?php
	include("header.php");
	
	$errorlog="";
	if (isset($_POST['Submit']))
	{
		newsett('sitetitle',$_POST['sitetitle']);
		newsett('siteauthor',$_POST['siteauthor']);
		newsett('copyright',$_POST['copyright']);
		newsett('sitedesc',$_POST['description']);
		$errorlog="Configuration has been successfully updated.";
	}
?>

<link rel="stylesheet" type="text/css" media="all" href="css/core.css" />

<table border="0" cellpadding="0" width="100%" align="center" height="100%">
	<tr>
		<td valign="top" align="center" bgcolor="#FFFFFF">
		<BR />
		<table border="0" cellpadding="0" cellspacing="1" width="95%" class="stdTableBorder" >
		<form id="auctionform" class="information sell" action="configure.php" method="post">
		<tr>
			<td valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td class="pagetitle" align="left" style="padding-left:15px" height="25" align="center">Site Configuration </td>
				</tr>
			</table>
			</td>
		</tr>
        
		<tr><td class="successMsg" style="color:#FF0000;"> <?php
        	if ($errorlog!="") echo "<h5 style='color:red;'>".$errorlog."</h5>";?>
                        <br/>
        </td></tr>
        
	    <tr>
           <td valign="top" align="center" style="padding-left:20px">
			<table border="0" cellpadding="2" cellspacing="2" width="80%">

                 <tr>
                            <td width="39%" class="fieldlabelRight2">&nbsp;</td>
                        </tr>
                        <tr>
                                <td class="varnormal"><strong>Site Information</strong></td>
                            <td width="61%" class="fieldlabelRight2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="39%" class="fieldlabelRight2">&nbsp;</td>
                        </tr>
				
                <tr>
                	<td>
                     <table cellpadding="0" width="90%" align="center">
                         <tr>
	                         <td valign="top" class="fieldlabelRight2" align="left"><label for="url" class="short">Site Title : </label> </td>
                             <td class="fieldlabelRight2" align="left">
                         		 <textarea name="sitetitle" class="wysiwyg" cols="60" rows="3"><?php echo siteinfo("sitetitle");?></textarea>
                                 <br/>Maximum 100 characters
                       		 </td>
						 </tr>
						<tr><td>&nbsp;</td></tr>
                         <tr>
	                         <td  valign="top" class="fieldlabelRight2" align="left"><label for="url" class="short">Site Author : </label> </td>
                             <td class="fieldlabelRight2" align="left">
                         		 <input type="text" name="siteauthor" class="wysiwyg" style="width:450px" value="<?php echo siteinfo("siteauthor");?>">
                       		 </td>
						 </tr>
                         <tr><td>&nbsp;</td></tr>
                         <tr>
	                         <td  valign="top" class="fieldlabelRight2" align="left"><label for="url" class="short">Copyright : </label> </td>
                             <td class="fieldlabelRight2" align="left">
                         		 <input type="text" name="copyright" class="wysiwyg" style="width:450px" value="<?php echo siteinfo("copyright");?>">
                       		 </td>
						 </tr>
                         <tr><td>&nbsp;</td></tr>
                         <tr>
	                         <td  valign="top" class="fieldlabelRight2" align="left"><label for="url" class="short">Site Description : </label> </td>
                             <td class="fieldlabelRight2" align="left">
                         		 <textarea name="description" id="description" class="wysiwyg" cols="90" rows="3"><?php echo siteinfo("sitedesc");?></textarea>
                                 <br/>
                                 Maximum 400 characters <br/><strong>
Site Description</strong> - This text appears in the listing for your site in search engine results (e.g., a brief description of the services and products you offer, as well as your location). Begin this description with your service title, and then include other keywords and/or phrases describing your services.
                       		 </td>
						 </tr>
                     </table>
                    </td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr>
				    <td colspan="2" align="right"><input type="submit" name="Submit" value="Update" class="stdButton"></td>
				</tr>
			</table>
			</br>
		</td>
	</tr>
	</form>
</table>		</td>
	</tr>
</table>
<?php
	include("footer.php");
?>
