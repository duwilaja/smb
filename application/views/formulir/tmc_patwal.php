<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

?>

<div class="card">
	<div class="card-header">
		<div class="card-title judul">Permohonan Pengawalan
            <div class="row mt-5">
            <div class="col">
            <form method="POST">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-calendar"></i>
                    </div>
                </div>
                <input type="text" class="form-control datepicker" id="date">
            </div>
            </div>
            <div class="col">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                    <i class="fa fa-times"></i>
                    </div>
                </div>
                <input type="text" class="form-control timepicker" id="time">
            </div>
            </div>
            <div class="col">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                    <i class="fa fa-list"></i>
                    </div>
                </div>
                <select name="status" id="status" class="form-select">
                    <option value="">All</option>
                    <option value="0">Pengajuan</option>
                    <option value="1">Disetujui</option>
                    <option value="2">Ditolak</option>
                    <option value="3">Sedang Berjalan</option>
                    <option value="4">Selesai</option>
                </select>
            </div>
            </div>
            <div class="col">
            <div class="input-group">
                <button type="button" id="cari" class="btn btn-success" >Cari</button>
            </div>
            </form>
            </div>
            </div>										
		</div>
		<div class="card-options ">
			<!--a href="#" title="Batch" class=""><i class="fe fe-upload"></i></a>
			<a href="#" onclick="openForm(0);" data-toggle="modal" data-target="#myModal" title="Add" class=""><i class="fe fe-plus"></i></a-->
			<!-- <a href="#" title="Refresh" onclick="reload_table();"><i class="fe fe-refresh-cw"></i></a> -->
			<a href="#" title="Expand/Collapse" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
			<!--a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a-->
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="mytbl" class="table table-striped table-bordered w-100">
				<thead>
					<tr>
						<th>Kode</th>
						<th>Pemohon</th>
						<th>Tanggal</th>
						<th>Alamat Awal</th>
						<th>Alamat Tujuan</th>
						<th>Status</th>
                        <th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div id="proses" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-xs-center">Proses Permohonan (<span id="nama_pemohon"></span>)</h4>
            </div>
            <div class="modal-body">
                <!-- <form role="form" method="POST" action="<?php echo base_url().'patwal/proses_permohonan'?>"> -->
                <form action="#" id="form">
                    <input type="hidden" name="pp_id" id="pp_id" value="">
                    <div class="form-group">
                        <label class="control-label text-dark">Petugas Pengawal</label>
                        <div>
                             <select class="form-select" id="petugas" name="petugas[]" multiple='multiple' style="width: 100%;">
								<option value=""></option>
                                <?php foreach($this->db->get('persons')->result() as $row):?>
                                <option value="<?php echo $row->rowid;?>"><?php echo $row->nama."(".$row->nrp.")";?></option>
                                <?php endforeach;?>   
							</select>
                        </div>                        
                    </div>
                    <div class="form-group">
                        <label class="control-label text-dark">Keterangan</label>
                        <div>
                            <textarea name="msg" id="msg" class="form-control input-lg" cols="15" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div>                           
                            <div class="row">
                                <div class="col">
                                    <!-- <input type="submit" value="Reject" name="submit" class="btn btn-danger btn-block" /> -->
                                    <input type="submit" value="Reject" id="btnSaveReject" onclick="save_reject()" class="btn btn-danger btn-block">
                                </div>
                                <div class="col">
                                    <!-- <input type="submit" value="Approve" name="submit" class="btn btn-info btn-block" /> -->
                                    <input type="submit" value="Approve" id="btnSaveApprove" onclick="save_approve()" class="btn btn-info btn-block">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="proses_berjalan" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-xs-center">Proses Permohonan (<span id="nama_pemohon_berjalan"></span>)</h4>
            </div>
            <div class="modal-body">
                <form action="#" id="form_berjalan">
                    <input type="hidden" name="pp_id_berjalan" id="pp_id_berjalan" value="">
                    <div class="form-group">
                        <label class="control-label text-dark">Status</label>
                        <div>
                             <select class="form-select" id="status_berjalan" name="status_berjalan"style="width: 100%;">
								<option value="1" selected>Disetujui</option>
                                <option value="3">Berjalan</option>
							</select>
                        </div>                        
                    </div>
                    <div class="form-group">
                        <div>                           
                            <div class="row">
                                <div class="col">
                                    <!-- <input type="submit" value="Reject" name="submit" class="btn btn-danger btn-block" /> -->
                                    <!-- <input type="submit" value="Reject" id="btnSaveReject" onclick="save_reject()" class="btn btn-info btn-block"> -->
                                </div>
                                <div class="col">
                                    <!-- <input type="submit" value="Approve" name="submit" class="btn btn-info btn-block" /> -->
                                    <input type="submit" value="Update" id="btnSaveBerjalan" onclick="save_berjalan()" class="btn btn-info btn-block">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="proses_selesai" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-xs-center">Proses Permohonan (<span id="nama_pemohon_selesai"></span>)</h4>
            </div>
            <div class="modal-body">
                <form action="#" id="form_selesai">
                    <input type="hidden" name="pp_id_selesai" id="pp_id_selesai" value="">
                    <div class="form-group">
                        <label class="control-label text-dark">Status</label>
                        <div>
                             <select class="form-select" id="status_selesai" name="status_selesai"style="width: 100%;">
                                <option value="3" selected>Berjalan</option>
                                <option value="4">Selesai</option>
							</select>
                        </div>                        
                    </div>
                    <div class="form-group">
                        <div>                           
                            <div class="row">
                                <div class="col">
                                    <!-- <input type="submit" value="Reject" name="submit" class="btn btn-danger btn-block" /> -->
                                    <!-- <input type="submit" value="Reject" id="btnSaveReject" onclick="save_reject()" class="btn btn-info btn-block"> -->
                                </div>
                                <div class="col">
                                    <!-- <input type="submit" value="Approve" name="submit" class="btn btn-info btn-block" /> -->
                                    <input type="submit" value="Update" id="btnSaveSelesai" onclick="save_selesai()" class="btn btn-info btn-block">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="detail" tabindex="-1" aria-labelledby="detail" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detail">Detail Permohonan - <span id="kode_detail"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="row">
                <input type="hidden" name="id_detail" id="id_detail" value="">
                <div class="col">
                    <h5 class="mb-4 ">Nama Pemohon</h5>
                    <p class="text-gray" id="nama_pemohon_detail"></p>
                </div>
                <div class="col">
                    <h5 class="mb-4">Kategori</h5>
                    <p class="text-gray" id="kategori_detail"></p>
                </div>
                <div class="col">
                    <h5 class="mb-4">Tanggal Pengajuan</h5>
                    <p class="text-gray" id="tgl_pengajuan_detail"></p>
                </div>
                <div class="col">
                    <h5 class="mb-4">Status</h5>
                    <p class="text-gray" id="status_detail"></p>
                </div>
            </div>
            <hr>
            <div class="row">
                <input type="hidden" name="id_detail" id="id_detail" value="">
                <div class="col">
                    <h5 class="mb-4 ">No Ktp</h5>
                    <p class="text-gray" id="ktp_detail"></p>
                </div>
                <div class="col">
                    <h5 class="mb-4">No Tlp</h5>
                    <p class="text-gray" id="no_hp_detail"></p>
                </div>
                <div class="col">
                    <h5 class="mb-4">Email</h5>
                    <p class="text-gray" id="email_detail"></p>
                </div>
            </div>
            <hr>
            <div>
                <h5>Kategori Pengawalan</h5>
                <p class="text-gray" id="kategori_pengawalan_detail"></p>
            </div>
            <hr>
            <div class="row mb-4">
                <div class="col">
                    <h5 class="mb-4">Alamat Awal</h5>
                    <p class="text-gray" id="alamat_awal_detail">Beranda di Jalan Dr Rajiman Nomor 343, Kelurahan Panularan, Kecamatan Laweyan, Solo, Kode Pos 57149</p>
                </div>
                <div class="col">
                    <h5 class="mb-4">Alamat Tujuan</h5>
                    <p class="text-gray">Nama Jalan : <span id="alamat_tujuan_detail"></span></p>
                    <!-- <p class="text-gray">Kordinat : <span>-6.294251968190391,107.07775037512127</span></p>
                    <p class="text-gray">Usulan Route : <span>Dari Kecamatan A, masuk jalan B,C,D</span></p> -->
                </div>
            </div>
            <hr>
            <div>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tab1" aria-current="page">Riwayat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab2">Pengawal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab3">Deskripsi</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div id="tab1" class="tab-pane fade show in active container">
                    <div class="mt-3">
                      <div class="table-responsive">
                            <table id="riwayat" class="table table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Operator</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="tab2" class="tab-pane fade container">
                    <div class="mt-2">
                        <div class="table-responsive">
                            <table id="pengawal" class="table table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NRP</th>
                                        <th>Nama Pengawal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="tab3" class="tab-pane fade container">
                    <div class="row mt-2" >
                         <span id="deskripsi"></span>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<script>

    var date;
    var time;
    var status;
    var table ;  
