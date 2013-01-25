<?php
	include_once("header.php");
	$kid=1;
	if (!isset($_SESSION['kapipalist12878498g94j93gj9458']) && !isset($_SESSION['admin192839748374865']))
	{
		?><script>window.location.href="index.php";</script><?php
	}
	if (isset($_GET['kid']))
		$kid=$_GET['kid'];
	if (isset($_POST['kid']))
		$kid=$_POST['kid'];
	$log="";
	if (isset($_POST['continue']))
	{
		$title=$_POST['title'];
		$amount=$_POST['amount'];
		$duration=$_POST['duration'];
		$mincontribution=$_POST['mincontribution'];
		$paypalid=$_POST['paypalid'];
		$siteurl=$_POST['siteurl'];
		$description=$_POST['description'];
		$fixedcontribution=$_POST['fixedcontribution'];
		if ($title=="") $log="missingtitle\n";
		if ($amount=="") $log.="missingamount\n";
		if ($paypalid=="") $log.="missingpaypal\n";
		else if (!ereg("^([a-zA-Z0-9_\.-]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$", $paypalid))
			$log.="paypalinvalid\n";
		if ($log=="")
		{
			$imgurl="";
			if ($_FILES['uplImage']['name']!="")
				$imgurl=uploadpicture($_FILES['uplImage']);
			if ($imgurl=="")
			{
				$imageradio=$_POST['imageradio'];
				switch ($imageradio)
				{
				case 0: $imgurl="img/default1.jpg";break;
				case 1: $imgurl="img/default2.jpg";break;
				case 2: $imgurl="img/default3.jpg";break;
				case 3: $imgurl="img/default4.jpg";break;
				}
			}
			setkapipaldetail($kid,"title",$title);
			setkapipaldetail($kid,"amounttoraise",$amount);
			setkapipaldetail($kid,"duration",$duration);
			setkapipaldetail($kid,"mincontribution",$mincontribution);
			setkapipaldetail($kid,"paypalemail",$paypalid);
			setkapipaldetail($kid,"image",$imgurl);
			setkapipaldetail($kid,"website",$siteurl);
			setkapipaldetail($kid,"description",$description);
			setkapipaldetail($kid,"fixedcontribution",$fixedcontribution);
			?><script>window.location.href="myprojects.php";</script><?php
		}
	}else{
		$det=kapipaldetail($kid);
		$title=$det[2];
		$amount=$det[3];
		$duration=$det[4];
		$mincontribution=$det[5];
		$paypalid=$det[6];
		$siteurl=$det[8];
		$description=$det[9];
		$fixedcontribution=$det[10];
	}
