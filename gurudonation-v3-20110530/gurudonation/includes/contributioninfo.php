<?php
	function contributionbykapipal($kid)
	{
		include("linkmysql.php");		$kid=mysql_real_escape_string($kid);
		$query="select id from contributions where kapipalid='$kid'";

		$a=array();
		$cnt=0;
		if ($q=mysql_query($query,$link))
			if ($r=mysql_fetch_array($q))
			{
				$a[$cnt]=$r[0];
				$cnt=$cnt+1;
			}
		return $a;
	}
	
	function removecontributionbykapipal($kid)
	{
		include("linkmysql.php");		$kid=mysql_real_escape_string($kid);
		$query="delete from contributions where kapipalid='$kid'";

		if ($q=mysql_query($query,$link))
			return TRUE;
		return FALSE;
	}
	
	function contributiondetail($id)
	{
		include("linkmysql.php");
		$id=mysql_real_escape_string($id);
		$query="select * from contributions where id='$id'";
		
		if ($q=mysql_query($query,$link))
			if ($r=mysql_fetch_array($q))
			{
				$r[3]=stripslashes($r[3]);
				$r[4]=stripslashes($r[4]);
				return $r;
			}
		return FALSE;
	}
	
	function removecontribution($id)
	{
		include("linkmysql.php");
		$id=mysql_real_escape_string($id);
		$query="delete from contributions where id='$id'";
		
		if ($q=mysql_query($query,$link))
			return TRUE;
		return FALSE;
	}
	
	function contributionlisting()
	{
		include("linkmysql.php");

		$sql = "select * from contributions";
		if ($query = mysql_query($sql))
		{
			$lists="";
			while ($r=mysql_fetch_array($query))
			{
				$lists.="<tr>";
				$lists.="<td class='varnormal' align='center'>".$r[0]."</td>";
				$r[1]=stripslashes($r[1]);
				$lists.="<td class='varnormal' align='center'>".idtotitle($r[1])."</td>";
				$lists.="<td class='varnormal' align='center'>".$r[2]."</td>";
				$lists.="<td class='varnormal' align='center'>".$r[4]."</td>";		

				$urldelete="deletecontribute.php?id=".$r[0];
				$lists.="<td align='center'>
						<a href='$urldelete'><img src='../img/delete.gif'  id='deletegig' class='imgAction' title='Delete' border='0' onclick='return suredelete()'></a>
						</td>";
				$lists.="</tr>";
			}
			return $lists;
		}else
			return FALSE;
	}
?>