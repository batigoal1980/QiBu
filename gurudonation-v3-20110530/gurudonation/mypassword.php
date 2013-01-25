<?php
	include_once("header.php");
	if (!isset($_SESSION['kapipalist12878498g94j93gj9458'])){
		?><script>window.location.href="index.php";</script><?php
	}
	$log="";
	if (isset($_POST['change']))
	{
		$oldpass=$_POST['oldpassword'];
		$pass1=$_POST['newpassword1'];
		$pass2=$_POST['newpassword2'];
		if ($oldpass=="")
			$log.="oldpassrequired\n";
		if ($pass1=="")
			$log.="pass1required\n";
		else if (strlen($pass1)<4 || strlen($pass1)>16)
			$log.="pass1lenerror\n";
		if ($pass2=="" || $pass1!=$pass2)
			$log.="passdifferent\n";
		if ($log=="")
			if (!guru_decrypt(getpassword($_SESSION['kapipalist12878498g94j93gj9458']),$oldpass))
				$log="error";
			else{
				setpassword($_SESSION['kapipalist12878498g94j93gj9458'],$pass1);
				$log="ok";
			}
	}
?>    
	<div id="main">
			<div id="main_2">			        
				<form method="post" action="mypassword.php">
					<div id="page_my_edit_password">
						<div class="breadcrumbs">
							<a href="index.php" title="Go to Home">Home</a> &gt; 
							<a href="myaccount.php" title="Go to My Account">My Account</a> &gt; Change Password
						</div>
						<h1>Change Password</h1>
                        <?php if ($log=="error"){ ?>
						<div>
							<div class="error">
								<h3>Error</h3>
								<p>Sorry, your request could not be processed now. Please try again later</p>
								<a href="myaccount.php">Return to My Account</a>
							</div>
						</div>
                        <?php }else if ($log=="ok"){ ?>
						<div>
							<div class="success">
								<h3>Password Changed</h3>
								<p>Your password has been changed.</p>
								<a href="myaccount.php">Go to My Account</a>
							</div>
						</div>
                        <?php }else{ ?>
						<div id="Input">
							<fieldset>
								<div class="field sep">
									<label for="Password">
										<strong>Old Password</strong>                    
										<abbr title="(required)">*</abbr>
                                        <?php if (substr_count($log,"oldpassrequired")>0){ ?>
                                        <span class="error" style="color:Red;">required</span>
                                        <?php } ?>
									</label>
									<input name="oldpassword" type="password" class="text" />
								</div>
								<div class="field">
									<label for="Password">
										<strong>New Password</strong>
										<abbr title="(required)">*</abbr>
                                        <?php if (substr_count($log,"pass1required")>0){ ?>
                                        <span class="error" style="color:Red;">required</span>
                                        <?php }else if (substr_count($log,"pass1lenerror")>0){ ?>
                                        <span class="error" style="color:Red;">between 4 and 16 chars</span>
                                        <?php } ?>
									</label>
									<input name="newpassword1" type="password" class="text" />
								</div>
								<div class="field">
									<label for="Password2">
										<strong>Confirm New Password</strong>
										<abbr title="(required)">*</abbr>
                                        <?php if (substr_count($log,"passdifferent")>0){ ?>
                                        <span class="error" style="color:Red;">the passwords are different</span>
                                        <?php } ?>
									</label>
									<input name="newpassword2" type="password" class="text" />
								</div>
								<div class="buttons">
									<input type="submit" name="change" value="Change Password" class="ok" />
									<a href="myaccount.php">Cancel and return to My Account</a>
								</div>
							</fieldset>        
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