$(document).ready(function(){
    table =  $('#mytbl').DataTable({
        // Processing indicator
        "bAutoWidth": false,
        "destroy": true,
        "autoWidth": true,
        "searching": false,
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        "scrollX": true,
        // Initial no order.
        "order": [],
        // Load data from an Ajax source
        "ajax": {
            "url": '<?php echo base_url()?>patwal/dt_patwal_permohonan',
            "type": "POST",
            "data" : {
                'a' : null,
                'tgl' : null,
                'length' : 10,
            }
        },
        // "paging":   false,
        //Set column definition initialisation properties
        "columnDefs": [{
            // "targets": [8],
            "orderable": false
        }]
    });
    datepicker(); 
    timepicker();
    $('#petugas').select2({
        dropdownParent: $('#proses')
    });
    $("#cari").click(function(){
        // if (date == '' || time != '') {
        //     alert('isi Tanggal');
        // }else{
            date = $("#date").val();
            time =   $("#time").val();
            status =   $("#status").val();
            table =  $('#mytbl').DataTable({
                // Processing indicator
                "bAutoWidth": false,
                "destroy": true,
                "autoWidth": true,
                "searching": false,
                "processing": true,
                // DataTables server-side processing mode
                "serverSide": true,
                "scrollX": true,
                // Initial no order.
                "order": [],
                // Load data from an Ajax source
                "ajax": {
                    "url": '<?php echo base_url()?>patwal/dt_patwal_permohonan',
                    "type": "POST",
                    "data" : {
                        'tanggal_patwal' : date,
                        'jam_patwal' : time,
                        'status' : status,
                        'a' : null,
                        'tgl' : null,
                        'length' : 10,
                    }
                },
                // "paging":   false,
                //Set column definition initialisation properties
                "columnDefs": [{
                    // "targets": [8],
                    "orderable": false
                }]
            });
            datepicker(); 
            timepicker();
        // }
    });
});

