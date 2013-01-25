<?php
	include_once("header.php");
	if (!isset($_SESSION['kapipalist12878498g94j93gj9458']))
	{
		?><script>window.location.href="index.php";</script><?php
	}
	$amount=0;
	$log="";
	if (isset($_POST['continue'])){
		$amount=$_POST['amount'];
		if ($amount>getbalance($_SESSION['kapipalist12878498g94j93gj9458']))
			$log="overbalance";
		else if ($amount==0)
			$log="zero";
		if ($log=="")
		{
			$log="ok";
			
			$fp=siteinfo("feepercent");
			$ff=siteinfo("fixedfee");
			$amount2=$amount-$ff;
			$ff2=$amount2;
			$count2=($amount*$fp)/100;
			$count3=$amount2-$count2;
			$fp2=$amount2;
                        $amount2 = number_format($count3, 2);
			$fp2=$amount2;
			
			newwithdrawal($_SESSION['kapipalist12878498g94j93gj9458'],$amount2);
			$body="Hi ".idtoname($_SESSION['kapipalist12878498g94j93gj9458']).",<br/>
				   Your withdrawal request of $amount has just been sent successfully.<br/>
				   Note that the actual sum you will receive is <b>$amount2</b><br/>
				   Fixed fee applied: $ff Usd - as $ff2<br/>
				   Fee percent applied: $fp % - as $fp2<br/>
				   Please note, if fixed fee exists it will be first applied to your withdraw
				   request and than the fee percent will be applied
				   to the value of the widtdraw request minus the fixed fee.<br/>
				   We'll process it within 24 hours.<br/>";
			sendemail(idtoemail($_SESSION['kapipalist12878498g94j93gj9458']),"GuruDonation Support",$body);
			setbalance($_SESSION['kapipalist12878498g94j93gj9458'],getbalance($_SESSION['kapipalist12878498g94j93gj9458'])-$amount);
		}
	}
?>
	<div id="main">
			<div id="main_2">			        
				<div id="page_edit_kapipal">    
					<div class="breadcrumbs">
						<a href="index.php" title="Go to Home">Home</a> &gt; <a href="myaccount.php" title="My Account">My Account</a> &gt; Withdraw Money
					</div>
					<h1>Withdraw Money(Balance $<?php echo getbalance($_SESSION['kapipalist12878498g94j93gj9458']);?>)</h1>
                    <?php if ($log!="ok"){ ?>
                    <form name="newForm" method="post" action="withdraw.php" enctype="multipart/form-data">
                    <div>
						<fieldset>
							<div class="field amount">
								<label for="Amount">
									<strong>Amount to withdraw:</strong>
									<abbr title="(required)">*</abbr>
									<span class="instruction">How much would you like to withdraw now?</span>
									<?php if (substr_count($log,"overbalance")){ ?>
										<span class="error" style="color:Red;">over balance error</span>
									<?php }else  if (substr_count($log,"zero")){?>
	                                    <span class="error" style="color:Red;">amount to withdraw required</span>
									<?php } ?>
								</label>
								<div class="text_amount box short">
									<span>$</span>
									<input name="amount" type="text" class="currency" value="<?php echo $amount;?>" onkeypress="feeshow()"/>
								</div>
							</div>
                            <div class="buttons">
								<input type="submit" name="continue" value="Submit" class="ok" />
								<a href="myaccount.php">Cancel</a>
							</div>
						</fieldset>
					</div>
                    </form>
                    <?php }else{ ?>
                    <div id="Success">
						<div class="success">
							<h3>Withdrawal Request has been sent</h3>
							<p>Your withdrawal has been submitted successfully.</p>
							<p>Your withdrawal request will be processed within a day.</p>
							<a href="myaccount.php">Continue</a>
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