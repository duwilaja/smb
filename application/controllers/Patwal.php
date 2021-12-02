<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patwal extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
        $this->load->model('MPatwal','mpl');
		// Your own constructor code
	}
	
    public function dt_patwal_permohonan()
    {
        echo $this->mpl->dt_patwal_permohonan();
    }
    public function dt_riwayat()
    {
        echo $this->mpl->dt_riwayat();
    }
    public function dt_pengawal()
    {
        echo $this->mpl->dt_pengawal();
    }
    public function get_pk_id($pk_id='')
    {
        $dt = $this->db->get_where('patwal_kategori', array('id'=> $pk_id))->result();
        foreach ($dt as $key) {
            $kateg_patwal = $key->kateg_patwal;
        }
        return $kateg_patwal;
    }
    public function get_kateg($kateg_pemohon='')
    {
        # code...
    }

    public function status ($status='')
    {
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

    public function kategori($status='')
    {
        // $status = "";
        if ($status == 1) {
            $status = "Masyarakat";
        }elseif ($status == 2) {
            $status = "Instansi";
        }elseif ($status == 3) {
            $status = "Perusahaan";
        }else{
            $status = "Tidak diketahui";
        }

        return $status;
    }
    public function dt_detail()
    {
        $id = $this->uri->segment(3);
        $get_detail = $this->db->get_where('patwal_permohonan',array('id'=>$id))->result();
        foreach ($get_detail as $key ) {
        }
        $dt['id'] = $key->id;
        $dt['kode'] = $key->kode;
        $dt['nama_pemohon'] = $key->nama_pemohon;
        $dt['ktp'] = $key->ktp;
        $dt['pk_id'] = $this->get_pk_id($key->pk_id);
        $dt['kateg_pemohon'] = $this->kategori($key->kateg_pemohon);
        $dt['jam_pengawalan'] = $key->jam_pengawalan;
        $dt['alamat_awal'] = $key->alamat_awal;
        $dt['alamat_tujuan'] = $key->alamat_tujuan;
        $dt['jam_patwal'] = $key->jam_patwal;
        $dt['deskripsi'] = $key->deskripsi;
        $dt['status'] = $this->status($key->status);
        $dt['no_hp'] = $key->no_hp;
        $dt['email'] = $key->email;
        $dt['ctddate'] = tgl_indo($key->ctddate);        

        echo json_encode($dt);
    }

    function petugas(){

        $petugas="<option value='0'>--pilih--</pilih>";
        
        $this->db->order_by('nama','ASC');
        $kab= $this->db->get('persons');
        
        foreach ($kab->result_array() as $data ){
        $petugas.= "<option value='$data[nrp]'>$data[nama]</option>";
        }
        
        return $petugas;
        
        }

    public function proses_approve()
    {
        //   1  update status  ke table patwal_permohonan (approve)
        //   2. insert ke table patwal_approved untuk mendapatkan pa_id
        //   3. insert ke table patwal_petugas untuk menentukan siapa petugas yg mengawal
        //   4. insert ke table patwal_riwayat untuk log

        $user=$this->session->userdata('user_data');
        $pp_id = $this->input->post('pp_id');
        $ctdby = $user['rowid'];
        $petugas = $this->input->post('petugas');

        $this->db->set('status', '1');
        $this->db->where('id', $pp_id);
        $this->db->update('patwal_permohonan');
        

        $insert_patwal_approved = array(
            'pp_id' => $pp_id,
            'status' => '1',
            'ctddate' => date('y-m-d'),
            'ctdtime' => date('h:i:s'),
            'ctdby' => $ctdby
        );
        $this->db->insert('patwal_approved',$insert_patwal_approved);
        $pa_id = $this->db->insert_id();

        foreach ($petugas as $value) {
            $insert_patwal_petugas = array(
                'pp_id' =>  $pp_id,
                // 'person_id' => implode(",", $petugas),
                'person_id' => $value,
                'pa_id' => $pa_id,
                'ctdby' => $ctdby,
                'ctddate' => date('y-m-d')
            );
            $this->db->insert('patwal_tugas',$insert_patwal_petugas);
        }
        
        $insert_riwayat = array (

            'pp_id' => $pp_id, 
            'status_riwayat' => '1',
            'msg' => 'Approved',
            'ctddate' => date('y-m-d'),
            'ctdtime' => date('h:i:s'),
            'ctdby' => $ctdby
        );
        $this->db->insert('patwal_riwayat',$insert_riwayat);

        echo json_encode(array("status" => TRUE));
    }   
    
    public function proses_reject()
    {
        //   1  update status  ke table patwal_permohonan (reject)
        //   2. insert ke table patwal_approved untuk mendapatkan pa_id
        //   3. insert ke table patwal_riwayat untuk log
        $user=$this->session->userdata('user_data');
        $pp_id = $this->input->post('pp_id');
        $ctdby = $user['rowid'];
        $petugas = $this->input->post('petugas');

        $this->db->set('status', '2');
        $this->db->where('id', $pp_id);
        $this->db->update('patwal_permohonan');
        

        $insert_patwal_approved = array(
            'pp_id' => $pp_id,
            'status' => '2',
            'ctddate' => date('y-m-d'),
            'ctdtime' => date('h:i:s'),
            'ctdby' => $ctdby
        );
        $this->db->insert('patwal_approved',$insert_patwal_approved);
  
        $insert_riwayat = array (

            'pp_id' => $pp_id, 
            'status_riwayat' => '2',
            'msg' => 'Reject',
            'ctddate' => date('y-m-d'),
            'ctdtime' => date('h:i:s'),
            'ctdby' => $ctdby
        );
        $this->db->insert('patwal_riwayat',$insert_riwayat);


        echo json_encode(array("status" => TRUE));
    }   

    public function proses_berjalan()
    {
        //   1  update status  ke table patwal_permohonan (berjalan)
        //   2. insert ke table patwal_approved untuk mendapatkan pa_id
        //   3. insert ke table patwal_petugas untuk menentukan siapa petugas yg mengawal
        //   4. insert ke table patwal_riwayat untuk log

        $user=$this->session->userdata('user_data');
        $pp_id = $this->input->post('pp_id_berjalan');
        $status = $this->input->post('status_berjalan');
        $ctdby = $user['rowid'];
        if ($status == 1) {
            echo json_encode(array("status" => TRUE));
        }else{
            $this->db->set('status', $status);
            $this->db->where('id', $pp_id);
            $this->db->update('patwal_permohonan');
            
    
            $insert_patwal_approved = array(
                'pp_id' => $pp_id,
                'status' => $status,
                'ctddate' => date('y-m-d'),
                'ctdtime' => date('h:i:s'),
                'ctdby' => $ctdby
            );
            $this->db->insert('patwal_approved',$insert_patwal_approved);
        
            $insert_riwayat = array (
    
                'pp_id' => $pp_id, 
                'status_riwayat' => $status,
                'msg' => 'Berjalan',
                'ctddate' => date('y-m-d'),
                'ctdtime' => date('h:i:s'),
                'ctdby' => $ctdby
            );
            $this->db->insert('patwal_riwayat',$insert_riwayat);
    
            echo json_encode(array("status" => TRUE));
         
        }
}


public function proses_selesai()
{
    //   1  update status  ke table patwal_permohonan (selesai)
    //   2. insert ke table patwal_approved untuk mendapatkan pa_id
    //   3. insert ke table patwal_petugas untuk menentukan siapa petugas yg mengawal
    //   4. insert ke table patwal_riwayat untuk log

    $user=$this->session->userdata('user_data');
    $pp_id = $this->input->post('pp_id_selesai');
    $status = $this->input->post('status_selesai');
    $ctdby = $user['rowid'];
    if ($status == 3) {
        echo json_encode(array("status" => TRUE));
    }else{
        $this->db->set('status', $status);
        $this->db->where('id', $pp_id);
        $this->db->update('patwal_permohonan');
        

        $insert_patwal_approved = array(
            'pp_id' => $pp_id,
            'status' => $status,
            'ctddate' => date('y-m-d'),
            'ctdtime' => date('h:i:s'),
            'ctdby' => $ctdby
        );
        $this->db->insert('patwal_approved',$insert_patwal_approved);
    
        $insert_riwayat = array (

            'pp_id' => $pp_id, 
            'status_riwayat' => $status,
            'msg' => 'Selesai',
            'ctddate' => date('y-m-d'),
            'ctdtime' => date('h:i:s'),
            'ctdby' => $ctdby
        );
        $this->db->insert('patwal_riwayat',$insert_riwayat);

        echo json_encode(array("status" => TRUE));
     
    }
}
  
	

}