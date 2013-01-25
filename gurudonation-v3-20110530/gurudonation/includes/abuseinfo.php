<?php
	function removeabuse($id)
	{
		include("linkmysql.php");
		$id=mysql_real_escape_string($id);
		$query="delete from abuses where id='$id'";
		
		if ($q=mysql_query($query,$link))
			return TRUE;
		return FALSE;
	}
	
	function abusedetail($id)
	{
		include("linkmysql.php");
		$id=mysql_real_escape_string($id);
		$query="select * from abuses where id='$id'";
		if ($q=mysql_query($query,$link))
			if ($r=mysql_fetch_array($q))
			{
				$r[2]=stripslashes($r[2]);
				return $r;
			}
		return FALSE;
	}
	
	function abuselisting()
	{
		include("linkmysql.php");

		$sql = "select * from abuses";
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
				$lists.="<td class='varnormal' align='center'>".$r[3]."</td>";		

				$urldelete="deleteabuse.php?id=".$r[0];
				$urlreply="sendmail.php?abuse_id=".$r[0];
				$lists.="<td align='center'>
						<a href='$urlreply'><img src='../img/sendmail.gif'  class='imgAction' title='Reply' border='0' target='_blank'></a>
						<a href='$urldelete'><img src='../img/delete.gif'  class='imgAction' title='Delete' border='0' onclick='return suredelete()'></a>
						</td>";
				$lists.="</tr>";
			}
			return $lists;
		}else
			return FALSE;
	}
?>