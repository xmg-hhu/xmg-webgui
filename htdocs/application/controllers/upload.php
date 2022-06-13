<?php

class Upload extends CI_Controller {

    //Display URL path
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    function index() {
        $this->load->view('home_view', array('error' => ' '));
    }

		function upload_viewer() {
        $this->load->view('upload_viewer_form', array('error' => ' '));
    }

		function viewer() {
				if (isset($_POST['uploadToViewer'])) {
	 					$locale='en_US.UTF-8';
			 			putenv('LANG='.$locale);
						$config['upload_path'] = './uploads/';
						$config['allowed_types'] = 'xml';
						$config['max_size'] = '1000000';

						$old_file_name = $_FILES['userfile']['name'];

						$new_file_name = $_SERVER['REMOTE_ADDR'].'_'.$old_file_name;
						$config['file_name'] = $new_file_name;
						$config['overwrite'] = TRUE;

						$this->load->library('upload', $config);

						if (!$this->upload->do_upload()) {
								$error = array('error' => $this->upload->display_errors());
								$this->load->view('upload_viewer_form', $error);
						} else {
								$data = array('upload_data' => $this->upload->data());
								$this->load->view('viewer_view', $data);
						}
				}
				else {
				    $this->load->view('viewer_view', array('error' => ' '));
				}
    }

		function upload_grammar() {
        $this->load->view('upload_grammar_form', array('error' => ' '));
		}

		function xtag() {
				$this->load->view('xtag_view', array('error' => ' '));
		}

		function resources() {
				$this->load->view('resources_view', array('error' => ' '));
		}



		function tulipa(){
			$this->load->view('tulipa_view', array('error' => ' '));

		}



		function tulipa_viewer(){

			if (!isset($_POST['uploadToViewer'])){

				$this->load->view('tulipa_view', array('error' => ' '));

				return;

			}
					

		function upload_tulipa_input_file($file_id_name, $upl_id=''){
			if (!is_uploaded_file($_FILES[$file_id_name]['tmp_name'])){
				//echo "not exists: " . $file_id_name . "<br>";
				if ($file_id_name=='tyhifile'){
				  echo "Type hierarchy was not uploaded (file too large)";
				}				
				return '';
			}

			$upl_dir = 'tulipa/uploads/';

			$upl_ok = 1;

			$upl_file = $upl_dir . $upl_id . '_' .  basename($_FILES[$file_id_name]['name']);

			$upl_file_type = strtolower(pathinfo($upl_file,PATHINFO_EXTENSION));

			// echo "type: " . $upl_file_type;

			if ($upl_file_type != "xml" && $upl_file_type != "mac") {

				//echo "sorry, I need an xml or mac file!";
				$upl_ok = 0;

			}

			if ($file_id_name=='gramfile' and $_FILES['gramfile']['size'] > 1000000){

				echo "Grammar was not uploaded (file too large)";

				$upl_ok = 0;

			}
			if ($file_id_name=='tyhifile' and $_FILES['tyhifile']['size']  > 1000000){

				echo "Type hierarchy was not uploaded (file too large)";

				$upl_ok = 0;

			}
			if ($file_id_name=='morphfile' and $_FILES['morphfile']['size'] > 1000000){

				echo "Morph lexicon was not uploaded (file too large)";

				$upl_ok = 0;

			}
			if ($file_id_name=='lemfile' and $_FILES['lemfile']['size'] > 1000000){

				echo "Lemma lexicon was not uploaded (file too large)";

				$upl_ok = 0;

			}
			if ($file_id_name=='framesfile' and $_FILES['framesfile']['size'] > 1000000){

				echo "Frame grammar was not uploaded (file too large)";

				$upl_ok = 0;

			}

			

			if ($upl_ok > 0){

				$upload_worked = move_uploaded_file($_FILES[$file_id_name]["tmp_name"], $upl_file);

				/* if ($upload_worked) {

					echo "done uploading: " . $upl_file;

				} else {

					echo "error uploading file " . $upl_file;

				} */

			}

			return $upl_file;

		}

			// build the TuLiPA call

			// text inputs: 

			$tp_parser = $_POST['parser-sel'];

			$tp_sent = $_POST['sent'];

			$tp_axiom = $_POST['axiom'];

			/* echo "parser: " . $tp_parser . "<br>";

			echo "sent: " . $tp_sent . '<br>';

			echo "ax: " . $tp_axiom . "<br>"; */



			$tp_out_dir = 'tulipa/parseresults/';

			$upl_id = $_SERVER['REMOTE_ADDR'].'_'.time();

			$upl_id = str_replace('.','-',$upl_id);

			$gramfile = upload_tulipa_input_file('gramfile', $upl_id);

			// $framefile = upload_tulipa_input_file('framfile', $upl_id);

			$tyhifile = upload_tulipa_input_file('tyhifile', $upl_id);

			$lemfile = upload_tulipa_input_file('lemfile', $upl_id);

			$morphfile = upload_tulipa_input_file('morphfile', $upl_id);

			$framesfile = upload_tulipa_input_file('framesfile', $upl_id);



			if ($gramfile == '' or $tp_sent == ''){

				// echo "yay I got here <br>";

				$this->load->view('tulipa_view', array('error' => ' '));

				return;

			} 



			$tp_command = 'java -jar tulipa/TuLiPA-frames.jar -no-gui';

			if ($gramfile != ''){

				$tp_command .= ' -g '.$gramfile;

			}


			if ($lemfile != '') {

				$tp_command .= ' -l '.$lemfile;

			}		

			if ($morphfile != '') {

				$tp_command .= ' -m '.$morphfile;

			}

			if ($framesfile != '') {

				$tp_command .= ' -f '.$framesfile;

			}


			 if ($tyhifile != ''){

			     	$tp_command .= ' -th '.$tyhifile;

			}


			if ($tp_axiom != ''){

				$tp_command .= ' -a '.$tp_axiom;

			}

			if ($tp_sent != ''){

				$tp_command .= ' -s "' . $tp_sent.'"';

			}

			if ($tp_parser == 'rrg'){

				$tp_command .= ' -rrg ';

			} else if ($tp_parser == 'cyktag') {

				$tp_command .= ' -cyktag ';

			} else if ($tp_parser == 'tag2rcg'){

				$tp_command .= ' -tag2rcg ';

			}

			// out file:

			$tp_out_file_str = $tp_out_dir . $upl_id.'_out.xml';

			$tp_command .= ' -xg -o '.$tp_out_file_str;

			// echo $tp_command;

			$tp_out = array();

			exec($tp_command, $tp_out, $tulipa_exec);

			// exec('ls', $ls_out, $ls_exec);

			//foreach($tp_out as $line)

			//	   echo 'tulipa log: ' . $line . '<br>';

			$data['tp_out_file'] = $tp_out_file_str;

			$data['tp_command'] = $tp_command;

			$data['tp_out'] = $tp_out;

			// echo "got it here ".$data['tp_out_file'];

			$this->load->view('tulipa_viewer_view', $data);

		}

	

