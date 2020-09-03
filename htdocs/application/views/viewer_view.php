<!DOCTYPE html>
<html style="">
		<head>
				<title>Viewer | XMG WebGUI</title>

				<meta http-equiv="content-type" content="text/html; charset=UTF-8">
				<!-- <base href="<?#php echo base_url(); ?>" /> -->
				<base href="http://xmg.phil.hhu.de/"/>
				
				<script src="js/d3.v3.min.js"></script>
				<script src="js/script.js"></script>
				<script src="js/xmgview.js"></script>
				<script src="js/FileSaver.js"></script>
				<script src="js/jquery.min.js"></script>
				<script src="js/bootstrap.min.js"></script>
				<script type="text/javascript" src="js/jquery.layout.js"></script>

				<?php

				if (isset($_GET['file'])) {
						$grammarfile=$_GET['file'];
				}
				else {
						$grammarfile="";
				}

				if (isset($_GET['compiler'])) {
						$compiler=$_GET['compiler'];
				}
				else {
						$compiler = "";
				}

				?>

				<link rel="stylesheet" href="css/bootstrap.min.css">
				<style type="text/css">
				 .node {
						 cursor: pointer;
				 }
				 .node circle {
						 fill: #fff;
						 stroke: steelblue;
						 stroke-width: 1.5px;
				 }
				 .node text {
						 font: 10px sans-serif;
				 }
				 .link {
						 fill: none;
						 stroke: steelblue;
						 stroke-width: 1.5px;
				 }
				 body {
						 overflow: auto;
				 }

				 .col-sm-2 {
						 overflow: auto;
						 /* height: 750px; */
				 }

				 #semFrame{
						 overflow: auto;
				 }

				 #synTree{
						 overflow: auto;
				 }

				</style>
		</head>


		<?php

		if (isset($_GET['file'])) {
				echo('<input id ="file_display" type="hidden" value='."uploads/".$_GET['file'].'>');
		}
		  else {
				echo('<input id ="file_display" type="hidden" source='.$_FILES['userfile']['name'].' value='."uploads/".$upload_data['raw_name'].$upload_data['file_ext'].'>');
		}
		?>

		<body>
				<nav class="navbar navbar-inverse">
						<div class="container-fluid">
								<div class="navbar-header">
										<a class="navbar-brand" href=".">XMG WebGUI</a>
								</div>
								<div
										<ul class="nav navbar-nav">
												<li><a href="index.php/upload/workbench<?php
																															 if ($grammarfile != "") {
																																	 echo('?file=');
																																	 echo(basename($grammarfile,'.'.pathinfo($grammarfile)['extension']).'.mg');
																															 }
																															 if ($compiler != "") {
 																																	 echo('&compiler=');
																																	 echo($compiler);
																															 }
																															 ?>
																		 ">Workbench</a></li>
												<li class="active"><a href="index.php/upload/upload_viewer<?php
																																									if ($grammarfile != "") {
																																											echo('?file=');
																																											echo(basename($grammarfile,'.'.pathinfo($grammarfile)['extension']).'.xml');
																																									}
																																									if ($compiler != "") {
 																																											echo('&compiler=');
																																											echo($compiler);
																																									}
																																									?>">Viewer</a></li>
												<li><a href="https://github.com/spetitjean/XMG-2/wiki" target="_blank">Documentation</a></li>
												<li><a href="https://github.com/xmg-hhu/xmg-webgui/issues" target="_blank">Issue tracker</a></li>

												<li><a href="https://github.com/spetitjean/TuLiPA-frames">Parser</a></li>
												<li><a href="index.php/upload/xtag<?php
																													if ($grammarfile != "") {
																															echo('?file=');
																															echo(basename($grammarfile,'.'.pathinfo($grammarfile)['extension']).'.xml');
																													}
																													if ($compiler != "") {
 																															echo('&compiler=');
																															echo($compiler);
																													}
																													?>">XTAG</a></li>
												<li><a href="index.php/upload/resources">Resources</a></li>
										</ul>
								</div>
						</div>
				</nav>
    </br>
    <a href="index.php/upload/upload_viewer<?php
	     if ($grammarfile != "") {
				   echo('?file=');
				   echo(basename($grammarfile,'.'.pathinfo($grammarfile)['extension']).'.xml');
				   }
				   if ($compiler != "") {
 						      echo('&compiler=');
						      echo($compiler);
						      }
						      ?>" class="btn btn-success" role="button">Upload file</a>
    <a href="index.php/upload/upload_viewer<?php
	     if ($grammarfile != "") {
				   echo('?file=');
				   echo(basename($grammarfile,'.'.pathinfo($grammarfile)['extension']).'.xml');
				   }
				   if ($compiler != "") {
 						      echo('&compiler=');
						      echo($compiler);
						      }
						      ?>" target="_blank" class="btn btn-info" role="button"><span class="glyphicon glyphicon-plus"></span></a>
        <a href="https://github.com/spetitjean/XMG-2/wiki/8:-Tools#the-xmg-webgui" target="_blank" class="btn btn-info" role="button">Help</a>
    
    <div class="row">
      <div class="col-sm-2"  id="entries" >
        <h3  class="list-group-item list-group-item-success">Entries <span id="numentry" class="badge"> </span></h3>
        <p></p>
        <div class="input-group"> <span class="input-group-addon">Filter</span>
	  
	  <input id="filter" type="text" class="form-control" placeholder="Type to select an entry...">
        </div>
        </div>
        <div class="col-sm-5"  id="synTree">
            <h3  class="list-group-item list-group-item-success">Syntactic Tree</h3>
            <p></p>
        </div>
            <div class="col-sm-5" >
	  <div class="row" id="semFrame">
            <h3  class="list-group-item list-group-item-success">Semantics</h3>
            <p></p>
	  </div>
	  <div class="row" id="Trace">
	    <h3  class="list-group-item list-group-item-success">Trace</h3>
	    <p></p>
	  </div>
	  <div class="row" id="Interface">
	    <h3  class="list-group-item list-group-item-success">Interface</h3>
	    <p></p>
	  </div>
        </div>
    </div>
    <div id="ajaxLoadAni">
        <img src="img/ajax-loader.gif" alt="Ajax Loading Animation" />
        <span>Loading...</span>
    </div>		
    <br>
    <br>
    <br>
    <br>
    <div class="navbar navbar-default navbar-fixed-bottom">
        <div class="container">
            <span class="navbar-text">
    								<a href="http://www.sfb991.uni-duesseldorf.de/">CRC 991, Düsseldorf, 2017</a>
            </span>
        </div>
    </div>
		<ul>

		</ul>
		</body>
</html>