function dt_tbl(){
    var date = $("#date").val();
    var time =   $("#time").val();
    var status =   $("#status").val();
    $('#mytbl').DataTable({
        // Processing indicator
        "bAutoWidth": false,
        "destroy": true,
        "autoWidth": true,
        "searching": false,
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        "scrollX": true,
        // Initial no order.
        "order": [],
        // Load data from an Ajax source
        "ajax": {
            "url": '<?php echo base_url()?>patwal/dt_patwal_permohonan',
            "type": "POST",
            "data" : {
                'tanggal_patwal' : date,
                'jam_patwal' : time,
                'status' : status,
                'a' : null,
                'tgl' : null,
                'length' : 10,
            }
        },
        // "paging":   false,
        //Set column definition initialisation properties
        "columnDefs": [{
            // "targets": [8],
            "orderable": false
        }]
    });
    datepicker(); 
    timepicker();
}

function proses (id){
            $('#proses').modal('show');
            $.ajax({
                type: 'GET',
                dataType: 'JSON',
                url: '<?php echo base_url()?>patwal/dt_detail/' + id,
                success: function (data) {
                    $("#pp_id").val(data.id);
                    $("#nama_pemohon").html(data.nama_pemohon); 
                }
            });
}
function proses_berjalan (id){
            $('#proses_berjalan').modal('show');
            $.ajax({
                type: 'GET',
                dataType: 'JSON',
                url: '<?php echo base_url()?>patwal/dt_detail/' + id,
                success: function (data) {
                    $("#pp_id_berjalan").val(data.id);
                    $("#nama_pemohon_berjalan").html(data.nama_pemohon); 
                }
            });
}
function proses_selesai (id){
            $('#proses_selesai').modal('show');
            $.ajax({
                type: 'GET',
                dataType: 'JSON',
                url: '<?php echo base_url()?>patwal/dt_detail/' + id,
                success: function (data) {
                    $("#pp_id_selesai").val(data.id);
                    $("#nama_pemohon_selesai").html(data.nama_pemohon); 
                }
            });
}

