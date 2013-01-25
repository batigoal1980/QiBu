<?php
	include_once("../includes/withdrawalinfo.php");
	include_once("../includes/func.php");
	include_once("../includes/userinfo.php");
	$url = 'https://www.paypal.com/cgi-bin/webscr';
	$postdata = '';
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
			$det=withdrawaldetail($_GET['id']);
			$body="Hi ".idtoname($det[1]).",<br/>
				   Your withdrawal request has just been processed.<br/>
				   Amount you have requested: ".$det[2]."<br/>
				   Fee: ".calcfee($det[2])."<br/>
				   Amount you have received: ".$_POST['amount']."<br/>
				   Thanks.";
			sendemail(idtoemail($det[1]),"GuruDonation Support - Withdrawal",$body);
			newsett("moneyraised",siteinfo("moneyraised")+calcfee($det[2]));
			removewithdrawal($_GET['id']);
			$_SESSION['status']="You've just processed user's withdrawal request.";
			echo "<script>window.location.href='withdrawalrequests.php';</script>";
		} else {
			echo "<script>window.location.href='withdrawalrequests.php';</script>";
		}
	}
?>