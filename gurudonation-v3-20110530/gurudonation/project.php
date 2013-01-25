<?php

	include_once("header.php");
include_once("linkmysql.php");
$adda=$_GET['a']; 
$cont=$_GET['c']; 
$id=$_GET['id'];
$select="SELECT * FROM kapipals where id='$id'";
$qselect = mysql_query($select);
while ($row = mysql_fetch_array($qselect)) { 
$newa = $adda + $row['amountraised']  ; 
$newc = $cont + $row['contributions'] ;
$update = "UPDATE kapipals SET amountraised = '$newa' , contributions = '$newc' where id =$id";
$qupdate = mysql_query($update); } 


	$id=1;

	if (isset($_GET['id']))

		$id=$_GET['id'];

	setkapipaldetail($id,"views",kapipalattr($id,"views")+1);

	$det=kapipaldetail($id);

	date_default_timezone_set('UTC');

?>

	<div id="main">

			<div id="main_2">

				<div id="page_kapipal">

					<h1><?php echo $det[2];?></h1>

					<img src="<?php echo $det[7];?>" id="image" alt="<?php echo $det[2];?>" />

                    <img src="img/image_progress1.jpeg" id="progress"/>

                    <?php

						$percent=$det[12]*100/$det[3];

						$percent=round($percent);

						$percent1=$percent;

						if ($percent>100) $percent1=100;

						$height=250*$percent1/100;

						if ($height==0) $height=1;

						$top=250-$height;

						if ($height>230)

							$ptop=5;

						else

							$ptop=230-$height;

                    	echo "<img src='img/image_progress2.jpeg' id='progress' style='left:-50px; position:relative;height:".$height."px;top:".$top."px'/>";

						echo "<div align='center' id='progress' style='left:-90px; position:relative;width:40px;top:".$ptop."px'><font color='#516B60'><strong style='color:white'>".$percent."%</strong></font></div>";

						$curr=date("Y-m-d");

						$diff=abs(strtotime($curr) - strtotime($det[11]));

						$years=floor($diff / (365*60*60*24));

						$months=floor(($diff - $years * 365*60*60*24) / (30*60*60*24));

						$days=$det[4]-floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

						$donateurl="donate.php?kid=".$det[0];

					?>

					<div id="info">

                    	$<strong title="Raised Money"><?php echo $det[12];?></strong>

						<div id="progress_goal"><?php echo $percent;?>% of $<strong title="Goal Amount"><?php echo $det[3];?></strong></div>

                        <?php if ($days>0){ ?>

						<a href="<?php echo $donateurl;?>" title="Click and send money">

							<img alt="Send Money" class="pay" src="img/send_1.gif" />

						</a>

                        <?php } ?>

						<div id="time_left">

                        <?php

							if ($days>0)

								echo "<strong>Time left</strong>$days days";

							else

								echo "<strong>No time left</strong>for other contributions";

						?>

						</div>

					</div>

					<div class="clearer"></div>

					<div id="bottom">

						<div id="right">

							<div class="ad" style="margin-bottom: 15px;">

								<div>

								
							</div>

						</div>

						<div class="addthis_toolbox">

							<h3>Share with Your Friends</h3>

							<div class="vertical">

								<a class="addthis_button_email">Email</a>

								<a class="addthis_button_twitter">Twitter</a>

								<a class="addthis_button_friendfeed">Friendfeed</a>

								<a class="addthis_button_tumblr">Tumblr</a>

								<a class="addthis_button_myspace">MySpace</a>

								<a class="addthis_button_facebook">Facebook</a>

							</div>

						</div>

						<div id="account_name">

							<h3>Project Raised by</h3>

							<?php

								echo idtoname($det[1]);

								$contacturl="contactkap.php?kid=".$det[0];

							?>

							<a href="<?php echo $contacturl;?>" title="Contact this Poster">Send a Message</a>

						</div>

					</div>

					<div id="left">

						<div id="text"><?php echo $det[9];?></div>

						<div id="url">

							<strong>Related Website</strong>

							<a title="Go to the author's website" href="<?php echo $det[8];?>" target="_blank" rel="nofollow"><?php echo $det[8];?></a>

						</div>

						<a id="messages" name="messages"></a>

						<h2>Contributors' Messages</h2>

                        <?php

							$a=contributionbykapipal($det[0]);

							$lists="";

							foreach ($a as $i=>$var)

							{

								$cdet=contributiondetail($var);

								if ($cdet[4]!=""){

									$lists.="<div class='message'>

											 <em>$cdet[4]</em>

											 <label id='pay_date'>$cdet[5]</label> ";

									if ($cdet[3]=="")

										$lists.="<strong>Anonymous</strong>";

									else

										$lists.="<strong>$cdet[3]</strong>";

									$lists.="</div>";

								}

							}

							if ($lists==""){

								echo "No messages.<br/>";

								if ($days>0)

									echo "To leave a message, <a href='$donateurl' title='Send Money with 1 Click!'>contribute to this Project</a>";

							}else

								echo $lists;

						?>

					</div>

				</div>

			</div>

			<div class="clearer"></div>

	</div>

<?php

	include_once("footer.php");

?>