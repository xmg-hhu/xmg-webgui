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
