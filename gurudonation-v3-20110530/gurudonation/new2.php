<?php
	include_once("header.php");
	$log="";
	$loginemail="";
	$loginpass="";
	$registeremail="";
	$displayname="";
	$pass1="";
	$pass2="";
	$paypalid="";
	
	if (isset($_POST['Login']))
	{
		$loginemail=$_POST['loginemail'];
		$loginpass=$_POST['password'];
		if ($loginemail=="")
			$log.="loginemailrequired\n";
		if (!ereg("^([a-zA-Z0-9_\.-]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$", $loginemail))
			$log.="loginemailinvalid\n";
		if (!userexistbyemail($loginemail))
			$log.="loginemailnotexist\n";
		if (!guru_decrypt(getpassword(emailtoid($loginemail)),$loginpass))
			$log.="loginpasswrong\n";
		if ($log==""){
			$id=emailtoid($loginemail);
			newkapipal($id,$_SESSION['newkapipal']['title'],$_SESSION['newkapipal']['amount'],$_SESSION['newkapipal']['duration'],$_SESSION['newkapipal']['mincontribution'],"",$_SESSION['newkapipal']['imgurl'],$_SESSION['newkapipal']['siteurl'],$_SESSION['newkapipal']['description'],$_SESSION['newkapipal']['fixedcontribution'],"n");
			$_SESSION['kapipalist12878498g94j93gj9458']=$id;
			$_SESSION['status']="kapipalcreated";
			$kapipalid=kapipalidbyusername($id);
			echo "<script>window.location.href=\"project.php?id=".$kapipalid."\";</script>";
		}else
			$log.="loginprocess\n";
	}else if (isset($_POST['Register']))
	{
		$registeremail=$_POST['registeremail'];
		$displayname=$_POST['displayname'];
		$paypalid=$_POST['paypalid'];
		$pass1=$_POST['pass1'];
		$pass2=$_POST['pass2'];
		if ($registeremail=="") 
			$log.="registeremailrequired\n";
		else if (!ereg("^([a-zA-Z0-9_\.-]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$", $registeremail))
			$log.="registeremailinvalid\n";
		else if (userexistbyemail($registeremail))
			$log.="registeremailalreadytaken\n";
		if ($displayname=="") 
			$log.="displaynamerequired\n";
		else if (userexistbyname($displayname))
			$log.="displaynametaken\n";
		if ($paypalid=="") $log.="missingpaypal\n";
		else if (!ereg("^([a-zA-Z0-9_\.-]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$", $paypalid))
			$log.="paypalinvalid\n";
		if ($pass1=="") $log.="pass1\n";
		if ($pass2=="") 
			$log.="pass2\n";
		else 
			if ($pass1!=$pass2) $log.="passdifferent\n";
		if (!isset($_POST['chkprivacy']))
			$log.="chkprivacy\n";
		if ($log==""){
			$keycode=generatecode();
			if (newuser($displayname,$registeremail,$pass1,$keycode,"n",$paypalid)){
				$log="ok";
				newkapipal(nametoid($displayname),$_SESSION['newkapipal']['title'],$_SESSION['newkapipal']['amount'],$_SESSION['newkapipal']['duration'],$_SESSION['newkapipal']['mincontribution'],"",$_SESSION['newkapipal']['imgurl'],$_SESSION['newkapipal']['siteurl'],$_SESSION['newkapipal']['description'],$_SESSION['newkapipal']['fixedcontribution'],"n");
				$body="<p>Hi ".$displayname.",</p>
					   <p>Thanks for registering with GuruDonation.com. You're almost ready to get started, but first we need you to activate your account by clicking on the link below:</p>";
				$url=$domainurl."verify.php?key=".$keycode;
				$body.="<p><a href='$url'>$url"."</a></p>
						<p>Note: If the above URL is spilt into 2 lines, copy and paste the entire URL into the address bar of your browser instead of clicking the URL from this email.</p>
						<p>Without this confirmation, you will not able to start your Project and you will not receive any money.</p>
						<p>If you did not register with GuruDonation.com, someone probably mis-typed their email address. You can ignore this message, we apologize for the inconvenience.</p>
						Have a Great Day!<br/>
						The Guruscript Team<br/>
						<a href='".$domainurl."'>".$domainurl."</a>";
				sendemail($registeremail,"Confirm Your Project",$body);
				unset($_POST);
			}
		}else
			$log.="registerprocess\n";
	}
