<?php
	function totalwithdrawals()
	{
		include("linkmysql.php");
		$query="select count(*) from withdrawals";
		
		if ($q=mysql_query($query,$link))
			if ($r=mysql_fetch_array($q))
				return $r[0];
		return 0;
	}

	function withdrawaldetail($id)
	{
		include("linkmysql.php");
		$id=mysql_real_escape_string($id);
		$query="select * from withdrawals where id='$id'";
		
		if ($q=mysql_query($query,$link))
			if ($r=mysql_fetch_array($q))
				return $r;
		return FALSE;
	}
	
	function removewithdrawalsbyuserid($userid)
	{
		include("linkmysql.php");
		$userid=mysql_real_escape_string($userid);
		$query="delete from withdrawals where userid='$userid'";
		if ($q=mysql_query($query,$link))
			return TRUE;
		return FALSE;
	}
	
	function removewithdrawal($id)
	{
		include("linkmysql.php");
		$id=mysql_real_escape_string($id);
		$query="delete from withdrawals where id='$id'";
		if ($q=mysql_query($query,$link))
			return TRUE;
		return FALSE;
	}
	
	function withdrawallisting()
	{
		include("linkmysql.php");
		include("config.php");
		include_once("userinfo.php");
		include_once("func.php");
		
		$query = "select * from withdrawals";
		$lists="";
		if ($q=mysql_query($query,$link))
			while ($r=mysql_fetch_array($q))
			{
				$lists.="<tr>";

				$notifyurl=$domainurl."admin/ipn.php?id=".$r[0];
				$cancelurl=$domainurl."admin/withdrawalrequests.php";
				$udet=userdetail($r[1]);
				$amount=$amount-calcfee($amount);
				$lists.="<form action='https://www.paypal.com/cgi-bin/webscr' method='post'  name='paypal_form' id='paypal_form'>
						 <input type='hidden' name='cmd' value='_xclick'>
						 <input type='hidden' name='notify_url' value ='$notifyurl' >
						 <input type='hidden' name='return' value ='$cancelurl' >
						 <input type='hidden' name='cancel_return' value ='$cancelurl' >			 
						 <input type='hidden' name='business' value='$udet[7]'>
						 <input type='hidden' name='no_shipping' value='1'>
						 <input type='hidden' name='no_note' value='1'>
						 <input type='hidden' name='currency_code' value='USD'>
						 <input type='hidden' name='lc' value='US'>
						 <input type='hidden' name='amount' value='$amount'/>";

				$lists.="<td class='varnormal' align='center'>".$r[0]."</td>";
				$lists.="<td class='varnormal' align='center'>".idtoname($r[1])."</td>";
				$lists.="<td class='varnormal' align='center'>".$r[2]."</td>";
				
				$deleteurl="deletewithdrawal.php?id=".$r[0];
				$lists.="<td align='center'>
						<input class='btn-submit' alt='Submit' src='../images/paypal.jpg' type='image'/>
						<a href='$deleteurl'><img src='../img/delete.gif' class='imgAction' title='Delete' border='0' onclick='return suredelete()'></a>
						</td></form>";
				$lists.="</tr>";
			}
		return $lists;
	}
?>