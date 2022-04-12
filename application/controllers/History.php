<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
        $this->load->model('MHistory', 'mh');
	}

	public function index()
	{
		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$data['session'] = $user;
			$data['formulir'] = $this->db->select('view_laporan as v,nama_laporan as t')->like('tipe','F')->where(array("unit"=>$user['unit'],"isactive"=>"Y"))->order_by("nama_laporan")->get('formulir')->result_array();
			$data['rekap'] = $this->db->select('view_laporan as v,nama_laporan as t')->like('tipe','R')->where(array("unit"=>$user['unit'],"isactive"=>"Y"))->order_by("nama_laporan")->get('formulir')->result_array();
            $data['history'] = $this->db->select('view_laporan as v,nama_laporan as t, view_field as f')->like('tipe','R')->where(array("unit"=>$user['unit'],"isactive"=>"Y"))->order_by("nama_laporan")->get('formulir')->result_array();
			
			if($user["wasdal"]=="Y"){
				$data['unit'] = $this->db->select('unit_id,unit_nam')->order_by("unit_nam")->get('unit')->result_array();
			}
			
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

    public function historydetail()
	{
		$user=$this->session->userdata('user_data');
		if(isset($user)){
			$data['session'] = $user;
			$data['formulir'] = $this->db->select('view_laporan as v,nama_laporan as t')->like('tipe','F')->where(array("unit"=>$user['unit'],"isactive"=>"Y"))->order_by("nama_laporan")->get('formulir')->result_array();
			$data['rekap'] = $this->db->select('view_laporan as v,nama_laporan as t')->like('tipe','R')->where(array("unit"=>$user['unit'],"isactive"=>"Y"))->order_by("nama_laporan")->get('formulir')->result_array();
            $data['history'] = $this->db->select('view_laporan as v,nama_laporan as t, view_field as f')->like('tipe','R')->where(array("unit"=>$user['unit'],"isactive"=>"Y"))->order_by("nama_laporan")->get('formulir')->result_array();
			
			if($user["wasdal"]=="Y"){
				$data['unit'] = $this->db->select('unit_id,unit_nam')->order_by("unit_nam")->get('unit')->result_array();
			}
			
			$data["nama"]="";
			$data["nrp"] = $this->input->get("nrp");
			$pers=$this->db->where("nrp",$data["nrp"])->get("persons")->result_array();
			if(count($pers)>0) $data["nama"]=$pers[0]["nama"];
			
			$data['js_local'] = 'historydetail.js';
			$this->template->load("historydetail",$data);
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
            // $fld = $formulir->row()->view_field;
            $cs = $this->custom_select($tbl);
            $this->db->select($cs['select']);
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

    public function custom_select($tbl='')
    {

        $tolak = [
            'rowid',
            'dtm',
            'dinas',
            'subdinas',
            'polda',
            'polres',
            'unit',
            'nomor',
            'dasar',
            'giatid',
            'darilat',
            'darilng',
            'kelat',
            'kelng',
            'identifikasiag',
            'identifikasigm'
        ];
        
        $ubah = [
            'nrp' => 'nrp as ID/NRP',
            'tgl' => 'tgl as Tanggal',
            'lat' => 'lat as Latitude',
            'lng' => 'lng as Longitude',
            'namajalan' => 'namajalan as Jalan',
            'ket' => 'ket as Keterangan',
            'penyebabd' => 'penyebabd as Detail',
            'md' => 'md as Meninggal Dunia',
            'lb' => 'lb as Luka Berat',
            'lr' => 'lr as Luka Ringan',
            'langgarperda' => 'langgarperda as Langgar Perda',
            'langgarlalin' => 'langgarlalin as Pelanggaran Lalin',
            'pengungsi' => 'pengungsi as Estimasi Pengungsi',
            'rs' => 'rs as Faskes Rujukan',
            'rsalm' => 'rsalm as Alamat',
            'rslat' => 'rslat as Lat',
            'rslng' => 'rslng as Lng',
            'rscc' => 'rscc as Call Center',
            'penggal' => 'penggal as Status Penggal',
            'obyek' => 'obyek as Obyek Pengawalan',
            'obyeklain' => 'obyeklain as Obyek Lain',
            'namaob' => 'namaob as Nama',
            'ag' => 'ag as Ambang Gangguan',
            'gm' => 'gm as Giat Masyarakat',
            
        ];

        $isi = [];

        $field = $this->db->list_fields($tbl);
        foreach ($field as $k => $v) {
           $data_tolak = $this->tolak_bala($v,$tolak);
           if (!$data_tolak) {
               if (!empty($ubah[$v])) {
                   $isi[] = $ubah[$v];
               }else{
                   $isi[] = $v.' as '.ucfirst($v);
               }
           }
        }

        $rsp['field_arr'] = $isi;
        $rsp['select'] = implode(',',$isi); 
        return $rsp;
    }

    public function tolak_bala($cari='',$data=[])
    {   
        if (in_array($cari,$data)) {
            return true;
        }
        return false;
    }

    public function tes()
    {
        $r = $this->input->get('t');
        $tname=base64_decode($r);
        echo json_encode($tname);
    }

    public function dt_history()
    {
        $nrp = $this->input->post('nrp');
        $s_date = $this->input->post('s_date');
        $e_date = $this->input->post('e_date');
        $unit = $this->input->post('unit');
        $filter = [
            'nrp' => $nrp,
            'start_date' => $s_date,
            'end_date' => $e_date,
            'unit' => $unit,
        ];

        echo $this->mh->dt_history($filter);
    }
}
