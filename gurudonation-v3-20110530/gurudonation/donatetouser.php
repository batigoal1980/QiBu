<?php
	include_once("header.php");
	$kid=1;
	if (isset($_GET['kid']))
		$kid=$_GET['kid'];
	if (isset($_POST['kid']))
		$kid=$_POST['kid'];
	$kurl="project.php?id=".$kid;
	$det=kapipaldetail($kid);
	$cine=$det[1];
	$cine1=userdetail($cine);
	$paypaluseremail=$cine1['7'];
	$paypaluseremail2=$det['6'];
	//print $paypaluseremail2;
	$amount=0;
	$log="";
	if (isset($_POST['Send'])){
		if (isset($_POST['amount'])){
			$amount=$_POST['amount'];
			if ($amount<$det[5]) $log.="min\n";
		}
		if (isset($_POST['fixed_amount']))
			$amount=$_POST['fixed_amount'];
		$leavemessage=$_POST['leavemessage'];
		$name=$_POST['name'];
		$message=$_POST['message'];
		if ($log==""){
			$_SESSION['newcontribute']=array("kapipal192389347"=>$kid,"amount1927838743"=>$amount,"leavemessage"=>$leavemessage,"name"=>$name,"message"=>$message);
			//print_r ($_SESSION['newcontribute']);
			//die;
			$log="ok";
		}
	}
