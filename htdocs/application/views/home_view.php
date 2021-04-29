<!DOCTYPE html>
<?php include 'navbar_simple.php';?>
<html style="">
  <head>
    <title>XMG WebGUI</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <base href="<?php echo base_url(); ?>" />
    <!-- <base href="http://xmg.phil.hhu.de/"/> -->
    
    <script src="js/d3.v3.min.js"></script>
    
    <script src="js/script.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
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
      
      
      .attr-value{
          font-style:italic;
      }
      .col-sm-2 {
          width: 16.66666667%;
          overflow: auto;
          height: 750px;
      }
      .MathJax_SVG * {
          position: fixed;
	  
      }
      
    </style>
  </head>
  <body>
    <?php display_navbar_simple('home');?>
    <div class="container">
      <div class="jumbotron">
	<h2>eXtensible MetaGrammar (XMG)</h2>
	<?php echo base_url(); ?>
	The XMG system corresponds to what is usually called a “metagrammar compiler”. More precisely it is a tool for designing large scaled grammars for natural language. Provided a compact representation of grammatical information, XMG combines elementary fragments of information to produce a fully redundant strongly lexicalised grammar. It is worth noticing that by XMG, we refer to both a formalism allowing one to describe the linguistic information contained in a grammar, a device computing grammar rules from a description based on this formalism.
	<br/><br/>
	The original XMG website can be found <a href="https://sourcesup.renater.fr/xmg">here</a>. The latest version, <a href="https://github.com/spetitjean/XMG-2">XMG-2</a>, and its <a href="https://github.com/spetitjean/XMG-2/wiki">documentation</a>, are available on GitHub.
	
	<h2>Aim of the XMG WebGUI</h2>
	The XMG WebGUI makes available a compiler and viewer for XMG. No local installation of the XMG software is necessary. Just upload your code and let our server do the job.
	<br/><br/>
	The XMG WebGUI is also intended to make accessible already completed grammars in the XMG format. To begin with, we have converted the <a href="http://www.cis.upenn.edu/~xtag/">XTAG grammar</a> of English. Take a look <a href="xtag">here</a>.
	
	<h2>Team</h2>
	<ul>
	  <li><a href="http://user.phil.hhu.de/~lichte">Timm Lichte</a> (web services, tree and frame display)</li>
	  <li><a href="https://user.phil.hhu.de/petitjean/">Simon Petitjean</a> (XMG integration)</li>
	  <li><a href="https://user.phil.hhu.de/~samih">Younes Samih</a> (web services, tree and frames display)</li>
	  <li><a href="https://user.phil.hhu.de/~seyffarth">Esther Seyffarth</a> (XTAG conversion)</li>
	</ul>
	
	<h2>Contact</h2>
	Besides email, you can also reach us by using the issue tracker of our <a href="https://github.com/xmg-hhu/xmg-webgui">github repository</a>.
	<br/><br/>
	<a href="http://www.uni-duesseldorf.de/home/footer/datenschutz.html">Privacy</a>
      </div>
      
    </div>
    <?php display_bottom_navbar('home') ?>
  </body>
</html>
