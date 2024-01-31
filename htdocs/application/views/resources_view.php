<!DOCTYPE html>
<?php include 'navbar_simple.php';?>
<html style="">
  <head>
    <title>Resources | XMG WebGUI</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <base href="<?php echo base_url(); ?>" />
    <!-- <base href="https://xmg.phil.hhu.de/"/> -->
    
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
    
    <?php display_navbar_simple('resources');?>
    
    <div class="container">
      <div class="jumbotron">
	<h2>Resources</h2>
	This page gathers links to existing metagrammars which were developed using XMG. These resources are sorted by the type of XMG compiler they use, you can compile them with a local installation by using the corresponding compiler, or select the right item in the selection menu of the <a href="index.php/upload/workbench">Workbench</a>. 
	<br/><br/>	
	If you developed or are developing a resource using XMG and would like to see it listed on this page, or if you would like any of the information on this page to be modified or extended, please contact us.
	<br/><br/>
	<h4>Compiler synsem / XMG-1 - Tree based grammars and predicate semantics</h4>
	<ul>
	  <li><a href="https://github.com/spetitjean/XMG-2/tree/master/MetaGrammars/synsem/FrenchTAG_XMG-2">FrenchTAG</a>: a Tree Adoining Grammar for French written by Benoît Crabbé using XMG-1, slighly updated for XMG-2. See the documentation <a href="https://sourcesup.renater.fr/xmg/frenchmetagrammar/index.html">here</a> (in French).</li>
	  <li><a href="https://github.com/spetitjean/XMG-2/tree/master/MetaGrammars/synsem/XMG-based-XTAG">XMG-based XTAG</a>: a Tree Adjoining Grammar for English based on the large-coverage English TAG (<a href="http://www.cis.upenn.edu/~xtag/">XTAG</a>) written by Katya Saint-Amand during her Master thesis at LORIA (Nancy, France) under the supervision of Claire Gardent. The metagrammar was initially written using XMG-1, and slighly updated for XMG-2. See the documentation <a href="http://homepages.inf.ed.ac.uk/s0896251/XMG-basedXTAG/titlepage.html">here</a>.</li>         
	  <li><a href="https://github.com/eschang/xmg_GC_metagrammar">xmg_GC_metagrammar</a>: a Tree Adjoining Grammar for Guadeloupean Creole, by Emmanuel Schang.</li>
	</ul>
	<br/>
	<h4>Compiler synframe - Tree based grammars and frame semantics</h4>
	<ul>
	  <li><a href="https://github.com/Bonhammer/depictive_grammar">Depictive grammar</a>: an LTAG grammar fragment with semantic frames for English depictives, by Benjamin Burkhardt.</li>
	  <li><a href="https://raw.githubusercontent.com/spetitjean/XMG-2/master/MetaGrammars/synframe/polysemy/al.mg">Al</a>: a description of derivational polysemy with the suffix -al on verbs of change of possession, by Marios Andreou and Simon Petitjean (see the article <a href="http://taln2017.cnrs.fr/wp-content/uploads/2017/06/actes_TALN_2017-vol2.pdf#page=106">here</a>).</li>
	  <li><a href="https://raw.githubusercontent.com/spetitjean/XMG-2/master/MetaGrammars/synframe/frame-constraints.mg">frame-constraints</a>: a set of frame constraints defining a type hierarchy for selected event types, by Laura Kallmeyer.</li>
	  <li><a href="https://gitlab.com/agata.savary/mwe-xmg/">FrenchTAG + MWE</a>: a FrenchTAG grammar updated with a number of Multi Word Expressions, by Agata Savary (<a href="https://xmg.phil.hhu.de/uploads/FrenchTAG+MWE.pdf">draft of an accompanying paper</a>)</li>
	</ul>
	<br/>
	<h4>Compiler lpframe - Morphological descriptions and frame semantics</h4>
	<ul></ul>
	<br/>
	<h4>Compiler tf - Morphological descriptions based on topological fields</h4>
	<ul>
	  <li><a href="https://raw.githubusercontent.com/spetitjean/XMG-2/master/MetaGrammars/tf_morph/ikota_verbs.mg">Ikota-verbs</a>: a metagrammatical description of verbal morphology in Ikota (Bantu language), by Denys Duchier, Brunelle Magnana Ekoukou, Yannick Parmentier, Simon Petitjean, and Emmanuel Schang (see the article <a href="http://aflat.org/content/describing-morphologically-rich-languages-using-metagrammars-look-verbs-ikota">here</a>).</li>
	</ul>
	<br/>
      </div>
    </div>
    
    
  </body>
</html>
