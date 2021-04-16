<?php 
  function display_navbar($arg_tab_id, $grammarfile, $compiler){
?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="http://xmg.phil.hhu.de">XMG WebGUI</a>
    </div>
    <div>	
      <ul class="nav navbar-nav">
	<li <?php if($arg_tab_id == 'workbench'){ ?> class="active" <?php } ?> ><a href="index.php/upload/workbench<?php
				    if ($grammarfile != "") {
							  echo('?file=');
							  echo(basename($grammarfile,'.'.pathinfo($grammarfile)['extension']).'.mg');
							  }
							  if ($compiler != "") {
 									     echo('&compiler=');
									     echo($compiler);
									     }
									     ?>">Workbench</a></li>
	<li <?php if($arg_tab_id == 'viewer'){ ?> class="active" <?php } ?>><a href="index.php/upload/upload_viewer<?php
		     if ($grammarfile != "") {
					   echo('?file=');
					   echo(basename($grammarfile,'.'.pathinfo($grammarfile)['extension']).'.xml');
							  }
							  if ($compiler != "") {
 									     echo('&compiler=');
									     echo($compiler);
									     }
									     ?>">Viewer</a></li>
	<li <?php if($arg_tab_id == 'documentation'){ ?> class="active" <?php } ?> ><a href="https://github.com/spetitjean/XMG-2/wiki" target="_blank">Documentation</a></li>
	<li <?php if($arg_tab_id == 'issue_tracker'){ ?> class="active" <?php } ?> ><a href="https://github.com/xmg-hhu/xmg-webgui/issues" target="_blank">Issue tracker</a></li>
	<li <?php if($arg_tab_id == 'parser'){ ?> class="active" <?php } ?> ><a href="index.php/upload/tulipa">Parser</a></li>
	<li <?php if($arg_tab_id == 'xtag'){ ?> class="active" <?php } ?> ><a href="index.php/upload/xtag<?php
		     if ($grammarfile != "") {
					   echo('?file=');
					   echo(basename($grammarfile,'.'.pathinfo($grammarfile)['extension']).'.xml');
					   }
					   if ($compiler != "") {
 							      echo('&compiler=');
							      echo($compiler);
							      }
							      ?>">XTAG</a></li>
	<li <?php if($arg_tab_id == 'resources'){ ?> class="active" <?php } ?> ><a href="index.php/upload/resources">Resources</a></li>																													
      </ul>
    </div>
  </div>
</nav>
<?php 
  }
?>
