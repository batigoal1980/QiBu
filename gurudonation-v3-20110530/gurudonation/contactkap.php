<?php
	include_once("header.php");
	$captcha="";
	$image="";
	$captchatext="";
	$name="";
	$message="";
	$email="";
	$log="";
	$kid=1;
	if (isset($_GET['kid']))
		$kid=$_GET['kid'];
	if (isset($_POST['kid']))
		$kid=$_POST['kid'];
	$det=kapipaldetail($kid);
	if (isset($_POST['Send'])){
		$captcha=$_SESSION["dlkfjlw0938409klj3498ejf09adj2jf0e9jdf04kjkgjlaowkj3405"];
		$image=$_SESSION["captchaimgurl"];
		$name=$_POST['name'];
		$message=$_POST['message'];
		$email=$_POST['email'];
		$captchatext=$_POST['captchatext'];
		if ($name=="") $log="name\n";
		if ($message=="") $log.="message\n";
		if ($email=="") 
			$log.="emailrequired\n";
		else if (!ereg("^([a-zA-Z0-9_\.-]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$", $email))
			$log.="emailinvalid\n";
		if ($captcha!=$captchatext) $log.="captcha\n";
		if ($log=="")
		{
			$log="ok";
			sendrepliableemail(idtoemail($det[1]),"GuruDonation Support - ".$name."'s message",$message,$email);
		}
	}
	if ($log!="ok"){
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
	}
	$kurl="project.php?id=".$kid;
?>
	<div id="main">
			<div id="main_2">			        
				<div id="page_contact_kapipal">
					<h1>
						Contact <?php echo idtoname($det[1]);?>
						<span>creator of <?php echo $det[2];?></span>
					</h1>
                    <?php if ($log=="ok"){ ?>
					<div class="success">
						<h3>Message Sent</h3>
						<a href="<?php echo $kurl;?>">Go to Project</a>
					</div>
                    <?php }else{ ?>
                    <form action="contactkap.php" method="post">
                    <input type="hidden" name="kid" value="<?php echo $kid;?>"/>
					<div>
						<fieldset>
							<div class="field">
								<label for="Name">
									<strong>Your Name</strong>
									<abbr title="(required)">*</abbr>
									&nbsp;
                                    <?php if (substr_count($log,"name")){ ?>
                                    <span class="error" style="color:Red;">required</span>
                                    <?php } ?>
								</label>
								<input name="name" type="text" class="text medium" />
							</div>
							<div class="field">
								<label for="Email">
									<strong>Your Email</strong>
									<abbr title="(required)">*</abbr>
									<span class="instruction">To receive a reply</span>
                                    <?php if (substr_count($log,"emailrequired")){ ?>
                                    <span class="error" style="color:Red;">required</span>
                                    <?php }else if (substr_count($log,"emailinvalid")){ ?>
                                    <span class="error" style="color:Red;">not valid</span>
                                    <?php } ?>
								</label>
								<input name="email" type="text" class="text medium" />
							</div>
							<div class="field">
								<label for="Message">
									<strong>Message</strong>
									<abbr title="(required)">*</abbr>
									&nbsp;
                                    <?php if (substr_count($log,"message")){ ?>
                                    <span class="error" style="color:Red;">required</span>
                                    <?php } ?>
								</label>
								<textarea name="message" rows="2" cols="20"></textarea>
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
                                <input name="captchatext" type="text" size="5" class='text medium' value="" />
							</div>
						</div>
					</div>
					<div class="buttons">
						<input type="submit" name="Send" value="Send Message" class="ok" />
						<a href="<?php echo $kurl;?>" title="Go to Project">Cancel</a>
					</div>
                    </form>
                    <?php } ?>
				</fieldset>
			</div>
		</div>
		</form>
		<div class="clearer"></div>
	</div>
<?php
	include_once("footer.php");
?>