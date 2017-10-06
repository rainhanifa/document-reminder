<?php
class auth extends CI_Controller
{
    
    
    function __construct() {
        parent::__construct();
        $this->load->helper('string');
         
    
    }
    
    
    function index()
    {
        redirect('auth/login');
    }
    
    function login()
    {
        if ($this->session->userdata('is_logged_in')){
            redirect('dashboard');
        }
        
        $data['error'] = "";
        
        if(isset($_POST['submit'])){
            $un     = $this->input->post('username');
            $pw     = $this->input->post('password');

            $login  =  $this->db->get_where('users',array('username'=>$un,'password'=>  $pw));
            if($login->num_rows()>0)
            {
                $r      = $login->row_array();
                $data   = array('user_active' => $r['username'],
                            'nama_active' => $r['nama'],
                            'is_logged_in' => 'TRUE');

                $this->session->set_userdata($data);

                redirect('dashboard');
            }else{
                $data['error'] = "Username atau password salah";
            }        
        }
            $this->load->view('auth/login', $data);    
    }
    
    function logout()
    {
        $this->session->sess_destroy();
        $this->session->unset_userdata();
        redirect('auth/login');
    }
    
}