function detail (id){
            $('#detail').modal('show');
            $.ajax({
                type: 'GET',
                dataType: 'JSON',
                url: '<?php echo base_url()?>patwal/dt_detail/' + id,
                success: function (data) {
                    // console.log(data.alamat_tujuan);
                    $("id_detail").html(data.id);
                    $("#kode_detail").html(data.kode);
                    $("#nama_pemohon_detail").html(data.nama_pemohon);
                    $("#kategori_detail").html(data.kateg_pemohon);
                    $("#tgl_pengajuan_detail").html(data.ctddate);
                    $("#status_detail").html(data.status);
                    $("#kategori_pengawalan_detail").html(data.pk_id);
                    $("#alamat_awal_detail").html(data.alamat_awal);
                    $("#alamat_tujuan_detail").html(data.alamat_tujuan);
                    $("#ktp_detail").html(data.ktp);
                    $("#no_hp_detail").html(data.no_hp);
                    $("#email_detail").html(data.email);
                    $("#deskripsi").html(data.deskripsi);        
                }
            });
                $('#riwayat').DataTable({
                    // Processing indicator
                    "bAutoWidth": true,
                    "destroy": true,
                    "autoWidth": true,
                    "searching": false,
                    "processing": true,
                    // DataTables server-side processing mode
                    "serverSide": true,
                    "scrollX": true,
                    // Initial no order.
                    "order": [],
                    // Load data from an Ajax source
                    "ajax": {
                        "url": '<?php echo base_url()?>patwal/dt_riwayat',
                        "type": "POST",
                        "data" : {
                            'id': id,
                            'a' : null,
                            'tgl' : null,
                            'length' : 10,
                        }
                    },
                    // "paging":   false,
                    //Set column definition initialisation properties
                    "columnDefs": [{
                        // "targets": [8],
                        "orderable": false
                    }]
                });
                $('#pengawal').DataTable({
                    // Processing indicator
                    "bAutoWidth": true,
                    "destroy": true,
                    "autoWidth": true,
                    "searching": false,
                    "processing": true,
                    // DataTables server-side processing mode
                    "serverSide": true,
                    "scrollX": true,
                    // Initial no order.
                    "order": [],
                    // Load data from an Ajax source
                    "ajax": {
                        "url": '<?php echo base_url()?>patwal/dt_pengawal',
                        "type": "POST",
                        "data" : {
                            'id': id,
                            'a' : null,
                            'tgl' : null,
                            'length' : 10,
                        }
                    },
                    // "paging":   false,
                    //Set column definition initialisation properties
                    "columnDefs": [{
                        // "targets": [8],
                        "orderable": false
                    }]
                });
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
    // location.reload(true);
}

function save_approve()
{
    $('#btnSaveApprove').text('saving...'); //change button text
    $('#btnSaveApprove').attr('disabled',true); //set button disable 
 
    // ajax adding data to database
    $.ajax({
        url : "<?php echo base_url()?>patwal/proses_approve",
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) 
            {
                $('#proses').modal('hide');
                reload_table();
                swal("Berhasil", "klik ok", "success");
            }

             $('#btnSaveApprove').text('Approve'); //change button text
             $('#btnSaveApprove').attr('disabled',false); //set button enable 
 
        }
    });
}

function save_reject()
{
    $('#btnSaveReject').text('reject...'); //change button text
    $('#btnSaveReject').attr('disabled',true); //set button disable 
 
    // ajax adding data to database
    $.ajax({
        url : "<?php echo base_url()?>patwal/proses_reject",
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) 
            {
                $('#proses').modal('hide');
                reload_table();
                swal("Berhasil", "klik ok", "success");
            }

             $('#btnSaveReject').text('Reject'); //change button text
             $('#btnSaveReject').attr('disabled',false); //set button enable 
 
        }
    });
}

function save_berjalan()
{
    $('#btnSaveBerjalan').text('Update...'); //change button text
    $('#btnSaveBerjalan').attr('disabled',true); //set button disable 
 
    // ajax adding data to database
    $.ajax({
        url : "<?php echo base_url()?>patwal/proses_berjalan",
        type: "POST",
        data: $('#form_berjalan').serialize(),
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) 
            {
                $('#proses_berjalan').modal('hide');
                reload_table();
                swal("Berhasil", "klik ok", "success");
            }

             $('#btnSaveBerjalan').text('Update'); //change button text
             $('#btnSaveBerjalan').attr('disabled',false); //set button enable 
 
        }
    });
}

function save_selesai()
{
    $('#btnSaveSelesai').text('Update...'); //change button text
    $('#btnSaveSelesai').attr('disabled',true); //set button disable 
 
    // ajax adding data to database
    $.ajax({
        url : "<?php echo base_url()?>patwal/proses_selesai",
        type: "POST",
        data: $('#form_selesai').serialize(),
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) 
            {
                $('#proses_selesai').modal('hide');
                reload_table();
                swal("Berhasil", "klik ok", "success");
            }

             $('#btnSaveSelesai').text('Update'); //change button text
             $('#btnSaveSelesai').attr('disabled',false); //set button enable 
 
        }
    });
}



</script>


