<?php
	include_once("header.php");
	if (!isset($_SESSION['kapipalist12878498g94j93gj9458'])){
		?><script>window.location.href="index.php";</script><?php
	}
	date_default_timezone_set('UTC');
	$a=userkapipals($_SESSION['kapipalist12878498g94j93gj9458']);
?>    
	<div id="main">
			<div id="main_2">			        
				<div id="page_my_edit_kapipals" class="page_edit_items">
					<div class="breadcrumbs">
						<a href="index.php" title="Go to Home">Home</a> &gt; 
						<a href="myaccount.php" title="Go to My Account">My Account</a> &gt; 
						My Projects
					</div>
					<h1>My Projects</h1>    
					<table width="100%">
						<tr>
							<th class="title" align="left">Project</th>   
							<th class="amount" align="left">Amount</th>     
							<th class="views" align="left">Views</th>  
							<th class="timeleft" align="left">Time Left</th>
							<th class="actions" align="left"></th>    
						</tr>
                        <?php
							$lists="";
							$curr=date("Y-m-d");
							foreach ($a as $i=>$var)
							{
								$det=kapipaldetail($var);
								$viewurl="project.php?id=".$var;
								$editurl="editproject.php?kid=".$var;
								$delurl="deleteproject.php?kid=".$var;
								$diff=abs(strtotime($curr) - strtotime($det[11]));
								$years=floor($diff / (365*60*60*24));
								$months=floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
								$days=$det[4]-floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
								$lists.="<tr>
										 <td class='title'>
										 <strong><a class='edit' title='View Project' href='$viewurl'>$det[2]</a></strong>
										 Started on ".$det[11]."
										 </td>
										 <td class='amount'>
										 <strong>$".$det[12]."</strong>";
								$percent=$det[12]*100/$det[3];
								$percent=round($percent);
								$lists.=$percent."% of $".$det[3]."<br/>
										 <span class='contributors'>".$det[15]." contributions</span></td>
										 <td class='views'>".$det[13]."
										 <a class='tip' href='faq.php#public-tips'>How to Increase Traffic?</a>
										 </td>";
								if ($days>0)
									$lists.="<td class='timeleft'>".$days." days</td>";
								else
									$lists.="<td class='timeleft'>No time left</td>";
								$lists.="<td class='actions'>
										 <a title='Edit Project' href='$editurl'>Edit</a>
										 <a title='View Project' href='$viewurl'>View</a>
										 <a title='Delete Project' href='$delurl'>Delete</a>
										 </td>";
								$lists.="</tr>";
							}
							if ($lists=="")
								echo "<tr><td colspan='4'>No Projects</td></tr>";
							else 
								echo $lists;
						?>
					</table>
				</div>
				<div class="clearer"></div>
			</div>									
	</div>
<?php
	include_once("footer.php");
?>