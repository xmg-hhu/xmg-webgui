<?php include 'navbar_simple.php';?>
<?php include 'navbar.php';?>
<html>
  <head>
    <title>Metagrammar upload | XMG WebGUI</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <!-- <base href="http://xmg.phil.hhu.de/"/> -->
    <base href="<?php echo base_url(); ?>" />
    
    <script src="js/d3.v3.min.js"></script>
    
    <script src="js/script.js"></script>
    
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/filestyle.min.js"> </script>
    
    <?php
      
      if (isset($_GET['file'])) {
      $grammarfile = $_GET['file'];
      }
      else {
      $grammarfile = "";
      }
      
      if (isset($_GET['compiler'])) {
      $compiler = $_GET['compiler'];
      }
      else {
      $compiler = "";
      }

      
      ?>
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/bootstrap-select.min.css">
    
    <!-- generate list of available compilers -->
    <?php $output = shell_exec("ls /var/www/xmg.phil.hhu.de/htdocs/xmg-ng/.install/yap/xmg/compiler/ 2>&1"); ?>
    <script type="text/javascript">
      $( document ).ready(function() {
      var a = <?php echo json_encode($output); ?>;
      var res = a.split("\n");
      res.pop();
      for (var i=0;i<res.length;i++){
		      $('<option/>').val(res[i]).html(res[i]).appendTo('#items');
		      //$('select option:contains("synframe")').prop('selected',true);
		      $('#items').find('option').filter(function() {
		      return this.text === 'synframe';
		      }).attr('selected','selected');
		      }
		      
		      }) ;
		      </script>
  </head>
  
  <body>
	<?php display_navbar('workbench', $grammarfile, $compiler);?>
    
    <h1>&nbsp;&nbsp;eXtensible MetaGrammar NG (XMG-NG) Compiler</h1>
    <div class="well">
      
      <?php echo $error;?>
      
      <form action="index.php/upload/workbench" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	
	<input class="btn btn-primary filestyle" data-buttonBefore="true" type="file" data-buttonName="btn-primary" name="userfile" size="20">
	
	<hr></hr>
	<h3> Select a Compiler</h3>
	<div>
	  <select id='items' name="compilers" class="selectpicker" data-mobile="true" data-style="btn-primary">
	  </select>
	</div>
	Debug mode:<input type="checkbox" id='debug' name="debug">
	</div>
	Type hierarchy:<input type="checkbox" id='type_hierarchy' name="type_hierarchy">
	<br/>
	<br/>
	
	
	<input class="btn btn-primary" name="uploadGrammarFile" type="submit" value="Upload">
	
      </form>
    </div>
    <br/>
    
    <br/>
    
    <!-- <div class="navbar navbar-default navbar-fixed-bottom"> -->
    <!--   <div class="container"> -->
    <!-- 	<span class="navbar-text"> -->
    <!-- 	  <a href="http://www.sfb991.uni-duesseldorf.de/">CRC 991, D&uuml;sseldorf, 2017</a> -->
    <!-- 	</span> -->
    <!--   </div> -->
    <!-- </div> -->
    <?php display_bottom_navbar('workbench'); ?>
    
  </body>
</html>
