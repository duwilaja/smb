<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class MPatwal extends CI_Model {

    private $t = 'patwal_permohonan';
    public $see = '*';

    public function __construct()
    {
        parent::__construct();
    }
    
    public function get($id='',$where='',$groupby='')
    {
        $this->db->select($this->see);
        
        if ($groupby != '') {
            $this->db->group_by($groupby);
        }

        if($id != ''){
            $q = $this->db->get_where($this->t,['id' => $id]);
        }else if($where != ''){
            $this->db->where($where);
            $q = $this->db->get($this->t);
        }else{
            $q = $this->db->get($this->t);
        }
        return $q;
    }
    public function get_where($table='',$id='',$where='',$groupby='')
    {
        $this->db->select($this->see);
        
        if ($groupby != '') {
            $this->db->group_by($groupby);
        }

        if($id != ''){
            $q = $this->db->get_where($table,['id' => $id]);
        }else if($where != ''){
            $this->db->where($where);
            $q = $this->db->get($table);
        }else{
            $q = $this->db->get($table);
        }
        return $q;
    }

    public function get_petugas($id='')
    {
        $nama = "";
        $dt= $this->db->get_where('persons',array('rowid'=> $id))->result();
        foreach ($dt as $data ){
            $nama = $data->nama;
        }

        return $nama;
    }

    public function get_nrp($id='')
    {
        $nama = "";
        $dt= $this->db->get_where('persons',array('rowid'=> $id))->result();
        foreach ($dt as $data ){
            $nama = $data->nrp;
        }
        return $nama;
    }

    public function status($status='')
    {
        // $status = "";
        if ($status == 0) {
            $status = "Pengajuan";
        }elseif ($status == 1) {
            $status = "Disetujui";
        }elseif ($status == 2) {
            $status = "Ditolak";
        }elseif ($status == 3) {
            $status = "Berjalan";
        }elseif ($status == 4) {
            $status = "Selesai";
        }else{
            $status = "Tidak diketahui";
        }

        return $status;
    }

    public function dt_patwal_permohonan()
    {
         // Definisi
         $condition = [];
         $data = [];
         
         $CI = &get_instance();
         $CI->load->model('DataTable', 'dt');
         
         // Set table name
         $CI->dt->table = $this->t.' e';
         // Set orderable column fields
         $CI->dt->column_order = ['kode','nama_pemohon','tanggal_patwal','alamat_awal','alamat_tujuan','status',null];
         // Set searchable column fields
         $CI->dt->column_search = ['kode','nama_pemohon','tanggal_patwal','alamat_awal','alamat_tujuan','status'];
         // Set select column fields
         $CI->dt->select = 'id,kode,nama_pemohon,tanggal_patwal,jam_patwal,alamat_awal,alamat_tujuan,status';
         // Set default order
         $CI->dt->order = ['status' => 'asc'];
        //  $this->db->group_by('e.da');
        
        //  if ($status != '') {
        //    $con1 = ['where','status',$status];
        //    array_push($condition,$con1);
        //   }
         $tanggal_patwal = $this->input->post('tanggal_patwal');
         $jam_patwal = $this->input->post('jam_patwal');
         $status = $this->input->post('status');

         if ($tanggal_patwal != '') {
           $con1t = ['where','date(tanggal_patwal)',$tanggal_patwal];
           array_push($condition,$con1t);
          }
         
         if ($jam_patwal != '') {
            $con1t = ['where','time(jam_patwal)',$jam_patwal];
            array_push($condition,$con1t);
           } 
         
        if ($status != '') {
            $con1t = ['where','status',$status];
            array_push($condition,$con1t);
           }   

        //  $cons = ['join','polda p','p.rowid = e.da','inner'];
        //  array_push($condition,$cons);
         
         // Fetch member's records
         $dataTabel = $this->dt->getRows($_POST, $condition);
         $i = $this->input->post('start');
         foreach ($dataTabel as $dt) {
             $i++;
            if ($dt->status == 0) {
                $data[] = array(
                    substr($dt->kode,0,10)." ...",
                    $dt->nama_pemohon,
                    tgl_indo($dt->tanggal_patwal).", ".$dt->jam_patwal,
                    (str_word_count($dt->alamat_awal) > 3 ? substr($dt->alamat_awal,0,20)." ..." : $dt->alamat_awal),
                    (str_word_count($dt->alamat_tujuan) > 3 ? substr($dt->alamat_tujuan,0,20)." ..." : $dt->alamat_tujuan),
                    $this->status($dt->status),
                    '<a href="javascript:void(0);"  onclick="proses('.$dt->id.')" class="btn btn-xs btn-warning text-white"> Proses</a>
                     <a href="javascript:void(0);"  onclick="detail('.$dt->id.')" class="btn btn-xs btn-info text-white"> Detail</a>'
                   //  '<a href="" id="btn-edit" data-id="'.$dt->id.'" class="btn btn-outline btn-circle btn-sm purple" ><i class="fa fa-edit"></i> Edit </a>'
                );
            }elseif ($dt->status == 1) {
                $data[] = array(
                    substr($dt->kode,0,10)." ...",
                    $dt->nama_pemohon,
                    tgl_indo($dt->tanggal_patwal).", ".$dt->jam_patwal,
                    (str_word_count($dt->alamat_awal) > 3 ? substr($dt->alamat_awal,0,20)." ..." : $dt->alamat_awal),
                    (str_word_count($dt->alamat_tujuan) > 3 ? substr($dt->alamat_tujuan,0,20)." ..." : $dt->alamat_tujuan),
                    $this->status($dt->status),
                    '<a href="javascript:void(0);"  onclick="proses_berjalan('.$dt->id.')" class="btn btn-xs btn-warning text-white"> Proses</a>
                     <a href="javascript:void(0);"  onclick="detail('.$dt->id.')" class="btn btn-xs btn-info text-white"> Detail</a>'
                   //  '<a href="" id="btn-edit" data-id="'.$dt->id.'" class="btn btn-outline btn-circle btn-sm purple" ><i class="fa fa-edit"></i> Edit </a>'
                );
            }elseif ($dt->status == 3) {
                $data[] = array(
                    substr($dt->kode,0,10)." ...",
                    $dt->nama_pemohon,
                    tgl_indo($dt->tanggal_patwal).", ".$dt->jam_patwal,
                    (str_word_count($dt->alamat_awal) > 3 ? substr($dt->alamat_awal,0,20)." ..." : $dt->alamat_awal),
                    (str_word_count($dt->alamat_tujuan) > 3 ? substr($dt->alamat_tujuan,0,20)." ..." : $dt->alamat_tujuan),
                    $this->status($dt->status),
                    '<a href="javascript:void(0);"  onclick="proses_selesai('.$dt->id.')" class="btn btn-xs btn-warning text-white"> Proses</a>
                     <a href="javascript:void(0);"  onclick="detail('.$dt->id.')" class="btn btn-xs btn-info text-white"> Detail</a>'
                   //  '<a href="" id="btn-edit" data-id="'.$dt->id.'" class="btn btn-outline btn-circle btn-sm purple" ><i class="fa fa-edit"></i> Edit </a>'
                );
            }else{
                $data[] = array(
                    substr($dt->kode,0,10)." ...",
                    $dt->nama_pemohon,
                    tgl_indo($dt->tanggal_patwal).", ".$dt->jam_patwal,
                    (str_word_count($dt->alamat_awal) > 3 ? substr($dt->alamat_awal,0,20)." ..." : $dt->alamat_awal),
                    (str_word_count($dt->alamat_tujuan) > 3 ? substr($dt->alamat_tujuan,0,20)." ..." : $dt->alamat_tujuan),
                    $this->status($dt->status),
                    '<a href="javascript:void(0);"  onclick="detail('.$dt->id.')" class="btn btn-xs btn-info text-white"> Detail</a>'
                   //  '<a href="" id="btn-edit" data-id="'.$dt->id.'" class="btn btn-outline btn-circle btn-sm purple" ><i class="fa fa-edit"></i> Edit </a>'
                );
                
            }
         }
         
         $output = array(
             "draw" =>  $this->input->post('draw'),
             "recordsTotal" => $this->dt->countAll($condition),
             "recordsFiltered" => $this->dt->countFiltered($_POST, $condition),
             "data" => $data,
         );
         
         // Output to JSON format
         return json_encode($output);
    } 

    public function dt_riwayat()
    {
         // Definisi
         $condition = [];
         $data = [];
         
         $CI = &get_instance();
         $CI->load->model('DataTable', 'dt');
         
         // Set table name
         $CI->dt->table = 'patwal_riwayat e';
         // Set orderable column fields
         $CI->dt->column_order = ['id','status_riwayat','ctddate','ctdby'];
         // Set searchable column fields
         $CI->dt->column_search = ['status_riwayat','ctddate','ctdby'];
         // Set select column fields
         $CI->dt->select = 'id,status_riwayat,ctddate,ctdtime,ctdby';
         // Set default order
         $CI->dt->order = ['id' => 'desc'];

         $pp_id = $this->input->post('id');

         if ($pp_id != '') {
           $con1t = ['where','pp_id',$pp_id];
           array_push($condition,$con1t);
          }
         
   

        //  $cons = ['join','polda p','p.rowid = e.da','inner'];
        //  array_push($condition,$cons);
         
         // Fetch member's records
         $dataTabel = $this->dt->getRows($_POST, $condition);
         $i = $this->input->post('start');
         foreach ($dataTabel as $dt) {
             $i++;
             $data[] = array(
                $this->status($dt->status_riwayat),
                $this->get_petugas($dt->ctdby),
                tgl_indo($dt->ctddate). " ". $dt->ctdtime
            );
         }
         
         $output = array(
             "draw" =>  $this->input->post('draw'),
             "recordsTotal" => $this->dt->countAll($condition),
             "recordsFiltered" => $this->dt->countFiltered($_POST, $condition),
             "data" => $data
         );
         
         // Output to JSON format
         return json_encode($output);
    } 

    public function dt_pengawal()
    {
         // Definisi
         $condition = [];
         $data = [];
         
         $CI = &get_instance();
         $CI->load->model('DataTable', 'dt');
         
         // Set table name
         $CI->dt->table = 'patwal_tugas e';
         // Set orderable column fields
         $CI->dt->column_order = ['id','person_id','pa_id'];
         // Set searchable column fields
         $CI->dt->column_search = ['id','person_id','pa_id'];
         // Set select column fields
         $CI->dt->select = 'id,person_id,pa_id';
         // Set default order
         $CI->dt->order = ['id' => 'desc'];

         $pp_id = $this->input->post('id');

         if ($pp_id != '') {
           $con1t = ['where','pp_id',$pp_id];
           array_push($condition,$con1t);
          }
         
   

        //  $cons = ['join','polda p','p.rowid = e.da','inner'];
        //  array_push($condition,$cons);
         
         // Fetch member's records
         $dataTabel = $this->dt->getRows($_POST, $condition);
         $i = $this->input->post('start');
         foreach ($dataTabel as $dt) {
            $i++;
             $data[] = array(
                $i,
                $this->get_nrp($dt->person_id),
                $this->get_petugas($dt->person_id)
                
            );
         }
         
         $output = array(
             "draw" =>  $this->input->post('draw'),
             "recordsTotal" => $this->dt->countAll($condition),
             "recordsFiltered" => $this->dt->countFiltered($_POST, $condition),
             "data" => $data
         );
         
         // Output to JSON format
         return json_encode($output);
    } 
    
}