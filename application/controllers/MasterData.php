<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MasterData extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MGeneral','mg');
        
    } 

    // public function smd_dash()
    // {
    //     $d = [
	// 		'title' => 'Social Media Dashboard',
	// 		'linkView' => 'page/smd/social_media_dashboard',
	// 		'fileScript' => 'social_media_dashboard.js',
	// 		'bread' => [
	// 			'nama' => 'SMD',
	// 			'data' => [
	// 				//['nama' => 'Karyawan','link' => site_url('main/karyawan'),'active' => 'active']
	// 			]
    //         ]
	// 	];
	// 	$this->load->view('_main',$d);
    // }

    public function get_konstruksi()
    {
         echo json_encode(KONSTRUKSI);
    }

    public function get_prasarana_public()
    {
         echo json_encode(PRASARANA_PUBLIC);
    }

    public function kondisi_alam()
    {
        $arr = [
            'title' => 'Kondisi Alam',
            'tabel' => 'kondisi_alam',
            'field_in' =>[
                srlen('ka_id') => 'ID',
                srlen('kondisi') => 'NAMA'
            ],
            'field_up' =>[
                'rowid' => 'hidden',
                'ka_id' => 'ID',
                'kondisi' => 'NAMA'
            ],
            'field_se' =>[
                'ka_id' => 'ID',
                'kondisi' => 'NAMA'
            ],
            'dt' => [
                'order' => [
                    'ka_id',
                    'kondisi'
                ],
                'search' => [
                    'ka_id',
                    'kondisi'
                ],
                'view' => [
                    'ka_id',
                    'kondisi'
                ]
            ]
        ];
        
        $this->mg->crud($arr);
    }

    public function kondisi_jalan()
    {
        $arr = [
            'title' => 'Kondisi Jalan',
            'tabel' => 'kondisi_jalan',
            'field_in' =>[
                srlen('kj_id') => 'ID',
                srlen('nama_jalan') => 'NAMA JALAN',
                srlen('kelas_jalan') => 'KELAS JALAN',
                srlen('status_jalan') => 'STATUS JALAN',
                srlen('konstruksi_jalan') => 'KONSTRUKSI JALAN|select|get_konstruksi'
            ],
            'field_up' =>[
                'rowid' => 'hidden',
                'kj_id' => 'ID',
                'nama_jalan' => 'NAMA JALAN',
                'kelas_jalan' => 'KELAS JALAN',
                'status_jalan' => 'STATUS JALAN',
                'konstruksi_jalan' => 'KONSTRUKSI JALAN|select|get_konstruksi'
                
            ],
            'field_se' =>[
                'kj_id' => 'ID',
                'nama_jalan' => 'NAMA JALAN',
                'kelas_jalan' => 'KELAS JALAN',
                'status_jalan' => 'STATUS JALAN',
                'konstruksi_jalan' => 'KONSTRUKSI JALAN'
                
            ],
            'dt' => [
                'order' => [
                    'kj_id',
                    'nama_jalan',
                     null,
                     null,
                     null,

                ],
                'search' => [
                    'kj_id',
                    'nama_jalan'
                ],
                'view' => [
                    'kj_id',
                    'nama_jalan',
                    'kelas_jalan',
                    'status_jalan',
                    'konstruksi_jalan'
                ]
            ]
        ];
        
        $this->mg->crud($arr);
    }

    public function kondisi_lalin()
    {
        $arr = [
            'title' => 'Kondisi Lalin',
            'tabel' => 'kondisi_lalin',
            'field_in' =>[
                srlen('kl_id') => 'ID',
                srlen('kondisi') => 'NAMA'
            ],
            'field_up' =>[
                'rowid' => 'hidden',
                'kl_id' => 'ID',
                'kondisi' => 'NAMA'
            ],
            'field_se' =>[
                'kl_id' => 'ID',
                'kondisi' => 'NAMA'
            ],
            'dt' => [
                'order' => [
                    'kl_id',
                    'kondisi'
                ],
                'search' => [
                    'kl_id',
                    'kondisi'
                ],
                'view' => [
                    'kl_id',
                    'kondisi'
                ]
            ]
        ];
        
        $this->mg->crud($arr);
    }


    public function prasarana_public()
    {
        $arr = [
            'title' => 'Prasarana Public',
            'tabel' => 'prasarana_public',
            'field_in' =>[
                srlen('pp_id') => 'PRASARANA|select|get_prasarana_public',
                srlen('pp_nama') => 'NAMA',
                // srlen('pp_table') => 'Table',
            ],
            'field_up' =>[
                'rowid' => 'hidden',
                'pp_id' => 'PRASARANA|select|get_prasarana_public',
                'pp_nama' => 'Nama',
                // 'pp_table' => 'Table',
            ],
            'field_se' =>[
                'pp_id' => 'PRASARANA',
                'pp_nama' => 'NAMA PRASARANA',
            ],
            'dt' => [
                'order' => [
                    'pp_id',
                    'pp_nama'
                    // 'pp_table'
                ],
                'search' => [
                    'pp_id',
                    'pp_nama'
                    // 'pp_table'
                ],
                'view' => [
                    'pp_id',
                    'pp_nama',
                    // 'pp_table'
                ]
            ]
        ];
        
        $this->mg->crud($arr);
       
    }

    public function potensi_masyarakat()
    {
        $arr = [
            'title' => 'Potensi Masyarakat',
            'tabel' => 'potensi_masyarakat',
            'field_in' =>[
                srlen('pm_id') => 'ID',
                srlen('pm_nama') => 'Jenis Potensi'
            ],
            'field_up' =>[
                'rowid' => 'hidden',
                'pm_id' => 'ID',
                'pm_nama' => 'Jenis Potensi'
            ],
            'field_se' =>[
                'pm_id' => 'ID',
                'pm_nama' => 'Jenis Potensi'
            ],
            'dt' => [
                'order' => [
                    'pm_id',
                    'pm_nama'
                ],
                'search' => [
                    'pm_id',
                    'pm_nama'
                ],
                'view' => [
                    'pm_id',
                    'pm_nama'
                ]
            ]
        ];
        
        $this->mg->crud($arr);
    }

    public function kegiatan()
    {
        $arr = [
            'title' => 'Kegiatan',
            'tabel' => 'kegiatan',
            'field_in' =>[
                srlen('k_id') => 'ID',
                srlen('k_nama') => 'Jenis Kegiatan'
            ],
            'field_up' =>[
                'rowid' => 'hidden',
                'k_id' => 'ID',
                'k_nama' => 'Jenis Kegiatan'
            ],
            'field_se' =>[
                'k_id' => 'ID',
                'k_nama' => 'Jenis Kegiatan'
            ],
            'dt' => [
                'order' => [
                    'k_id',
                    'k_nama'
                ],
                'search' => [
                    'k_id',
                    'k_nama'
                ],
                'view' => [
                    'k_id',
                    'k_nama'
                ]
            ]
        ];
        
        $this->mg->crud($arr);
    }

    public function penyebab()
    {
        $arr = [
            'title' => 'Penyebab',
            'tabel' => 'penyebab',
            'field_in' =>[
                srlen('p_id') => 'ID',
                srlen('p_nam') => 'Penyebab'
            ],
            'field_up' =>[
                'rowid' => 'hidden',
                'p_id' => 'ID',
                'p_nam' => 'Penyebab'
            ],
            'field_se' =>[
                'p_id' => 'ID',
                'p_nam' => 'Penyebab'
            ],
            'dt' => [
                'order' => [
                    'p_id',
                    'p_nam'
                ],
                'search' => [
                    'p_id',
                    'p_nam'
                ],
                'view' => [
                    'p_id',
                    'p_nam'
                ]
            ]
        ];
        
        $this->mg->crud($arr);
    }

    public function parameter_antrian()
    {
        $arr = [
            'title' => 'Parameter Antrian',
            'tabel' => 'parameter_antrian',
            'field_in' =>[
                srlen('prm_antr_id') => 'ID',
                srlen('prm_antr_nam') => 'Parameter'
            ],
            'field_up' =>[
                'rowid' => 'hidden',
                'prm_antr_id' => 'ID',
                'prm_antr_nam' => 'Parameter'
            ],
            'field_se' =>[
                'prm_antr_id' => 'ID',
                'prm_antr_nam' => 'Parameter'
            ],
            'dt' => [
                'order' => [
                    'prm_antr_id',
                    'prm_antr_nam'
                ],
                'search' => [
                    'prm_antr_id',
                    'prm_antr_nam'
                ],
                'view' => [
                    'prm_antr_id',
                    'prm_antr_nam'
                ]
            ]
        ];
        
        $this->mg->crud($arr);
    }

    public function kejadian_ditemukan()
    {
        $arr = [
            'title' => 'Kejadian Ditemukan',
            'tabel' => 'kejadian_ditemukan',
            'field_in' =>[
                srlen('kjd_dit_id') => 'ID',
                srlen('kjd_dit_nam') => 'Kejadian Ditemukan'
            ],
            'field_up' =>[
                'rowid' => 'hidden',
                'kjd_dit_id' => 'ID',
                'kjd_dit_nam' => 'Kejadian Ditemukan'
            ],
            'field_se' =>[
                'kjd_dit_id' => 'ID',
                'kjd_dit_nam' => 'Kejadian Ditemukan'
            ],
            'dt' => [
                'order' => [
                    'kjd_dit_id',
                    'kjd_dit_nam'
                ],
                'search' => [
                    'kjd_dit_id',
                    'kjd_dit_nam'
                ],
                'view' => [
                    'kjd_dit_id',
                    'kjd_dit_nam'
                ]
            ]
        ];
        
        $this->mg->crud($arr);
    }

}

/* End of file MasterData.php */
