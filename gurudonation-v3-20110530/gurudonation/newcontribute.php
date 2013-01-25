<?php
	include_once("header.php");
	if (!isset($_GET['kid']))
	{
		?><script>window.location.href="index.php";</script><?php
	}
	$kid=$_GET['kid'];
	$det=kapipaldetail($kid);
	$kurl="project.php?id=".$kid;
?>
	<div id="main">
			<div id="main_2">			        
				<div id="page_edit_kapipal">    
					<div class="breadcrumbs">
						<a href="index.php" title="Go to Home">Home</a> &gt; Contribution
					</div>
					<h1>Contribution Confirmation</h1>
					<div id="Success">
						<div class="success">
							<h3>Contribution done.</h3>                            
							<p>Congratulations! You have contributed to the Project <strong><?php echo $det[2];?></strong>.</p>
							<p>An email has been sent to <strong><?php echo idtoemail($det[1]);?></strong>.</p>
							<a href="<?php echo $kurl;?>">Continue</a>
						</div>
					</div>
				</div>
				<div class="clearer"></div>
			</div>									
	</div>
<?php
	include_once("footer.php");
?>