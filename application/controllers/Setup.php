<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MGeneral','mg');
    } 
    
    // Get All Direktorat
    public function get_direktorat()
    {

        $q = $this->mg->get('direktorat','','dit_id as nilai,dit_nam as nama');
        echo json_encode($q->result());
    }

    // Get All KORPS
    public function get_korps()
    {

        $q = $this->mg->get('korps','','krp_id as nilai,krp_nam as nama');
        echo json_encode($q->result());
    }

    // Get All RO
    public function get_ro()
    {

        $q = $this->mg->get('ro','','ro_id as nilai,ro_nam as nama');
        echo json_encode($q->result());
    }

    // Get All Bagian
    public function get_bag()
    {

        $q = $this->mg->get('bagian','','bag_id as nilai,bag_nam as nama');
        echo json_encode($q->result());
    }

    // Get All Direktorat
    public function get_subdit()
    {

        $q = $this->mg->get('subdit','','sub_id as nilai,sub_nam as nama');
        echo json_encode($q->result());
    }

     // Get Polda
     public function get_polda()
     {
         $q = $this->mg->get('polda','','da_id as nilai,da_nam as nama');
         echo json_encode($q->result());
     }

    public function dasargiat()
    {
        $arr = [
            'title' => 'Dasar Giat',
            'tabel' => 'dasargiat',
            'field_in' =>[
                srlen('dg_id') => 'ID',
                srlen('dg_nam') => 'NAMA',
            ],
            'field_up' =>[
                'rowid' => 'hidden',
                'dg_id' => 'ID',
                'dg_nam' => 'NAMA',
            ],
            'field_se' =>[
                'dg_id' => 'ID',
                'dg_nam' => 'NAMA',
            ],
            'dt' => [
                'order' => [
                    'dg_id',
                    'dg_nam',
                ],
                'search' => [
                    'dg_id',
                    'dg_nam'
                ],
                'view' => [
                    'dg_id',
                    'dg_nam',
                ]
            ]
        ];
        
        $this->mg->crud($arr);
       
    }

    public function pangkat()
    {
        $arr = [
            'title' => 'Kepangkatan',
            'tabel' => 'pangkat',
            'field_in' =>[
                srlen('pang_id') => 'ID',
                srlen('pang_nam') => 'NAMA',
            ],
            'field_up' =>[
                'rowid' => 'hidden',
                'pang_id' => 'ID',
                'pang_nam' => 'NAMA',
            ],
            'field_se' =>[
                'pang_id' => 'ID',
                'pang_nam' => 'NAMA',
            ],
            'dt' => [
                'order' => [
                    'pang_id',
                    'pang_nam',
                ],
                'search' => [
                    'pang_id',
                    'pang_nam'
                ],
                'view' => [
                    'pang_id',
                    'pang_nam',
                ]
            ]
        ];
        
        $this->mg->crud($arr);
       
    }

    public function unit()
    {
        $arr = [
            'title' => 'Unit',
            'tabel' => 'unit',
            'field_in' =>[
                srlen('unit_id') => 'ID',
                srlen('unit_nam') => 'NAMA',
            ],
            'field_up' =>[
                'rowid' => 'hidden',
                'unit_id' => 'ID',
                'unit_nam' => 'NAMA',
            ],
            'field_se' =>[
                'unit_id' => 'ID',
                'unit_nam' => 'NAMA',
            ],
            'dt' => [
                'order' => [
                    'unit_id',
                    'unit_nam',
                ],
                'search' => [
                    'unit_id',
                    'unit_nam'
                ],
                'view' => [
                    'unit_id',
                    'unit_nam',
                ]
            ]
        ];
        
        $this->mg->crud($arr);
       
    }

    public function korps()
    {
        $arr = [
            'title' => 'KORPS',
            'tabel' => 'korps',
            'field_in' =>[
                srlen('krp_id') => 'ID',
                srlen('krp_nam') => 'NAMA',
            ],
            'field_up' =>[
                'rowid' => 'hidden',
                'krp_id' => 'ID',
                'krp_nam' => 'NAMA',
            ],
            'field_se' =>[
                'krp_id' => 'ID',
                'krp_nam' => 'NAMA',
            ],
            'dt' => [
                'order' => [
                    'krp_id',
                    'krp_nam',
                ],
                'search' => [
                    'krp_id',
                    'krp_nam'
                ],
                'view' => [
                    'krp_id',
                    'krp_nam',
                ]
            ]
        ];
        
        $this->mg->crud($arr);
       
    }

    public function ro()
    {
        $arr = [
            'title' => 'Ro',
            'tabel' => 'ro',
            'field_in' =>[
                srlen('ro_id') => 'ID',
                srlen('ro_nam') => 'NAMA',
                srlen('korps') => 'RO|select|get_korps',
            ],
            'field_up' =>[
                'rowid' => 'hidden',
                'ro_id' => 'ID',
                'ro_nam' => 'NAMA',
                'korps' => 'KORPS|select|get_korps',
            ],
            'field_se' =>[
                'ro_id' => 'ID',
                'ro_nam' => 'NAMA',
                'korps' => 'KORPS'
            ],
            'dt' => [
                'order' => [
                    'ro_id',
                    'ro_nam',
                    'korps'
                ],
                'search' => [
                    'ro_id',
                    'ro_nam'
                ],
                'view' => [
                    'ro_id',
                    'ro_nam',
                    'korps'
                ]
            ]
        ];
        
        $this->mg->crud($arr);
       
    }
    public function sie()
    {
        $arr = [
            'title' => 'SIE',
            'tabel' => 'sie',
            'field_in' =>[
                srlen('si_id') => 'ID',
                srlen('ro_nam') => 'NAMA',
                srlen('subdit') => 'RO|select|get_subdit',
            ],
            'field_up' =>[
                'rowid' => 'hidden',
                'si_id' => 'ID',
                'si_nam' => 'NAMA',
                'subdit' => 'subdit|select|get_subdit',
            ],
            'field_se' =>[
                'si_id' => 'ID',
                'si_nam' => 'NAMA',
                'subdit' => 'subdit'
            ],
            'dt' => [
                'order' => [
                    'si_id',
                    'si_nam',
                    'subdit'
                ],
                'search' => [
                    'si_id',
                    'si_nam'
                ],
                'view' => [
                    'si_id',
                    'si_nam',
                    'subdit'
                ]
            ]
        ];
        
        $this->mg->crud($arr);
       
    }

    public function bagian()
    {
        $arr = [
            'title' => 'Bagian',
            'tabel' => 'bagian',
            'field_in' =>[
                srlen('bag_id') => 'ID',
                srlen('bag_nam') => 'NAMA',
                srlen('ro') => 'RO|select|get_ro',
            ],
            'field_up' =>[
                'rowid' => 'hidden',
                'bag_id' => 'ID',
                'bag_nam' => 'NAMA',
                'ro' => 'RO|select|get_ro',
            ],
            'field_se' =>[
                'bag_id' => 'ID',
                'bag_nam' => 'NAMA',
                'ro' => 'RO'
            ],
            'dt' => [
                'order' => [
                    'bag_id',
                    'bag_nam',
                    'ro'
                ],
                'search' => [
                    'bag_id',
                    'bag_nam'
                ],
                'view' => [
                    'bag_id',
                    'bag_nam',
                    'ro'
                ]
            ]
        ];
        
        $this->mg->crud($arr);
       
    }

    public function subbag()
    {
        $arr = [
            'title' => 'Sub Bagian',
            'tabel' => 'subbag',
            'field_in' =>[
                srlen('subbag_id') => 'ID',
                srlen('subbag_nam') => 'SUBBAG',
                srlen('bagian') => 'bagian|select|get_bag',
            ],
            'field_up' =>[
                'rowid' => 'hidden',
                'subbag_id' => 'ID',
                'subbag_nam' => 'SUBBAG',
                'bagian' => 'bagian|select|get_bag',
            ],
            'field_se' =>[
                'subbag_id' => 'ID',
                'subbag_nam' => 'SUBBAG',
                'bagian' => 'BAGIAN'
            ],
            'dt' => [
                'order' => [
                    'subbag_id',
                    'subbag_nam',
                    'bagian'
                ],
                'search' => [
                    'subbag_id',
                    'subbag_nam'
                ],
                'view' => [
                    'subbag_id',
                    'subbag_nam',
                    'bagian'
                ]
            ]
        ];
        
        $this->mg->crud($arr);
       
    }

    public function subdit()
    {
        $arr = [
            'title' => 'Subdit',
            'tabel' => 'subdit',
            'field_in' =>[
                srlen('sub_id') => 'ID',
                srlen('sub_nam') => 'NAMA',
                srlen('direktorat') => 'Direkotrat|select|get_direktorat',
            ],
            'field_up' =>[
                'rowid' => 'hidden',
                'sub_id' => 'ID',
                'sub_nam' => 'NAMA',
                'direktorat' => 'Direkotrat|select|get_direktorat',
            ],
            'field_se' =>[
                'sub_id' => 'ID',
                'sub_nam' => 'NAMA',
                'direktorat' => 'Direkotrat'
            ],
            'dt' => [
                'order' => [
                    'sub_id',
                    'sub_nam',
                    'direktorat'
                ],
                'search' => [
                    'sub_id',
                    'sub_nam'
                ],
                'view' => [
                    'sub_id',
                    'sub_nam',
                    'direktorat'
                ]
            ]
        ];
        
        $this->mg->crud($arr);
       
    }

    public function formulir()
    {
        $arr = [
            'title' => 'Formulir',
            'tabel' => 'dm_formulir',
            'field_in' =>[
                srlen('dmf_id') => 'ID',
                srlen('dmf_nam') => 'NAMA'
            ],  
            'field_up' =>[
                'rowid' => 'hidden',
                'dmf_id' => 'ID',
                'dmf_nam' => 'NAMA'
            ],
            'field_se' =>[
                'dmf_id' => 'ID',
                'dmf_nam' => 'NAMA'
            ],
            'dt' => [
                'order' => [
                    'dmf_id',
                    'dmf_nam'
                ],
                'search' => [
                    'dmf_id',
                    'dmf_nam'
                ],
                'view' => [
                    'dmf_id',
                    'dmf_nam'
                ]
            ]
        ];
        
        $this->mg->crud($arr);
       
    }
    public function dasar_giat()
    {
        $arr = [
            'title' => 'Dasar Giat',
            'tabel' => 'dasargiat',
            'field_in' =>[
                srlen('dg_id') => 'ID',
                srlen('dg_nam') => 'NAMA'
            ],  
            'field_up' =>[
                'rowid' => 'hidden',
                'dg_id' => 'ID',
                'dg_nam' => 'NAMA'
            ],
            'field_se' =>[
                'dg_id' => 'ID',
                'dg_nam' => 'NAMA'
            ],
            'dt' => [
                'order' => [
                    'dg_id',
                    'dg_nam'
                ],
                'search' => [
                    'dg_id',
                    'dg_nam'
                ],
                'view' => [
                    'dg_id',
                    'dg_nam'
                ]
            ]
        ];
        
        $this->mg->crud($arr);
       
    }

    public function polda()
    {
        $arr = [
            'title' => 'polda',
            'tabel' => 'polda',
            'field_in' =>[
                srlen('da_id') => 'ID',
                srlen('da_nam') => 'NAMA'
            ],
            'field_up' =>[
                'rowid' => 'hidden',
                'da_id' => 'ID',
                'da_nam' => 'NAMA'
            ],
            'field_se' =>[
                'da_id' => 'ID',
                'da_nam' => 'NAMA'
            ],
            'dt' => [
                'order' => [
                    'da_id',
                    'da_nam',
                ],
                'search' => [
                    'da_id',
                    'da_nam',
                ],
                'view' => [
                    'da_id',
                    'da_nam',
                ]
            ]
        ];
        
        $this->mg->crud($arr);
       
    }

    public function polres()
    {
        $arr = [
            'title' => 'polres',
            'tabel' => 'polres',
            'field_in' =>[
                srlen('res_id') => 'ID',
                srlen('res_nam') => 'NAMA',
                srlen('polda') => 'Polda|select|get_polda',
            ],
            'field_up' =>[
                'rowid' => 'hidden',
                'res_id' => 'ID',
                'res_nam' => 'NAMA',
                'polda' => 'Polda|select|get_polda',
            ],
            'field_se' =>[
                'res_id' => 'ID',
                'res_nam' => 'NAMA',
                'polda' => 'POLDA'
            ],
            'dt' => [
                'order' => [
                    'res_id',
                    'res_nam',
                    'polda'
                ],
                'search' => [
                    'res_id',
                    'res_nam',
                    'polda'
                ],
                'view' => [
                    'res_id',
                    'res_nam',
                    'polda'
                ]
            ]
        ];
        
        $this->mg->crud($arr);
    }

    public function direktorat()
    {
        $arr = [
            'title' => 'direktorat',
            'tabel' => 'direktorat',
            'field_in' =>[
                srlen('dit_id') => 'ID',
                srlen('dit_nam') => 'NAMA'
            ],
            'field_up' =>[
                'rowid' => 'hidden',
                'dit_id' => 'ID',
                'dit_nam' => 'NAMA'
            ],
            'field_se' =>[
                'dit_id' => 'ID',
                'dit_nam' => 'NAMA'
            ],
            'dt' => [
                'order' => [
                    'dit_id',
                    'dit_nam'
                ],
                'search' => [
                    'dit_id',
                    'dit_nam'
                ],
                'view' => [
                    'dit_id',
                    'dit_nam'
                ]
            ]
        ];
        
        $this->mg->crud($arr);
       
    }

    // Users

    public function users()
    {
        $data = [
            'title' => 'Users',
            'js_local' => 'users/users.js',
        ];
        $this->template->load('page/users/users', $data);
    }

    public function dt_users()
    {
        $this->load->model('MUsers','mu');
        echo $this->mu->dt_users();
    }

}

/* End of file MasterData.php */
