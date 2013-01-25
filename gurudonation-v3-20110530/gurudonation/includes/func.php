<?php

	//////////Mandatory////////////////

	function sendemail($to, $subj, $body)

	{

		$hostmail="norply@gmail.com";

		

		date_default_timezone_set('UTC');

		error_reporting(0);

		$headers = "MIME-Version: 1.0" . "\r\n";

		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

		$headers .= "From: ".$hostmail." \r\n";

		$headers .= "Reply-To : ".$hostmail." \r\n";



		return mail($to, $subj, $body, $headers);

	}

	

	function sendrepliableemail($to, $subj, $body, $reply)

	{	

		date_default_timezone_set('UTC');

		error_reporting(0);

		$headers = "MIME-Version: 1.0" . "\r\n";

		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

		$headers .= "From: ".$reply." \r\n";

		$headers .= "Reply-To : ".$reply." \r\n";



		return mail($to, $subj, $body, $headers);

	}

	

	function generatepassword()

	{

		mt_srand ((double) microtime() * 1000000);

		$len=mt_rand(15,20);

		$pass="";

		

		for ($i=0;$i<$len;$i++)

		{

			$c=mt_rand(48,90);

			if (($c>=48 && $c<=57) || ($c>=65 && $c<=90))

				$pass.=(chr($c));

		}

		return $pass;

	}

	

	function generatecode()

	{

		mt_srand ((double) microtime() * 1000000);

		$len=mt_rand(30,40);

		$code="";

		

		for ($i=0;$i<$len;$i++)

		{

			$c=mt_rand(48,90);

			if (($c>=48 && $c<=57) || ($c>=65 && $c<=90))

				$code.=(chr($c));

		}

		return $code;

	}

	

	function guru_encrypt($plain)

	{

		mt_srand ((double) microtime() * 1000000);

		$password = '';

	

		for ($i=0; $i<10; $i++) {

		  $password .= rand(1,1000);

		}

	

		$salt = substr(md5($password), 0, 2);

	

		$password = md5($salt . $plain) . ':' . $salt;

	

		return $password;

	}

	

	function guru_decrypt($encrypted,$plain)

	{

		$stack = explode(':', $encrypted);

		//if (sizeof($stack) != 2) return false;

		

		if (md5($stack[1] . $plain) == $stack[0]) 

		{

			return true;

		}

		

		return false;

	}

	

	function newsett($att,$val)

	{

		include("linkmysql.php");

		$att=mysql_real_escape_string($att);
		$val=mysql_real_escape_string($val);

		$val=addslashes($val);

		$query="Select id from settings where attribute='$att'";

		$b=0;

		if ($result=mysql_query($query))

			if ($r=mysql_fetch_array($result))

				$b=1;

		

		if ($b==0){

			$query="Insert into settings values('0','$att','$val')";

		}else{

			$query="Update settings Set value='$val' where attribute='$att'";

		}

		

		if (mysql_query($query,$link))

			return TRUE;

		else

			return FALSE;

	}



	function siteinfo($att)

	{

		include("linkmysql.php");
		$att=mysql_real_escape_string($att);
		$query="Select value from settings where attribute='$att'";

		if ($q=mysql_query($query,$link))

			if ($r=mysql_fetch_array($q))

			{

				$r[0]=stripslashes($r[0]);

				return $r[0];

			}

		return FALSE;

	}

	

	function uploadpicture($file)

	{

		//Find extension

		$filename = strtolower($file['name']); 

		$exts = split("[/\\.]", $filename); 

		$ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
		
		if (($ext!="jpg")&&($ext!="gif")&&($ext!="png"))
		{
		print "not valid image extension.";
		die;
		}


		$n = count($exts)-1; 

		$ext = $exts[$n];

	

		$c=siteinfo("piccount")+1;

		$target_path = "uploads/"."a";

		$target_path = $target_path . basename($file['name']);

		if (!move_uploaded_file($file['tmp_name'], $target_path))

			$target_path="";

		rename($target_path,"uploads/".$c.".".$ext);

		newsett("piccount",$c);	

		return "uploads/".$c.".".$ext;

	}

	////////////////////////////

	

	function newresetrequest($email,$key)

	{

		include("linkmysql.php");
		$email=mysql_real_escape_string($email);
		$query="insert into resetrequests values('0','$email','$key')";

		

		if (mysql_query($query,$link))

			return TRUE;

		return FALSE;

	}

	

	function newabuse($pageaddr,$problem,$youremail)

	{

		include("linkmysql.php");
		$pageaddr=mysql_real_escape_string($pageaddr);
		$problem=mysql_real_escape_string($problem);
		$youremail=mysql_real_escape_string($youremail);
		$query="insert into abuses values('0','$pageaddr','$problem','$youremail')";

		

		if (mysql_query($query,$link))

			return TRUE;

		return FALSE;

	}

	

	function newuser($name,$email,$password,$keycode,$activation,$paypal)

	{

		include("linkmysql.php");
		$name=mysql_real_escape_string($name);
		$email=mysql_real_escape_string($email);
		$password=mysql_real_escape_string($password);
		$paypal=mysql_real_escape_string($paypal);
		$name=addslashes($name);

		$password=guru_encrypt($password);



		$query="insert into users values('0','$name','$email','$password','$keycode','$activation','0','$paypal')";

		if (mysql_query($query,$link))

			return TRUE;

		return FALSE;

	}

	

	function newkapipal($userid,$title,$amounttoraise,$duration,$mincontribution,$paypalemail,$image,$website,$description,$fixedcontribution,$featured)

	{

		include("linkmysql.php");
		$title=mysql_real_escape_string($title);
		$amounttoraise=mysql_real_escape_string($amounttoraise);
		$duration=mysql_real_escape_string($duration);
		$mincontribution=mysql_real_escape_string($mincontribution);
		$paypalemail=mysql_real_escape_string($paypalemail);
		$image=mysql_real_escape_string($image);
		$website=mysql_real_escape_string($website);
		$description=mysql_real_escape_string($description);
		$fixedcontribution=mysql_real_escape_string($fixedcontribution);
		
		$title=addslashes($title);

		$description=addslashes($description);

		date_default_timezone_set('UTC');

		$d=date("Y-m-d");

		

		$query="insert into kapipals values('0','$userid','$title','$amounttoraise','$duration','$mincontribution','$paypalemail','$image','$website','$description','$fixedcontribution','$d','0','0','$featured','0')";

		if (mysql_query($query,$link))

			return TRUE;

		return FALSE;

	}

	

	function newcontribution($kid,$amount,$name,$message)

	{

		include("linkmysql.php");
		$kid=mysql_real_escape_string($kid);
		$amount=mysql_real_escape_string($amount);
		$name=mysql_real_escape_string($name);
		$message=mysql_real_escape_string($message);
		$name=addslashes($name);

		$message=addslashes($message);

		date_default_timezone_set('UTC');

		$d=date("Y-m-d");

		$query="insert into contributions values('0','$kid','$amount','$name','$message','$d')";

		

		if (mysql_query($query,$link))

			return TRUE;

		return FALSE;

	}

	

	function newadmin($name,$pass)

	{

		include("linkmysql.php");
		$name=mysql_real_escape_string($name);
		$pass=mysql_real_escape_string($pass);
		$pass=md5($pass);

		

		$query="Insert into admins values('0','$name','$pass')";

		if (mysql_query($query,$link))

			return TRUE;

		else

			return FALSE;

	}

	

	function calcfee($amount)

	{

		include("linkmysql.php");

		$fee=$amount*siteinfo("feepercent")/100;

		if ($fee<siteinfo("fixedfee"))

			$fee=siteinfo("fixedfee");

		return $fee;

	}

	

	function newwithdrawal($user,$amount)

	{

		include("linkmysql.php");

		
		$user=mysql_real_escape_string($user);
		$amount=mysql_real_escape_string($amount);
		$query="insert into withdrawals values('0','$user','$amount')";

		if (mysql_query($query,$link))

			return TRUE;

		else

			return FALSE;

	}

	

	function newcate($cate,$pic){

		include("linkmysql.php");

		$cate=mysql_real_escape_string($cate);
		$pic=mysql_real_escape_string($pic);

		$cate=addslashes($cate);

		$query="insert into categories values('0','$cate','$pic')";

		if (mysql_query($query,$link))

			return TRUE;

		else

			return FALSE;

	}

?>