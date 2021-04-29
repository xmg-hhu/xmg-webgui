# xmg-webgui

This repo holds the code for the website xmg.phil.hhu.de 

For configuring a local version of this website for development, this guide might be helpful: https://prognotes.net/2016/08/configuring-local-lamp-stack-web-development/  Requirements on your local machine are apache and php for running the server, and a jdk if you want to work with TuLiPA.

Directories to add (with adapted writing permissions):
- htdocs/uploads
- htdocs/tulipa/uploads
- htdocs/tulipa/parseresults

To adapt all links for a local version:
- in htdocs/config/config.php, adapt the line:
    $config['base_url'] = 'http://xmg.phil.hhu.de';
