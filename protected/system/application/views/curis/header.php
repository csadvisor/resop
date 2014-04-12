<html>
	<head>
		<title><?php echo $title; ?></title>
		<!-- insert metadata here -->
		
		
		<!-- CSS for everything -->
		<style type="text/css">
		#container {
			margin-left: 100px;
			margin-right: auto;
			width: 800px;
		}
		
		#topbar {	
			background: url('https://cs.stanford.edu/resop/gradient.png');
			margin: 0 0 40px 0;
			text-align: left;
			height:95px;
			vertical-align:middle;
		}

   
		#main {
			float: left;
			width: 800px;
			background-color: #EFEFEF;
		}
	       
		a:link { color: #980000; }
		 a:visited { color: #980000; }

		#sidebar {
			width: 140px;
			float: left;
			padding: 5px;
			
		}
		
		#sidebar h3, #sidebar ul {
			margin: 0px;
			padding: 0px;
			list-style: none;
			}
			
		#sidebar li{
			padding-left: 10px;
			margin: 0px;
			}
		
		#content {
			width: 645px;
			float: left;
			padding: 5px;
			padding-right: 0px;
			background-color: #FFFFFF;
			min-height: 300px;
		}
		
		#content h1, #content h2{
			margin: 0px;
			text-align: center;
		}

		
		#content table td.caption {
			color: #980000;
			text-align: right;
			margin-top: auto;
			margin-bottom: auto;
                        font-size:15px;
			padding-right: 3px;
		}
		
		#content table td.input {
			text-align: left;
			margin-top: auto;
			margin-bottom: auto;
			padding-left: 3px;
                        font-size:13px;
		}
	        table.shaded td {
                   background-color:#F4F4F4;
                   border-top:solid 1px #FFF;
   	           padding:3px 10px 3px 10px;
	        }
                table.shaded {
		   border-collapse:collapse;
                   border:solid 2px #BBB;
                }
		
		#content table#adminsettings td{
			text-align: left;
		}
		#content table#adminsettings td.button{
			width: 100px;
			text-align: center;
		}
		
		#content table.projectblurb {
			background-color: #EEEEEE;
			margin-left: auto;
			margin-right: auto;
			margin-bottom: 20px;
			padding: 10px;
			width: 400px;
		}
		
		#content table.projectblurb td.caption{
			width: 125px;
		}
		
		#content .b-red{
			color:#980000; 
			font-weight:bold;
		}
		
		#content .b{
			font-weight: bold;
		}
		
		#botbar {
			float: left;
			width: 800px;
			text-align: center;
		}
		a img {
			border-width: 0px;
		}
		
		body {
			font-family: Arial, sans-serif;
			margin:0px;
		}
		
		.projectheader {
			width: 80%;
			margin-left: auto;
			margin-right: auto;
		}
		
		.application {
			width: 90%;
			margin-left: auto;
			margin-right: auto;
			background-color: #EEEEEE;
		}
		.accept {font-weight:bold;color:#339933;}
		.reject {font-weight:bold;color:#D80000;}
		.application .caption {width: 35%;}
		</style>
			
	</head>
	<body>
		<div id="topbar">
			<div style="display:inline;">
				<a href = "<?php 
	    	if ($title == "Stanford Research Opportunities") 
	     		echo 'http://cs.stanford.edu/resop';
	    	else echo '/resop/protected/index.php/curis'?>">
				<img src="https://cs.stanford.edu/resop/cslogo.png"></a>
			</div>
		</div>  
		<div id="container">

		<div id="main">
