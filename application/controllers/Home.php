<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
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
			$this->template->load("home",$data);
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
	
	public function dttbl(){
		$data=array(); $data_assoc=array();
		//if(isset($user)){
			$tname=base64_decode($this->input->post('tname')); //tablename
			$cols=base64_decode($this->input->post('cols')); //column
			
			$where=array();
			$acol=explode(",",$cols);
			
			//build where polda/polres
			if ($this->input->post('tgl') != '') {
				$ftgl=$this->input->post('ftgl')?$this->input->post('ftgl'):'tgl';
				$where[$ftgl] = $this->input->post('tgl'); //date('Y-m-d');
			}
			
			$this->db->select($cols);
			//$this->db->from($tname);
			$this->db->where($where);
			$semua=$this->db->count_all_results($tname,FALSE);
			
			//$this->db->order_by($acol[$this->input->post('order')[0]['column']], $this->input->post('order')[0]['dir']);
			$this->db->order_by('tgl DESC, jam DESC');
			$this->db->limit($this->input->post('length'),$this->input->post('start'));
			$data_assoc=$this->db->get()->result_array();
			
			for($i=0;$i<count($data_assoc);$i++){
				$data[]=array_values($data_assoc[$i]);
			}
		//}
		$output = array(
                        "draw" => $this->input->post('draw'),
                        "recordsTotal" => $semua,
                        "recordsFiltered" => $semua,
                        "data" => $data,
						"assoc" => $data_assoc
                );
        //output to json format
        echo json_encode($output);
	}
	
}