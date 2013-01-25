<?php

	function getadmPassword($u)

	{

		include("linkmysql.php");


		$u=mysql_real_escape_string($u);
		$query="Select * from admins where username='$u'";



		$result=mysql_query($query);

			if ($r=mysql_fetch_array($result)){

				return $r['password'];
}else{

return FALSE;
}
		

	}

	

	function deladmin($id)

	{

		include("linkmysql.php");

		$query="Delete from admins where id='$id'";



		if (mysql_query($query,$link))

			return TRUE;

		else

			return FALSE;

	}

	

	function updateadminPassword($user,$pass)

	{

		include("linkmysql.php");
		$user=mysql_real_escape_string($user);
		$pass=mysql_real_escape_string($pass);
		$pass=guru_encrypt($pass);

		

		$query="Update admins Set password='$pass' where username='$user'";

		if (mysql_query($query,$link))

			return TRUE;

		else

			return FALSE;

	}

	

	function adminlisting()

	{

		include("linkmysql.php");

		

		$sql = "Select * from admins where id>'1'";	

		$query = mysql_query($sql,$link);

		if ($query)

		{	

			$lists="";

			while ($r=mysql_fetch_array($query))

			{

				$url='subadmindel.php?id='.$r[0];

				$lists.="<script type='text/javascript' src='js/jquery.js'></script>";

				$lists.="

					<tr class='list_A'>

						<td width='30%' class='bodytextblack' align='center'>$r[1]</td>

						<td width='42%' class='bodytextblack' align='center'>Subadmin</td>

						<td align='center'>

							&nbsp;&nbsp;

                            <a class='actionLink' href='$url'>

							  	<img src='../img/delete.gif' class='imgAction' title='Delete' id='deletegig' onclick='return suredelete()'>

                            </a>

						</td>

					</tr>

				";

			}

			return $lists;

		}else{

			return "";

		}

	}

?>