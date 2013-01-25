<?php
	include_once("header.php");
	$key="";
	$pass1="";
	$pass2="";
	$log="";
	if (isset($_GET['key']))
		$key=$_GET['key'];
	if (isset($_POST['key']))
		$key=$_POST['key'];
	if ($key==""){
		?><script>window.location.href="index.php";</script><?php
	}else if (!isexistkey($key)){
		?><script>window.location.href="index.php";</script><?php
	}else if(isset($_POST['Save'])){
		$pass1=$_POST['pass1'];
		$pass2=$_POST['pass2'];
		if ($pass1=="" || $pass2=="")
			$log="Missing Field";
		else if ($pass1!=$pass2)
			$log="Unmatched Passwords";
		else{
			setpassword(emailtoid(keytoemail($key)),$pass1);
			removebyemail(keytoemail($key));
			$_SESSION['kapipalist12878498g94j93gj9458']=emailtoid(keytoemail($key));
			$log="ok";
		}
	}
?>
	<div id="main">
			<div id="main_2">			        
				<div id="page_reset_password" class="auth">
					<h1>Reset Password</h1>
                    <?php
						if ($log!="ok"){
					?>
					<div id="Input">
						<fieldset>
                        	<form action="reset.php" method="post">
                            <input type="hidden" name="key" value="<?php echo $key;?>"/>
							<h2>Please Enter a New Password</h2>
							<?php if ($log=="Missing Field"){ ?>
                                <div class="error">
                                    <h3>Missing Field</h3>
                                    <p>Please fill out all the password fields.</p>
                                </div>
                            <?php }else if ($log=="Unmatched Passwords"){ ?>
                            	<div class="error">
                                    <h3>Unmatched Passwords</h3>
                                    <p>Password and Confirmation password don't match.</p>
                                </div>
							<?php } ?>
							<div class="field email">
								<label><strong>Email:</strong></label>
								<strong><?php echo keytoemail($key);?></strong>
							</div>
							<div class="field password">
								<label for="Password"><strong>New Password:</strong><abbr title="(required)">*</abbr></label>
								<input name="pass1" type="password" class="text" value="<?php echo $pass1;?>"/>
							</div>
							<div class="field password">
								<label for="Password"><strong>Confirm New Password:</strong><abbr title="(required)">*</abbr></label>
								<input name="pass2" type="password" class="text" value="<?php echo $pass2;?>"/>
							</div>
							<div class="buttons">
								<input type="submit" name="Save" value="Save My Password" class="ok" />
								<a href="index.php">Cancel</a>
							</div>
                            </form>
						</fieldset>
					</div>
					<?php }else{ ?>
                    <div id="Success">
						<div class="success">
							<h3>Congratulations, your password has been changed</h3>
							<p>Your password has been changed. The next time you come to Project, you can login with your new password.</p>
							<a href="myaccount.php">Go to My Account</a>
						</div>
					</div>
                    <?php } ?>
    			</div>
				<div class="clearer"></div>
			</div>									
	</div>
<?php
	include_once("footer.php");
?>