<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->lang->load('message', 'indo');
		// Your own constructor code
	}
	function switchLang($language = "indo") {
       
        // $language = ($language != "") ? $language : "indo";
        // $this->session->set_userdata('site_lang', $language);
		if ($language != "") {
			$this->session->set_userdata('site_lang',$language);
			redirect('Profile/index');

		}else{
			$language = "indo";
			$this->session->set_userdata('site_lang',$language);
			redirect('Profile/index');
		}
		// echo $this->session->userdata('site_lang');
       
       
    }
	
	
	public function index()
	{

		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$data['session'] = $user;
			$data['pangkat'] = comboopts($this->db->select('pang_id as v,pang_nam as t')->order_by("pang_nam","DESC")->get('pangkat')->result());
			$data['polda'] = comboopts($this->db->select('da_id as v,da_nam as t')->order_by("da_id","DESC")->get('polda')->result());
			$data['unit'] = comboopts($this->db->select('unit_id as v,unit_nam as t')->order_by("unit_id","DESC")->get('unit')->result());
			$data['dinas'] = comboopts($this->db->select('din_id as v,din_nam as t')->get('dinas')->result());
			//$data['bagian'] = comboopts($this->db->select('bag_id as v,bag_nam as t')->get('bagian')->result());
			$data['specs'] = comboopts($this->db->select('spec_id as v,spec_nam as t')->get('spesialisasi')->result());
			$data['formulir'] = $this->db->select('view_laporan as v,nama_laporan as t')->like('tipe','F')->where(array("unit"=>$user['unit'],"isactive"=>"Y"))->order_by("nama_laporan")->get('formulir')->result_array();
		$data['rekap'] = $this->db->select('view_laporan as v,nama_laporan as t')->like('tipe','R')->where(array("unit"=>$user['unit'],"isactive"=>"Y"))->order_by("nama_laporan")->get('formulir')->result_array();
			
			if($user['unit']==''){
				$data['incomplete_profile']=true;
			}
			$data['title'] = "My Profile";
			$this->template->load('profile',$data);
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
	
	public function save()
	{
		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$this->db->where('rowid',$this->input->post('rowid'));
			$post_data=$_POST;
			if(isset($post_data['tmp_spek']))	unset($post_data['tmp_spek']); //specs multiple select
			$this->db->update('persons',$post_data);
			if($this->db->affected_rows()>0){
				$msgs="Data updated";
				$this->db->where('rowid',$this->input->post('rowid'));
				$u=$this->db->get("persons")->result_array();
				$this->session->set_userdata('user_data',$u[0]);
			}else{
				$msgs="No update has been made";
			}
			$retval=array('code'=>"200",'ttl'=>"OK",'msgs'=>$msgs);
			echo json_encode($retval);
		}else{
			$retval=array('code'=>"403",'ttl'=>"Session closed",'msgs'=>array());
			echo json_encode($retval);
		}
	}
	public function chgpwd()
	{
		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$msgs="Invalid old password";
			$code="404";
			$where=array('uid'=>$user['nrp'],'upwd'=>md5(trim($this->input->post('op'))));
			$this->db->where($where)->update('core_user',array("upwd"=>md5(trim($this->input->post('np')))));
			if($this->db->affected_rows()>0){
				$msgs="Password changed"; $code="200";
			}
			$retval=array('code'=>$code,'ttl'=>"",'msgs'=>$msgs);
			echo json_encode($retval);
		}else{
			$retval=array('code'=>"403",'ttl'=>"Session closed",'msgs'=>array());
			echo json_encode($retval);
		}
	}
	
	public function get_polres()
	{
		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$id=$this->input->post('id');
			$ret=$this->db->select('res_id as v,res_nam as t')->where(array('polda'=>$id))->get('polres')->result();
			$retval=array('code'=>"200",'ttl'=>"OK",'msgs'=>$ret);
			echo json_encode($retval);
		}else{
			$retval=array('code'=>"403",'ttl'=>"Session closed",'msgs'=>array());
			echo json_encode($retval);
		}
	}
	public function get_subdin()
	{
		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$id=$this->input->post('id');
			$ret=$this->db->select('sub_id as v,sub_nam as t')->where(array('dinas'=>$id))->get('subdinas')->result();
			$retval=array('code'=>"200",'ttl'=>"OK",'msgs'=>$ret);
			echo json_encode($retval);
		}else{
			$retval=array('code'=>"403",'ttl'=>"Session closed",'msgs'=>array());
			echo json_encode($retval);
		}
	}
	public function get_subbag()
	{
		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$id=$this->input->post('id');
			$ret=$this->db->select('subbag_id as v,subbag_nam as t')->where(array('bagian'=>$id))->get('subbag')->result();
			$retval=array('code'=>"200",'ttl'=>"OK",'msgs'=>$ret);
			echo json_encode($retval);
		}else{
			$retval=array('code'=>"403",'ttl'=>"Session closed",'msgs'=>array());
			echo json_encode($retval);
		}
	}
	
	public function avatar(){
		$user=$this->session->userdata('user_data');
		if(isset($user)){
			//$this->load->helper('file');
			$farr=glob('./uploads/avatars/'.$user['nrp'].'.*');
			$r="";
			for($i=0;$i<count($farr);$i++){
				$del=unlink($farr[$i]);
				if($del){
					$r.=$farr[$i]."deleted";
				}else{
					$r.=$farr[$i]."failed";
				}
			}
			$retval=array('code'=>"200",'ttl'=>"OK",'msgs'=>"Done");
			if($this->input->post('preset')=='N'){
				$config['upload_path'] = './uploads/avatars/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['file_name'] = $user['nrp'];
				$config['file_ext_tolower'] = true;
				$config['overwrite'] = true;
				
				$this->load->library('upload', $config);
				
				if ( ! $this->upload->do_upload('foto'))
				{
					$retval=array('code'=>"500",'ttl'=>"Error",'msgs'=>$this->upload->display_errors('',''));
				}
				else
				{
					$retval=array('code'=>"200",'ttl'=>"OK",'msgs'=>"File uploaded");
				}
			}
			echo json_encode($retval);
		}else{
			$retval=array('code'=>"403",'ttl'=>"Session closed",'msgs'=>array());
			echo json_encode($retval);
		}
	}
	
	public function ravatar(){
		$user=$this->session->userdata('user_data');
		$img=$img=base_url().'my/images/sm.png';
		if(isset($user)){
			$farr=glob('./uploads/avatars/'.$user['nrp'].'.*');
			if(count($farr)>0){
				$img=$farr[0];
			}else{
				//$img=base_url().'my/images/'.$user['unit'].'.png';
			}
		}
		echo '<img src="'.$img.'?id='.time().'" class="avatar brround avatar-xl" alt="img">';
	}
}