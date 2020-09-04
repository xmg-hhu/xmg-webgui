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
												<li><a href="index.php/upload/tulipa">Parser</a></li>
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