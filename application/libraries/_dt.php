<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
  
  class _dt {
    
    public function __construct() {
        
      $this->CI = &get_instance();
      $this->CI->load->model('MGeneral','mg');
    
    }

    function cari_arr($arr=[],$nilai='')
    {
        $x = '';
        foreach ($arr as $k => $v) {
            if($v['nilai'] == $nilai) return $v['nama'];
        }
    }

    function select_dt($t='',$field='',$dt=''){
        
        // atur If disini bos
        if ($t == 'kondisi_jalan') {
            $field[4] = $this->cari_arr(KONSTRUKSI,$field[4]);
        }else if ($t == 'prasarana_public') {
            $field[0] = $this->cari_arr(PRASARANA_PUBLIC,$field[0]);
        }elseif ($t == 'sie') {
            $q = $this->CI->mg->get('subdit',['sub_id' => $field[2]]);
            if($q->num_rows() > 0) $field[2] = $q->row()->sub_id;
        }elseif ($t == 'ro') {
            $q = $this->CI->mg->get('korps',['krp_id' => $field[2]]);
            if($q->num_rows() > 0) $field[2] = $q->row()->krp_id;
        }elseif ($t == 'bagian') {
            $q = $this->CI->mg->get('ro',['ro_id' => $field[2]]);
            if($q->num_rows() > 0) $field[2] = $q->row()->ro_id;
        }elseif ($t == 'subbag') {
            $q = $this->CI->mg->get('bagian',['bag_id' => $field[2]]);
            if($q->num_rows() > 0) $field[2] = $q->row()->bag_id;
        }

        $field[0] = '<a href="#" data-toggle="modal" data-target="#myModal2" onclick="get_data_id('.$dt->rowid.')">'.$field[0].'</a>';
        
        return $field;
    }


  }    