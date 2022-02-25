<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PublicService extends CI_Controller {
	
	private $token = '45fd595dcb1cdb51293fee28335c43487f4eaa2e940db4f589bec08cfae723a2';
	
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
	
	private function uplots($fld,$path){
		$ret=array();
		// Count total files
        $countfiles = count($_FILES[$fld]['name']);
		// Looping all files
        for($i=0;$i<$countfiles;$i++){
			if(!empty($_FILES[$fld]['name'][$i])){
				// Define new $_FILES array - $_FILES['file']
				  $_FILES['file']['name'] = $_FILES[$fld]['name'][$i];
				  $_FILES['file']['type'] = $_FILES[$fld]['type'][$i];
				  $_FILES['file']['tmp_name'] = $_FILES[$fld]['tmp_name'][$i];
				  $_FILES['file']['error'] = $_FILES[$fld]['error'][$i];
				  $_FILES['file']['size'] = $_FILES[$fld]['size'][$i];
				
				if ( $this->upload->do_upload('file')){
						$ret[]= $path.$this->upload->data('file_name');
					}
			}
		}
		
		return implode(";",$ret);
	}
	
	public function save()
	{
		$user=$this->session->userdata('user_data');
		$auth=$this->input->get_request_header('X-token', TRUE);
		if(isset($user)||$auth==$this->token){
			$msgs="No data has been saved";
			$rowid=$this->input->post("rowid");
			$kategori=$this->input->post('kategori');
			$tname=$this->input->post('tablename');
			$fname=$this->input->post('fieldnames');
			$data=$this->input->post(explode(",",$fname));
			//upload here
			$path="./uploads/publicservice/$kategori/";
			$config['upload_path'] = $path;
			$config['allowed_types'] = '*';//'gif|jpg|jpeg|png';//all
			//$config['file_name'] = $user['nrp'];
			$config['file_ext_tolower'] = true;
			//$config['overwrite'] = false;
			$m="";
			$this->load->library('upload', $config);
			
			$data['uploadedfile'] =  $this->uplots('uploadedfile',$path);
			
			if($rowid==""||$rowid=="0"){
				$this->db->insert($tname,$data);
			}else{
				$this->db->update($tname,$data,"rowid=$rowid");
			}
			
			$ret=$this->db->affected_rows();
			if($ret>0){
				$msgs="$ret record(s) saved";
				$this->send_notif_web($kategori);
			}
			$retval=array('code'=>"200",'ttl'=>"OK",'msgs'=>$msgs.$m);
			echo json_encode($retval);
		}else{
			$retval=array('code'=>"403",'ttl'=>"Session closed",'msgs'=>"Please login");
			echo json_encode($retval);
		}
	}
	private function send_notif_web($kategori){
		$cat = "Kecelakaan";
		if($kategori=="laka"){
			$cat = "Kecelakaan";
		}else if($kategori=="macet"){
			$cat = "Kemacetan";
		}else if($kategori=="langgar"){
			$cat = "Pelanggaran";
		}else if($kategori=="infra"){
			$cat = "Infrastruktur Jalan";
		}else if($kategori=="gangguan"){
			$cat = "Gangguan Lalin";
		}else if($kategori=="pidana"){
			$cat = "Tindak Pidana di Jalan";
		}
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://backoffice.elingsolo.com/satupeta/API/intan/API/send_notif_smci',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => array("title"=>"Laporan ".$cat." Masuk" ,"msg"=>"Terdapat laporan baru"),
		CURLOPT_SSL_VERIFYPEER => true 
		));
		$response = curl_exec($curl);    
		curl_close($curl);
	}
	private function uplot($fld,$path){
		if ( $this->upload->do_upload($fld)){
				return $path.$this->upload->data('file_name');
			}else{
		return '';
			}
	}
	
	public function save_permohonan()
	{
		$user=$this->session->userdata('user_data');
		$auth=$this->input->get_request_header('X-token', TRUE);
		if(isset($user)||$auth==$this->token){
			$msgs="No data has been saved";
			$tname=$this->input->post('tablename');
			$fname=$this->input->post('fieldnames');
			$data=$this->input->post(explode(",",$fname));
			$kategori=$this->input->post('kategori');
			
			$filenames=explode(",",$this->input->post('filenames'));
			
			//upload here
			$path="./uploads/publicservice/$kategori/";
			$config['upload_path'] = $path;
			$config['allowed_types'] = '*';//'gif|jpg|jpeg|png';//all
			//$config['file_name'] = $user['nrp'];
			$config['file_ext_tolower'] = true;
			//$config['overwrite'] = false;
			$m="";
			$this->load->library('upload', $config);
			
			for($i=0;$i<count($filenames);$i++){
				$data[$filenames[$i]] =  $this->uplot($filenames[$i],$path);
			}
			
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