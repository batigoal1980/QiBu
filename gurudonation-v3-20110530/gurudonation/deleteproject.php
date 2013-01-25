<?php

	include_once("header.php");

	//if (!isset($_SESSION['kapipalist12878498g94j93gj9458']) || !isset($_SESSION['admin192839748374865']))

	//{

	//	?>
         //<?php

	//}

	$kid=1;

	if (isset($_GET['kid']))

		$kid=$_GET['kid'];

	if (isset($_POST['kid']))

		$kid=$_POST['kid'];

	if (isset($_POST['delete'])){

		removekapipal($kid);

		?><script>window.location.href="/admin/projectlisting.php";</script><?php

	}

?>

	<div id="main">

			<div id="main_2">			        

				<form method="post" action="deleteproject.php">

                	<input type="hidden" name="kid" value="<?php echo $kid;?>"/>

					<div id="page_my_delete_kapipal">

						<div class="breadcrumbs">

							<a href="index.php" title="Go to Home">Home</a> &gt; 

							<a href="myaccount.php" title="Go to My Account">My Account</a> &gt; 

							Delete Project

						</div>

						<h1>Delete Project</h1>

						<div>

							<div class="warning">

								<h3>Warning!</h3>

								<p>Are you sure to delete the Project <strong><?php echo idtotitle($kid);?></strong>?</p>

								<p>The Project page will be deleted and you friends won't be able to send you money anymore. Of course, the money you've already received on your PayPal account is not affected.</p>

								<p><strong>You can't undo this operation.</strong></p>

							</div>

							<fieldset>

								<div class="buttons">

									<a href="myaccount.php">Cancel and return to My Account</a>

									<input type="submit" name="delete" value="Delete Project" class="ok" />

								</div>

							</fieldset>

						</div>

					</div>

				</form>

				<div class="clearer"></div>

			</div>									

	</div>

<?php

	include_once("footer.php");

?>