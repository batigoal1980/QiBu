<?php
	include_once("header.php");
	$page=1;
	if (isset($_GET['page']))
		$page=$_GET['page'];
?>
<div id="box5">
	<div style="padding-left:50px">
    	<a href="index.php">Home</a> > Latest projects
    </div>
    <br/>
	<?php
		$a=latestkapipals(4,$page-1);
		include("projectlisting.php");
		include("pagination.php");
	?>
</div>
<?php
	include_once("footer.php");
?>