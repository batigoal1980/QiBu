<?php
	function featuredkapipals()
	{
		include("linkmysql.php");
		$query="select id from kapipals where featured='y'";

		$a=array();
		$cnt=0;
		
		if ($q=mysql_query($query,$link))
			while ($r=mysql_fetch_array($q)){
				$a[$cnt]=$r[0];
				$cnt=$cnt+1;
			}
		return $a;
	}
	
	function idtotitle($id)
	{
		include("linkmysql.php");		$id=mysql_real_escape_string($id);
		$query="select title from kapipals where id='$id'";
		
		if ($q=mysql_query($query,$link))
			if ($r=mysql_fetch_array($q)){
				$r[0]=stripslashes($r[0]);
				return $r[0];
			}
		return $a;
	}
	
	
	function kapipalids()
	{
		include("linkmysql.php");
		$query="select id from kapipals";

		$a=array();
		$cnt=0;
		
		if ($q=mysql_query($query,$link))
			while ($r=mysql_fetch_array($q)){
				$a[$cnt]=$r[0];
				$cnt=$cnt+1;
			}
		return $a;
	}

function kapipalids2()
	{
		include("linkmysql.php");
		$query="select id from kapipals ORDER BY RAND()";

		$a=array();
		$cnt=0;
		
		if ($q=mysql_query($query,$link))
			while ($r=mysql_fetch_array($q)){
				$a[$cnt]=$r[0];
				$cnt=$cnt+1;
			}
		return $a;
	}
	
	function latestkapipals($pc,$index){
		$a=kapipalids();
		for ($i=count($a)-1;$i>=0 && $index>0;$index--){
			$i=$i-$pc;
		}
		$b=array();
		if ($index==0 && $i>=0){
			for ($j=0;$j<=$i && $j<$pc;$j++)
				$b[$j]=$a[$i-$j];
		}
		return $b;
	}
	
	function totalkapipals()
	{
		include("linkmysql.php");
		$query="select count(*) from kapipals";
		
		if ($q=mysql_query($query,$link))
			if ($r=mysql_fetch_array($q))
				return $r[0];
		return 0;
	}
	
	function totalfeaturedkapipals()
	{
		include("linkmysql.php");
		$query="select count(*) from kapipals where featured='y'";
		
		if ($q=mysql_query($query,$link))
			if ($r=mysql_fetch_array($q))
				return $r[0];
		return 0;
	}
	
	function userkapipals($userid)
	{
		include("linkmysql.php");		$userid=mysql_real_escape_string($userid);
		$query="select id from kapipals where userid='$userid'";

		$a=array();
		$cnt=0;
		
		if ($q=mysql_query($query,$link))
			while ($r=mysql_fetch_array($q)){
				$a[$cnt]=$r[0];
				$cnt=$cnt+1;
			}
		return $a;
	}
	
	function kapipalidbyusername($name)
	{
		include("linkmysql.php");		$name=mysql_real_escape_string($name);
		$query="select id from kapipals where userid='$name' order by id desc";

		if ($q=mysql_query($query,$link))
			if ($r=mysql_fetch_array($q))
				return $r[0];
		return FALSE;
	}
	
	function kapipaldetail($id)
	{
		include("linkmysql.php");
		$id=mysql_real_escape_string($id);
		$query="select * from kapipals where id='$id'";
		
		if ($q=mysql_query($query,$link))
			if ($r=mysql_fetch_array($q))
			{
				$r[2]=stripslashes($r[2]);
				$r[9]=stripslashes($r[9]);
				return $r;
			}
		return FALSE;
	}
	
	function removekapipalbyuserid($userid)
	{
		include("linkmysql.php");
		$userid=mysql_real_escape_string($userid);
		$query="select id from kapipals where userid='$userid'";
		if ($q=mysql_query($query,$link))
			while ($r=mysql_fetch_array($q))
				removekapipal($r[0]);
		return FALSE;
	}
	
	function removekapipal($id)
	{
		include("linkmysql.php");
		$id=mysql_real_escape_string($id);
		$query="delete from kapipals where id='$id'";
		removecontributionbykapipal($id);
		if ($q=mysql_query($query,$link))
			return TRUE;
		return FALSE;
	}
	
	function setkapipaldetail($id,$attr,$val)
	{
		include("linkmysql.php");
		$id=mysql_real_escape_string($id);
		$attr=mysql_real_escape_string($attr);
		$val=mysql_real_escape_string($val);
		$query="update kapipals set $attr='$val' where id='$id'";
		
		if ($q=mysql_query($query,$link))
			return TRUE;
		return FALSE;
	}
	
	function kapipalattr($id,$attr)
	{
		include("linkmysql.php");
		$id=mysql_real_escape_string($id);
		$attr=mysql_real_escape_string($attr);
		$query="select $attr from kapipals where id='$id'";
		
		if ($q=mysql_query($query,$link))
			if ($r=mysql_fetch_array($q))
			{
				$r[0]=stripslashes($r[0]);
				return $r[0];
			}
		return FALSE;
	}
	
	function searchkapipals($title,$amount,$duration,$desc)
	{
		include("linkmysql.php");
		$title=mysql_real_escape_string($title);
		$amount=mysql_real_escape_string($amount);
		$duration=mysql_real_escape_string($duration);
		$desc=mysql_real_escape_string($desc);
		$query="select id,description from kapipals";
		$where="";
		if ($title!="")
		{
			$title=trim($title);
			$where=" title='$title' ";
		}
		if ($amount!="")
		{
			if ($where!="") $where.=" and ";
			$where.=" amounttoraise='$amount' ";
		}
		if ($duration!=0)
		{
			if ($where!="") $where.=" and ";
			$where.=" duration='$duration' ";
		}
		
		if ($where!="") $query.=" where ".$where;
		$a=array();
		$cnt=0;
		$b=array();
		$desc=trim($desc);
		if ($desc!="") $b=explode(',',$desc);
		if ($q=mysql_query($query,$link))
			while ($r=mysql_fetch_array($q))
			{
				$r[1]=stripslashes($r[1]);
				if ($desc!=""){
					$tt=0;
					foreach ($b as $var)
						if (substr_count($r[1],$var)<=0) {
							$tt=1;
							break;
						}
					if ($tt==1) continue;
				}
				$a[$cnt]=$r[0];
				$cnt=$cnt+1;
			}
		return $a;
	}
?>