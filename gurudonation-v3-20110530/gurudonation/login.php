<?php
	include_once("header.php");
	$log="";
	$email="";
	$pass="";
	if (isset($_POST['login']))
	{
		$email=$_POST['email'];
		$pass=$_POST['password'];
		if ($email=="")
			$log="Email can't be blank.";
		else if (!ereg("^([a-zA-Z0-9_\.-]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$", $email))
			$log="Email id is Invalid.";
		else if (!userexistbyemail($email))
			$log="Email id doesn't exist.";
		else if (!guru_decrypt(getpassword(emailtoid($email)),$pass))
			$log="Incorrect Password.";
		else{
			$_SESSION['kapipalist12878498g94j93gj9458']=emailtoid($email);
			?><script>window.location.href="myaccount.php";</script><?php
		}
	}
?>
	<div id="main">
			<div id="main_2">
            	<br/>
				<form name="loginform" method="post" action="login.php">
				<div class="auth">
					<fieldset>
						<h1>Login</h1>
                        <?php if ($log!=""){ ?>
                            <div id="Error">
                                <div class="error">
                                    <h3>Login Error</h3>
                                    <p>Please check email and password and try again.</p>
                                </div>
                            </div>
						<?php } ?>                        
						<div class="field email">
							<label for="Email">
								<strong>Email:</strong>
							</label>
							<input name="email" type="text" class="text" value="<?php echo $email;?>"/>
						</div>
						<div class="field password">
							<label for="Password">
								<strong>Password:</strong>
							</label>
							<div class="box">
								<input name="password" type="password" class="text" value="<?php echo $pass;?>"/>
								<a class="remind_password" href="forgot.php" target="_blank">Forgot your password?</a>
							</div>
						</div>
						<div class="buttons">
							<input type="submit" name="login" value="Login" class="ok" />
							<a href="index.php">Cancel</a>
						</div>
					</fieldset>
				</div>
				</form>
				<div class="clearer"></div>
			</div>						
	</div>
<?php
	include_once("footer.php");
?>