?>
	<div id="main">
			<div id="main_2">			        
				<form name="editForm" method="post" action="editproject.php" enctype="multipart/form-data">
                	<input type="hidden" name="kid" value="<?php echo $kid;?>"/>
					<div id="page_edit_kapipal">
						<div class="breadcrumbs"><a href="index.php" title="Go to Home">Home</a> &gt; <a href="myaccount.php" title="Go to My Account">My Account</a> &gt; Edit Project</div>
						<h1>Edit Project</h1>
                        <?php if ($log!=""){ ?>
						<div class="error">
							<h3>Missing Data</h3>
							<p>Please fill out all the required fields to continue</p>
						</div>
                        <?php } ?>
						<div>
							<fieldset>
        						<div class="field title">
									<label for="Title">
										<strong>Title:</strong>
										<abbr title="(required)">*</abbr>
										<span class="instruction">Why are you raising money?</span>
                                        <?php if (substr_count($log,"missingtitle")){ ?>
                                        <span class="error" style="color:Red;">Required</span>
                                        <?php } ?>
									</label>
									<input name="title" type="text" maxlength="100" class="text" value="<?php echo $title;?>"/>
								</div>
								<div class="field amount">
									<label for="Amount">
										<strong>Amount to Raise:</strong>
										<abbr title="(required)">*</abbr>
										<span class="instruction">How much would you like to raise?</span>
                                        <?php if (substr_count($log,"missingamount")){ ?>
                                        <span class="error" style="color:Red;">Min $1 - Max $1,000,000</span>
                                        <?php } ?>
									</label>
									<div class="text_amount box short">            
										<span>$</span>
										<input name="amount" type="text" value="<?php echo $amount;?>"/>                
									</div>
								</div>
								<div class="field dateend">
									<label for="duration">
										<strong>Duration:</strong>
										<span class="instruction">By when you need to raise the money?</span>
									</label>
									<div class="box">
										<select name="duration" class="short">
                                        <?php
											$day_array=array("7"=>"7 days","14"=>"14 days","30"=>"1 month","60"=>"2 months","90"=>"3 months","180"=>"6 months","365"=>"1 year");
											$lists="";
											foreach ($day_array as $i=>$var)
											{
												if ($duration==$i)
													$lists.="<option value='$i' selected>$var</option>";
												else
													$lists.="<option value='$i'>$var</option>";
											}
											echo $lists;
										?>
										</select>
									</div>
								</div>
								<div class="field amount">
									<label for="Minimum Contribution">
										<strong>Min Contribution:</strong>
										<abbr title="(required)">*</abbr>
										<span class="instruction">Minimum amount users can send you</span>
									</label>
									<div class="text_amount box short">            
										<span>$</span>
										<input name="mincontribution" type="text" value="<?php echo $mincontribution;?>"/>
									</div>
								</div>   
								<div class="field paypal">
									<label for="PaypalId">
										<strong>Paypal Email:</strong>
										<abbr title="(required)">*</abbr>
										<span class="instruction">Contributions will go directly to this PayPal Account. Email will be visible to contributors.</span>
                                        <?php if (substr_count($log,"missingpaypal")){ ?>
                                        <span class="error" style="color:Red;">Required</span>
                                        <?php }else if (substr_count($log,"paypalinvalid")){ ?>
                                        <span class="error" style="color:Red;">not valid</span>
                                        <?php } ?>
									</label>
									<div class="box">
										<input name="paypalid" type="text" class="text" value="<?php echo $paypalid;?>"/>
										<p id="paypal_info">
										A PayPal Account is required to receive money. If you don't have one, <a href="https://www.paypal.com/" target="_blank">sign up to PayPal</a> (it's free).
										Project doesn't charge you any fee. PayPal may charge you a <a href="http://www.paypal.com/cgi-bin/webscr?cmd=_display-fees-outside" target="_blank">processing fee</a>.
										</p>
									</div>
								</div>
								<div class="field sep image">
									<label for="Image">
										<strong>Image:</strong>
										<span class="instruction">Show an image on your Project page</span>
									</label>
									<div class="box">
										<div class="clearer"></div>                
										<div class="line">
											<span><input type="radio" name="imageradio" value="0" checked="checked" /><label for="radImage1">Collection</label></span>
											<img src="img/default1.jpg" alt="Collection" />
										</div>
										<div class="line">
											<span><input type="radio" name="imageradio" value="1" /><label for="radImage2">Present</label></span>
											<img src="img/default2.jpg" alt="Present" />
										</div>
										<div class="line">
											<span><input type="radio" name="imageradio" value="2" /><label for="radImage3">Wedding</label></span>
											<img src="img/default3.jpg" alt="Wedding" />
										</div>
										<div class="line">
											<span><input type="radio" name="imageradio" value="3" /><label for="noImage">No Image</label></span>
											<img src="img/missing_small.gif" alt="" />
										</div>
										<div class="clearer"></div>                
										<div class="line" style="width: 300px;" >
											<label for="uplImage"><strong>Upload your image</strong> (max 1Mb)</label>
											<input type="file" name="uplImage" class="file" />
										</div>
									</div>
									<div class="clearer"></div>
								</div>
								<h2>Options</h2>
								<div class="field url">
									<label for="siteurl">
										<strong>Website (recommended):</strong>
										<span class="instruction">A site where users can find more about you or about this Project.<br />Ex. your site, blog, Twitter, MySpace, LinkedIn...</span>
									</label>
									<input name="siteurl" type="text" maxlength="1000" class="text" value="<?php echo $siteurl;?>"/>
								</div>
								<div class="field description">
									<label for="Description">
										<strong>Description:</strong>
										<span class="instruction">
											If you want to succeed, give the details, prove your identity, convince users to partecipate.<br /><br />Left <span id="leftchars">-</span> chars</span>
									</label>
									<textarea name="description" rows="2" cols="20"><?php echo $description;?></textarea>
								</div>
								<div class="field fixed">
									<label for="fixedcontribution">
										<strong>Fixed Contribution Amounts:</strong>
										<span class="instruction">Enter the set amounts that users can send you</span>
									</label>
									<div class="box">
										<textarea name="fixedcontribution" rows="2" cols="20" class="short"><?php echo $fixedcontribution;?></textarea> 
										Enter 1 amount per line, for example:<br /><br />
										10<br />
										25<br />
										50<br /><br />
										To allow free contributions, leave this box empty
									</div>
								</div>
                                <div class="buttons">
									<input type="submit" name="continue" value="Continue" class="ok" />
									<a href="myprojects.php">Cancel</a>
								</div>
							</fieldset>
						</div>
					</div>
				</form>
				<div class="clearer"></div>
			</div>									
	</div>
<?php
	include_once("footer.php");
?>