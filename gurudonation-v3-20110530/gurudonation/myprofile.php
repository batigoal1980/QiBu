<?php

	include_once("header.php");

	if (!isset($_SESSION['kapipalist12878498g94j93gj9458'])){

		?><script>window.location.href="index.php";</script><?php

	}

	$name="";

	$email="";

	$log="";

	if (isset($_POST['update']))

	{

		$name=$_POST['name'];

		$email=$_POST['email'];
		$ext=ia_extensii($_FILES['avatar']['name']);

		if ($name=="") $log.="namerequired\n";

		if ($email=="")

			 $log.="emailrequired\n";

		else if (!ereg("^([a-zA-Z0-9_\.-]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$", $email))

			$log.="emailinvalid\n";

		if ($log==""){

			$log="ok";

			setusername($_SESSION['kapipalist12878498g94j93gj9458'],$name);

			setuseremail($_SESSION['kapipalist12878498g94j93gj9458'],$email);
			
			$poza2 = 'avatar_'.uniqid().".".$ext;
            move_uploaded_file($_FILES['avatar']['tmp_name'], "uploads/".$poza2);
           setuseravatar($_SESSION['kapipalist12878498g94j93gj9458'],$poza2);
		}

	}

	if ($log=="")

	{

		$det=userdetail($_SESSION['kapipalist12878498g94j93gj9458']);

		$name=$det[1];

		$email=$det[2];

	}

?>

	<div id="main">

			<div id="main_2">			        

				<form method="post" action="myprofile.php" enctype="multipart/form-data">

					<div id="page_my_edit_profile">

						<div class="breadcrumbs">

							<a href="index.php" title="Go to Home">Home</a> &gt; 

							<a href="myaccount.php" title="Go to My Account">My Account</a> &gt; Edit Profile

						</div>

						<h1>Edit Profile</h1>

                        <?php if ($log!="ok"){ ?>

						<div id="Input">

							<fieldset>

								<div class="field">

									<label for="Name">

										<strong>Name</strong>

										<abbr title="(required)">*</abbr>

                                        <?php if (substr_count($log,"namerequired")>0){ ?>

                                        <span class="error" style="color:Red;">required</span>

                                        <?php } ?>

									</label>

									<input name="name" type="text" value="<?php echo $name;?>" class="text" />

								</div>

								<div class="field">

									<label for="Email">

										<strong>Email</strong>

										<abbr title="(required)">*</abbr>

										<?php if (substr_count($log,"emailrequired")>0){ ?>

                                        <span class="error" style="color:Red;">required</span>

                                        <?php }else if (substr_count($log,"emailinvalid")>0){ ?>

                                        <span class="error" style="color:Red;">not valid</span>

                                        <?php } ?>

									</label>

									<input name="email" type="text" value="<?php echo $email;?>" class="text" />
									
										

								</div>
								<div class="field"><label for="avatar">Avatar</label><input name="avatar" type="file" value="" class="text" /></div>

								<div class="buttons">

									<input type="submit" name="update" value="Update Profile" class="ok" />

									<a href="myaccount.php">Cancel and return to My Account</a>

								</div>

							</fieldset>        

						</div>

                        <?php }else{ ?>

						<div>

							<div class="success">

								<h3>Profile Updated</h3>

								<p>Your profile has been updated.</p>

								<a href="myaccount.php">Go to My Account</a>

							</div>

						</div>

                        <?php } ?>

					</div>

				</form>

				<div class="clearer"></div>

			</div>									

	</div>

<?php

	include_once("footer.php");

?>