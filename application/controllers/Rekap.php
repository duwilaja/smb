<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
	}

	private function select_formulir($v='')
	{
		$user=$this->session->userdata('user_data');
		if ($v != '') {
			return $this->db->select('view_laporan as v,nama_laporan as t')->like('tipe','R')->where(array("unit"=>$user['unit'],"isactive"=>"Y",'view_laporan' => 'tmc_ops_laka'))->or_where("unit",$user["subdinas"])->order_by("nama_laporan")->get('formulir')->row();
		}else{
			return comboopts($this->db->select('view_laporan as v,nama_laporan as t')->like('tipe','R')->where(array("unit"=>$user['unit'],"isactive"=>"Y"))->or_where("unit",$user["subdinas"])->order_by("nama_laporan")->get('formulir')->result());
		}
	}
	
	public function index()
	{
		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$data['session'] = $user;
			$data['title'] = "Rekap";
			$data['formulir'] = $this->select_formulir();
			
			$this->template->load('rekap',$data);
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
			$ret=$this->db->select('view_laporan as v,nama_laporan as t')->where($where)->get('formulir')->result();
			$retval=array('code'=>"200",'ttl'=>"OK",'msgs'=>$ret);
			echo json_encode($retval);
		}else{
			$retval=array('code'=>"403",'ttl'=>"Session closed",'msgs'=>array());
			echo json_encode($retval);
		}
	}
	public function get_content()
	{
		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$id=$this->input->post('id');//this is the view
			
			//put all masterdatas needed here
			$data['dummy']="this is dummy data";
			
			$this->load->view("rekap/$id",$data); //load the view
			
		}else{
			echo "<script>alrt('Session Closed, please login','error','Error');</script>";
		}
	}
	
	public function datatable_all(){
		$user=$this->session->userdata('user_data');
		$data=array(); $data_assoc=array();
		if(isset($user)){
			$tname=base64_decode($this->input->post('tname')); //tablename
			$cols=base64_decode($this->input->post('cols')); //column
			
			$ismap=base64_decode($this->input->post('ismap')); //is map button active?
			$isverify=base64_decode($this->input->post('isverify')); //is verify button active?
			$isfile=base64_decode($this->input->post('isfile')); //is files active?
			$order_p = $this->input->post('orders');
            $ord = "";
            if($order_p!=""){
                $ord = base64_decode($order_p);
            }
			$where=array();
			//build where polda/polres
			if ($this->input->post('tgl') != '') {
				$ftgl=$this->input->post('ftgl')?$this->input->post('ftgl'):'tgl';
				$where[$ftgl] = $this->input->post('tgl'); //date('Y-m-d');
			}
			//$d=$user['polres'];
			///if($d!='')
				//$where[$tname.'.polres']=$d;
			//$d=$user['polda'];
			//if($d!='')
				//$where[$tname.'.polda']=$d;
			
			$this->db->select($cols);
			$this->db->from($tname);
			if($tname=="ais_laka"||$tname=="eri_kendaraan"){
				$this->db->join("polda","polda.da_id=$tname.da","left");
				$this->db->join("polres","polres.res_id=$tname.res","left");
			}
			$this->db->where($where);
			if($ord!=""){
                $this->db->order_by($ord);
            }
			$data_assoc=$this->db->get()->result_array();

			$i = 0;
			foreach ($data_assoc as $k => $v) {
				$lnk='';
				if($ismap){
					$lnk.='<button type="button" class="btn btn-icon btn-info" onclick="mapview('.$v['lat'].','.$v['lng'].
					');"><i class="fa fa-map-marker"></i></button>';
					$nm=isset($data_assoc[$i]['tit'])?$data_assoc[$i]['tit']:'';
					$src='https://satupeta.elingsolo.com/satupeta?lokasi='.$data_assoc[$i]['lat'].','.$data_assoc[$i]['lng'].'&nama='.$nm;
					$lnk='<a type="button" class="btn btn-icon btn-info" href="JavaScript:;" data-fancybox="" data-type="iframe" data-src="'.$src.'"><i class="fa fa-map-marker"></i></a><br />';
				}
				if($isverify){
					$lnk.=' <button type="button" class="btn btn-icon btn-warning" onclick="openmodal('.$v['rowid'].');"><i class="fa fa-check"></i></button>';
				}
				if($isfile){
					$myfiles=explode(",",$this->input->post('filefields'));
					for($z=0;$z<count($myfiles);$z++){
						$v[$myfiles[$z]]=$this->make_link($v[$myfiles[$z]]);
					}
				}
				if($lnk!=''){
					$v['btnset']=$lnk;
				}
				if(array_key_exists('link',$v)){
					$v['link'] = '<a href="'.$v['link'].'"  target="__blank">Link Preview</a>';
				}
				$data[]=array_values($v);
			}
			// for($i=0;$i<count($data_assoc);$i++){
			// 	$lnk='';
			// 	if($ismap){
			// 		$lnk.='<button type="button" class="btn btn-icon btn-info" onclick="mapview('.$data_assoc[$i]['lat'].','.$data_assoc[$i]['lng'].
			// 		');"><i class="fa fa-map-marker"></i></button>';
			// 	}
			// 	if($isverify){
			// 		$lnk.=' <button type="button" class="btn btn-icon btn-warning" onclick="openmodal('.$data_assoc[$i]['rowid'].');"><i class="fa fa-check"></i></button>';
			// 	}
			// 	if($isfile){
			// 		$myfiles=explode(",",$this->input->post('filefields'));
			// 		for($z=0;$z<count($myfiles);$z++){
			// 			$data_assoc[$i][$myfiles[$z]]=$this->make_link($data_assoc[$i][$myfiles[$z]]);
			// 		}
			// 	}
			// 	if($lnk!=''){
			// 		$data_assoc[$i]['btnset']=$lnk;
			// 	}
			// 	if(key($data_assoc[$i]) == "link"){
			// 		die;
			// 		$lnk.='<a href="'.$data_assoc[$i]['link	'].'">Link Privew</a>';
			// 	}

			// 	$data[]=array_values($data_assoc[$i]);
			// }
		}
		$output = array(
                        "draw" => 0,//$this->input->post('draw'),
                        "recordsTotal" => count($data),
                        "recordsFiltered" => count($data),
                        "data" => $data,
						"assoc" => $data_assoc
                );
        //output to json format
        echo json_encode($output);
	}
	
	public function datatable(){
		$user=$this->session->userdata('user_data');
		$data=array(); $data_assoc=array();
		if(isset($user)){
			$tname=base64_decode($this->input->post('tname')); //tablename
			$cols=base64_decode($this->input->post('cols')); //column
			
			$ismap=base64_decode($this->input->post('ismap')); //is map button active?
			$isverify=base64_decode($this->input->post('isverify')); //is verify button active?
			$isfile=base64_decode($this->input->post('isfile')); //is files active?
			
			$where=array();
			$acol=explode(",",$cols);
			
			//build where polda/polres
			if ($this->input->post('tgl') != '') {
				$ftgl=$this->input->post('ftgl')?$this->input->post('ftgl'):'tgl';
				$where[$ftgl] = $this->input->post('tgl'); //date('Y-m-d');
			}
			//$d=$user['polres'];
			///if($d!='')
				//$where[$tname.'.polres']=$d;
			//$d=$user['polda'];
			//if($d!='')
				//$where[$tname.'.polda']=$d;
			
			$this->db->select($cols);
			//$this->db->from($tname);
			if($tname=="ais_laka"||$tname=="eri_kendaraan"){
				$this->db->join("polda","polda.da_id=$tname.da","left");
				$this->db->join("polres","polres.res_id=$tname.res","left");
			}

			$order_p = $this->input->post('orders');
            $ord = "";
            if($order_p!=""){
                $ord = base64_decode($order_p);
            }
			$this->db->where($where);
			$semua=$this->db->count_all_results($tname,FALSE);
      
			if($ord!=''){
				$this->db->order_by($ord);
			}else{
				$this->db->order_by($acol[$this->input->post('order')[0]['column']], $this->input->post('order')[0]['dir']);
			}
			$this->db->limit($this->input->post('length'),$this->input->post('start'));
			$data_assoc=$this->db->get()->result_array();
			
			$sme = $this->load->database('db_intan', TRUE);
			$select =  $this->select_formulir($tname);

			for($i=0;$i<count($data_assoc);$i++){

				if ($tname == 'tmc_ops_laka') {
					$data_assoc[$i]['rowid'] = "<a href='".site_url('Laporan/view_upd?col='.$this->input->post('cols').'&t='.$this->input->post('tname').'&rowid='.$data_assoc[$i]['rowid']).'&text='.$select->t.'&tbl='.$select->v."'>".$data_assoc[$i]['rowid']."</a>"; 

					$instansi = explode(';',$data_assoc[$i]['instansi']);
					$petugas = explode(';',$data_assoc[$i]['petugas']);
					$nopol = explode(';',$data_assoc[$i]['nopol']);

					
					if ($data_assoc[$i]['instansi'] != '') {
						$data_assoc[$i]['instansi'] = '';
						foreach ($petugas as $k => $v) {
							$ins = @$sme->get_where('instansi',['id' => $instansi[$k]])->row()->nama_instansi;
							$data_assoc[$i]['instansi'] .= '<label class="label label-primary px-1 py-1 mb-1">'.$petugas[$k].' - '.$ins.'</label>';
						}
					}

					if ($data_assoc[$i]['nopol'] != '') {
						$data_assoc[$i]['nopol'] = '';
						foreach ($nopol as $k => $v) {
							$data_assoc[$i]['nopol'] .= '<label class="label label-dark px-1 py-1 mb-1">'.$v.'</label>';
						}
					}
				}


				$lnk='';
				if($ismap){
					$lnk.='<button type="button" class="btn btn-icon btn-info" onclick="mapview('.$data_assoc[$i]['lat'].','.$data_assoc[$i]['lng'].
					');"><i class="fa fa-map-marker"></i></button>';
					$nm=isset($data_assoc[$i]['tit'])?$data_assoc[$i]['tit']:'';
					$src='https://satupeta.elingsolo.com/satupeta?lokasi='.$data_assoc[$i]['lat'].','.$data_assoc[$i]['lng'].'&nama='.$nm;
					$lnk='<a type="button" class="btn btn-icon btn-info" href="JavaScript:;" data-fancybox="" data-type="iframe" data-src="'.$src.'"><i class="fa fa-map-marker"></i></a><br />';
				}
				if($isverify){
					$lnkx=' <button type="button" class="btn btn-icon btn-warning" onclick="openmodal('.$data_assoc[$i]['rowid'].');"><i class="fa fa-check"></i></button>';
					if($tname=='tmc_pservice_langgar'){
						$lnkx=' <button type="button" class="btn btn-icon btn-warning" onclick="openmodal('.$data_assoc[$i]['rowid'].',\''.$data_assoc[$i]['langgar'].'\');"><i class="fa fa-check"></i></button>';
					}
					$lnk.=$lnkx;
				}
				if($isfile){
					$myfiles=explode(",",$this->input->post('filefields'));
					for($z=0;$z<count($myfiles);$z++){
						$data_assoc[$i][$myfiles[$z]]=$this->make_link($data_assoc[$i][$myfiles[$z]]);
					}
				}
				if($lnk!=''){
					$data_assoc[$i]['btnset']=$lnk;
				}
				$data[]=array_values($data_assoc[$i]);
			}
		}
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
	
	private function make_link($links){
		$ret="";
		$alink=explode(";",$links);
		for($j=0;$j<count($alink);$j++){
			//$ret.='<a target="_blank" href="'.$alink[$j].'">Attachment '.($j+1).'</a>';
			if(trim($alink[$j])!=""){
				$ret.='<a href="JavaScript:;" data-fancybox="" data-type="iframe" data-src="'.$alink[$j].'">Attachment '.($j+1).'</a><br />';
			}
		}
		return $ret;
	}
	private function save_notif($array){
		if(count($array) > 0){
			for ($i=0; $i < count($array); $i++) { 
				$el = $array[$i];
				if($el["input_peng"]!="0"){
					$cat = "";
					if($el["kategori_peng_id"]=="1")
						$cat ="laka";
					else if($el["kategori_peng_id"]=="1019")
						$cat="macet";
					else if($el["kategori_peng_id"]=="1020")
						$cat="langgar";
					else if($el["kategori_peng_id"]=="1022")
						$cat="gangguan";
					else if($el["kategori_peng_id"]=="1021")
						$cat="infra";
					else if($el["kategori_peng_id"]=="1023")
						$cat="pidana";
					else if($el["kategori_peng_id"]=="1024")
						$cat="wal";
					else if($el["kategori_peng_id"]=="1025")
						$cat="sim";
					$status = "";
					if($el["status"]=="0")
						$status="Menunggu Konfirmasi";
					else if($el["status"]=="1")
						$status="Sudah Dikonfirmasi";
					else if($el["status"]=="2")
						$status="Ditangani";
					else if($el["status"]=="3")
						$status="Selesai";
					else if($el["status"]=="4")
						$status="Batal";
					$save = array(
						'masyarakat_id' => $el["input_peng"],
						'kategori_elapor' => $cat,
						'kategori_peng_id' => $el["kategori_peng_id"],
						'table_rowid' => $el['mobile_uniqueid'],
						'judul' => $el['judul']." di ".$el["alamat"],
						'status_name' => $status,
						'pesan' => $el['keterangan'],
						'read_status' => 0,
						'ctddate' => date('Y-m-d'),
						'ctdtime' => date('h:i:s'),
					);
					$this->db->insert("notifikasi_masyarakats",$save);
				}
			}
		}
	}
	public function save()
	{
		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$msgs="No data has been saved";
			$tname=$this->input->post('tablename');
			$fname=$this->input->post('fieldnames');
			$rowid=$this->input->post('rowid');
			$dispatch=$this->input->post('dispatch');
			$data=$this->input->post(explode(",",$fname));	
			$this->db->update($tname,$data,"rowid=$rowid");
			$ret=$this->db->affected_rows();
			$img=[];
			// echo $ret;
			// die;
			if($ret>0){
				$msgs="$ret record(s) saved";
				if($dispatch=='yes' && $this->input->post("verifikasi")=='Y'){
					$select=base64_decode($this->input->post('dispatched'));
					if ($tname == 'tmc_pservice_laka' || $tname == 'tmc_pservice_pidana') {
						$select .= ',uploadedfile';
					}
				
					$datadis=$this->db->select($select)->where(array("rowid"=>$rowid))->get($tname)->result_array();
					$otherdb = $this->load->database('db_intan', TRUE);
					$img = isset($datadis[0]['uploadedfile'])? explode(';',$datadis[0]['uploadedfile']):array();

					unset($datadis[0]['uploadedfile']);
					$otherdb->insert('pengaduan',$datadis[0]);
					$pengaduan_id = $otherdb->insert_id();

					if (count($img) > 0) {
						foreach ($img as $v) {
							$otherdb->insert('peng_img', [
								'pengaduan_id' => $pengaduan_id,
								'img' => base_url().substr($v, 2),
								'ctddate'=> date('Y-m-d'),
								'ctdtime' => date('H:i:s')
							]);
						}
					}

					
					$ret=$otherdb->affected_rows();
					$msgs.=" & $ret DIPATCHED. ";
					
					$fid=$datadis[0]['input_peng'];
					$judul=$datadis[0]['judul'];
					$this->notip($fid,$judul);
					$this->save_notif($datadis);
					$this->notip_sme($judul);
				}
				if ($tname == "tmc_pservice_langgar" && $this->input->post("verifikasi")=='Y' && $this->input->post("lalin")=='Y') {
					$etle =  $this->save_etle($tname,$rowid);
					if ($etle == true) {
						$msgs ="berhasil insert etle";
					}else{
						$msgs ="Gagal insert etle";
					}
				}
			}
			$retval=array('code'=>"200",'ttl'=>"OK",'msgs'=>$msgs);
			echo json_encode($retval);
		}else{
			$retval=array('code'=>"403",'ttl'=>"Session closed",'msgs'=>array());
			echo json_encode($retval);
		}
	}
	private function notip_sme($title){
		$judul="Laporan $title";
		$mess="Laporan terverifikasi";
		
		$url="https://backoffice.elingsolo.com/satupeta/API/intan/API/send_notif_web";
		// $url="http://localhost/intan/API/intan/API/send_notif_web";
		$payload = array("title"=> $judul, "msg"=>$mess);
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => $payload,
		CURLOPT_SSL_VERIFYPEER => true 
		));
		
		$res = curl_exec($curl);  
		//$ret=json_decode('{"error":false,"msg":"Hore"}');
		$ret = json_decode($res);
		// print_r($ret->msg);
		return $ret->msg;
	}
	private function notip($id,$title){
		$judul="Laporan $title";
		$mess="Laporan terverifikasi";
		
		$url="https://backoffice.elingsolo.com/satupeta/API/intan/API/send_notif";
		$payload = array("id"=>$id, "title"=> $judul, "msg"=>$mess);
		
		$ch = curl_init($url);
		
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		
		// grab URL and pass it to the res
		$res=curl_exec($ch);

		// close cURL resource, and free up system resources
		curl_close($ch);
		
		//$ret=json_decode('{"error":false,"msg":"Hore"}');
		$ret = json_decode($res);
		
		return $ret->msg;
	}
	private $token = '45fd595dcb1cdb51293fee28335c43487f4eaa2e940db4f589bec08cfae723a2';
	
	public function take(){
		$auth=$this->input->get_request_header('X-token', TRUE);
		$res=array();
		if($auth==$this->token){
			$tname=$this->input->post('tablename');
			$fname=$this->input->post('fieldnames');
			$filtereqs=$this->input->post('filtereqs'); //separated by ,
			$filterlikes=$this->input->post('filterlikes'); //separated by ,
			$where=array(); $like=array();
			if($filtereqs){
				$where=$this->input->post(explode(",",$filtereqs));
			}
			if($filterlikes){
				$like=array_merge($where,$this->input->post(explode(",",$filterlikes)));
			}
			
			$this->db->select($fname);
			if(count($where)>0){
				$this->db->where($where);
			}
			if(count($like)>0){
				$this->db->like($like);
			}
			$res=$this->db->get($tname)->result();
		}
		
		echo json_encode($res);
	}

	public function save_etle($tname='',$rowid='')
	{
		$data = [];
		$get_pelanggaran = $this->db->get_where('tmc_pservice_langgar',array('rowid'=>$rowid))->result();
		foreach ($get_pelanggaran as $key) {
			$nopol = $key->nopol;
			$sumber_data = $key->sumber_data;
			$jenis = $key->jenis;
			$file = substr($key->uploadedfile, 2);
			$data = [
				'gambar' => base_url().$file,
				'img_no_plat' => base_url().$file,
				'no_plat' => $key->nopol,
				'pelang_kend' => $this->tipe_pelang($key->jenis),
				'status' => 1,
				'ctddate' => date('Y-m-d'),
				'tgl_pelang' => $key->tgl,
				'waktu_pelang' => $key->jam,
				'sumber_inp' => 'backoffice',
				'sumber_data' => $key->sumber_data
			];
		}
		$db2 = $this->load->database('etle', TRUE);
		$db2->insert('pelang_kend',$data);
		$ipk = $db2->insert_id();
		$ret=$db2->affected_rows();
		if ($ret > 0) {
			$dt = [
				'pelang_kend_id' => $ipk,
				'regident_id' => 24,
				'no_referensi' => date('his'),
				'status_k_pelang' => 0,
				'aktif' => 1,
				'activity' => 1,
				'ctddate' => date('Y-m-d'),
				'no_plat' => $nopol,
				'sumber_inp' => 'backoffice',
				'sumber_data' => $sumber_data

			];
			$db2->insert('data_pelang',$dt);
			$idp = $db2->insert_id();
			$dt_notif = [
				'keterangan' => 'New Konfirmasi',
				'no_plat' => $nopol,
				'status' => 2,
				'no_referensi' => date('his'),
				'ctddate'  => date('Y-m-d'),
				'ctdtime' => date('h:i:s'),
				'read' => 0,
				'link' => 'https://backoffice.elingsolo.com/new_etle/min/BackOffice/detail_pelanggaran/'.$idp,
				'data_pelang_id' => $idp,
			];
			$db2->insert('notifikasi',$dt_notif);
			// $idp = $db2->insert_id();
			// $dt = [
			// 	'id' => $idp,
			// 	'tipe_pelang' => $jenis

			// ];
			// $db2->insert('data_tipe_pelang',$dt);
			// $idtp = $db2->insert_id();
			// $dt = [
			// 	'data_tipe_pelang_id' => $idtp,
			// 	'pasal_id' => 5

			// ];
			// $db2->insert('pasal_pelang',$dt);

			// $dt = [
			// 	'data_pelang_id' => $idp,
			// 	'data_tipe_pelang_id' => 1,
			// 	'ctddate' => date('Y-m-d') 

			// ];
			// $db2->insert('tipe_pelang',$dt);

			return true;
		}else{
			return false;
		}
		
	}
	public function tipe_pelang($id='')
	{
		$db2 = $this->load->database('etle', TRUE);
		$db2->select('*');
		$db2->from('data_tipe_pelang');
		$db2->like('tipe_pelang',$id);
		$dt = $db2->get()->row();
		if (isset($dt)) {
			return $dt->id;
		}else{
			return 99;
		}
	}

}