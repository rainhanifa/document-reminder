<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pinjaman extends CI_Controller {

	function __construct() {
        parent::__construct();

	     if (!$this->session->userdata('is_logged_in')){
	        redirect('auth/login');
	     }
    
    }

	public function index()
	{
		redirect(base_url('pinjaman/view'));
	}

	public function entry()
	{
		$data['message'] = "";
		if($_POST){
			$client = $_POST['id_client'];
			$data['hasil_pencarian'] = $client;

			$query_client = "SELECT * FROM master_data WHERE nama_proyek LIKE '%$client%' OR nama_client LIKE '%$client%' LIMIT 1";
			$data['client'] = $this->db->query($query_client)->result_array();
			$id_master_data = $data['client'][0]['id'];
			$data['dokumen'] = $this->db->query("SELECT * FROM detail_data WHERE id_master_data = $id_master_data")->result_array();
		}

		$this->template->load('template','pinjaman/post',$data);
	}

	public function view()
	{
		$query_pinjaman		= "SELECT md.nama_client, ms.tanggal_peminjaman, ms.tanggal_jatuh_tempo, ms.tanggal_kembali, ms.id
								FROM master_peminjaman as ms, master_data as md
								WHERE ms.id_client = md.id
								ORDER BY status";
		$data['pinjaman'] 	= $this->db->query($query_pinjaman)->result_array() ;

		$this->template->load('template','pinjaman/view',$data);
	}

	public function akan_jatuh_tempo()
	{
		
		$query_pinjaman		= "SELECT md.nama_client, ms.tanggal_peminjaman, ms.tanggal_jatuh_tempo, ms.tanggal_kembali, ms.id
								FROM master_peminjaman as ms, master_data as md
								WHERE ms.id_client = md.id
								AND DATEDIFF(tanggal_jatuh_tempo, CURDATE()) < 5 AND tanggal_jatuh_tempo > CURDATE()
								AND ms.status = 0
								ORDER BY status";
		$data['pinjaman'] 	= $this->db->query($query_pinjaman)->result_array() ;

		$this->template->load('template','pinjaman/view_akan_jatuh_tempo',$data);
	}
	public function lewat_jatuh_tempo()
	{
		
		$query_pinjaman		= "SELECT md.nama_client, ms.tanggal_peminjaman, ms.tanggal_jatuh_tempo, ms.tanggal_kembali, ms.id
								FROM master_peminjaman as ms, master_data as md
								WHERE ms.id_client = md.id
								AND tanggal_jatuh_tempo <= CURDATE()
								AND ms.status = 0";
		$data['pinjaman'] 	= $this->db->query($query_pinjaman)->result_array() ;

		$this->template->load('template','pinjaman/view_lewat_jatuh_tempo',$data);
	}

	public function kembali()
	{
		$data['title'] = "";

		if($_POST){
			$tanggal_kembali =	$this->input->post('tanggal_kembali');
			$dokumen 	 	=	$this->input->post('dokumen');

			foreach($dokumen as $dd){
				// UPDATE DI TABLE DETAIL PEMINJAMAN
				$data_kembali	=   array('tanggal_kembali'=>date('Y-m-d', strtotime($tanggal_kembali)),
    								'status_dokumen'=>1);
	    		$this->db->where('id_dokumen', $dd);
				$this->db->update('detail_peminjaman', $data_kembali);

				// UPDATE DI TABLE DETAIL MASTER
				$dokumen_kembali	=   array('status'=>1);
	    		$this->db->where('id_dokumen', $dd);
				$this->db->update('detail_data', $dokumen_kembali); 

			}
			// PILIH ID PEMINJAMAN DI TABLE DETAIL PEMINJAMAN
			$query_pinjam 	=	"SELECT id_peminjaman FROM detail_peminjaman WHERE id_dokumen = $dd";
			$pinjam 		=	$this->db->query($query_pinjam)->row_array();
			$id_pinjam 		=	$pinjam['id_peminjaman'];

			$this->cek_dokumen_kembali_semua($id_pinjam);

			$data['success'] = TRUE;
		}
		$this->template->load('template','pinjaman/kembali', $data);
	}

	public function save_keterangan(){
		if($_POST){
			$keterangan = $this->input->post('keterangan');
			$id_pinjam	=  $this->input->post('id_pinjam');

			$data_keterangan = array('keterangan' => $keterangan);
    		$this->db->where('id', $id_pinjam);
			$this->db->update('master_peminjaman', $data_keterangan); 

			if($this->db->affected_rows()){
				redirect(base_url('pinjaman/view'));
			}else{
				var_dump($this->db->error());
			}
		}
	}

	public function save(){
		if($_POST){

            $id_client          =   $this->input->post('id_client');
            $dokumen            =   $this->input->post('dokumen');	
            $tanggal_peminjaman =	$this->input->post('tanggal_peminjaman');	
           	$jumlah_waktu		=	$this->input->post('durasi_pinjam');

           	$jatuh_tempo 		=	date('Y-m-d', strtotime($tanggal_peminjaman. " + ".$jumlah_waktu." days"));
           	$counter			=	0;

       		$data_pinjam    =   array('id_client'=>$id_client,
       									'tanggal_peminjaman'=>date('Y-m-d', strtotime($tanggal_peminjaman)),
       									'tanggal_jatuh_tempo' => $jatuh_tempo,
       									'status' => 0
       							);
       		$this->db->insert('master_peminjaman',$data_pinjam);

       		$id_master_pinjam	= $this->db->insert_id();

           	foreach($dokumen as $dd){
           		$data_pinjam_dokumen	=   array('id_peminjaman'=>$id_master_pinjam,
		       									'id_dokumen'=>$dd,
		       									'status_dokumen' => 0,
		       								);
       			$this->db->insert('detail_peminjaman',$data_pinjam_dokumen);


				$dokumen_dipinjam	=   array('status'=>0);
	    		$this->db->where('id_dokumen', $dd);
				$this->db->update('detail_data', $dokumen_dipinjam); 
           	}
			$data["success"] = TRUE;

			$this->template->load('template','pinjaman/post',$data);	
		}
		else
		{
			redirect(base_url('pinjaman/entry'));
		}
	}

	public function get_dokumen_by_id_pinjam(){
        $id    =   $_GET['id'];
		
        $query = "SELECT md.nama_client, md.nama_proyek, mp.tanggal_peminjaman, mp.tanggal_jatuh_tempo, dp.id_peminjaman, mp.keterangan
        					FROM master_data as md, master_peminjaman as mp, detail_peminjaman as dp
        					WHERE mp.id = $id AND mp.id_client = md.id
        						AND dp.id_peminjaman = mp.id AND dp.status_dokumen = 0";		
       	$ada	= $this->db->query($query)->num_rows();
        $data 	= $this->db->query($query)->row_array();

        if($ada > 0){
        	echo "<div class='row'>
	                <div class='col-md-4'>Nama Client</div>
	                <div class='col-md-8'>".$data['nama_client']."</div>
	              </div><div class='row'>
	                <div class='col-md-4'>Nama Proyek</div>
	                <div class='col-md-8'>".$data['nama_proyek']."</div>
	              </div><div class='row'>
	                <div class='col-md-4'>Tanggal Peminjaman</div>
	                <div class='col-md-8'>".$data['tanggal_peminjaman']."</div>
	              </div><div class='row'>
	                <div class='col-md-4'>Tanggal Jatuh Tempo</div>
	                <div class='col-md-8'>".$data['tanggal_jatuh_tempo']."</div>
	              </div>";
	        $query_dokumen = "SELECT dd.nama_dokumen, dd.tipe_dokumen
			        			FROM detail_data as dd, detail_peminjaman as dp, master_peminjaman as mp, master_data as md
		    					WHERE dp.id_peminjaman = $id AND mp.id_client = md.id
    							AND dp.id_peminjaman = mp.id AND dp.status_dokumen = 0 AND dp.id_dokumen = dd.id_dokumen" ;
    						
			$data_dokumen = $this->db->query($query_dokumen)->result_array();

			echo "<div class='row'><div class='col-md-4'><h4>Daftar Dokumen:</h4></div></div><div class='row'><ul>";
			foreach($data_dokumen as $d){
				echo "<li>(".$d['nama_dokumen'].") ".$d['tipe_dokumen']."</li>";
	        }
	        echo "</ul></div>";

	        if($data['keterangan']){
	        	$keterangan = $data['keterangan'];
	        }
	        else{
				$keterangan = '';
	        }
	        // FORM
	        echo "<form class='form-horizontal' role='form' method='post' action='save_keterangan'>
                  <div class='form-group'>
                    <label  class='col-sm-2 control-label'
                              for='keterangan'>Keterangan</label>
                    <div class='col-sm-10'>
                		<input type='hidden' name='id_pinjam' value='$id'>
                        <input type='keterangan' class='form-control' 
                        id='Keterangan' placeholder='Keterangan' name='keterangan' value='".$keterangan."'/>
                    </div>
                  </div>
                  <div class='form-group'>
                    <div class='col-sm-offset-2 col-sm-8'>
                      <input type='submit' class='btn btn-default' value='Simpan Keterangan' /'>
                  </form>";	
        }else{
        	echo "<div class='alert alert-success'>SEMUA DOKUMEN TELAH DIKEMBALIKAN<div>";
        }
        exit;
	}

	public function get_dokumen_kembali_by_nama_client(){
        $id    =   $_GET['id'];

		$query_client	= "SELECT * FROM master_data WHERE nama_proyek LIKE '%$id%' OR nama_client LIKE '%$id%' LIMIT 1";
		$ada_client	= $this->db->query($query_client)->num_rows();

        if($ada_client > 0){
        	$data_client	= $this->db->query($query_client)->row_array();
        	echo "<div class='row'>
	                <div class='col-md-4'>Nama Client</div>
	                <div class='col-md-8'>".$data_client['nama_client']."</div>
	              </div><div class='row'>
	                <div class='col-md-4'>Nama Proyek</div>
	                <div class='col-md-8'>".$data_client['nama_proyek']."</div>
	              </div>";
        }
        else{
        	echo "<div class='row'>
	                Tidak ditemukan data debitur atau proyek dengan kata kunci '$id'
	              </div>";
        }
    }

    public function get_dokumen_kembali_by_id_client(){
        $id    =   $_GET['id'];


		$query_client	= "SELECT * FROM master_data WHERE nama_proyek LIKE '%$id%' OR nama_client LIKE '%$id%' LIMIT 1";
		$data_client	= $this->db->query($query_client)->row_array();
		$id_master_data	= $data_client['id'];

		$query_dokumen	= "SELECT * FROM detail_data dd, master_peminjaman mp, detail_peminjaman dp
							WHERE dd.id_master_data = $id_master_data AND dp.status_dokumen = 0 AND mp.status = 0
								AND dd.id_dokumen = dp.id_dokumen AND dd.id_master_data = mp.id_client";
		$ada_dokumen	= $this->db->query($query_client)->num_rows();
		echo "<div class='panel panel-default'>
                <div class='panel-heading'>
                    <h4 class='panel-title'>Kembalikan Dokumen</h4>
                </div>
                <div class='panel-body'>";

        if($ada_dokumen > 0){
        	$data_dokumen	= $this->db->query($query_dokumen)->result_array();
        	echo "<div class='row'>
        			<div class='col-md-10 col-md-offset-1'>";

        	if($data_dokumen){
        		echo "<form action='".base_url()."pinjaman/kembali' method='post'>";
              	foreach($data_dokumen as $d){
                	echo "<label class='checkbox'>
                        <input type='checkbox' value='".$d['id_dokumen']."' name='dokumen[]'/>(".$d['nama_dokumen'].") ".$d['tipe_dokumen']."</label>";
                } 
	        	echo "<div class='row'>
	                    <div class='form-group'>
	                    <label class='col-sm-3 col-lg-2 control-label'>Tanggal Pengembalian</label>
                        <div class='col-sm-6 col-lg-5 controls'>
                            <div class='input-group date date-picker' data-date='12-05-2017' data-date-format='dd-mm-yyyy' data-date-viewmode='years'>
                            <span class='input-group-addon'><i class='fa fa-calendar'></i></span>
                            <input class='form-control date-picker' size='16' type='text' value='12-05-2017' name='tanggal_kembali' id='datepicker'>
                         </div>
                        </div>
                        <div class='col-sm-3'>
                           <input type='submit' class='btn btn-primary' value='Kembalikan' />
                        </div>
                    </div>
                    </div>";
        	}else{
        		echo "<div class='alert alert-success>Tidak ada dokumen yang keluar/dipinjam</div>";	
        	}
	        
                echo "</div></div>";
        }
        else{
        	echo "<div class='row'>
	                <div class='alert alert-success col-md-10 col-md-offset-1'>Tidak ada dokumen yang keluar/dipinjam</div>
	              </div>";
        }

        echo "</div>
            </div>";
    }

    public function cek_dokumen_kembali_semua($id_pinjam){	
    	$query_cari = "SELECT COUNT(id_detail) AS total, MAX(tanggal_kembali) as kembali_akhir
    					FROM detail_peminjaman
    					WHERE status_dokumen=0 AND id_peminjaman = $id_pinjam";
    	$cari_jumlah = $this->db->query($query_cari)->row_array();
    	$jumlah      = $cari_jumlah['total'];
    	$kembali_akhir = $cari_jumlah['kembali_akhir'];

    	if($jumlah == 0){
    		$data_kembali     =   array('tanggal_kembali'=>$kembali_akhir,
    								'status'=>1);
    		$this->db->where('id', $id_pinjam);
			$this->db->update('master_peminjaman', $data_kembali); 
    	}
    }
}
