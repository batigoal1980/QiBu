<?php

	function userexistbyemail($eml)

	{

		include("linkmysql.php");
		$eml=mysql_real_escape_string($eml);
		$query="select id from users where email='$eml'";

		

		if ($q=mysql_query($query,$link))

			if ($r=mysql_fetch_array($q))

				return TRUE;

		return FALSE;

	}

	

	function totalusers()

	{

		include("linkmysql.php");

		$query="select count(*) from users";

		

		if ($q=mysql_query($query,$link))

			if ($r=mysql_fetch_array($q))

				return $r[0];

		return 0;

	}

	

	function userexistbykey($key)

	{

		include("linkmysql.php");
		$key=mysql_real_escape_string($key);
		$query="select id from users where keycode='$key'";

		

		if ($q=mysql_query($query,$link))

			if ($r=mysql_fetch_array($q))

				return TRUE;

		return FALSE;

	}

	

	function userexistbyname($name)

	{

		include("linkmysql.php");
		$name=mysql_real_escape_string($name);
		$query="select id from users where name='$name'";

		

		if ($q=mysql_query($query,$link))

			if ($r=mysql_fetch_array($q))

				return TRUE;

		return FALSE;

	}

	

	function nametoid($name)

	{

		include("linkmysql.php");
		$name=mysql_real_escape_string($name);
		$query="select id from users where name='$name'";

		

		if ($q=mysql_query($query,$link))

			if ($r=mysql_fetch_array($q))

				return $r[0];

		return FALSE;

	}

	

	function idtoname($id)

	{

		include("linkmysql.php");
		$id=mysql_real_escape_string($id);
		$query="select name from users where id='$id'";

		

		if ($q=mysql_query($query,$link))

			if ($r=mysql_fetch_array($q))

			{

				$r[0]=stripslashes($r[0]);

				return $r[0];

			}

		return FALSE;

	}

	
		function user_avatar($id)

	{

		include("linkmysql.php");
		$id=mysql_real_escape_string($id);
		$query="select * from users where id='$id'";

		

		if ($q=mysql_query($query,$link))

			if ($r=mysql_fetch_array($q))

			{

				$r[8]=stripslashes($r[8]);

if(is_file('uploads/'.$r[8])){
				return $r[8];
				}else{
				return "avatar.jpg";
				}

			}

		return FALSE;

	}
	
	

	function keytoid($key)

	{

		include("linkmysql.php");
		$key=mysql_real_escape_string($key);
		$query="select id from users where keycode='$key'";

		

		if ($q=mysql_query($query,$link))

			if ($r=mysql_fetch_array($q))

				return $r[0];

		return FALSE;

	}

	

	function emailtoid($eml)

	{

		include("linkmysql.php");
		$eml=mysql_real_escape_string($eml);
		$query="select id from users where email='$eml'";

		

		if ($q=mysql_query($query,$link))

			if ($r=mysql_fetch_array($q))

				return $r[0];

		return FALSE;

	}



	function idtoemail($id)

	{

		include("linkmysql.php");
		$id=mysql_real_escape_string($id);
		$query="select email from users where id='$id'";

		

		if ($q=mysql_query($query,$link))

			if ($r=mysql_fetch_array($q))

				return $r[0];

		return FALSE;

	}



	function setpassword($id,$pass)

	{

		include("linkmysql.php");

		include_once("func.php");

		$pass=guru_encrypt($pass);
		$id=mysql_real_escape_string($id);
		$pass=mysql_real_escape_string($pass);
		$query="update users set password='$pass' where id='$id'";

		

		if (mysql_query($query,$link))

			return TRUE;

		return FALSE;

	}

	

	function setactivation($id,$a)

	{

		include("linkmysql.php");
		$a=mysql_real_escape_string($a);
		$id=mysql_real_escape_string($id);
		
		$query="update users set activate='$a' where id='$id'";

		

		if (mysql_query($query,$link))

			return TRUE;

		return FALSE;

	}

	

	function userdetail($id)

	{

		include("linkmysql.php");

		$id=mysql_real_escape_string($id);

		$query="select * from users where id='$id'";

		

		if ($q=mysql_query($query,$link))

			if ($r=mysql_fetch_array($q))

			{

				$r[1]=stripslashes($r[1]);

				return $r;

			}

		return FALSE;

	}

	

	function getpassword($id)

	{

		include("linkmysql.php");

		$id=mysql_real_escape_string($id);

		$query="select password from users where id='$id'";

		

		if ($q=mysql_query($query,$link))

			if ($r=mysql_fetch_array($q))

				return $r[0];

		return FALSE;

	}

	

	function isuseractive($id)

	{

		include("linkmysql.php");
		$id=mysql_real_escape_string($id);
		$query="select activate from users where id='$id'";

		

		if ($q=mysql_query($query,$link))

			if ($r=mysql_fetch_array($q))

				if ($r[0]=="y") return TRUE;

		return FALSE;

	}

	

	function removeuser($id)

	{

		include("linkmysql.php");

		include_once("kapipalinfo.php");

		include_once("withdrawalinfo.php");

		removekapipalbyuserid($id);

		removewithdrawalsbyuserid($id);
		$id=mysql_real_escape_string($id);
		$query="delete from users where id='$id'";

		

		if ($q=mysql_query($query,$link))

			return TRUE;

		return FALSE;

	}

	

	function setusername($id,$name)

	{

		include("linkmysql.php");

		

		$name=addslashes($name);
		$name=mysql_real_escape_string($name);
		$id=mysql_real_escape_string($id);
		$query="update users set name='$name' where id='$id'";

		

		if (mysql_query($query,$link))

			return TRUE;

		return FALSE;

	}

	

	function setuseremail($id,$eml)

	{

		include("linkmysql.php");

		
		$eml=mysql_real_escape_string($eml);
		$id=mysql_real_escape_string($id);
		$query="update users set email='$eml' where id='$id'";

		

		if (mysql_query($query,$link))

			return TRUE;

		return FALSE;

	}
	
		function setuseravatar($id,$eml)

	{

		include("linkmysql.php");

		$id=mysql_real_escape_string($id);
		$eml=mysql_real_escape_string($eml);

		$query="update users set avatar='$eml' where id='$id'";

		

		if (mysql_query($query,$link))

			return TRUE;

		return FALSE;

	}
	

	function ia_extensii($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }

	function getbalance($id)

	{

		include("linkmysql.php");

		
		$id=mysql_real_escape_string($id);
		$query="select balance from users where id='$id'";

		

		if ($q=mysql_query($query,$link))

			if ($r=mysql_fetch_array($q))

				return $r[0];

		return 0;

	}

	

	function setbalance($id,$amount)

	{

		include("linkmysql.php");

		
		$amount=mysql_real_escape_string($amount);
		$id=mysql_real_escape_string($id);
		$query="update users set balance='$amount' where id='$id'";

		

		if ($q=mysql_query($query,$link))

			return TRUE;

		return FALSE;

	}

	

	function userlisting($nick,$eml,$payeml)

	{

		include("linkmysql.php");
		$nick=mysql_real_escape_string($nick);
		$eml=mysql_real_escape_string($eml);
		$payeml=mysql_real_escape_string($payeml);
		$sql = "select * from users";

		$where="";

		if ($nick!="")

		{

			$where=" name='$nick' ";

		}

		if ($eml!="")

		{

			if ($where!="") $where.="and ";

			$where.="email='$eml'";

		}

		if ($payeml!="")

		{

			if ($where!="") $where.="and ";

			$where.="paypalid='$payeml'";

		}

		if ($where!="") $sql.=" where ".$where;

		if ($query = mysql_query($sql))

		{

			$lists="";

			while ($r=mysql_fetch_array($query))

			{

				$lists.="<tr>";

				$lists.="<td class='varnormal' align='center'>".$r[0]."</td>";

				$r[1]=stripslashes($r[1]);

				$lists.="<td class='varnormal' align='center'>".$r[1]."</td>";

				$lists.="<td class='varnormal' align='center'>".$r[2]."</td>";

				$lists.="<td class='varnormal' align='center'>".$r[7]."</td>";		

				$lists.="<td class='varnormal' align='center'>$".$r[6]."</td>";



				$urledit="edituser.php?user_id=".$r[0];

				$urldelete="deleteuser.php?user_id=".$r[0];

				$urlsendmail="sendmail.php?user_id=".$r[0];

				$lists.="<script type='text/javascript' src='js/jquery.js'></script>";

				$lists.="<td align='center'>

						<a href='$urledit'><img src='../img/edit.gif' class='imgAction' title='Edit' border='0'></a>

						<a href='$urldelete'><img src='../img/delete.gif'  id='deletegig' class='imgAction' title='Delete' border='0' onclick='return suredelete()'></a>

						<a href='$urlsendmail'><img src='../img/sendmail.gif' class='imgAction' title='Send Mail' border='0'></a>

						</td>";

				$lists.="</tr>";

			}

			return $lists;

		}else

			return FALSE;

	}

	

	function setuserattr($id,$attr,$val)

	{

		include("linkmysql.php");


		$id=mysql_real_escape_string($id);
		$attr=mysql_real_escape_string($arrt);
		$val=mysql_real_escape_string($val);
		
		$query="update users set $attr='$val' where id='$id'";

		if ($q=mysql_query($query,$link))

			return TRUE;

		return FALSE;

	}

?>