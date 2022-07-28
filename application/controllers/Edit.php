<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
	}
	
	public function index()
	{
		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$data['session']=$user;
			$data['i']=$this->input->get('i');
			$data['t']=$this->input->get('t');
			$this->load->view('edit',$data);
		}else{
			echo "<h3>Invalid session, please login.</h3>";
		}
	}
	
	public function get(){
		$user=$this->session->userdata('user_data');
		$ret=array();
		$sub=array();
		if(isset($user)){
			$id=$this->input->post('id');
			$t=$this->input->post('q');
			$ret=$this->db->where("rowid",$id)->get($t)->result_array();
			$sub=$t=='tmc_rengiat_vip'?$this->db->where("rengiatid",$ret[0]['rengiatid'])->get("tmc_rengiat_vip_route")->result_array():$sub;
		}
		$out=array("code"=>"200", "msgs"=>$ret, "sub"=>$sub);
		echo json_encode($out);
	}
	
}