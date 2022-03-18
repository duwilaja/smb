<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myapi extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$this->load->model('MApi','mapi');
	}
	
	public function index()
	{
		//$this->load->view('welcome_message');
		//$this->load->view('login');
	}
	private function tbl($di,$l){
		$r=array();
		switch($l){
			case 'jalan?prov_id=13&kota_id=208':
					$ln='<a href="JavaScript:showModal('.$di->id.');">'.$di->nama_jalan.'&nbsp;&nbsp;</a>';
					$r=array($ln,$di->lat,$di->lng);
				break;
		}
		return $r;
	}
	
	
	public function dttbl(){
		$lnk=base64_decode($this->input->post('lnk'));
		$d=$this->mapi->get($lnk);
		$data=array();
		if(!$d[0]){
			$x=json_decode($d[1]);
			$d = isset($x->data)?$x->data:$data;
			for($i=0;$i<count($d);$i++){
				$data[]=$this->tbl($d[$i],$lnk);
			}
			$s=$i>0?"OK":$x;
		}else{
			$s=$d[0];
		}
		
		$iTotal=count($data);
		
		$output = array(
          "draw"=>0,
          "recordsTotal"=>$iTotal, // total number of records 
          "recordsFiltered"=>$iTotal, // if filtered data used then tot after filter
          "data"=>$data,
		  "m"=>$s
        );
		
		echo json_encode($output);
	}
	public function show(){
		$data=array();
		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$id=$this->input->post('id');
			$lnk=$this->input->post('lnk').'/'.$id;
			$d=$this->mapi->get($lnk);
			if(!$d[0]){
				$x=json_decode($d[1]);
				$data = isset($x->data)?$x->data:$data;
			}
		}
		echo json_encode($data);
	}
	public function save(){
		$data=array("status"=>false,"msg"=>"Session closed. Please login","data"=>[]);
		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$id=$this->input->post('id');
			$tname=$this->input->post('tname');
			$lnk=$this->input->post('apilnk');
			$fn=$this->input->post('fieldnames');
			$data=$this->input->post(explode(",",$fn));
			if($id==0){
				$d=$this->mapi->post($lnk,$data);
			}else{
				$d=$this->mapi->put($lnk.'/'.$id,$data);
			}
			$datax=array("status"=>false,"msg"=>$d[0],"data"=>[]);
			if(!$d[0]){
				$x=json_decode($d[1]);
				$datax = array("status"=>$x->status,"msg"=>$x->msg,"data"=>$x->data);
				if($tname!=''){ //save to local table
					if($id==0){
						$dd=$x->data;
						$data['id']=$dd->id;
						$this->db->insert($tname,$data);
					}else{
						$this->db->update($tname,$data,"id=$id");
					}
				}
			}
		}
		echo json_encode($datax);
	}
	public function dele(){
		$data=array("status"=>false,"msg"=>"Session closed. Please login","data"=>[]);
		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$id=$this->input->post('id');
			$tname=$this->input->post('tname');
			$lnk=$this->input->post('apilnk');
			$d=$this->mapi->del($lnk.'/'.$id);
			
			$data=array("status"=>false,"msg"=>$d[0],"data"=>[]);
			if(!$d[0]){
				$x=json_decode($d[1]);
				$data = array("status"=>$x->status,"msg"=>$x->msg,"data"=>$x->data);
				
				if($tname!=''){ //del from local table
					$this->db->delete($tname,array('id' => $id));
				}
			}
		}
		echo json_encode($data);
	}
	public function get(){
		$data=array();
		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$lnk=$this->input->post('lnk');
			$d=$this->mapi->get($lnk);
			if(!$d[0]){
				$x=json_decode($d[1]);
				$data = isset($x->data)?$x->data:$data;
			}
		}
		echo json_encode($data);
	}
}
