<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
  
  class _api {
    
    public function __construct() {
        
      $this->CI = &get_instance();
      $this->CI->load->model('MGeneral','mg');
    
    }
    public function get($table='',$where='',$select='')
    {
        $status = false;
        $msg = "Gagal Mendapatkan Data";
        $data = [];

        $method = $_SERVER['REQUEST_METHOD'];
        if ($method === 'GET') {
            $q = $this->CI->mg->get($table,$where,$select);
            if($q->num_rows() > 0){
                $status = true;
                $data = $q->result();
                $msg = "Data berhasil didapatkan";
            } 
        }else{
            $msg = "Method Tidak Diketahui";
        }
        $rsp = [
            'data' => $data,
            'msg' => $msg,
            'status' => $status
        ];
        return $rsp;
    }

    public function validasi($arr_validasi=[])
    {
      $i = inp();

      foreach ($arr_validasi as $k => $v) {
        $x = $v[1];
        $expp = explode('.',$v[0]);
        $exp = explode('.',$x);
        if ($exp[0] == 'required') {
          if ($expp[0] == 'form' && $this->CI->input->post($expp[1]) == '') {
            $this->set_json_valid($v[2]);
          }else if($expp[0] == 'json' && isset($i[$expp[1]]) && $i[$expp[1]] == ''){
            $this->set_json_valid($v[2]);
          }
        }else{
          $q = $this->CI->mg->get($exp[0],[$exp[1] => $i[$expp[1]] ])->num_rows();
          if ($q > 0) $this->set_json_valid($v[2]);
        }
      }

      return false;
    }

    private function set_json_valid($msg='')
    {
      $data = [
        'status' => false,
        'msg' => $msg
      ];
      echo json_encode($data);
      die;
    }

  }    