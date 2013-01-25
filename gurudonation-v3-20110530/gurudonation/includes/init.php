<?php
	include_once("initsettings.php");
	include_once("kapipalinfo.php");
	include_once("initcate.php");
	newuser("Paul","webstar1992@gmail.com","whoami","","y","webstar1992@gmail.com");
	newkapipal(1,"wedding party",3500,14,100,"","img/default1.jpg","http://Guruscript.com","I'm looking for donation from my customers.","","y");
	newcontribution(1,1500,"John","Happy your wedding!");
	newcontribution(1,2500,"Lohan","My regards to you. Have a nice party!");
	setkapipaldetail(1,"amountraised",4000);
	setkapipaldetail(1,"contributions",2);
	setkapipaldetail(1,"views",32);
?>