		function workbench() {

				if (isset($_POST['savecompile'])){ // "save & compile"
						file_put_contents('uploads/'.$_GET['file'],$_POST['myEditorArea']);
						$this->load->view('workbench_view', array('error' => ' '));
				}
				else {
						$locale='en_US.UTF-8';
			 			putenv('LANG='.$locale);
						$config['upload_path'] = './uploads/';
						$config['allowed_types'] = '*';
						$config['max_size'] = '1000000';


						if (isset($_POST['uploadGrammarFile'])){ // grammar upload
								$old_file_name = $_FILES['userfile']['name'];
								$new_file_name = $_SERVER['REMOTE_ADDR'].'_'.$old_file_name;
								$config['file_name'] = $new_file_name;
								$config['overwrite'] = TRUE;

								$this->load->library('upload', $config);

								if (!$this->upload->do_upload()) {
										$error = array('error' => $this->upload->display_errors());
										$this->load->view('upload_grammar_form', $error);
								} else {						
										$data = array('upload_data' => $this->upload->data());
										$data['compiler_name'] =  $this->input->post('compilers') ;
										if ($this->input->post('debug')){
										    $data['debug_val'] = ' --debug ' ;
										}
										else{
										    $data['debug_val'] = '' ;
										}
										if ($this->input->post('type_hierarchy')){
										    $data['type_hierarchy_val'] = ' --more ' ;
										}
										else{
										    $data['type_hierarchy_val'] = '' ;
										}
										$this->load->view('workbench_view', $data);
								}
						}
						else {
								$file_name = $_SERVER['REMOTE_ADDR'].'_'.'newfile'.'.mg';
								copy("examples/xmg-example.mg","uploads/".$file_name);
								$config['file_name'] = $file_name;
								$config['overwrite'] = FALSE;
								
								$this->load->library('upload', $config);

								$this->upload->do_upload();
								$data = array('upload_data' => $this->upload->data());
								$data['compiler_name'] = "synframe";
								$data['debug_val'] = false;
								$data['type_hierarchy_val'] = false;
								
								$this->load->view('workbench_view', $data);
						}
				}
		}

		/* function do_upload() {
			 $config['upload_path'] = './uploads/';
			 $config['allowed_types'] = 'xml';
			 $config['max_size'] = '200000';

			 $old_file_name = $_FILES['userfile']['name'];
			 $new_file_name = $_SERVER['REMOTE_ADDR'].'_'.$old_file_name;
			 $config['file_name'] = $new_file_name;
			 $config['overwrite'] = TRUE;

			 $this->load->library('upload', $config);

			 if (!$this->upload->do_upload()) {
			 $error = array('error' => $this->upload->display_errors());
			 $this->load->view('upload_form', $error);
			 } else {
			 $data = array('upload_data' => $this->upload->data());
			 $this->load->view('xmg_view', $data);
			 }
			 }*/
		
		/* function compile_grammar() {
			 $locale='en_US.UTF-8';
			 putenv('LANG='.$locale);
			 $config['upload_path'] = './uploads/';
			 $config['allowed_types'] = '*';
			 $config['max_size'] = '10000';

			 $old_file_name = $_FILES['userfile']['name'];
			 $new_file_name = $_SERVER['REMOTE_ADDR'].'_'.$old_file_name;
			 $config['file_name'] = $new_file_name;
			 $config['overwrite'] = TRUE;

			 $this->load->library('upload', $config);

			 if (!$this->upload->do_upload()) {
			 $error = array('error' => $this->upload->display_errors());
			 $this->load->view('upload_grammar_form', $error);
			 } else {						
			 $data = array('upload_data' => $this->upload->data());
			 $data['compiler_name'] =  $this->input->post('compilers') ;
			 $this->load->view('xmg_compiler_view', $data);
			 }
			 }*/

}


?>
