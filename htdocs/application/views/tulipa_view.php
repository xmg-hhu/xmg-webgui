



<html>

		<head>

				<title>TuLiPA online | XMG WebGUI</title>

        <meta http-equiv="content-type" content="text/html; charset=UTF-8">

        <!-- Does not work for some reason

						 <base href="<?#php echo base_url(); ?>" /> --> 

				<base href=""/>



        <script src="../../js/d3.v3.min.js"></script>

        <!-- <script src="../../js/script.js"></script> -->

        <script src="../../js/jquery.min.js"></script>

        <script src="../../js/bootstrap.min.js"></script>

        <script type="text/javascript" src="../../js/filestyle.min.js"> </script>



				

				<link rel="stylesheet" href="../../css/bootstrap.min.css">

		</head>

		<body>



        <nav class="navbar navbar-inverse">

            <div class="container-fluid">

                <div class="navbar-header">

                    <a class="navbar-brand" href="http://xmg.phil.hhu.de">XMG WebGUI</a>

                </div>

                <div>

										<ul class="nav navbar-nav">

												<li><a href="http://xmg.phil.hhu.de/index.php/upload/workbench">Workbench</a></li>

												<li><a href="upload_viewer.html">Viewer</a></li>

												<li><a href="https://github.com/spetitjean/XMG-2/wiki" target="_blank">Documentation</a></li>

												<li><a href="https://github.com/xmg-hhu/xmg-webgui/issues" target="_blank">Issue tracker</a></li>

												<li class="active"><a href="index.html">Parser</a></li>

												<li><a href="http://xmg.phil.hhu.de/index.php/upload/xtag">XTAG</a></li>

										       <li><a href="http://xmg.phil.hhu.de/index.php/upload/resources">Resources</a></li>																													

										</ul>

                </div>

            </div>

        </nav>



				<h1>&nbsp;&nbsp;TuLiPA parser</h1>

				<div class="well">



						 

						<form action="tulipa_viewer" method="post" accept-charset="utf-8" enctype="multipart/form-data" target="_blank">

							

						<fieldset>

							<legend>Select a Parser!</legend>

							<input type="radio" id="rrg" name="parser-sel" value="rrg" checked>

							<label for="rrg">RRG</label><br>

							<input type="radio" id="cyktag" name="parser-sel" value="cyktag">

							<label for="cyktag">CYKTAG</label><br>

							<input type="radio" id="tag2rcg" name="parser-sel" value="tag2rcg">

							<label for="tag2rcg">Tag 2 RCG</label>

						</fieldset>



						<fieldset>

							<legend>Select input parameters</legend>



							<label for="gram-upl">Grammar:</label>

							<input id="gram-upl" class="btn btn-primary filestyle" data-buttonBefore="true" type="file" data-buttonName="btn-primary" name="gramfile" size="20" required="true"/>



							<br>



							<!-- <label for="fram-upl">Frames:</label>

							<input id="fram-upl" class="btn btn-primary filestyle" data-buttonBefore="true" type="file" data-buttonName="btn-primary" name="framfile" size="20">



							<br>



							<label for="tyhi-upl">Type hierarchy:</label>

							<input id="tyhi-upl" class="btn btn-primary filestyle" data-buttonBefore="true" type="file" data-buttonName="btn-primary" name="tyhifile" size="20"> -->



							<!-- <br> -->



							<label for="lem-upl">Lemmas:</label>

							<input id="lem-upl" class="btn btn-primary filestyle" data-buttonBefore="true" type="file" data-buttonName="btn-primary" name="lemfile" size="20">



							<br>



							<label for="morph-upl">Morphological entries:</label>

							<input id="morph-upl" class="btn btn-primary filestyle" data-buttonBefore="true" type="file" data-buttonName="btn-primary" name="morphfile" size="20">



							<br>

							

							<label for="axiom">Axiom:</label>

							<input type="text" id="axiom" name="axiom" style="width: 100px;">

							<br>

							<label for="sent">Sentence:</label>

							<input type="text" id="sent" name="sent" style="width: 700px;" required>



							<br>

						</fieldset>

							<input class="btn btn-primary" name="uploadToViewer" type="submit" value="upload">



						</form>

				</div>

				<br/>



				<br/>



				<div class="navbar navbar-default navbar-fixed-bottom">

            <div class="container">

                <span class="navbar-text">

										<a href="http://www.sfb991.uni-duesseldorf.de/">CRC 991, D&uuml;sseldorf, 2020</a>

				</span>

				<span class="navbar-text">

					<a href="https://github.com/spetitjean/TuLiPA-frames">Code for the parser</a>

				</span>

            </div>

        </div>



		</body>

</html>


