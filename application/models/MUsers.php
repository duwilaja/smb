<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MUsers extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }

    public function get_users($item='',$select='*')
    {
        $t = 'core_user';

        if ($select != '*') {
            $this->db->select($select);
        }

        $this->db->join('persons p', 'p.nrp = '.$t.'.uid', 'inner');
        if (is_array($item)) {
            $q = $this->db->get_where($t,$item);
        }else{
            $q = $this->db->get_where($t,[$t.'.rowid' => $item]);
        }

        return $q;
    }
    
    public function dt_users()
    {
        // Definisi
        $condition = [] ;
        $data = [];
        
        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');
        
        // Set table name
        $CI->dt->table = 'core_user a';
        // Set orderable column fields
        $CI->dt->column_order = ['a.uname','pangkat','polda','polres',null];
        // Set searchable column fields
        $CI->dt->column_search = ['a.uname', 'pangkat','polda','polres'];
        // Set select column fields
        $CI->dt->select = 'a.rowid,a.uid, a.uname, pangkat, polda, polres';
        // Set default order
        $CI->dt->order = ['p.registered' => 'DESC'];
        
        $con3 = ['join','persons p','p.nrp = a.uid','inner'];
        array_push($condition,$con3);

        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);
         
        $i = $this->input->post('start');
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                '<a href="#" data-toggle="modal" data-target="#modal_edit" title="Add" onclick="get_id('.$dt->rowid.')">'.$dt->uname.'</a>',
                $dt->pangkat,
                $dt->polda,
                $dt->polres,
                // '<div class="btn-group align-top">
                //  <button class="btn btn-outline-default badge" type="button" data-toggle="modal" data-target="#user-form-modal">Edit</button>
                //  <button class="btn btn-outline-default badge" type="button"><i class="fa fa-eye"></i></button>
                // </div>',
            );
        }
         
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->dt->countAll($condition),
            "recordsFiltered" => $this->dt->countFiltered($_POST, $condition),
            "data" => $data,
        );
         
        // Output to JSON format
        return json_encode($output);
    }
        
}   
    