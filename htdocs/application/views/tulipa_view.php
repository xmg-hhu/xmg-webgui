<?php include 'navbar_simple.php';?>
<html>

  <head>
    
    <title>TuLiPA online | XMG WebGUI</title>
				
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <base href="<?php echo base_url(); ?>" /> 

    <!-- <base href="http://xmg.phil.hhu.de/"/> -->



    <script src="../../js/d3.v3.min.js"></script>

    <!-- <script src="../../js/script.js"></script> -->

    <script src="../../js/jquery.min.js"></script>

    <script src="../../js/bootstrap.min.js"></script>

    <script type="text/javascript" src="../../js/filestyle.min.js"> </script>



				

    <link rel="stylesheet" href="../../css/bootstrap.min.css">

  </head>
  
  <body>

    <?php display_navbar_simple('parser');?>

    <h1>&nbsp;&nbsp;TuLiPA parser</h1>

    <div class="well">



						 

      <form action="index.php/upload/tulipa_viewer" method="post" accept-charset="utf-8" enctype="multipart/form-data" target="_blank">

							

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

	       <label for="frames-upl">Frame grammar:</label>
	       
	       <input id="frames-upl" class="btn btn-primary filestyle" data-buttonBefore="true" type="file" data-buttonName="btn-primary" name="framesfile" size="20">
	       
	       
	       
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


    <?php display_bottom_navbar('parser'); ?>
  </body>
  
</html>


