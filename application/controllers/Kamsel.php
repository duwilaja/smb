<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kamsel extends CI_Controller {
	
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
			$data['dasargiat'] = comboopts($this->db->select('dg_id as v,dg_nam as t')->get('dasargiat')->result());
			$data['formulir'] = comboopts($this->db->select('view_laporan as v,nama_laporan as t')->where("unit",$user['unit'])->or_where("unit",$user["subdinas"])->get('formulir')->result());
			$data['title'] = "Formulir";
			
			$this->template->load('laporan',$data);
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
	
	private function uplot($fld,$path){
		if ( $this->upload->do_upload($fld)){
				return $path.$this->upload->data('file_name');
			}else{
		return '';
			}
	}
	
	public function save_dikmas()
	{
		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$msgs="No data has been saved";
			$tname=$this->input->post('tablename');
			$fname=$this->input->post('fieldnames');
			$data=$this->input->post(explode(",",$fname));
			//upload here
			$path='./uploads/kamsel/dikmas/';
			$config['upload_path'] = $path;
			$config['allowed_types'] = '*';//'gif|jpg|jpeg|png';//all
			//$config['file_name'] = $user['nrp'];
			$config['file_ext_tolower'] = true;
			//$config['overwrite'] = false;
			$m="";
			$this->load->library('upload', $config);
			
			$data['kesimpulan'] =  $this->uplot('kesimpulan',$path);
			$data['materi'] =  $this->uplot('materi',$path);
			$data['doc'] =  $this->uplot('doc',$path);
			
			$this->db->insert($tname,$data);
			$ret=$this->db->affected_rows();
			if($ret>0){
				$msgs="$ret record(s) saved";
			}
			$retval=array('code'=>"200",'ttl'=>"OK",'msgs'=>$msgs.$m);
			echo json_encode($retval);
		}else{
			$retval=array('code'=>"403",'ttl'=>"Session closed",'msgs'=>"Please login");
			echo json_encode($retval);
		}
	}
	public function save_jemenopsrek()
	{
		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$msgs="No data has been saved";
			$tname=$this->input->post('tablename');
			$fname=$this->input->post('fieldnames');
			$data=$this->input->post(explode(",",$fname));
			//upload here
			$path='./uploads/kamsel/jemenopsrek/';
			$config['upload_path'] = $path;
			$config['allowed_types'] = '*';//'gif|jpg|jpeg|png';//all
			//$config['file_name'] = $user['nrp'];
			$config['file_ext_tolower'] = true;
			//$config['overwrite'] = false;
			$m="";
			$this->load->library('upload', $config);
			
			$data['materi1'] =  $this->uplot('materi1',$path);
			$data['materi2'] =  $this->uplot('materi2',$path);
			$data['materi3'] =  $this->uplot('materi3',$path);
			$data['materi4'] =  $this->uplot('materi4',$path);
			
			$data['rundown'] =  $this->uplot('rundown',$path);
			$data['kesimpulan'] =  $this->uplot('kesimpulan',$path);
			$data['notulen'] =  $this->uplot('notulen',$path);
			$data['doc'] =  $this->uplot('doc',$path);
			
			$this->db->insert($tname,$data);
			$ret=$this->db->affected_rows();
			if($ret>0){
				$msgs="$ret record(s) saved";
			}
			$retval=array('code'=>"200",'ttl'=>"OK",'msgs'=>$msgs.$m);
			echo json_encode($retval);
		}else{
			$retval=array('code'=>"403",'ttl'=>"Session closed",'msgs'=>"Please login");
			echo json_encode($retval);
		}
	}
	public function save_standard()
	{
		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$msgs="No data has been saved";
			$tname=$this->input->post('tablename');
			$fname=$this->input->post('fieldnames');
			$data=$this->input->post(explode(",",$fname));
			//upload here
			$path='./uploads/kamsel/standard/';
			$config['upload_path'] = $path;
			$config['allowed_types'] = '*';//'gif|jpg|jpeg|png';//all
			//$config['file_name'] = $user['nrp'];
			$config['file_ext_tolower'] = true;
			//$config['overwrite'] = false;
			$m="";
			$this->load->library('upload', $config);
			
			$data['materi1'] =  $this->uplot('materi1',$path);
			$data['materi2'] =  $this->uplot('materi2',$path);
			$data['materi3'] =  $this->uplot('materi3',$path);
			$data['materi4'] =  $this->uplot('materi4',$path);
			
			$data['rundown'] =  $this->uplot('rundown',$path);
			$data['kesimpulan'] =  $this->uplot('kesimpulan',$path);
			$data['notulen'] =  $this->uplot('notulen',$path);
			$data['doc'] =  $this->uplot('doc',$path);
			
			$this->db->insert($tname,$data);
			$ret=$this->db->affected_rows();
			if($ret>0){
				$msgs="$ret record(s) saved";
			}
			$retval=array('code'=>"200",'ttl'=>"OK",'msgs'=>$msgs.$m);
			echo json_encode($retval);
		}else{
			$retval=array('code'=>"403",'ttl'=>"Session closed",'msgs'=>"Please login");
			echo json_encode($retval);
		}
	}
	public function save_audit()
	{
		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$msgs="No data has been saved";
			$tname=$this->input->post('tablename');
			$fname=$this->input->post('fieldnames');
			$data=$this->input->post(explode(",",$fname));
			//upload here
			$path='./uploads/kamsel/audit/';
			$config['upload_path'] = $path;
			$config['allowed_types'] = '*';//'gif|jpg|jpeg|png';//all
			//$config['file_name'] = $user['nrp'];
			$config['file_ext_tolower'] = true;
			//$config['overwrite'] = false;
			$m="";
			$this->load->library('upload', $config);
			
			$data['materi1'] =  $this->uplot('materi1',$path);
			$data['materi2'] =  $this->uplot('materi2',$path);
			$data['materi3'] =  $this->uplot('materi3',$path);
			$data['materi4'] =  $this->uplot('materi4',$path);
			
			$data['rundown'] =  $this->uplot('rundown',$path);
			$data['kesimpulan'] =  $this->uplot('kesimpulan',$path);
			$data['notulen'] =  $this->uplot('notulen',$path);
			$data['doc'] =  $this->uplot('doc',$path);
			
			$this->db->insert($tname,$data);
			$ret=$this->db->affected_rows();
			if($ret>0){
				$msgs="$ret record(s) saved";
			}
			$retval=array('code'=>"200",'ttl'=>"OK",'msgs'=>$msgs.$m);
			echo json_encode($retval);
		}else{
			$retval=array('code'=>"403",'ttl'=>"Session closed",'msgs'=>"Please login");
			echo json_encode($retval);
		}
	}
}