?>
	<div id="main">
			<div id="main_2">			        
				<form name="aspnetForm" method="post" action="new2.php" enctype="multipart/form-data">
					<div id="page_edit_kapipal">
						<div class="breadcrumbs"><a href="index.php" title="Go to Home">Home</a> &gt; Create Project</div>
						<h1>Create New Project</h1>
                        <?php if ($log!="ok"){ ?>
                        <?php if (substr_count($log,"registerprocess")>0){ ?>
                        <div class="error">
							<h3>Missing Data</h3>
							<p>Please fill out all the required fields to continue</p>
						</div>
                        <input type="hidden" name="hdnstate" id="hdnState" value="register"/>
                        <?php }else if (substr_count($log,"loginprocess")>0){ ?>
						<div class="error">
							<h3>Login Error</h3>
							<p>Please check email and password and try again.</p>
						</div>
                        <input type="hidden" name="hdnstate" id="hdnState" value="login"/>
                        <?php }else{ ?>
                        <input type="hidden" name="hdnstate" id="hdnState" value="register"/>
                        <?php } ?>
						<div class="auth">
							<fieldset id="login">                    
								<h2 class="step">Step 2 of 2: <span>Login</span></h2>
								<p class="switch">Please confirm your identity to continue (or <a id="showRegister" href="#register">Create a new account</a>)</p>
								<div class="field email">
									<label for="EmailLogin" id="emaillogin"><strong>Email:</strong></label>
									<input name="loginemail" type="text" class="text" />
								</div>
								<div class="field password">
									<label for="PasswordLogin">
										<strong>Password:</strong>
									</label>
									<div class="box">
										<input name="password" type="password" id="passwordlogin" class="text" />
										<a class="remind_password" target="_blank" href="forgot.php">Forgot your password?</a>
									</div>
								</div>
								<div class="buttons">
									<input type="submit" name="Login" value="Login and Finish >>" class="ok" id="btnLogin"/>
									<a href="new.php">Back</a>
								</div>
							</fieldset>
							
                            <fieldset id="register">             
								<h2 class="step">Step 2 of 2: <span>Create a Free Account</span></h2>
								<p class="switch">Already registered? <a id="showLogin" href="#login">Login</a> into your account</p>         
								<div class="field email">
									<label for="Email">
										<strong>Email:</strong>
										<abbr title="(required)">*</abbr>
										<span class="instruction">We'll send your activation email here</span>
                                        <?php if (substr_count($log,"registeremailrequired")){ ?>
                                        <span class="error" style="color:Red;">required</span>
                                        <?php }else if (substr_count($log,"registeremailinvalid")){ ?>
                                        <span class="error" style="color:Red;">not valid</span>
                                        <?php }else if (substr_count($log,"registeremailalreadytaken")){ ?>
                                        <span class="error" style="color:Red;">already registered</span>
                                        <?php } ?>
									</label>
									<input name="registeremail" type="text" class="text"  id="emailregister" value="<?php echo $registeremail;?>"/>
								</div>
								<div class="field name">
									<label for="Display Name">
										<strong>Display name:</strong>
										<abbr title="(required)">*</abbr>
										<span class="instruction">Your real name, or a nickname</span>
                                        <?php if (substr_count($log,"displaynamerequired")){ ?>
                                        <span class="error" style="color:Red;">required</span>
                                        <?php }else if (substr_count($log,"displaynametaken")){ ?>
                                        <span class="error" style="color:Red;">already registered</span>
                                        <?php } ?>
									</label>
									<input name="displayname" type="text" class="text" value="<?php echo $displayname;?>"/>
								</div>
                                <div class="field name">
									<label for="Paypal ID">
										<strong>Paypal ID:</strong>
										<abbr title="(required)">*</abbr>
										<span class="instruction">We'll send money to this paypal account</span>
                                        <?php if (substr_count($log,"missingpaypal")){ ?>
                                        <span class="error" style="color:Red;">required</span>
                                        <?php }else if (substr_count($log,"paypalinvalid")){ ?>
                                        <span class="error" style="color:Red;">not valid</span>
                                        <?php } ?>
									</label>
									<input name="paypalid" type="text" class="text" value="<?php echo $paypalid;?>"/>
								</div>
								<div class="field password">
									<label for="Password">
										<strong>Password:</strong>
										<abbr title="(required)">*</abbr>
										<span class="instruction"></span>
                                        <?php if (substr_count($log,"pass1")){ ?>
                                        <span class="error" style="color:Red;">required</span>
                                        <?php } ?>
									</label>
									<input name="pass1" type="password" class="text" value="<?php echo $pass1;?>"/>
								</div>
								<div class="field password">
									<label for="Password">
										<strong>Confirm password:</strong>
										<abbr title="(required)">*</abbr>
										<span class="instruction"></span>
                                        <?php if (substr_count($log,"pass2")){ ?>
                                        <span class="error" style="color:Red;">required</span>
                                        <?php }else if (substr_count($log,"passdifferent")){ ?>
                                        <span class="error" style="color:Red;">the passwords are different</span>
                                        <?php } ?>
									</label>
									<input name="pass2" type="password" class="text" value="<?php echo $pass2;?>"/>
								</div>
								<div class="field tos">
									<label for="Privacy">
										<strong>&nbsp;</strong>
									</label>
									<input type="checkbox" name="chkprivacy" />
                                    <?php if (substr_count($log,"chkprivacy")){ ?>
									<span class="error" style="color:Red;">required</span>
									<?php } ?>
									<label class="inline">I have read, understand, and agree to the <a href="terms.php" target="_blank" title="Terms of Use">Terms of Use</a> </label>
								</div>  
								<div class="buttons">
									<input type="submit" name="Register" value="Register and Finish >>" class="ok" id="btnRegister"/>
									<a href="new.php">Back</a>
								</div>
							</fieldset>
						</div>
                        <?php }else{ ?>
						<div id="Success">
							<div class="success">
								<h3>Project Created - Confirmation Required</h3>                            
								<p>Congratulations! You have successfully created the Project <strong><?php echo $_SESSION['newkapipal']['title'];?></strong>.</p>
								<p>An email has been sent to <strong><?php echo $registeremail;?></strong> with a confirmation link.
								<br />When you receive the email, <strong>click the link to start your Project</strong>!</p>
								<a href="index.php">Continue</a>
							</div>
						</div>
                        <?php } ?>
					</div>
					<script src="js/new.js" type="text/javascript"></script>
				</form>
				<div class="clearer"></div>
			</div>									
	</div>
<?php
	include_once("footer.php");
?>