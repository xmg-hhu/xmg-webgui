<!DOCTYPE html>
<?php include 'navbar_simple.php'; ?>
<?php include 'navbar.php'; ?>
<html style="">
  <head>
    <title>Workbench | XMG WebGUI</title>    
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <!-- <base href="http://xmg.phil.hhu.de/"/> -->
    <base href="<?php echo base_url(); ?>" />
    
    <script src="js/d3.v3.min.js"></script>
    
    <script src="js/script.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    <?php
      $locale='en_US.UTF-8';
      putenv('LANG='.$locale);
      if (isset($_GET['file'])) {
      $grammarfile=$_GET['file'];
      }
      else {
      $grammarfile=$upload_data['raw_name'].$upload_data['file_ext'];
      }
      
      if (isset($_GET['compiler'])) {
      $compiler=$_GET['compiler'];
      }
      else {
      $compiler = $compiler_name;
      }

      if (isset($_GET['debug'])) {
      $debug=$_GET['debug'];
      }
      else {
      $debug = $debug_val;
      }

      if (isset($_GET['type_hierarchy'])) {
      $type_hierarchy=$_GET['type_hierarchy'];
      }
      else {
      $type_hierarchy = $type_hierarchy_val;
      }
      
      if (isset($_GET['line'])) {
      $line=$_GET['line'];
      }
      else {
      $line = 0;
      }
      
      ?>
    
    
    <!-- copy content of php variables to javascript  -->
    <script type="text/javascript">
      var uploaded_file_name = "<?php echo($grammarfile) ?>";
      var upload_folder = "uploads/";
      var compiler = '<?php echo($compiler) ?>';
      var debug = '<?php echo($debug) ?>';
      var type_hierarchy = '<?php echo($type_hierarchy) ?>';
      var line = '<?php echo($line) ?>';
    </script>
    
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
		      return this.text === compiler;
		      }).attr('selected','selected');
		      }
		      
		      }) ;
		      </script>
    
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
      
      foreignObject {
      background-color: #fcefa1;
      border:10px solid #ff0000;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
      }
    </style>
  </head>
  
  <body>
    
    <?php display_navbar('workbench', $grammarfile, $compiler); ?>
    
    <a href="index.php/upload/upload_grammar<?php
	     if ($grammarfile != "") {
				   echo('?file=');
				   echo(basename($grammarfile,'.'.pathinfo($grammarfile)['extension']).'.xml');
				   }
				   if ($compiler != "") {
 						      echo('&compiler=');
						      echo($compiler);
						      }
						      ?>" class="btn btn-success" role="button">Upload file</a>
    <a href="index.php/upload/upload_grammar<?php
	     if ($grammarfile != "") {
				   echo('?file=');
				   echo(basename($grammarfile,'.'.pathinfo($grammarfile)['extension']).'.xml');
				   }
				   if ($compiler != "") {
 						      echo('&compiler=');
						      echo($compiler);
						      }
						      ?>" target="_blank" class="btn btn-info" role="button"><span class="glyphicon glyphicon-plus"></span></a>
    
    <div class="row">
      <div class="col-sm-2"  id="files">
	<h3  class="list-group-item list-group-item-success">File</h3>
	<p></p>
	<div class="form-group">
	  <label for="comment" style="margin-left: 3px;font-weight: bold;"> <?php echo(preg_replace("/^.*\..*\..*\..*?_/","",basename($grammarfile))) ?></label><br/>
	  <?php echo('<a target="_blank" href="uploads/'.basename($grammarfile,'.'.pathinfo($grammarfile)['extension']).'.mg " class="btn btn-success" download="'.preg_replace("/^.*\..*\..*\..*_/","",basename($grammarfile,'.'.pathinfo($grammarfile)['extension'])).'.mg" role="button"><span class="glyphicon glyphicon-download-alt"></span> Download MG </a>');?>
	  <p></p>
	  <button id="saveCompileButton" name="savecompile" class="btn btn-primary" form="saveCompileForm" type="submit"><span class="glyphicon glyphicon-save"></span> <span class="glyphicon glyphicon-forward"></span> Save & compile</button>
	  <form method="post" accept-charset="utf-8" enctype="multipart/form-data">
	    <select id='items' name="compiler_selection" class="selectpicker" data-mobile="true" data-style="btn-primary">
	    </select>
	    <br/>
	    Debug mode:<input type="checkbox" id='debug_' name="debug_">
	    <br/>
	    Type hierarchy:<input type="checkbox" id='type_hierarchy_' name="type_hierarchy_">
	    <br/>
	  </form>
	  <p></p>
	  <br />
	  
	  <?php echo('<a target="_blank" href="uploads/'.basename($grammarfile,'.'.pathinfo($grammarfile)['extension']).'.xml " class="btn btn-success" download="'.preg_replace("/^.*\..*\..*\..*_/","",basename($grammarfile,'.'.pathinfo($grammarfile)['extension'])).'.xml" role="button"><span class="glyphicon glyphicon-download-alt"></span> Download XML </a>');?>
	  <?php echo('<a target="_blank" href="index.php/upload/viewer?file='.basename($grammarfile,'.'.pathinfo($grammarfile)['extension']).'.xml" class="btn btn-success" role="button"><span class="glyphicon glyphicon-eye-open"></span> View </a>');?>
	  
	  <p></p>
	  <!-- <button name="compile" class="btn btn-primary" form="saveCompileForm" type="submit"><span class="glyphicon glyphicon-forward"></span> Compile</button> -->
	</div>
      </div>
      <div class="col-sm-10" id="console" >
	<h3  class="list-group-item list-group-item-success">Console</h3>
	<p></p>
	<div class="form-group">
	  <label for="comment">Editor</label>
	  <!-- Create a simple CodeMirror instance -->
	  <link rel="stylesheet" href="codemirror/lib/codemirror.css">
	  <link rel="stylesheet" href="codemirror/theme/monokai.css">
	  <style type="text/css">
	    .CodeMirror {
	    border: 1px solid #ccc;
	    /* height: auto; */
	    }
	  </style>
	  <script src="codemirror/lib/codemirror.js"></script>
	  <script src="codemirror/addon/dialog/dialog.js"></script>
	  <script src="codemirror/addon/search/searchcursor.js"></script>
	  <script src="codemirror/addon/cm-resize.js"></script>
	  <script src="codemirror/addon/edit/matchbrackets.js"></script>
	  <script src="codemirror/addon/edit/closebrackets.js"></script>
	  <script src="codemirror/addon/display/autorefresh.js"></script>
	  <script>
	    
	    CodeMirror.defineExtension("centerOnLine", function(line) { 
	    var h = this.getScrollInfo().clientHeight; 
	    var coords = this.charCoords({line: line, ch: 0}, "local"); 
	    this.scrollTo(null, (coords.top + coords.bottom - h) / 2); 
	    }); 
	    
	    $(function(){
	    $.get(upload_folder+uploaded_file_name,  function(data){
	    $('textarea#myEditorArea').val(data);
	    // now init codemirror 
	    var myEditorArea = document.getElementById("myEditorArea");
	    var editor = CodeMirror.fromTextArea(myEditorArea, {
	    lineNumbers: true,
	    /* theme: "monokai"*/
	    /* viewportMargin: "infinity"*/
	    matchBrackets: true, /* from matchbrackets.js */
	    showCursorWhenSelecting: true,
	    autoCloseBrackets: true, /* from closebrackets.js */
	    autofocus: true,
	    autoRefresh: true,
	    });
	    cmResize(editor); /* from cm-resize.js */
	    
	    editor.setCursor({line: line});
	    editor.centerOnLine(line);
	    
	    editor.save();
	    function updateTextArea() {
	    editor.save();
	    }
	    editor.on('change', updateTextArea);
	    
	    // save cursor position on every activity
	    editor.on("cursorActivity", function () {
	    line = editor.getCursor().line;
	    });
	    
	    });
	    
	    })
	    
	  </script>
	  <form
	    action="index.php/upload/workbench?file=<?php echo($grammarfile) ?>&compiler=<?php  echo($compiler) ?>&debug=<?php  echo($debug) ?>"&type_hierarchy=<?php  echo($type_hierarchy) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" id="saveCompileForm">
	    <textarea name="myEditorArea" rows="10" id="myEditorArea"></textarea>
	  </form>
	  <br/>
	  <label for="comment">Compiler output</label>
	  <script type="text/javascript">
	    $(function(){
	    /* scroll to end */
	    var textarea = document.getElementById("logs");
	    textarea.scrollTop = textarea.scrollHeight;
	    });
	  </script>
	  <textarea class="form-control" rows="10" id="logs" style="height:auto; min-height:200px; resize:both;">
	    <?php $output = shell_exec('/var/www/xmg.phil.hhu.de/htdocs/xmg-ng/xmg compile '.$compiler.' /var/www/xmg.phil.hhu.de/htdocs/uploads/'.basename($grammarfile).' '.$debug.' '.$type_hierarchy.' --force 2>&1');
	    echo($output);
	    echo('Compiler used: '.$compiler);
	    ?>
	  </textarea>
	  <br/><br/>
	  <br/><br/>
	</div>
      </div>
    </div>
    
    <br>
    
    <?php display_bottom_navbar('workbench') ?>
    <!-- <div class="navbar navbar-default navbar-fixed-bottom"> -->
    <!--   <div class="container"> -->
    <!-- 	<span class="navbar-text"> -->
    <!-- 	  <a href="http://www.sfb991.uni-duesseldorf.de/">CRC 991, Düsseldorf, 2017</a> -->
    <!-- 	</span> -->
    <!--   </div> -->
    <!-- </div> -->
    
    
    <!-- forward compiler selection to saveCompileForm -->
    <script type="text/javascript">
      var compiler_select = document.getElementById('items');
      var save_compile_button = document.getElementById('saveCompileButton');
      var save_compile_form = document.getElementById('saveCompileForm');
      var editor_area = document.getElementById('myEditorArea');
      var action = "index.php/upload/workbench";
      var debug = document.getElementById('debug_');
      var debug_select = "";
      var type_hierarchy = document.getElementById('type_hierarchy_');
      var type_hierarchy_select = "";
      
      // handling the checkbox
      debug.addEventListener('change', (event) => {
      if (event.target.checked) {
        debug_select=" --debug ";
      } else {
        debug_select="";
      }
      })

      // handling the checkbox
      type_hierarchy.addEventListener('change', (event) => {
      if (event.target.checked) {
        type_hierarchy_select=" --more ";
      } else {
        type_hierarchy_select="";
      }
      })
 
      save_compile_button.onclick = function () {
      var my_action = action + "?file=" + uploaded_file_name + "&compiler=" + compiler + "&debug=" + debug_select + "&type_hierarchy=" + type_hierarchy_select + "&line=" + line;
      save_compile_form.setAttribute("action", my_action);
      };
      
      compiler_select.onchange = function() {
      compiler = this.value;
      var my_action = action + "?file=" + uploaded_file_name + "&compiler=" + compiler + "&debug=" + debug_select + "&type_hierarchy=" + type_hierarchy_select + "&line=" + line;
      save_compile_form.setAttribute("action", my_action);
      };

    </script>
    
    
  </body>
</html>

