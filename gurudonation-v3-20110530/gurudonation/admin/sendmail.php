<?php
	include("header.php");
	date_default_timezone_set('UTC');
	$userid=0;
	if (isset($_GET['user_id']))
		$userid=$_GET['user_id'];
	if (isset($_POST['user_id']))
		$userid=$_POST['user_id'];
	$abuseid=0;
	if (isset($_GET['abuse_id']))
		$abuseid=$_GET['abuse_id'];
	if (isset($_POST['abuse_id']))
		$abuseid=$_POST['abuse_id'];
	if ($userid!=0)
	{
		$mailid=idtoemail($userid);
		$subject="";
	}else
	{
		$det=abusedetail($abuseid);
		$mailid=$det[3];
		$subject=$det[2];
	}
	
	$content="";
	if (isset($_POST['content']))
	{
		if ($_POST['Submit']=="Back"){
			if ($userid!=0){
				?><script>window.location.href="manageusers.php";</script><?php
			}else{
				?><script>window.location.href="reportabuse.php";</script><?php
			}
		}
		else{
			if (isset($_POST['subject']))
				$subject=$_POST['subject'];
			$content=$_POST['content'];
			
			if ($subject=="")
				$_SESSION['status']="Please enter subject";
			else if ($content=="")
				$_SESSION['status']="Please enter content";
			else{
				if (sendemail($mailid,"GuruDonation Support - ".$subject,$content))
					$_SESSION['status']="Mail has sent successfully";
				else
					$_SESSION['status']="Mail has lost permanently";
			}
		}
	}
?>

<table border="0" cellpadding="0" width="100%" align="center" height="100%">
	<tr>
		<td valign="top" align="center" bgcolor="#FFFFFF">
		<BR />
		<table border="0" cellpadding="0" cellspacing="1" width="95%" class="stdTableBorder" >
	<form name="frmUsers" action="sendmail.php" method="post" >
    <input type="hidden" name="user_id" value="<?php echo $userid;?>"/>
    <input type="hidden" name="abuse_id" value="<?php echo $abuseid;?>"/>
	<tr>
			<td valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td class="pagetitle" align="left" style="padding-left:15px" height="25" align="center">User Manager [Send_Mail] </td>
				</tr>
			</table>
			</td>
		</tr>
        <tr><td class="successMsg" style="color:#FF0000;"> <?php
				if (isset($_SESSION['status']))
					echo "<h5 style='color:red;' align='center'>".$_SESSION['status']."</h5>";
				$_SESSION['status']="";
			?><br/></td></tr>
	<tr>
			<td valign="top" align="center" style="padding-left:20px">
			<table border="0" cellpadding="2" cellspacing="2" width="80%">
				<tr class="list_A">
					<td class="fieldlabelRight2" align="left">User Email ID :</td>
					<td class="fieldlabelRight2" align="left"><?php echo $mailid; ?></td>
				</tr>
                <?php if ($userid!=0){ ?>
				<tr class="list_A">
					<td class="fieldlabelRight2" align="left">Subject :</td>
					<td class="fieldlabelRight2" align="left"> <input type="text" name="subject" value="<?php echo $subject;?>"/></td>
				</tr>
                <?php }else{ ?>
				<tr class="list_A">
					<td class="fieldlabelRight2" align="left">Subject :</td>
					<td class="fieldlabelRight2" align="left"> <input type="text" name="subject" value="<?php echo $subject;?>" disabled="disabled"/></td>
				</tr>
                <?php } ?>
				<tr class="list_A">
					<td class="fieldlabelRight2" align="left">Content :</td>
					<td class="fieldlabelRight2" align="left"> <textarea name="content" cols="50" rows="5"><?php echo $content;?></textarea></td>
				</tr>
				<tr>
					<td colspan="4" align="left"><input type="submit" name="Submit" value="Send" class="stdButton">
                      &nbsp;
					  <input type="submit" name="Submit" value="Back" class="stdButton">
					  </td>
				</tr>
			</table>	
		</td>
	</tr>
	</form>
	</table>
	<br/>
		</td>
	</tr>
</table>
<?php
	include("footer.php");
?>
