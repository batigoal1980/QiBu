<?php
	session_start();
	include_once("includes/kapipalinfo.php");
	include_once("includes/func.php");
	include_once("includes/userinfo.php");
	$url = 'https://www.paypal.com/cgi-bin/webscr';
	$postdata = '';
	$amount=$_POST['mc_gross'];
	$who=$_POST['item_number'];
	$prvm=$_POST['custom'];
	if ($prvm!="")
	$privatemessage=split("\|",$prvm);
	
	$payment_status=$_POST['payment_status'];
	foreach($_POST as $i => $v) {
		$postdata .= $i.'='.urlencode($v).'&';
	}
	$postdata .= 'cmd=_notify-validate';
	$web = parse_url($url);
	if ($web['scheme'] == 'https') { 
		$web['port'] = 443;  
		$ssl = 'ssl://'; 
	} else { 
		$web['port'] = 80;
		$ssl = ''; 
	}
	
	
	$fp = @fsockopen($ssl.$web['host'], $web['port'], $errnum, $errstr, 30);

	if (!$fp) { 
		echo $errnum.': '.$errstr;
	} else {
		fputs($fp, "POST ".$web['path']." HTTP/1.1\r\n");
		fputs($fp, "Host: ".$web['host']."\r\n");
		fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
		fputs($fp, "Content-length: ".strlen($postdata)."\r\n");	
		fputs($fp, "Connection: close\r\n\r\n");
		fputs($fp, $postdata . "\r\n\r\n");

		while(!feof($fp)) { 
			$info[] = @fgets($fp, 1024); 
		}
		fclose($fp);
		$info = implode(',', $info);
		if (eregi('VERIFIED', $info)) {
			
			$amount2=kapipalattr($who,"amountraised");
			
			$myFile = "ipn.txt";
$fh = fopen($myFile, 'w') or die("can't open file");
$cme=$_POST['custom'];
$stringData = "Who: $who $amount $payment_status - $cme $privatemessage[0] $privatemessage[1]";
fwrite($fh, $stringData);
fclose($fh);
			if($payment_status == "Completed")
	{
		$cine=kapipalattr($who,"userid");
		$realbalance=getbalance($cine);
		setbalance($cine,$realbalance+$amount);
		
			newsett("moneytransferred",siteinfo("moneytransferred")+$amount);
			$contribution=kapipalattr($who,"contributions");
			setkapipaldetail($who,"amountraised",$amount2+$amount);
			setkapipaldetail($who,"contributions",$contribution+1);
			$url="newcontribute.php?kid=".$who;
			if ($privatemessage[0]!="")
				newcontribution($who,$amount,$privatemessage[0],$privatemessage[1]);
			else
				newcontribution($who,$amount,$privatemessage[0],$privatemessage[1]);
			$det=kapipaldetail($who);
			$body="Hi ".idtoname($det[1]).",<br/>";
			if ($_SESSION["newcontribute"]["leavemessage"]==0)
				$body.="Someone has just contributed to your project.<br/>";
			else
				$body.=$privatemessage[0]." has just contributed to your project and left a message.<br/>";
			$kurl=$domainurl."project.php?id=".$who;
			$body.="------------------------------------------<br/>
					Title: ".$det[2]."<br/>
					Amount: ".$amount."<br/>
					------------------------------------------<br/>
					Please visit your project here.<br/>
					<a href='$kurl'>".$kurl."</a>";
			sendemail(idtoemail($det[1]),"GuruDonation Support",$body);
			unset($_SESSION["newcontribute"]);
			echo "<script>window.location.href='".$url."';</script>";
			
	}
		} else {
			if (isset($_SESSION["newcontribute"]["kapipal192389347"]))
				$kurl="project.php?id=".$_SESSION["newcontribute"]["kapipal192389347"];
			else
				$kurl="index.php";
			echo "<script>window.location.href='".$kurl."';</script>";
		}
	}
?>