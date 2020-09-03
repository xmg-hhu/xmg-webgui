
<!DOCTYPE html>
<html style="">
    <head>
        <title>XTAG | XMG WebGUI</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <!-- <base href="<?#php echo base_url(); ?>" /> -->
				<base href="http://xmg.phil.hhu.de/"/>
				
				<script src="js/d3.v3.min.js"></script> <!-- needed by script.js --> 
				<script src="xtag/js/script.js"></script> <!-- connects data and viewer -->
				<script src="js/xmgview.js"></script> <!-- draws the trees -->
				<script src="js/FileSaver.js"></script> <!-- for doenloading SVGs -->
				
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

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

         /* .col-sm-2 {
            width: 16.66666667%;
            overflow: auto;
            height: 750px;
						} */
				 
        </style>
    </head>

    <body>

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href=".">XMG WebGUI</a>
                </div>
                <div>
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
																															 ?>">Workbench</a></li>
												<li><a href="index.php/upload/viewer<?php
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
												<li class="active"><a href="index.php/upload/xtag<?php
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

        <div class="row">

            <div class="col-sm-2"  id="entries" >

                <h3  class="list-group-item list-group-item-success">Entries <span id="numentry" class="badge"> </span></h3>
                <p></p>
                <div class="input-group"> <span class="input-group-addon">Filter</span>
                    <input id="filter" type="text" class="form-control" placeholder="Type to select an entry...">
                </div>
            </div>
            <div class="col-sm-10"  id="synTree">
                <h3  class="list-group-item list-group-item-success">Syntactic Tree</h3>
                <p></p>
								<div class="container" id="grammarDescription">
										<div class="jumbotron">
												<h2>About XTAG</h2>
												XTAG is a wide-coverage TAG for English developed between 1988&ndash;2001 within the <a href="http://www.cis.upenn.edu/~xtag/">XTAG project</a> located at the University of Pennsylvania. 

												<ul>
														<li>Project homepage: <a href="http://www.cis.upenn.edu/~xtag/">http://www.cis.upenn.edu/~xtag/</a></li>
														<li>Grammar files: <a href="ftp://ftp.cis.upenn.edu/pub/xtag/release-2.24.2001/english_gram.tar.gz">ftp://ftp.cis.upenn.edu/pub/xtag/release-2.24.2001/english_gram.tar.gz</a></li>
														<li>Grammar manual:<a href="ftp://ftp.cis.upenn.edu/pub/xtag/release-2.24.2001/tech-report.pdf">ftp://ftp.cis.upenn.edu/pub/xtag/release-2.24.2001/tech-report.pdf</a></li> 
												</ul>

												<p></p>
												
												<h3>Preprocessing notice</h3>

												XTAG has been developed with a metagrammar system different from XMG. The original format of XTAG therefore had to be converted into XMG XML (see <a href="https://github.com/xmg-hhu/xtag2xml">https://github.com/xmg-hhu/xtag2xml</a>).		

										</div>
								</div>
            </div>

						<br>

						<div class="navbar navbar-default navbar-fixed-bottom">
								<div class="container">
										<span class="navbar-text">
												<a href="http://www.sfb991.uni-duesseldorf.de/">CRC 991, Düsseldorf, 2017</a>
										</span>
								</div>
						</div>
    </body>
</html>
