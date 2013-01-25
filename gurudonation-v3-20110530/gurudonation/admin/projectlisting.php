<?php
	include("header.php");
	if (isset($_POST['Search']))
	{
		if ($_POST['Search']=='Search'){
			$_SESSION['search']=1;
			$_SESSION['kp_title']=$_POST['kp_title'];
			$_SESSION['kp_amount']=$_POST['kp_amount'];
			$_SESSION['kp_duration']=$_POST['kp_duration'];
			$_SESSION['kp_desc']=$_POST['description'];
		}	
	}
	if (isset($_GET['search'])) $_SESSION['search']=0;
?>
<table border="0" cellpadding="0" width="100%" align="center" height="100%">
	<tr>
		<td valign="top" align="center" bgcolor="#FFFFFF">
			<BR />
			<table border="0" cellpadding="0" cellspacing="1" width="95%" class="stdTableBorder" >
				<tr>
					<td valign="top">
						<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td class="pagetitle" align="left" style="padding-left:15px" height="25" align="center">Project Management </td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
                	<td class="successMsg" style="color:#FF0000;">
                    	<h5>
						<?php
							if (isset($_SESSION['status'])) echo $_SESSION['status'];
							$_SESSION['status']="";
						?>
                        </h5>
					</td>
				</tr>
				<tr>
					<td valign="top" align="center">
                        <table border="0" cellpadding="1" cellspacing="2" width="70%">
                            <tr><td>&nbsp;</td></tr>
                            <tr>
                                <td class="varnormal">
                                    Manage Projects here.
                                </td>
                            </tr>
                            <tr><td class="successMsg" align="center">&nbsp;</td></tr>
                        </table>
						<br>
						<div style="width:70%" id="page_my_edit_kapipals" class="page_edit_items">
							<table width="100%" style="text-align:left">
                                <tr>
                                    <th class="title">Project</th>   
                                    <th class="amount">Amount</th>     
                                    <th class="views">Views</th>  
                                    <th class="timeleft">Time Left</th>
                                    <th class="actions"></th>    
                                </tr>
                                <?php
                                    $lists="";
									date_default_timezone_set('UTC');
                                    $curr=date("Y-m-d");
									if (isset($_GET['featured']) && $_GET['featured']==1)
										$a=featuredkapipals();
									else if ($_SESSION['search']==0)
										$a=kapipalids();
									else{
										$a=searchkapipals($_SESSION['kp_title'],$_SESSION['kp_amount'],$_SESSION['kp_duration'],$_SESSION['kp_desc']);
									}
                                    foreach ($a as $i=>$var)
                                    {
                                        $det=kapipaldetail($var);
                                        $viewurl="../project.php?id=".$var;
                                        $editurl="../editproject.php?kid=".$var;
                                        $delurl="../deleteproject.php?kid=".$var;
                                        $diff=abs(strtotime($curr) - strtotime($det[11]));
                                        $years=floor($diff / (365*60*60*24));
                                        $months=floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                        $days=$det[4]-floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                        $lists.="<tr>
                                                 <td class='title'>
                                                 <strong><a class='edit' title='View Project' href='$viewurl' target='_blank'>$det[2]</a></strong>
                                                 Started on ".$det[11].", created by ".idtoname($det[1])."
                                                 </td>
                                                 <td class='amount'>
                                                 <strong>$".$det[12]."</strong>";
                                        $percent=$det[12]*100/$det[3];
										$percent=round($percent);
                                        $lists.=$percent."% of $".$det[3]."<br/>
                                                 <span class='contributors'>".$det[15]." contributions</span></td>
                                                 <td class='views'>".$det[13]."
                                                 <a class='tip' href='../faq.php#public-tips' target='_blank'>How to Increase Traffic?</a>
                                                 </td>";
                                        if ($days>0)
                                            $lists.="<td class='timeleft'>".$days." days</td>";
                                        else
                                            $lists.="<td class='timeleft'>No time left</td>";
										
                                        $lists.="<td class='actions'>
                                                 <a class='edit' title='Edit Project' href='$editurl' target='_blank'>Edit</a>
                                                 <a title='View Project' href='$viewurl' target='_blank'>View</a>
                                                 <a class='delete' title='Delete Project' href='$delurl' target='_blank'>Delete</a>";
										if ($det[14]=='y'){
											$featureurl="featureproject.php?id=".$var."&feature=n";
											$lists.="<a title='Make it unfeatured' href='$featureurl'><img src='../img/unfeatured.png'></a>";
										}else{
											$featureurl="featureproject.php?id=".$var."&feature=y";
											$lists.="<a title='Make it featured' href='$featureurl'><img src='../img/featured.png'></a>";
										}
                                        $lists.="</td></tr>";
                                    }
                                    if ($lists=="")
                                        echo "<tr><td colspan='4'>No Projects</td></tr>";
                                    else 
                                        echo $lists;
                                ?>
                            </table>
						</div>
						<br><br>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<?php
	include("footer.php");
?>
