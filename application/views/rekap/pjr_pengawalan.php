<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,dasar,nomor,";
$cols="nrp,tgl,instansi,deskripsi,darilat,darilng,kelat,kelng,via,tanggal,mulai,sampai,petugas";
$tname="pjr_pengawalan";
?>

<div class="card">
	<div class="card-header">
		<div class="card-title judul">PJR Pengawalan
		
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fa fa-calendar"></i>
													</div>
												</div>
												<input type="text" class="form-control datepicker" id="tgl">
											</div>
										
		</div>
		<div class="card-options ">
			<!--a href="#" title="Batch" class=""><i class="fe fe-upload"></i></a>
			<a href="#" onclick="openForm(0);" data-toggle="modal" data-target="#myModal" title="Add" class=""><i class="fe fe-plus"></i></a-->
			<a href="#" title="Refresh" onclick="reload_table();"><i class="fe fe-refresh-cw"></i></a>
			<a href="#" title="Expand/Collapse" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
			<!--a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a-->
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="mytbl" class="table table-striped table-bordered w-100">
				<thead>
					<tr>
						<th rowspan="2">NRP</th>
						<th rowspan="2">Tanggal</th>
						<th rowspan="2">Instansi</th>
						<th rowspan="2">Deskripsi</th>
						<th colspan="2">Dari</th>
						<th colspan="2">Ke</th>
						<th rowspan="2">Via</th>
						<th rowspan="2">Tanggal</th>
						<th rowspan="2">Mulai</th>
						<th rowspan="2">Sampai</th>
						<th rowspan="2">Petugas</th>
					</tr>
					<tr>
						<th>Latitude</th>
						<th>Longitude</th>
						<th>Latitude</th>
						<th>Longitude</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script>
var  mytbl;
function load_table(){
	mytbl = $("#mytbl").DataTable({
		serverSide: false,
		processing: true,
		searching: false,
		buttons: ['copy', {extend : 'excelHtml5', messageTop: $(".judul").text()}],
		ajax: {
			type: 'POST',
			url: '<?php echo base_url()?>rekap/datatable_all',
			data: function (d) {
				d.cols= '<?php echo base64_encode($cols); ?>',
				d.tname= '<?php echo base64_encode($tname); ?>',
				d.tgl= $('#tgl').val();
			}
		},
		initComplete: function(){
			dttbl_buttons(); //for ajax call
		}
	});
	datepicker();
}

function contentcallback(){
	load_table();
}

function reload_table(){
	mytbl.ajax.reload();
}
</script>