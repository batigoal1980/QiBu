<?php
	include_once("header.php");
	$log="";
	if (isset($_POST['Reset']))
	{
		$eml=$_POST['email'];
		if ($eml=="")
			$log="Email can't be blank.";
		else if (!ereg("^([a-zA-Z0-9_\.-]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$", $eml))
			$log="Invalid Email id!";
		else{
			$log="ok";
			if (!userexistbyemail($eml)){
				$body.="There 's no user who has this email id on <a href='$domainurl'>$domainurl</a>. <br/>Check it out.<br/>";
				sendemail($eml,"GuruDonation Support",$body);
			}else{				
				$code=generatecode();
				newresetrequest($eml,$code);
				$body="Thank you for using Project. We received a password reset request for this email address (<a href='$eml'>".$eml."</a>) on <a href='$domainurl'>".$domainurl."</a>. To reset your password, click the link below:<br/>";
				$reseturl=$domainurl."reset.php?key=".$code;
				$contacturl=$domainurl."contact.php";
				$body.="<a href='$reseturl'>".$reseturl."</a><br/>
					   If you did not request a password reset, then someone probably mis-typed their email address. You can ignore this message, and we apologize for the inconvenience.<br/><br/>
					   Have a Great Day!<br/>
					   The Guruscript Team<br/><br/>
					   PS: Don't reply to this email, for I am a robot and cannot respond. For any questions, contact our humans at <a href='$contacturl'>$contacturl</a>";
				sendemail($eml,"GuruDonation Support",$body);
			}
		}
	}
?>
	<div id="main">
			<div id="main_2">			        
				<div id="page_remind_password">
					<h1>Reset Password</h1>
                    <?php
						if ($log!="ok"){
					?>
                    <form id="resetfrm" action="forgot.php" method="post">
					<div id="ResetForm">
						<p>If you forgot your password, enter your email address below, and we will send you a link to reset your password.</p>
						<fieldset>
							<div class="field">
								<label for="Email">
									<strong>Email</strong>
									<abbr title="(required)">*</abbr>                    
								</label>
								<input name="email" type="text"  class="text" />
							</div>
							<div class="buttons">
								<input type="submit" name="Reset" value="Reset My Password" class="ok" />
								<a href="index.php">Cancel</a>
							</div>
						</fieldset> 
					</div>
                    </form>
                    <?php }else{ ?>
					<div id="Success">
						<div class="success">
							<h3>Password Change Email has been sent</h3>
							<p>An email has been sent with a link where you can change your password.</p>
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