?>
<?php if ($log!="ok"){ ?>
	<div id="main">
			<div id="main_2">			        
				<form method="post" action="donate.php">
	                <input type="hidden" name="kid" value="<?php echo $kid;?>"/>
                	<input type="hidden" name="leavemessage" id="leavemessage" value="0"/>
			<input type="hidden" name="paypalue" value="<?php print $paypaluseremail;?>">
					<div id="page_pay_kapipal">
	                    <br/>
						<h1><a href="<?php echo $kurl;?>"><?php echo $det[2];?></a> &raquo; Send Money</h1>
						<div id="how">
							<div id="how_1">
								<h3>How It Works?</h3>
									<ol>
										<li>Enter the amount to send</li>
										<li>Pay with PayPal&trade;</li>
										<li>The money goes immediately and directly to <a href="<?php echo $kurl;?>" target="_blank" title="Go to Project"><?php echo idtoname($det[1]);?></a></li>
									</ol>
									It's <strong>secure</strong>, <strong>easy</strong> and <strong>fun</strong>! <a href="learn-more.php" target="_blank" title="Learn more about this site">Learn More</a>
							</div>
						</div>
						<fieldset id="left">
							<div class="field amount">
								<label for="Amount">
									<strong>Amount to Send:</strong>
									<abbr title="(required)">*</abbr>
                                    <?php if ($det[10]==""){ ?>
									<span class="instruction">Minimum <?php echo "$".$det[5];?></span>
                                    <?php } ?>
                                    <?php if (substr_count($log,"min")>0){ ?>
                                    <span id="ctl00_plcBody_vldAmountMin" class="error" style="color:Red;">Min <?php echo "$".$det[5];?></span>
                                    <?php } ?>
								</label>
								<div class="box">
	                                <?php
                                    	if ($det[10]!=""){
											$lists="";
											$b=explode("\n",$det[10]);
											for ($i=0;$i<count($b);$i++)
											{
												$var=$b[$i];
												$lists.="<div class='fixed_amount'>
														<input type='radio' name='fixed_amount' value='".$var."' checked/>
														<label class='inline'>$<strong>".$var."</strong></label></div>";
											}
											echo $lists;
										}else{ 
									?>
									<input name="amount" type="text" value="<?php echo $det[5];?>" class="text" style="width:100px"/>
                                    <?php } ?>
								</div>
								<div class="clearer"></div>
                                <script>
									function showmessage()
									{
										if (document.getElementById("leavemessage").value==0)
										{
											document.getElementById("box_message").style.display="inherit";
											document.getElementById("leavemessage").value=1;
										}else{
											document.getElementById("box_message").style.display="none";
											document.getElementById("leavemessage").value=0;
										}
									}
									
									function messagechange()
									{
										var name,message;
										var today = new Date();
										message=document.getElementById("message").value;
										name=document.getElementById("name").value;
										name=String(name).trim();
										message=String(message).trim();
										if (message!=""){
											document.getElementById("preview_message").innerHTML=message;
											if (name!="")
												document.getElementById("preview_name").innerHTML=name;
											else
												document.getElementById("preview_name").innerHTML="Anonymous";
											document.getElementById("pay_date").innerHTML=today.toDateString();
										}else{
											document.getElementById("preview_message").innerHTML="";
											document.getElementById("preview_name").innerHTML="";
										}
									}
								</script>
								<h2 id="showMessage"><a href="#" onClick="showmessage()">Leave a Message (optional) &raquo;</a></h2>
								<p>Click to write a public message on <?php echo idtoname($det[1]);?>'s page</p>
								<div id="box_message" style="display:none">
									<div class="field message">
										<label for="Text"><strong>Message:</strong></label>
										<input name="message" id="message" type="text" maxlength="200" class="text" onKeyUp="messagechange()"/>
									</div>
									<div class="field name">
										<label for="Name">
											<strong>Display Name:</strong>
											<span class="instruction"></span>
										</label>
										<input name="name" id="name" type="text" maxlength="25" class="text" onKeyUp="messagechange()"/>
									</div>
									<h4>preview message:</h4>
									<div id="preview">
										<div id="preview_box">
											<em id="preview_message"></em>
                                            <label id="pay_date"></label>
											<strong id="preview_name"></strong>
										</div>
									</div>
								</div>
							</div>
							<div class="buttons">
								<p>You're almost done! Click Send Money to <strong>pay securely</strong>!</p>
                                <input type="submit" name="Send" value="Send Money &raquo;" style="font-size: 22px; border: none; padding: 5px; color: #fff; background-color: #0065A3; float: right; margin-left: 15px;"/>
								<a href="<?php echo $kurl;?>" title="Don't Send Money">Cancel</a>
							</div>
						</fieldset>
					</div>
					</form>
				<div class="clearer"></div>
			</div>									
	</div>
<?php }else{
	
	$paypalue=$_REQUEST['paypalue'];
	//this is the donation requesters paypal address
	?>
<body onLoad="document.form.submit();">
	
	<div id="main">
			<div id="main_2" align="center">
            <br/><br/>
            <h2 align="center">Please wait until we forward you to Paypal</h2>
            <br/><br/>
            <form method="post" name="form" action="https://www.paypal.com/cgi-bin/webscr" target="_parent">
		<?php
		if ($paypaluseremail2!=""){
		?>
		    <input type="hidden" name="business" value="<?php echo $paypaluseremail2;?>" />
		<?php }
		else {
		?>
     <input type="hidden" name="business" value="<?php echo $paypalue;?>" />
     <?php } ?>
     <!-- <input type="hidden" name="business" value="<?php echo siteinfo("adminpaypal");?>" /> -->
	<!--   <input type="hidden" name="business" value="ithink_1300363330_biz@gmail.com" /> -->
                <input type="hidden" name="cmd" value="_xclick" />
                <input type="hidden" name="image_url" value="<?php echo $domainurl."images/logo.gif";?>" />
                <input type="hidden" name="return" value="<?php echo $domainurl.$kurl;?>" />
                <input type="hidden" name="cancel_return" value="<?php echo $domainurl.$kurl;?>" />
                <input type="hidden" name="notify_url" value="<?php echo $domainurl."ipn.php";?>" />
                <input type="hidden" name="rm" value="2" />
                <input type="hidden" name="currency_code" value="USD" />
                <input type="hidden" name="lc" value="US" />
                <input type="hidden" name="bn" value="toolkit-php" />
                <input type="hidden" name="cbt" value="Continue" />
                <input type="hidden" name="no_shipping" value="" />
                <input type="hidden" name="no_note" value="1" />
                <input type="hidden" name="cn" value="Comments" />
                <input type="hidden" name="cs" value="" />
		<input type="hidden" name="custom" value="<?php print $name."|".$message;?>" />
                <input type="hidden" name="item_name" value="<?php echo $det[2];?>" />
                <input type="hidden" name="amount" value="<?php echo $amount;?>" />
                <input type="hidden" name="item_number" value="<?php echo $kid;?>" />
            </form>
            </div>
	</div>
<?php
	}
	include_once("footer.php");
?>
