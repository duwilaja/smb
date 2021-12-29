<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
	}

	public function index()
	{
		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$data['session'] = $user;
			$data['formulir'] = $this->db->select('view_laporan as v,nama_laporan as t')->like('tipe','F')->where(array("unit"=>$user['unit'],"isactive"=>"Y"))->order_by("nama_laporan")->get('formulir')->result_array();
			$data['rekap'] = $this->db->select('view_laporan as v,nama_laporan as t')->like('tipe','R')->where(array("unit"=>$user['unit'],"isactive"=>"Y"))->order_by("nama_laporan")->get('formulir')->result_array();
            $data['history'] = $this->db->select('view_laporan as v,nama_laporan as t, view_field as f')->like('tipe','R')->where(array("unit"=>$user['unit'],"isactive"=>"Y"))->order_by("nama_laporan")->get('formulir')->result_array();
			$data['js_local'] = 'history.js';
			$this->template->load("history",$data);
		}else{
			$retval=array("403","Failed","Please login","error");
			$data['retval']=$retval;
			$data['rahasia'] = mt_rand(100000,999999);
			$arr = [
			'name'   => 'rahasia',
			'value'  => $data['rahasia'],                            
			'expire' => '3000',                                                                                   
			'secure' => TRUE
			];

			set_cookie($arr);
			$this->load->view('login',$data);
		}
	}

    public function show_table()
    {
        $user=$this->session->userdata('user_data');
		$data['history'] = $this->db->select('view_laporan as v,nama_laporan as t, view_field as f')->like('tipe','R')->where(array("unit"=>$user['unit'],"isactive"=>"Y"))->order_by("nama_laporan")->get('formulir')->result_array();
        echo json_encode($data);
    }

    public function get_jumlah_input()
    {
        $tbl = $this->input->post('tbl');
        $nrp = $this->input->post('nrp');
        $s_date = $this->input->post('s_date');
        $e_date = $this->input->post('e_date');
        
        if ($s_date != '') {
            $this->db->where('tgl >=', $s_date);
        }

        if ($e_date != '') {
            $this->db->where('tgl <=', $e_date);
        }

        $this->db->where('nrp', $nrp);
        $r = $this->db->count_all_results($tbl);

        $data = [
            'count' => $r
        ];
        echo json_encode($data);
    }

    public function get_table()
    {
        $tbl = $this->input->post('tbl');
        $fld = $this->input->post('fld');
        $nrp = $this->input->post('nrp');
        $s_date = $this->input->post('s_date');
        $e_date = $this->input->post('e_date');
        
        
        $formulir = $this->db->get_where('formulir',['view_laporan' => $tbl]);
        $data['count'] = 0;
        $data['data'] = [];
        $data['key'] = [];
        if ($formulir->num_rows() > 0) {
            if ($s_date != '') {
                $this->db->where('tgl >=', $s_date);
            }
    
            if ($e_date != '') {
                $this->db->where('tgl <=', $e_date);
            }
            $fld = $formulir->row()->view_field;
            $this->db->select($fld);
            $this->db->where('nrp',$nrp);
            $query = $this->db->get($tbl)->result_array();

            $data['data'] = $query;
            $data['count'] = count($query);
            if (count($query) != 0) {
                $data['key'] = array_keys($query[0]);
            }

            echo json_encode($data);
        }else{
            echo json_encode($data);
        }
        
    }

    public function tes()
    {
        $r = $this->input->get('t');
        $tname=base64_decode($r);
        echo json_encode($tname);
    }
}
