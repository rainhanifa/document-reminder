<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class report extends CI_Controller {

	function __construct() {
        parent::__construct();

	     if (!$this->session->userdata('is_logged_in')){
	        redirect('auth/login');
	     }
    
    }
	public function index()
	{
		redirect(base_url('report/dokumen_tersimpan'));
	}

	public function dokumen_tersimpan()
	{
		$query_tersimpan = "SELECT md.*, dd.*
							FROM master_data as md, detail_data as dd
							WHERE md.id = dd.id_master_data";
		$data['dokumen'] = $this->db->query($query_tersimpan)->result_array() ;
		$this->load->view('report/dokumen_tersimpan', $data);
	}

	public function dokumen_lengkap()
	{
		$query_lengkap = "SELECT md.*, dd.*, mp.*
							FROM master_data as md, detail_data as dd, master_peminjaman as mp
							WHERE md.id = dd.id_master_data AND md.id = mp.id_client AND mp.status = 1 
							GROUP BY md.id";
		$data['dokumen'] = $this->db->query($query_lengkap)->result_array() ;
		$this->load->view('report/dokumen_lengkap', $data);
	}

	public function dokumen_keluar()
	{
		$query_keluar = "SELECT md.*, dd.*, mp.*, dp.*
							FROM master_data as md, detail_data as dd, master_peminjaman as mp, detail_peminjaman as dp
							WHERE md.id = dd.id_master_data AND dp.status_dokumen != 1 AND dp.id_dokumen = dd.id_dokumen
							AND mp.id_client = md.id";
		$data['dokumen'] = $this->db->query($query_keluar)->result_array() ;
		$this->load->view('report/dokumen_keluar', $data);
	}
}
