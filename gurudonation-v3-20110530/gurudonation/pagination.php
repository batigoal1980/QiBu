<div class='nextsymbol'>
<?php
	$url="latestprojects.php?page=".($page-1);
	$total=count(kapipalids())/4;
   	if ($page>1)
		echo "<span><a href='$url'>&laquo; Prev</a></span>";
	else
		echo "<span>&laquo; Prev</span>";
	for ($i=0;$i<$total;$i++)
	{
		$url="latestprojects.php?page=".($i+1);
		if ($page-1==$i)
			echo "<span class='current'> ".($i+1)." </span> ";
		else
			echo "<span> <a href='$url'>".($i+1)."</a> </span>";		
	}
	$url="latestprojects.php?page=".($page+1);
	if ($page<$total) 
		echo "<span><a href='$url'>Next &raquo;</a></span>";
	else
		echo "<span>Next &raquo;</span>";
?>
</div>