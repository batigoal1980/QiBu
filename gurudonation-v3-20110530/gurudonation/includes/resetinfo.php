<?php
	function isexistkey($key)
	{
		include("linkmysql.php");
		$query="select email from resetrequests where keycode='$key'";
		
		if ($q=mysql_query($query))
			if ($r=mysql_fetch_array($q))
				return TRUE;
		return FALSE;
	}
	
	function keytoemail($key)
	{
		include("linkmysql.php");
		$query="select email from resetrequests where keycode='$key'";
		
		if ($q=mysql_query($query))
			if ($r=mysql_fetch_array($q))
				return $r[0];
		return FALSE;
	}
	
	function removebyemail($eml)
	{
		include("linkmysql.php");
		$query="delete from resetrequests where email='$eml'";
		
		if ($q=mysql_query($query))
			return TRUE;
		return FALSE;
	}
?>