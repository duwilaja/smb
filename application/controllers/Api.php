<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MGeneral','mg');
        
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $this->load->library('session');
    } 

    //  ini get input type select di form laporan gatur lalin
    public function kegiatan()
    { 
        $table = 'kegiatan';
        $where = '';
        $select = '*';
        $rsp = $this->_api->get($table,$where,$select);
        echo json_encode($rsp);
    }

    public function kejadian()
    { 
        $table = 'kejadian_ditemukan';
        $where = '';
        $select = '*';
        $rsp = $this->_api->get($table,$where,$select);
        echo json_encode($rsp);
    }
    
    public function parameter_antrian()
    { 
        $table = 'parameter_antrian';
        $where = '';
        $select = '*';
        $rsp = $this->_api->get($table,$where,$select);
        echo json_encode($rsp);
    }

    public function penyebab()
    { 
        $table = 'penyebab';
        $where = '';
        $select = '*';
        $rsp = $this->_api->get($table,$where,$select);
        echo json_encode($rsp);
    }

    public function lap_gatlin()
    {
        // Delakarasi
        $inp = [
            'kegiatan' => 'kegiatan',
            'no_sprint' => 'no_sprint',
            'tanggal' => 'tanggal',
            'jam' => 'jam',
            'pos_simpang' => 'pos_simpang',
            'koordinat' => 'kordinat',
            'kejadian' => 'kejadian',
            'tindakan' => 'ket_tindakan',
            'status' => 'status_lalin',
            'a_timur' => 'a_timur',
            'a_barat' => 'a_barat',
            'a_utara' => 'a_utara',
            'a_selatan' => 'a_selatan',
            'penyebab' => 'penyebab',
        ];
        $status = false;
        $table = 'lap_gatur_lalin';
        $msg = "Gagal Input Data";
        $data = [];
        $where = [];
        $obj = [];
        $i = inp();

        foreach ($i as $k => $v) {
            if(!empty($inp[$k])) $obj[$inp[$k]] = $v;
        }
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method == "GET") {
            $rsp = $this->_api->get($table);
            echo json_encode($rsp);
        }elseif ($method == "POST") {
            $q =  $this->mg->in($table, $obj);
            if($q[0]){
                $status = true;
                $msg = "Data berhasil di input";
            }
        }elseif ($method == "PUT") {
            $where = ['rowid' =>  $i['rowid']];
            foreach ($i as $k => $v) {
                if(!empty($inp[$k])) $obj[$inp[$k]] = $v;
            }
            
            $q =  $this->mg->up($table,$obj,$where);
            if($q[0]){
                $status = true;
                $msg = "Data berhasil di update";
            }
        }

        $rsp = [
            'data' => $data,
            'msg' => $msg,
            'status' => $status
        ];

        echo json_encode($rsp);
    }

    // Polda
    public function polda()
    { 
        $table = 'polda';
        $where = '';
        $select = '*';
        $rsp = $this->_api->get($table,$where,$select);
        echo json_encode($rsp);
    }

     // polres
     public function polres()
     { 
         $where = '';
         $select = '*';
         $table = 'polres';

         $polda = $this->input->get('polda');
         if ($polda != '') {
             $where = ['polda' => $polda];
         }
         $rsp = $this->_api->get($table,$where,$select);
         echo json_encode($rsp);
     }

     // pangkat
     public function pangkat()
     { 
         $table = 'pangkat';
         $where = '';
         $select = '*';
         $rsp = $this->_api->get($table,$where,$select);
         echo json_encode($rsp);
     }

     // unit
     public function unit()
     { 
         $table = 'unit';
         $where = '';
         $select = '*';
         $rsp = $this->_api->get($table,$where,$select);
         echo json_encode($rsp);
     }

    //  Core Users
    public function users()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $status = false;
        $table = 'core_user';
        $msg = "Gagal Input Data";
        $data = [];
        $where = [];

        // Delakarasi
        $inp_u = [ //users
            'username' => 'uid',
            'usts' => 'usts',
            'nama' => 'uname',
            'password' => 'upwd',
        ];

        $inp_p = [ //person
            'nama' => 'nama',
            'pangkat' => 'pangkat',
            'polda' => 'polda',
            'polres' => 'polres',
            'unit' => 'unit',
            'email' => 'email',
            'tlp' => 'telp',
        ];

        $inp = array_merge($inp_u,$inp_p);
        

        $i = inp();
        $obj_u = gnrt_inp($i,$inp_u);
        $obj_p = gnrt_inp($i,$inp_p);


        if ($method == "GET") {
            $q = $this->input->get('id');
            $this->load->model('MUsers','mu');
            $data = $this->mu->get_users($q)->row();

        }elseif ($method == "POST") {
           
            $validasi = [
                ['json.username','required.username','Username tidak boleh kosong'],
                ['json.pangkat','required.pangkat','Pangkat tidak boleh kosong'],
                ['json.password','required.password','Password tidak boleh kosong'],
                ['json.username','core_user.uid','Username sudah dipakai'],
            ];
    
            $this->_api->validasi($validasi);

            $obj_u['upwd'] = md5($obj_u['upwd']);
            $obj_u['usts'] = 1;
            $q =  $this->mg->in($table, $obj_u);
            if($q[0]){
                
                $obj_p['nrp'] = $obj_u['uid'];
                $obj_p['registered'] = date('Y-m-d H:i:s');
                $this->mg->in('persons',$obj_p);

                $status = true;
                $msg = "Data berhasil di input";
            }
        }elseif ($method == "PUT") {
            $obj1 = [];
            $obj2 = [];

            $whereu = ['rowid' =>  $i['u_rowid']];
            $wherep = ['nrp' =>  $i['u_username']];
            
            foreach ($i as $k => $v) {
                $ok = explode('_',$k);
                if(!empty($inp_u[$ok[1]])) $obj1[$inp_u[$ok[1]]] = $v;
            }

            foreach ($i as $k => $v) {
                $ok = explode('_',$k);
                if(!empty($inp_p[$ok[1]])) $obj2[$inp_p[$ok[1]]] = $v;
            }

            if($obj1['upwd'] == '') unset($obj1['upwd']);   
                else $obj1['upwd'] = md5($obj1['upwd']);
            $q =  $this->mg->up($table,$obj1,$whereu);
            $qq =  $this->mg->up('persons',$obj2,$wherep);

            $status = true;
            $msg = "Data berhasil di update";
        }

        $rsp = [
            'data' => $data,
            'msg' => $msg,
            'status' => $status
        ];

        echo json_encode($rsp);
    }

    public function save_uidfcm(){
        $rowid = $this->session->userdata("user_data")["rowid"];
        $token = $this->input->post("token");
        $obj["uid_fcm"]=$token;
        $where["rowid"]=$rowid;
        $up = $this->mg->up('persons',$obj,$where);
        $rsp = [
            'msg' => "OK",
            'status' => $up[0]
        ];

        echo json_encode($rsp);
    }
    // end get input type select di form laporan gatur 
}