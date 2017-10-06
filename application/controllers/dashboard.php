<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
        parent::__construct();

	     if (!$this->session->userdata('is_logged_in')){
	        redirect('auth/login');
	     }
    
    }

	public function index()
	{
		$q_desc		= "SELECT about_description from about";
        $get_desc	=  $this->db->query($q_desc)->row_array();
        $data['deskripsi'] = $get_desc['about_description'];
		$this->template->load('template','dashboard/dashboard',$data);
	}

	public function deskripsi(){
		if($_POST){
			$deskripsi	=   $this->input->post('deskripsi');
			$data_desc		= array('about_description' => $deskripsi);
			$this->db->update('about', $data_desc); 
			$data['success'] = TRUE;
		}

		$q_desc		= "SELECT about_description from about";
        $get_desc	=  $this->db->query($q_desc)->row_array();

        $data['deskripsi'] = $get_desc['about_description'];

		$this->template->load('template','deskripsi/view',$data);
	}
}
