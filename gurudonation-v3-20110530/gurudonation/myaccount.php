<?php
	include_once("header.php");
?>
	<div id="main">
			<div id="main_2">			        
				<div id="page_my_home">
					<div class="breadcrumbs">
						<a href="index.php" title="Go to Home">Home</a> &gt; 
						My Account
					</div>
					<h1>My Account(Balance $<?php echo getbalance($_SESSION['kapipalist12878498g94j93gj9458']);?>)</h1>
					<div id="menu">
        				<h2>Manage Projects</h2>
						<div>
							<a href="myprojects.php">My Projects</a>
							<strong>Watch your earnings</strong> and edit existing Projects
						</div>
						<div>
							<a href="new.php">Create Project</a>
							Start a new Project
						</div>
                        <div>
							<a href="withdraw.php">Withdraw Money</a>
						</div>
						<h2>My Profile</h2>
						<div>
							<a href="myprofile.php">Edit Profile</a>
							Change your profile
						</div>
						<div>
							<a href="mypassword.php">Change Password</a>
							Change your password
						</div>
						<div>
							<a href="deleteaccount.php">Delete Account</a>
							Delete your account and leave GuruDonation.com
						</div>
					</div>
				</div>
				<div class="clearer"></div>
			</div>									
	</div>
<?php
	include_once("footer.php");
?>