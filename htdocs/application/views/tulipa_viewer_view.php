<!DOCTYPE html>
<?php include 'navbar_simple.php';?>
<html style="">
<head>
    <title>Viewer | XMG WebGUI</title>

    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <base href="<?php echo base_url(); ?>" />
    <!-- <base href="https://xmg.phil.hhu.de/"/> -->
    <!--                <base href="http://localhost:3000"/>-->

    <script src="../../js/d3.v3.min.js"></script>
    <!--<script>uploaded_file="filefilefile"; console.log('file::',uploaded_file);</script>-->
    <script><?php echo 'uploaded_file="'.$tp_out_file.'"; console.log(uploaded_file);'?></script>    
<script src="../../js/script.js"></script>
    <script src="../../js/xmgview.js"></script>
    <script src="../../js/FileSaver.js"></script>
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../js/jquery.layout.js"></script>

    <link rel="stylesheet" href="../../css/bootstrap.min.css">
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


<!--<input id="file_display" type="hidden" source="../data/test_sisadj.xml" value="data/test_sisadj.xml">-->
<?php
$filename_array = explode("/", $tp_out_file);
$filename_wo_quotes = end($filename_array);
 $filename_wo_dir_with_quotes = '"'.$filename_wo_quotes.'"';

$filename_with_quotes='"'.$tp_out_file.'"';
echo '<input id="file_display" type="hidden" source='.$filename_wo_dir_with_quotes.' value=/tulipa/parseresults/'.$filename_wo_quotes.'>';?> 

<!--<input id="file_display" type="hidden"  source="134-99-174-20_1597666467_out.xml" value="tulipa/parseresults/134-99-174-20_1597666467_out.xml" /> -->
<!--<input id ="file_display" type="hidden" source=verbs_frames.xml value=uploads/134.99_.174_.20_verbs_frames_.xml>-->
<body>
  <?php display_navbar_simple('parser'); ?>
</br>
<h1>Parse results for sentence &lsquo;<?php echo $_POST['sent']; ?>&rsquo;</h1>
<?php ?>
<!--<a href="index.php/upload/upload_viewer" class="btn btn-success" role="button">Upload file</a>-->
<!--<a href="index.php/upload/upload_viewer" target="_blank" class="btn btn-info" role="button"><span-->
<!--        class="glyphicon glyphicon-plus"></span></a>-->

<div class="container">
  <a href="https://github.com/spetitjean/XMG-2/wiki/8:-Tools#the-xmg-webgui" target="_blank" class="btn btn-info"
   role="button">Help</a>
  <a href="#tp_console" class="btn btn-primary" data-toggle="collapse">Show TuLiPA console output</a>
  <div id="tp_console" class="collapse">
    <p style="border:3px; border-style:solid; border-color:#FF0000; padding: 1em;">
    <?php 
    echo '$ '.$tp_command.'<br>';
    foreach ($tp_out as $line) {
        echo $line.'<br>';
    }?>
    </p>
  </div>
</div>
<div class="row">
    <div class="col-sm-2" id="entries">
        <h3 class="list-group-item list-group-item-success">Entries <span id="numentry" class="badge"> </span></h3>
        <p></p>
        <div class="input-group"><span class="input-group-addon">Filter</span>

            <input id="filter" type="text" class="form-control" placeholder="Type to select an entry...">
        </div>
    </div>
    <div class="col-sm-5" id="synTree">
        <h3 class="list-group-item list-group-item-success">Syntactic Tree</h3>
        <p></p>
    </div>
    <div class="col-sm-5">
        <div class="row" id="semFrame">
            <h3 class="list-group-item list-group-item-success">Semantics</h3>
            <p></p>
        </div>
        <div class="row" id="Trace">
            <h3 class="list-group-item list-group-item-success">Trace</h3>
            <p></p>
        </div>
        <div class="row" id="Interface">
            <h3 class="list-group-item list-group-item-success">Interface</h3>
            <p></p>
        </div>
    </div>
</div>
<div id="ajaxLoadAni">
    <img src="img/ajax-loader.gif" alt="Ajax Loading Animation"/>
    <span>Loading...</span>
</div>
<br>
<br>
<br>
<br>
<?php display_bottom_navbar('home');?>
<ul>

</ul>
</body>
</html>

