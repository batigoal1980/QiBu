<?php
	include("header.php");
	$title="";
	$pic="";
	$log="";
	
	if (isset($_POST['Submit'])){
		if ($_POST['Submit']=="Add")
		{
			$title=$_POST['title'];
			if ($title=="")
				$log="You must enter category title.";
			else if ($_FILES['uplImage']['name']=="")
				$log="You must choose category picture.";
			else{
				$_SESSION['status']="New category has added successfully.";
				$imgurl="admin/".uploadpicture($_FILES['uplImage']);
				newcate($title,$imgurl);
				?><script>window.location.href="managecategories.php";</script><?php
			}
		}else{
			?><script>window.location.href="managecategories.php";</script><?php
		}
	}
?>

<table border="0" cellpadding="0" width="100%" align="center" height="100%">
	<tr>
		<td valign="top" align="center" bgcolor="#FFFFFF">
		<BR />
		<table border="0" cellpadding="0" cellspacing="1" width="95%" class="stdTableBorder" >
	<form name="frmUsers" action="addcategory.php" method="post" enctype="multipart/form-data">
	<tr>
			<td valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td class="pagetitle" align="left" style="padding-left:15px" height="25" align="center">Category Manager [Add] </td>
				</tr>
			</table>
			</td>
		</tr>
        <tr><td class="successMsg" style="color:#FF0000;"> <h5> <?php
				if ($log!="")
					echo $log;
			?></h5></td></tr>
		<tr>
			<td valign="top" align="center" style="padding-left:20px">
			<table border="0" cellpadding="2" cellspacing="2" width="80%">
				<tr class="list_A">
					<td class="fieldlabelRight2" align="left">Category Name :</td>
					<td class="fieldlabelRight2" align="left"><input type="text" name="title" class="textbox" size="40" value="<?php echo $title;?>" /></td>
				</tr>
				<tr class="list_A">
					<td class="fieldlabelRight2" align="left">Picture :</td>
					<td class="fieldlabelRight2" align="left"><input type="file" name="uplImage" class="file" /></td>
				</tr>
                <tr>
					<td colspan="4" align="right">
					<br/>
						<input type="submit" name="Submit" value="Add" class="stdButton">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="submit" name="Submit" value="Cancel" class="stdButton">
					<br/>
					</td>
                </tr>
			</table>
            <br/>
			</span>
		</td>
	</tr>
	</form>
</table>		</td>
	</tr>
</table>

<?php
	include("footer.php");
?>
