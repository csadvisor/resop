<html>
<head>
	<title>CS Research Opportunities</title>
	<!-- insert metadata here -->

	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<!-- CSS for everything -->
		<!--style type="text/css">
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
	</style-->

</head>
<body>
	<nav class="navbar navbar-inverse" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<li>
					<a href="/resop/protected/index.php/curis">
						<img src="https://cs.stanford.edu/resop/cslogo.png">
					</a>
				</li>
			</div>
			
		</div>
		<!--<p class="navbar-text navbar-right">Signed in as <a href="#" class="navbar-link">Mark Otto</a></p>-->
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<h3><?= isset($category) ? $category : "" ?></h3>
				<ul class="nav nav-pills nav-stacked well">
					<?php
					if (isset($links)) {
						$longest = "";
						$url = $_SERVER['PHP_SELF'];

						foreach($links as $name => $link){
							if (strpos($url, $link) !== FALSE && strlen($link) > strlen($longest)) {
								$longest = $link;
							}
						} 
						foreach($links as $name => $link){
							if ($link == $longest) {
								echo "<li class=\"active\">";
							} else {
								echo "<li>";
							}
							echo "<a href =\"".$link."\">".$name ."</a></li>";
						}
					}
					?>
				</ul>
			</div>
			<div class="col-md-9">
				<div id="main">
					<?  if (isset($html)) {
						echo $html;
					} else if (isset($view)) {
						$this->load->view($view, $this);
					}
					?>
				</div>
			</div>	
		</div>
		<div class="row text-center">
			<div id="botbar">
				<p>
					<a href = "/resop/protected/index.php/"> 
						Research Opportunities Home
					</a><br />
					Questions? Contact the 
					<a href="mailto:advisor@cs.stanford.edu">
						Course Advisor
					</a>
				</p>
			</div>
		</div>
		<!--div id="sidebar">
			<h3 style="margin-bottom:10px">Navigation</h3>
			<ul>
				
			</ul>
		</div>
		<div id="topbar">
			<div style="display:inline;">
				<a href = "/resop/protected/index.php/curis">
				<img src="https://cs.stanford.edu/resop/cslogo.png"></a>
			</div>
		</div>  
		<div id="container"-->

			<!--end 'main' div -->

		</div> <!--end 'container' div -->
	</body>
	</html>
