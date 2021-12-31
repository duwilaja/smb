<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class MHistory extends CI_Model{
    
    function __construct() {
      
    }

    public function dt_history($filter=[])
    {
          // Definisi
          $condition = [];
          $data = [];
  
          $CI = &get_instance();
          $CI->load->model('DataTable', 'dt');
          // Set table name
          $CI->dt->table = 'formulir as f';
          // Set orderable column fields
          $CI->dt->column_order = [null, null, 'nama_laporan'];
          // Set searchable column fields
          $CI->dt->column_search = ['nama_laporan'];
          // Set select column fields
          $CI->dt->select = '*';
          // Set default order
          $CI->dt->order = ['rowid' => 'desc'];

          if (isset($filter['unit'])) {
            $con = ['where','unit =',$filter['unit']];
            array_push($condition,$con);
          }

          // Fetch member's records
          $dataTabel = $this->dt->getRows(@$_POST, $condition);
          $k = array_search('tmc_pservice_soldes', $dataTabel);
          \array_splice($dataTabel, $k, 1);
  
          $i = @$this->input->post('start');
          foreach ($dataTabel as $dt) {
              $i++;
              // untuk menampilkan data di datatable, harus berurut dengan data tablenya
              $data[] = array(
                  $filter['nrp'],
                  $dt->unit,
                  $dt->nama_laporan,
                  isset($filter['start_date']) || isset($filter['end_date']) ? $this->get_tbl($dt->view_laporan,$filter['nrp'],$filter['start_date'],$filter['end_date']) : $this->get_tbl($dt->view_laporan,$filter['nrp']),
                  '<a class="btn btn-sm btn-primary" type="button" href="'.base_url ('History/historydetail?tbl='.$dt->view_laporan.'&tbln='.$dt->nama_laporan.'').'">Detail</a>'
              );
          }
  
          $output = array(
              "draw" => @$this->input->post('draw'),
              "recordsTotal" => $this->dt->countAll($condition),
              "recordsFiltered" => $this->dt->countFiltered(@$this->input->post(), $condition),
              "data" => $data,
          );
  
          // Output to JSON format
          return json_encode($output);
    }

    public function get_tbl($tbl="",$nrp='',$start='', $end='')
    {
        if (isset($start)) {
            $this->db->where('tgl >=',$start);
        }
        if (isset($end)) {
            $this->db->where('tgl <=',$end);
        }
        $this->db->where('nrp',$nrp);
        $query = $this->db->get($tbl)->result_array();
        return count($query);
    }
}