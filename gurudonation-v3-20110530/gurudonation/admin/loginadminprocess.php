<?php
	session_start();
	include("../includes/admininfo.php");
	include("../includes/func.php");
	
	if (isset($_POST['adminname']))
	{
		$username=$_POST['adminname'];
		//$pass=md5(trim($_POST['passwd']));
		$pass=trim($_POST['passwd']);
		/*print "Pass: $pass";
		print "Username: $username";
		print guru_encrypt($pass);
		print getadmPassword($username);
		
		$ceva=guru_decrypt(getadmPassword($username),pass);
		print "ceva: $ceva";
		die;*/
		if (getadmPassword($username)!=FALSE)
		{
			if (!guru_decrypt(getadmPassword($username),$pass))
			{
				$_SESSION['status']="Invalid Password!";
				?><script>window.location.href = 'loginadmin.php';</script><?php
			}else{
				$_SESSION['admin192839748374865']=$username;
				?><script>window.location.href='admin.php';</script><?php
			}
		}
		else
		{
			$_SESSION['status']="No matching User Name!";
			?><script>window.location.href = 'loginadmin.php';</script><?php
		}
	}
?>