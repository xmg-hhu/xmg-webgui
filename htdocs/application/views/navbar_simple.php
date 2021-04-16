<?php
  function display_navbar_simple($arg_tab_id){
?>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
	<a class="navbar-brand" href=".">XMG WebGUI</a>
      </div>
      <div>
	<ul class="nav navbar-nav">
<?php
  $tabs = array('workbench' => '<a href="index.php/upload/workbench">Workbench</a>',
               'viewer' => '<a href="index.php/upload/upload_viewer">Viewer</a>',
               'documentation' => '<a href="https://github.com/spetitjean/XMG-2/wiki" target="_blank">Documentation</a>',
	       'issue_tracker' => '<a href="https://github.com/xmg-hhu/xmg-webgui/issues" target="_blank">Issue tracker</a>',
	       'parser' => '<a href="index.php/upload/tulipa">Parser</a>',
	       'xtag' => '<a href="index.php/upload/xtag">XTAG</a>',	
               'resources' => '<a href="index.php/upload/resources">Resources</a>'
  );
  foreach ($tabs as $tab_id => $tab) {
    if($arg_tab_id == $tab_id){
      echo('<li class="active">');
    }
    else{
      echo('<li>');	    
    }
	    
    echo($tab);
  }
  echo('</li>');
?>
	</ul>
      </div>
    </div>
  </nav>
<?php    
  }

function display_bottom_navbar($arg_tab_id){
?>
  				<div class="navbar navbar-default navbar-fixed-bottom">
				  <div class="container">
				    <span class="navbar-text">
				      <a href="https://treegrasp.phil.hhu.de/">TreeGraSP</a>,
				      <a href="http://www.sfb991.uni-duesseldorf.de/">CRC 991</a>,
				      Düsseldorf, 2021
				    </span>
				    <?php 
				     if($arg_tab_id == 'parser'){
                                    ?>
				    <span class="navbar-text">
				      <a href="https://github.com/spetitjean/TuLiPA-frames">Code for the parser</a>  
                                    </span>
				    <?php
                                      }
				    ?>
				  </div>
				</div>

<?php
}
?>
