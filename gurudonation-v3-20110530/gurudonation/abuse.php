<?php
	include_once("header.php");

	$captcha="";
	$image="";
	$pageaddr="";
	$reason="";
	$email="";
	$captchatext="";
	$log="";
	
	if (isset($_POST['Send'])){
		$captcha=$_SESSION["dlkfjlw0938409klj3498ejf09adj2jf0e9jdf04kjkgjlaowkj3405"];
		$image=$_SESSION["captchaimgurl"];
		$pageaddr=$_POST['pageaddr'];
		$reason=$_POST['reason'];
		$email=$_POST['email'];
		$captchatext=$_POST['captchatext'];
		if ($pageaddr=="") $log="pageaddr\n";
		if ($reason=="") $log.="problem\n";
		if ($captcha!=$captchatext) $log.="captcha\n";
		if ($log=="")
		{
			$log="ok";
			newabuse($pageaddr,$reason,$email);
		}
	}
	
	$cpath="";
	if (isset($_SESSION["captchaimgurl"]))
		$cpath=$_SESSION["captchaimgurl"];
	$cpath=stripslashes($cpath);
	if ($cpath!="") unlink($cpath);
	$result = getCaptcha();
	$captcha=$result[0];
	$image=$result[2];
	$_SESSION["dlkfjlw0938409klj3498ejf09adj2jf0e9jdf04kjkgjlaowkj3405"]=$captcha;
	$_SESSION["captchaimgurl"]=$image;
?>
</div>
	<div id="main">
			<div id="main_2">			        
				<div id="page_abuse">
					<h1>Report Abuse</h1>
                    <?php if ($log!="ok"){ ?> 
					<div id="Input">
						<p>If you discover any Project page containing inappropriate or offensive content, please let us know about it by filling out this form. We'll investigate on it as soon as possible. We appreciate your input.</p>
                        <form action="abuse.php" method="post">
						<fieldset>
							<div class="field">
								<label for="txtUrl">
									<strong>Page Address</strong>
									<abbr title="(required)">*</abbr>
									<span class="instruction">Example: <em>http://GuruDonation.com/abc</em></span>&nbsp;
                                    <?php if (substr_count($log,"pageaddr")){ ?>
                                    <span class="error" style="color:Red;">required</span>
                                    <?php } ?>
								</label>
								<strong> </strong>
								<input name="pageaddr" type="text" class="text" value="<?php echo $pageaddr;?>"/>
							</div>
							<div class="field sep">
								<label for="Reason">
									<strong>Problem</strong>
									<abbr title="(required)">*</abbr>
									<span class="instruction">Example: offensive, obscene, copyright violation, etc.</span>&nbsp;
                                    <?php if (substr_count($log,"problem")){ ?>
                                    <span class="error" style="color:Red;">required</span>
                                    <?php } ?>
								</label>
								<input name="reason" type="text" class="text" value="<?php echo $reason;?>"/>
							</div>
							<div class="field">
								<label for="Email">
									<strong>Your Email</strong>
									<span class="instruction">(Optional) You can leave us an email address so we can contact you</span>
								</label>
								<input name="email" type="text" class="text medium" value="<?php echo $email;?>"/>
							</div>
							<div class="field">
								<label for="Captcha">
									<strong>Enter the code shown</strong>
									<abbr title="(required)">*</abbr>&nbsp;
                                    <?php if (substr_count($log,"captcha")){ ?>
                                    <span class="error" style="color:Red;">not valid</span>
                                    <?php } ?>
								</label>
								<div class='box'>
									<div id="captcha">
                                    	<img src="<?php echo $image;?>" alt="" width="180" height="50" />
									</div>
								<div>
                                <input name="captchatext" type="text" size="5" class='text medium' value="<?php echo $captchatext;?>" />
							</div>
						</div>
					</div>
					<div class="buttons">
						<input type="submit" name="Send" value="Report Abuse" class="ok" />
						<a href="index.php" title="Go to Home">Cancel</a>
					</div>
				</fieldset>
                </form>
			</div>
            <?php }else{ ?>
			<div class="success">          
				<h3>Request Sent</h3>
				<p>We'll investigate as soon as possible. Thanks!</p>
				<a href="index.php">Go to Home</a>
			</div>
            <?php } ?>
		</div>
		<div class="clearer"></div>
    </div>
<?php
	include_once("footer.php");
?>