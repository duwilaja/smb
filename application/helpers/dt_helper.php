<?php

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
        $field[4] = cari_arr(KONSTRUKSI,$field[4]);
    }else if ($t == 'prasarana_public') {
        $field[0] = cari_arr(PRASARANA_PUBLIC,$field[0]);
    }
    // elseif ($t == 'subbag') {
    //     $field[2] = cari_arr(SUBBAG,$field[0]);
    // }

    $field[0] = '<a href="#" data-toggle="modal" data-target="#myModal2" onclick="get_data_id('.$dt->rowid.')">'.$field[0].'</a>';
    
    return $field;
}