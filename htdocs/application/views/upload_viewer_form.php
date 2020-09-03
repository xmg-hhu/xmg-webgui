

<html>
		<head>
				<title>Grammar upload | XMG WebGUI</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <!-- Does not work for some reason
						 <base href="<?#php echo base_url(); ?>" /> --> 
				<base href="http://xmg.phil.hhu.de/"/>

        <script src="js/d3.v3.min.js"></script>
        <script src="js/script.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/filestyle.min.js"> </script>

				<?php

				if (isset($_GET['file'])) {
						$grammarfile=$_GET['file'];
				}
				else {
						$grammarfile = "";
				}

				if (isset($_GET['compiler'])) {
						$compiler=$_GET['compiler'];
				}
				else {
						$compiler = "";
				}

				?>

				<link rel="stylesheet" href="css/bootstrap.min.css">
		</head>
		<body>

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="http://xmg.phil.hhu.de">XMG WebGUI</a>
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

				<h1>&nbsp;&nbsp;eXtensible MetaGrammar NG (XMG-NG) Viewer</h1>
				<div class="well">

						<?php echo $error;?>

						<form action="index.php/upload/viewer<?php
																								 if ($grammarfile != "") {
																										 echo('?file=');
																										 echo(basename($grammarfile,'.'.pathinfo($grammarfile)['extension']).'.xml');
																								 }
																								 if ($compiler != "") {
 																										 echo('&compiler=');
																										 echo($compiler);
																								 }
																								 ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
								<input class="btn btn-primary filestyle" data-buttonBefore="true" type="file" data-buttonName="btn-primary" name="userfile" size="20">

								<br>

								<input class="btn btn-primary" name="uploadToViewer" type="submit" value="upload">

						</form>
				</div>
				<br/>

				<br/>

				<div class="navbar navbar-default navbar-fixed-bottom">
            <div class="container">
                <span class="navbar-text">
										<a href="http://www.sfb991.uni-duesseldorf.de/">CRC 991, D&uuml;sseldorf, 2016</a>
                </span>
            </div>
        </div>

		</body>
</html>
