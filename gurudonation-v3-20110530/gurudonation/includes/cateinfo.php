<?php
	function catedetail($id)
	{
		include("linkmysql.php");
		$id=mysql_real_escape_string($id);
		$query="select * from categories where id='$id'";
		if ($q=mysql_query($query,$link))
			if ($r=mysql_fetch_array($q))
			{
				$r[1]=stripslashes($r[1]);
				return $r;
			}
		return FALSE;
	}
	
	function removecate($id)
	{
		include("linkmysql.php");		$id=mysql_real_escape_string($id);
		$query="delete from categories where id='$id'";
		
		if ($q=mysql_query($query,$link))
			return TRUE;
		return FALSE;
	}

	function cateids()
	{
		include("linkmysql.php");

		$query="select id from categories";
		$a=array();
		$cnt=0;
		if ($q=mysql_query($query,$link))
			while ($r=mysql_fetch_array($q)){
				$a[$cnt]=$r[0];
				$cnt++;
			}
		return $a;
	}
	
	function cateattr($id,$attr)
	{
		include("linkmysql.php");
		$id=mysql_real_escape_string($id);
		$attr=mysql_real_escape_string($attr);
		$query="select $attr from categories where id='$id'";
		if ($q=mysql_query($query,$link))
			if ($r=mysql_fetch_array($q))
			{
				$r[0]=stripslashes($r[0]);
				return $r[0];
			}
		return FALSE;
	}
?>