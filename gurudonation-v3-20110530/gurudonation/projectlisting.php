<?php

	include_once("includes/kapipalinfo.php");

	date_default_timezone_set('UTC');

	$lists="";

	foreach ($a as $var){

		$det=kapipaldetail($var);

		$kurl="project.php?id=".$var;

		$lists.="<div class='projects'>

				 <div class='projectimg'>

				 <a href=\"$kurl\">

				 <img src='$det[7]'/></a>";

		if ($det[14]=='y'){

			$lists.="<div class='featured'><img src='img/feature-bg.png' /></div>";

		}

		$kapurl="contactkap.php?kid=".$var;

		$percent=$det[12]*100/$det[3];

		$percent=round($percent);

		$percent1=$percent;

		if ($percent>100) $percent1=100;

		$width=150*$percent1/100;

		if ($width==0) $width=1;

		$left=150-$width;		

		$curr=date("Y-m-d");

		$diff=abs(strtotime($curr) - strtotime($det[11]));

		$years=floor($diff / (365*60*60*24));

		$months=floor(($diff - $years * 365*60*60*24) / (30*60*60*24));

		$days=$det[4]-floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

		$lists.="</div>

				 <div class='title'><a href='$kurl'>$det[2]</a><br> ".substr($det[9],0,50)."

				 <div class='raisedby'>
                <right> <img src='uploads/".user_avatar($det[1])."' width='80' height='80'></right><br>
				 Posted by: <a href='$kapurl'>".idtoname($det[1])."</a>

				 </div>

				 </div>

				 <div class='sponsor'>";

		$lists.="<div class='progressbar'><img src='img/progress2.png' style='width:$width"."px;height:20px'></div>";

		$lists.="<div class='progressstatus'>

				 <strong>".$percent."% | ".$days." days to go</strong>

				 </div>

				 <div class='stake'>

				 Entry stake: $".$det[5]."

				 </div>

				 </div></div>";

	}

	echo $lists;

?>