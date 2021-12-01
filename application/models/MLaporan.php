<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MLaporan extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('dt');
    }
    
    // LAP GATUR LIN
    // model master data laporan gatur lalu lintas
    public function dt_lap_gat_lin()
    {
        // Definisi
        $condition = '';
        $data = [];
        
        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');
        
        // Set table name
        $CI->dt->table = 'lap_gatur_lalin a';
        // Set orderable column fields
        $CI->dt->column_order = ['a.rowid','a.no_sprint','a.kegiatan','a.kejadian','a.tanggal'];
        // Set searchable column fields
        $CI->dt->column_search = ['a.no_sprint', 'b.k_nama','c.kjd_dit_nam'];
        // Set select column fields
        $CI->dt->select = 'a.rowid,a.no_sprint,b.k_nama as kegiatan,c.kjd_dit_nam as kejadian,a.tanggal';
        // Set default order
        $CI->dt->order = ['a.rowid' => 'DESC'];
        
        $condition = [
            //['where',$this->t.'.status',$status],
            ['join','kegiatan b','b.rowid = a.kegiatan','left'],
			['join','kejadian_ditemukan c','c.rowid = a.kejadian','left'],
        ];
            // Fetch member's records
            $dataTabel = $this->dt->getRows($_POST, $condition);
            
            $i = $_POST['start'];
            foreach ($dataTabel as $dt) {
                $i++;
                $data[] = array(
                    $dt->no_sprint,
                    $dt->kegiatan,
                    $dt->kejadian,
                    tgl_indo($dt->tanggal),
                    '<div class="btn-group align-top">
                     <button class="btn btn-sm btn-outline-primary badge" type="button" data-toggle="modal" data-target="#user-form-modal">Edit</button>
                     <button class="btn btn-sm btn-outline-primary badge" type="button"><i class="fa fa-eye"></i></button>
                    </div>',
                );
            }
            
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->dt->countAll($condition),
                "recordsFiltered" => $this->dt->countFiltered($_POST, $condition),
                "data" => $data,
            );
            
            // Output to JSON format
            return json_encode($output);
        }
        
    }   
    