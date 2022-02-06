<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	
	public function __construct()
	{
        parent::__construct();
        $this->load->model('MLaporan','ml');
		// Your own constructor code
	}
	public function tes(){
			$retval=array('code'=>"403",'ttl'=>"Horee",'msgs'=>json_encode($this->input->post("gangguan")));
			echo json_encode($retval);
	}
	public function index()
	{
		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$data['session'] = $user;
			//$data['jumlah'] = comboopts($this->db->select('id as v, status as t')->where("status",0)->get('patwal_permohonan')->result());
			$data['dasargiat'] = comboopts($this->db->select('dg_id as v,dg_nam as t')->get('dasargiat')->result());
			$data['formulir'] = comboopts($this->db->select('view_laporan as v,nama_laporan as t')->like('tipe','F')->where(array("unit"=>$user['unit'],"isactive"=>"Y"))->or_where("unit",$user["subdinas"])->order_by("nama_laporan")->get('formulir')->result());
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

	public function view_upd()
	{
	
		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$data['session'] = $user;
			$data['formulir'] = $this->db->select('view_laporan as v,nama_laporan as t')->like('tipe','F')->where(array("unit"=>$user['unit'],"isactive"=>"Y"))->order_by("nama_laporan")->get('formulir')->result_array();
			$data['rekap'] = $this->db->select('view_laporan as v,nama_laporan as t')->like('tipe','R')->where(array("unit"=>$user['unit'],"isactive"=>"Y"))->order_by("nama_laporan")->get('formulir')->result_array();
			
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

    //Éntry Laporan Gatur Lalin
    public function dt_lap_gat_lin()
    {
        echo ($this->ml->dt_lap_gat_lin());
    }

    public function lap_gat_lin()
    {
        $data = [
            'title' => 'Laporan Giat Lalin',
            'js_local' => 'laporan/lap_gat_lin.js',
        ];
        $this->template->load('page/laporan/lap_gat_lin', $data);
    }
    

	
	public function get_form()
	{
		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$d=$this->input->post('direktorat');
			if($d!='')$where['direktorat']=$d;
			$d=$this->input->post('sie');
			if($d!='')$where['sie']=$d;
			$d=$this->input->post('subdit');
			if($d!='')$where['subdit']=$d;
			$ret=$this->db->select('view_laporan as v,nama_laporan as t')->where($where)->order_by("nama_laporan")->get('formulir')->result();
			$retval=array('code'=>"200",'ttl'=>"OK",'msgs'=>$ret);
			echo json_encode($retval);
		}else{
			$retval=array('code'=>"403",'ttl'=>"Session closed",'msgs'=>array());
			echo json_encode($retval);
		}
	}
	private function takeout($str,$arr){
		$ret=array();
		foreach($arr as $key=>$val){
			if($key!=$str)	$ret=array_merge($ret,array($key=>$val));
		}
		return $ret;
	}
	public function get_content()
	{
		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$data['session'] = $user;
			$id=$this->input->post('id');//this is the view
			
			//put all masterdatas needed here
			$data['dummy']="this is dummy data";
			
			if(substr($id,0,8)=='tmc_cctv'){
				$subm=array("tmc_cctv_jalan"=>"Jalan","tmc_cctv_toll"=>"Toll","tmc_cctv_public"=>"Fasilitas Publik","tmc_cctv_critical"=>"Wilayah Critical","tmc_cctv_object"=>"Object");
				$data['subm']=$subm;//$this->takeout($id,$subm);
				$data['frid']=$id;
				$data['penyebab'] = comboopts($this->db->select('sebab as v,sebab as t')->get('penyebab_macet')->result());
			}
			if(substr($id,0,8)=='tmc_data'){
				$subm=array("tmc_data_giatpublik"=>"Giat Publik","tmc_data_vip"=>"Route VIP","tmc_data_fas_public"=>"Fasilitas Publik",
				"tmc_data_jalan"=>"Data Jalan","tmc_data_statusjalan"=>"Status Jalan","tmc_data_gangguan"=>"Gangguan",
				"tmc_data_rawan"=>"Titik Rawan","tmc_data_darurat"=>"Layanan Darurat");
				$data['subm']=$subm;//$this->takeout($id,$subm);
				$data['frid']=$id;
				//$data['penyebab'] = comboopts($this->db->select('sebab as v,sebab as t')->get('penyebab_macet')->result());
			}
			if(substr($id,0,8)=='tmc_reng'){
				$subm=array("tmc_rengiat"=>"Giat Umum","tmc_rengiat_vip"=>"RenGiat PAM VIP","tmc_rengiat_lak_vip"=>"Pelaksanaan PAM VIP");
				$data['subm']=$subm;//$this->takeout($id,$subm);
				$data['frid']=$id;
				if($id=='tmc_rengiat_vip'){
					$data['gangguan'] = comboopts($this->db->select("concat(status,'-',penyebab,'-',penyebabd) as v, concat(jalan,'-',penyebab,'-',penyebabd,'-',status) as t")->order_by('jalan','ASC')->get('tmc_data_gangguan')->result());
				}
			}
			if($id=='tmc_cctv_gerbang'){  //
				$data['gerbang'] = ($this->db->select('val,txt')->where('grp','gerbang')->get('lov')->result_array());
				$data['kendaraan'] = ($this->db->select('val,txt')->where('grp','kendaraan')->get('lov')->result_array());
			}
			if($id=='tmc_data_rawan'){  //
				$data['rawan'] = ($this->db->select('val,txt')->where('grp','rawan')->get('lov')->result_array());
			}
			if($id=='tmc_data_giatpublik'){  //
				$data['giatpublik'] = ($this->db->select('val,txt')->where('grp','giatpublik')->get('lov')->result_array());
			}
			if($id=='tmc_rengiat'){  //
				$data['giatpol'] = ($this->db->select('val,txt')->where('grp','giatpol')->get('lov')->result_array());
			}
			if($id=='tmc_ops_pidana'||$id=='tmc_pservice_pidana'){  //
				$data['pidana'] = ($this->db->select('val,txt')->where('grp','pidana')->get('lov')->result_array());
			}
			if($id=='tmc_ops_laka'){  //
				$data['penggal'] = ($this->db->select('val,txt')->where('grp','penggal')->get('lov')->result_array());
			}
			if($id=='tmc_info_lalin' || $id=='ais_laka' || $id=='tmc_ops_macet' || $id=='tmc_ops_pol'){  //tmc info lalin
				$data['penyebab'] = comboopts($this->db->select('sebab as v,sebab as t')->get('penyebab_macet')->result());
			}
			if($id=='eri_kendaraan'||$id=='ais_laka'){  //eri kendaraan
				$data['polda'] = comboopts($this->db->select('da_id as v,da_nam as t')->get('polda')->result());
			}
			if($id=="tmc_ops_laka"||$id=="tmc_ops_langgar"||$id=="tmc_ops_pidana"||$id=="tmc_ops_pol"){
				$otherdb = $this->load->database('db_intan', TRUE);
				$data["instansi"]=$otherdb->select("nama_instansi as val, nama_instansi as txt")->get("instansi")->result_array();
			}
			if($id=='intan_analytic'){
				if($user["polda"]!=""){ $this->db->where("polda",$user["polda"]); }
				if($user["polres"]!=""){ $this->db->where("polres",$user["polres"]); }
				$data['ambulance']=$this->db->select("nama,lat,lng")->where("yan","Ambulance")->get('ssc_yan_darurat')->result();
				$data['faskes']=$this->db->select("nama,lat,lng")->where("yan","Faskes")->get('ssc_yan_publik')->result();
				$data['pospol']=$this->db->select("nama,lat,lng")->where("pos","Pos Polisi")->get('ssc_jalan')->result();
				$data['pospjr']=$this->db->select("nama,lat,lng")->where("pos","Pos PJR")->get('ssc_jalan')->result();
				$data['koordinasi']=$this->db->select("giat,lat,lng")->get('tmc_koordinasi')->result();
			}
			if($id=='tar_data'){
				$data['pelanggaran']=array(
				"Kamtibmas"=>"Kamtibmas",
				"Lampu Utama"=>"Lampu Utama",
				"Jalur/lajur lalu lintas"=>"Jalur/lajur lalu lintas",
				"Belokan/simpangan"=>"Belokan/simpangan",
				"Kecepatan"=>"Kecepatan",
				"Berhenti"=>"Berhenti",
				"Parkir"=>"Parkir",
				"Kendaraan Tidak Bermotor"=>"Kendaraan Tidak Bermotor");
			}
			
			$this->load->view("formulir/$id",$data); //load the view
			
		}else{
			echo "<script>alrt('Session Closed, please login','error','Error');</script>";
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
		/*$data = [
			'petugas' => '',
			'instansi' => '',
			'nopol' => ''
		]; diremark  krn bakalan ditimpa*/

		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$msgs="No data has been saved";
			$rowid=$this->input->post("rowid");
			$tname=$this->input->post('tablename');
			$fname=$this->input->post('fieldnames');
			$data=$this->input->post(explode(",",$fname));
			if(strpos($fname,"uploadedfile")){
				//upload here
				$path="./uploads/".$this->input->post("path");
				$config['upload_path'] = $path;
				$config['allowed_types'] = '*';//'gif|jpg|jpeg|png';//all
				//$config['file_name'] = $user['nrp'];
				$config['file_ext_tolower'] = true;
				//$config['overwrite'] = false;
				$m="";
				$this->load->library('upload', $config);
				
				$data['uploadedfile'] =  $this->uplots('uploadedfile',$path);
			}
			
			if (is_array($data['petugas'])) {
				$data['petugas'] = implode(';',$data['petugas']);
			}


			if (is_array($data['instansi'])) {
				$data['instansi'] = implode(';',$data['instansi']);
			}

			if (is_array($data['nopol'])) {
				$data['nopol'] = implode(';',$data['nopol']);
			}

			if($rowid==""||$rowid=="0"){
				$this->db->insert($tname,$data);
			}else{
				$this->db->update($tname,$data,"rowid=$rowid");
			}
			$ret=$this->db->affected_rows();
			if($ret>0){
				$msgs="$ret record(s) saved";
			}
			$retval=array('code'=>"200",'ttl'=>"OK",'msgs'=>$msgs);
			echo json_encode($retval);
		}else{
			$retval=array('code'=>"403",'ttl'=>"Session closed",'msgs'=>"Please login");
			echo json_encode($retval);
		}
	}
	public function dele()
	{
		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$msgs="No data has been deleted";
			$rowid=$this->input->post("rowid");
			$tname=$this->input->post('tablename');
			$fname=$this->input->post('fieldnames');
			$data=$this->input->post(explode(",",$fname));
			if($rowid!=""){
				$this->db->delete($tname,array('rowid' => $rowid));
			}
			$ret=$this->db->affected_rows();
			if($ret>0){
				$msgs="$ret record(s) deleted";
			}
			$retval=array('code'=>"200",'ttl'=>"OK",'msgs'=>$msgs);
			echo json_encode($retval);
		}else{
			$retval=array('code'=>"403",'ttl'=>"Session closed",'msgs'=>"Please login");
			echo json_encode($retval);
		}
	}
	
	public function get_subq()
	{
		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$id=$this->input->post('id');
			$cols=$this->input->post('cols');
			$tname=$this->input->post('tname');
			$where=$this->input->post('where');
			if($where!=""){
				$this->db->where(array($where=>$id));
			}
			$ret=$this->db->select($cols)->get($tname)->result();
			$retval=array('code'=>"200",'ttl'=>"OK",'msgs'=>$ret);
			echo json_encode($retval);
		}else{
			$retval=array('code'=>"403",'ttl'=>"Session closed",'msgs'=>array());
			echo json_encode($retval);
		}
	}
	
	public function dttbl(){
		$q=$this->input->post("q");
		$draw=$this->input->post("draw");
		
		$data=array();
		
		$query=$this->db->query(base64_decode($q));
		foreach ($query->result_array() as $row)
		{
			$data[]=array_values($row);
		}
		
		$iTotal=count($data);
		
		$output = array(
          "draw"=>$draw,
          "recordsTotal"=>$iTotal, // total number of records 
          "recordsFiltered"=>$iTotal, // if filtered data used then tot after filter
          "data"=>$data
        );

		echo json_encode($output);
	}
	public function datas(){
		$q=$this->input->post("q");
		$id=$this->input->post("id");
		$sql="";
		switch($q){
			case "statusjalan": $sql="select lat,lng,concat(jalan,'-',status) as ttl,rowid from tmc_data_statusjalan"; 
			if($id!="") $sql="select * from tmc_data_statusjalan where rowid=$id";
			break;
			case "rawan": $sql="select lat,lng,concat(jalan,'-',status) as ttl,rowid from tmc_data_rawan"; 
			if($id!="") $sql="select * from tmc_data_rawan where rowid=$id";
			break;
			case "darurat": $sql="select lat,lng,concat(jalan,'-',jenis) as ttl,rowid from tmc_data_darurat"; 
			if($id!="") $sql="select * from tmc_data_darurat where rowid=$id";
			break;
			case "gangguan": $sql="select lat,lng,concat(jalan,'-',status,'-',penyebab,'-',penyebabd) as ttl,rowid from tmc_data_gangguan"; 
			if($id!="") $sql="select * from tmc_data_gangguan where rowid=$id";
			break;
			case "jalan": $sql="select * from tmc_data_jalan"; 
			if($id!="") $sql="select * from tmc_data_jalan where rowid=$id";
			break;
			case "ec": $sql="select * from tmc_ops_ec"; 
			if($id!="") $sql="select * from tmc_ops_ec where rowid=$id";
			break;
			case "kendaraan": $sql="select * from tmc_data_kendaraan"; 
			if($id!="") $sql="select * from tmc_data_kendaraan where rowid=$id";
			break;
			case "pengemudi": $sql="select * from tmc_data_pengemudi"; 
			if($id!="") $sql="select * from tmc_data_pengemudi where rowid=$id";
			break;
		}
		
		$query=$this->db->query($sql);
		$output=$query->result();
		
		echo json_encode($output);
	}
	public function save_rengiat_vip()
	{
		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$msgs="No data has been saved";
			$rowid=$this->input->post("rowid");
			$tname=$this->input->post('tablename');
			$fname=$this->input->post('fieldnames');
			
			$data=$this->input->post(explode(",",$fname));
			if($rowid==""||$rowid=="0"){
				$rengiatid=time();
				$data=array_merge($data,array("rengiatid"=>$rengiatid));
				$this->db->insert($tname,$data);
			}else{
				//$this->db->update($tname,$data,"rowid=$rowid");
			}
			$ret=$this->db->affected_rows();
			if($ret>0){
				$msgs="$ret record(s) saved";
				//input detail here
				$nama=$this->input->post('nama'); $gangguan=$this->input->post('gangguan');
				$ejarak=$this->input->post('ejarak'); $ewaktu=$this->input->post('ewaktu');
				$transit=$this->input->post('transit'); $lat=$this->input->post('lat'); $lng=$this->input->post('lng');
				$dats=array();
				for($i=0;$i<count($nama);$i++){
					if($nama[$i]!=''){
						$dats[]=array("rengiatid"=>$rengiatid,"nour"=>$i+1,"nama"=>$nama[$i],"gangguan"=>$gangguan[$i],
							"ejarak"=>$ejarak[$i],"ewaktu"=>$ewaktu[$i],"transit"=>$transit[$i],"lat"=>$lat[$i],"lng"=>$lng[$i]);
					}
				}
				if(count($dats)>0){
					$this->db->insert_batch("tmc_rengiat_vip_route",$dats);
					$ret=$this->db->affected_rows();
					if($ret>0){
						$msgs.=" / $ret detail(s) saved";
					}
				}
			}
			$retval=array('code'=>"200",'ttl'=>"OK",'msgs'=>$msgs);
			echo json_encode($retval);
		}else{
			$retval=array('code'=>"403",'ttl'=>"Session closed",'msgs'=>"Please login");
			echo json_encode($retval);
		}
	}
	public function save_ops_wal()
	{
		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$msgs="No data has been saved";
			$rowid=$this->input->post("rowid");
			$tname=$this->input->post('tablename');
			$fname=$this->input->post('fieldnames');
			
			$data=$this->input->post(explode(",",$fname));
			if($rowid==""||$rowid=="0"){
				$rengiatid=time();
				$data=array_merge($data,array("giatid"=>$rengiatid));
				$this->db->insert($tname,$data);
			}else{
				//$this->db->update($tname,$data,"rowid=$rowid");
			}
			$ret=$this->db->affected_rows();
			if($ret>0){
				$msgs="$ret record(s) saved";
				//input detail here
				$nama=$this->input->post('nama'); $ejarak=$this->input->post('ejarak'); $jarak=$this->input->post('jarak'); 
				$ewaktu=$this->input->post('ewaktu'); $waktu=$this->input->post('waktu'); $transit=$this->input->post('transit');
				$dats=array();
				for($i=0;$i<count($nama);$i++){
					if($nama[$i]!=''){
						$dats[]=array("giatid"=>$rengiatid,"nour"=>$i+1,"nama"=>$nama[$i],"jarak"=>$jarak[$i],"waktu"=>$waktu[$i],
							"ejarak"=>$ejarak[$i],"ewaktu"=>$ewaktu[$i],"transit"=>$transit[$i]);
					}
				}
				if(count($dats)>0){
					$this->db->insert_batch($tname."_route",$dats);
					$ret=$this->db->affected_rows();
					if($ret>0){
						$msgs.=" / $ret detail(s) saved";
					}
				}
			}
			$retval=array('code'=>"200",'ttl'=>"OK",'msgs'=>$msgs);
			echo json_encode($retval);
		}else{
			$retval=array('code'=>"403",'ttl'=>"Session closed",'msgs'=>"Please login");
			echo json_encode($retval);
		}
	}
	public function save_ops_ec()
	{
		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$msgs="No data has been saved";
			$rowid=$this->input->post("rowid");
			$tname=$this->input->post('tablename');
			$fname=$this->input->post('fieldnames');
			
			$data=$this->input->post(explode(",",$fname));
			if($rowid==""||$rowid=="0"){
				$rengiatid=time();
				$data=array_merge($data,array("giatid"=>$rengiatid));
				$data["dampak"]=implode(", ",$this->input->post('dampak'));
				$data["kebutuhan"]=implode(", ",$this->input->post('kebutuhan'));
				$this->db->insert($tname,$data);
			}else{
				//$this->db->update($tname,$data,"rowid=$rowid");
			}
			$ret=$this->db->affected_rows();
			if($ret>0){
				$msgs="$ret record(s) saved";
				//input detail here
				$nama=$this->input->post('nama'); $jenis=$this->input->post('jenis'); $alamat=$this->input->post('alamat'); 
				$cc=$this->input->post('cc'); $lat=$this->input->post('latx'); $lng=$this->input->post('lngx');
				$dats=array();
				for($i=0;$i<count($nama);$i++){
					if($nama[$i]!=''){
						$dats[]=array("giatid"=>$rengiatid,"nama"=>$nama[$i],"jenis"=>$jenis[$i],"alamat"=>$alamat[$i],
							"cc"=>$cc[$i],"lat"=>$lat[$i],"lng"=>$lng[$i]);
					}
				}
				if(count($dats)>0){
					$this->db->insert_batch($tname."_fas",$dats);
					$ret=$this->db->affected_rows();
					if($ret>0){
						$msgs.=" / $ret detail(s) saved";
					}
				}
			}
			$retval=array('code'=>"200",'ttl'=>"OK",'msgs'=>$msgs);
			echo json_encode($retval);
		}else{
			$retval=array('code'=>"403",'ttl'=>"Session closed",'msgs'=>"Please login");
			echo json_encode($retval);
		}
	}
}
