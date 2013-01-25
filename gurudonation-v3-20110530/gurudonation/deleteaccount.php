<?php
	$log="";
	if (isset($_POST['btndelete'])){
		session_start();
		include_once("includes/userinfo.php");
		removeuser($_SESSION['kapipalist12878498g94j93gj9458']);
		session_destroy();
		$log="ok";
	}
	include_once("header.php");
?>    
	<div id="main">
			<div id="main_2">
            	<form action="deleteaccount.php" method="post">
				<div id="page_my_delete_account">
					<div class="breadcrumbs">
						<a href="index.php" title="Go to Home">Home</a> &gt; 
						<a href="myaccount.php" title="Go to My Account">My Account</a> &gt; Delete Your Account
					</div>
					<h1>Delete Your Account</h1>
                    <?php if ($log!="ok"){ ?>
					<div>
						<div class="warning">
							<h3>Warning!</h3>
							<p>If you delete your account, all of your Project Pages and data will be lost.</p>
							<p><strong>You can't undo this operation.</strong></p>
						</div>
						<fieldset>
							<div class="buttons">
								<a href="myaccount.php">Cancel and return to My Account</a>
								<input type="submit" name="btndelete" value="Delete My Account" class="ok" />
							</div>
						</fieldset>        
					</div>
                    <?php }else{ ?>
					<div>
						<div class="success">
							<h3>Account Deleted</h3>
							<p>Thank you for using Project and we hope to see you again soon.</p>
							<a href="index.php">Go to Home</a>
						</div>
					</div>
                    <?php } ?>
				</div>
				</form>
			<div class="clearer"></div>
	</div>
<?php
	include_once("footer.php");
?>