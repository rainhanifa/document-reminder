<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class master extends CI_Controller {

	function __construct() {
        parent::__construct();

	     if (!$this->session->userdata('is_logged_in')){
	        redirect('auth/login');
	     }
    
    }

	public function index()
	{
		redirect(base_url('master/view'));
	}

	public function entry()
	{
		$data['entry'] = "OK";
		if($_POST){
			/** CLIENT DATA **/
            $nama               =   $this->input->post('nama_client');
            $jenis              =   $this->input->post('tipe_client');
            $nama_proyek        =   $this->input->post('nama_proyek');
            $tipe_dokumen       =   $this->input->post('tipe_dokumen');
            $dokumen       		=   $this->input->post('dokumen');
            $new_client_id 		=	0;
            $counter			=	1;

            // CEK JIKA DATA NAMA KLIEN SUDAH ADA DI DATABASE
            $cek_client	= $this->db->query("SELECT * FROM master_data WHERE nama_client = '$nama'")->num_rows();
            if($cek_client == 0){
            	// POST NEW
	            $data_client        =   array('nama_client'=>$nama,'tipe_client'=>$jenis, 'nama_proyek' => $nama_proyek);
	            $this->db->insert('master_data',$data_client);


	            $new_client_id		= 	$this->db->select('id')->order_by('id','desc')->limit(1)->get('master_data')->row('id'); 
	            
            }
            else{
            	// CEK NAMA PROJECT
            	$cek_proyek	= $this->db->query("SELECT * FROM master_data WHERE nama_client = '$nama' AND nama_proyek = '$nama_proyek'")->num_rows();
            	if($cek_proyek == 0){
            		//POST NEW
            		$data_client        =   array('nama_client'=>$nama,'tipe_client'=>$jenis, 'nama_proyek' => $nama_proyek);
		            $this->db->insert('master_data',$data_client);

		            $new_client_id		= 	$this->db->select('id')->order_by('id','desc')->limit(1)->get('master_data')->row('id');
            	}
            	else
            	{
            		$new_client_id	= $this->db->query("SELECT * FROM master_data WHERE nama_client = '$nama' AND nama_proyek = '$nama_proyek'")->row()->id;
            		$last_document_id = $this->db->query("SELECT * FROM detail_data WHERE id_master_data = $new_client_id ORDER BY id_dokumen DESC")->row()->nama_dokumen;
            		$last 	 		 = explode('-',$last_document_id);
            		$counter = end($last) + 1;
            	}
            }

			/** FILE UPLOAD **/
	            // TIPE DOKUMEN
	            // RENAME FILE 
			$files = $_FILES;
			$filesCount = count($_FILES['dokumen']['name']);
			for($i = 0; $i < $filesCount; $i++){
				/**$_FILES['dokumen']['name'][$i];
				$_FILES['dokumen']['tmp_name'][$i];
		        $_FILES['dokumen']['error'][$i];
		        $_FILES['dokumen']['size'][$i];*/
		        $docname = explode('.',$_FILES['dokumen']['name'][$i]);
				$ext = end($docname);

				$folder = FCPATH.'uploads\\';
	            $last_id	= $this->db->select('id_dokumen')->order_by('id_dokumen','desc')->limit(1)->get('detail_data')->row('id');
	            $new_id		= $last_id + 1;
		        

				$new_name	= "DR-".$new_client_id."-".$counter;
				$link		= 'uploads/'.$new_name;

				
                $temp = $_FILES['dokumen']['tmp_name'][$i];
                if(move_uploaded_file($temp, $folder.$new_name.".".$ext))
                {
                	$data_file        =   array('id_master_data'=>$new_client_id,
                                        		'nama_dokumen'	=>$new_name,
                                        		'file_dokumen'	=>$link.".".$ext,
                                        		'tipe_dokumen'	=>$tipe_dokumen[$i],
                                        		'status' => 1);
                	
					$this->db->insert('detail_data',$data_file);

                 	$data['success'] = TRUE;
                 	//$this->template->load('template','master/post',$data);
                	
                	$counter++;
                }
                else
                {
                	redirect(base_url('master/view'));
                }
        	}
		}
		if($_GET){
			$eid	=	$_GET['eid'];
			$edit_data = $this->db->query("SELECT * FROM master_data WHERE id = $eid")->row();
			$data['nama_client'] = $edit_data->nama_client;
			$data['jenis_client'] = $edit_data->tipe_client;
			$data['nama_proyek'] = $edit_data->nama_proyek;
		}
		$this->template->load('template','master/post',$data);	
	}

	public function view()
	{
		$data['client'] = $this->db->query('SELECT * FROM master_data')->result_array() ;
		$this->template->load('template','master/view',$data);
	}


	public function delete()
	{
		$id_client = $_GET['id'];

		$query_cek_pinjaman = "SELECT * FROM master_peminjaman WHERE id_client = $id_client AND status = 0";
		$cek_pinjaman 		= $this->db->query($query_cek_pinjaman)->num_rows();

		if($cek_pinjaman){
			$data['alert']	= "Tidak dapat menghapus! Data ini masih memiliki pinjaman/dokumen belum kembali.";
		}else{
			//HAPUS dokumen_terupload
			$data = $this->db->get_where('detail_data',array('id_master_data'=>$id_client))->result_array();

			foreach($data as $d){
				$path = realpath(APPPATH . '../' . $d['file_dokumen']);	
				unlink($path);
			}
			
			/**HAPUS detail_peminjaman
			$ambil_id = $this->db->query('SELECT * FROM master_peminjaman WHERE id_client = '.$id_client)->result_array();
			$id_pinjam = $ambil_id['id'];
			$this->db->delete('detail_peminjaman', array('id_client' => $id_client));

			$this->db->delete('master_peminjaman', array('id_client' => $id_client)); 
			*/
			//HAPUS 
			$this->db->delete('detail_data', array('id_master_data' => $id_client)); 
			$this->db->delete('master_data', array('id' => $id_client)); 

			$data['alert']	= "Data telah dihapus";
		}
		$data['client'] = $this->db->query('SELECT * FROM master_data')->result_array() ;
		$this->template->load('template','master/view',$data);
	}

	public function get_dokumen_by_id(){
        $id    =   $_GET['id'];
		$data = $this->db->get_where('detail_data',array('id_master_data'=>$id))->result_array();

		echo "<ul>";
		foreach($data as $d){
			echo "<li><a href='".base_url()."/".$d['file_dokumen']."'>(".$d['nama_dokumen'].") ".$d['tipe_dokumen']."</a></li>";
		}
		echo "</ul>";
		exit;
	}

	public function get_client_by_id(){
        $id    =   $_GET['id'];
		$data = $this->db->get_where('master_data',array('id'=>$id))->result_array();
		echo "FINE";
		foreach($data as $d){
		echo "<div class='row'>
                <div class='col-md-2'>ID Client</div>
                <div class='col-md-10'>".$id."</div>
              </div>
              <div class='row'>
                <div class='col-md-2'>Nama Client</div>
                <div class='col-md-10'>".$d['nama_client']."</div>
              </div>
              <div class='row'>
              	<div class='col-md-2'>Jenis Client</div>
				<div class='col-md-10'>";
		echo ($d['tipe_client']==1)?"Perusahaan":"Perorangan";
		echo "</div>
             </div>";
    	}
    }

	public function get_dokumen_by_id_client(){
        $id    =   $_GET['id'];
		$data = $this->db->get_where('detail_data',array('id'=>$id))->result_array();

		foreach($data as $d){
		echo "<label class='checkbox'>
              	<input type='checkbox' value='' name='dokumen[]'/>(".$d['nama_dokumen'].") ".$d['tipe_dokumen']."</label>";
        }
	}
}


