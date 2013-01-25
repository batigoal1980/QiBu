<?php

	include_once("header.php");

?>

<div id="head_bottom"><img src="img/head_bottom.jpg" border="0" usemap="#Map" />
<map name="Map" id="Map"><area shape="rect" coords="76,261,369,307" href="new.php" />
</map></div>

</div>

<div id="main">

	<div id="box1">

		<p class="box1a">

        	Set how much you want to raise, and your friends will be able to send you the money

		</p>

        <fieldset>

        	<div class="field amount">

				<form name="newform" method="post" action="new.php">

				<div id="b">

					<div class="text_amount_m">

						<span class="box1b">$</span>

						<input name="amount" type="text" class="currency" />

					</div>

					<div class="clearer"></div>

				</div>

				</form>

			</div>  

		</fieldset>

        <div id="go"><a href="javascript:document.newform.submit();"></a></div>

        <p class="box1c">It's free, secure, and fun! <a href="learn_more.php">Learn more</a></p>

	</div>

    <div id="box2">

    	<p class="box2a" id="box2a"><span id="counter_money"><?php siteinfo("moneytransferred");?></span></p>

        <p class="box2b">For projects, presents, group purchases, charity, and any other dream!</p>

		<p class="box2c"><a href="new.php">Raise the money</a> ! You need now!</p>    

	</div>

	<script type="text/javascript">

		document.getElementById('counter_money').style.visibility = 'hidden';

	</script>

	<div id="box3">

    <?php
   $featured=kapipalids2(rand());
		if (count(kapipalids())>0){
$det=kapipaldetail($featured[0]);
			//$det=kapipaldetail(1);

	?>

		<div id="box3_img"><img src="<?php echo $det[7];?>" style="width:167px;height:153px"/></div><!--end box3_img-->

		<div id="box3_text">

			<p class="box3a">$ <?php echo $det[12];?></p>

			<p class="box3b">from <?php echo $det[15];?> contributors</p>

			<div id="don_button"><a href="project.php?id=1"></a></div><!--end don_button-->

		</div>

	<?php

		}

	?>

	</div><!--end box3-->

	<div id="box4"><a href="new.php"></a></div><!--end box4-->

    <?php

		include("top4projects.php");

	?>

</div>

<?php

	include_once("footer.php");

?>