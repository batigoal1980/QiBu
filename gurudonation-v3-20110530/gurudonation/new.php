<?php
	include_once("header.php");
	$log="";
	$title="";
	$amount="";
	if (isset($_POST['amount']))
		$amount=$_POST['amount'];
	$duration=30;
	$mincontribution="1";
	$siteurl="";
	$description="";
	$fixedcontribution="";
	$catepicture="img/default4.gif";
	
	if (isset($_POST['continue']))
	{
		$title=$_POST['title'];
		$amount=$_POST['amount'];
		$duration=$_POST['duration'];
		$mincontribution=$_POST['mincontribution'];
		$siteurl=$_POST['siteurl'];
		$description=$_POST['description'];
		$fixedcontribution=$_POST['fixedcontribution'];
		$catepicture=$_POST['category'];
		
		if ($title=="") $log="missingtitle\n";
		if ($amount=="") $log.="missingamount\n";
		if ($log=="")
		{
			$imgurl="";
			if ($_FILES['uplImage']['name']!="")
				$imgurl=uploadpicture($_FILES['uplImage']);
			if ($imgurl=="") $imgurl=$catepicture;
			$_SESSION['newkapipal']=array("title"=>$title,"amount"=>$amount,"duration"=>$duration,"mincontribution"=>$mincontribution,"imgurl"=>$imgurl,"siteurl"=>$siteurl,"description"=>$description,"fixedcontribution"=>$fixedcontribution);
			?><script>window.location.href="new2.php";</script><?php
		}
	}
?>
	<div id="main">
			<div id="main_2">			        
				<form name="newForm" method="post" action="new.php" enctype="multipart/form-data">
					<div id="page_edit_kapipal">
						<div class="breadcrumbs"><a href="index.php" title="Go to Home">Home</a> &gt; Create Project</div>
						<h1>Create New Project</h1>
                        <?php if ($log!=""){ ?>
						<div class="error">
							<h3>Missing Data</h3>
							<p>Please fill out all the required fields to continue</p>
						</div>
                        <?php } ?>
						<div>
							<fieldset>
								<h2 class="step">Step 1 of 2: <span>Configure Your Project</span></h2>
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
									<div class="text_amount box short"><font style="font-size:42px; font-weight:bold;">$</font>           
										<input name="amount" size=6 type="text" class="text" value="<?php echo $amount;?>"/>             
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
									<div class="text_amount box short"><font style="font-size:42px; font-weight:bold;">$</font>            
										<input name="mincontribution" type="text" class="text" value="<?php echo $mincontribution;?>"/>
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
                                        <script>
											function changecate(){
												document.getElementById("catepicture").src=document.getElementById("category").value;
											}
										</script>
                                        <select id="category" name="category" style="width:200px" onchange="changecate()">
                                        <?php
											$a=cateids();
											$lists="";
											foreach ($a as $var){
												$det=catedetail($var);
												$det[2]=addslashes($det[2]);
												if ($det[2]==$catepicture)
													$lists.="<option value='$det[2]' selected>".$det[1]."</option>";
												else
													$lists.="<option value='$det[2]'>".$det[1]."</option>";
											}
											echo $lists;
										?>
                                        </select>
                                        <img src="<?php echo $catepicture;?>" width="100px" height="100px" id="catepicture"/>
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
											If you want to succeed, give the details, prove your identity, convince users to partecipate.<br /><br />
											<script type="text/javascript" src="charactercounter.js"></script>
											<span id="sBann" class="minitext">500 characters left.</span>
											<!--Left <span id="leftchars">-</span> chars</span>-->
									</label>
									<textarea name="description" id="eBann" rows="2" maxlength="500" cols="20" onKeyUp="toCount('eBann','sBann','{CHAR} characters left',500);"><?php echo $description;?></textarea>
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
									<a href="index.php">Cancel</a>
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