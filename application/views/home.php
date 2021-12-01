<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
	<div class="col-lg-12">
		<div class="alert alert-info" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		Welcome <?php echo $session['nama']?> @ <?php echo $session['unit']?></div>
	</div>
</div>

<!--div class="row">
	<div class="col-md-4">
		<img src="<?php echo base_url()?>my/images/infos/rst.jpg" />
	</div>
	<div class="col-md-4">
		<img src="<?php echo base_url()?>my/images/infos/rain.jpg" />
	</div>
	<div class="col-md-4">
		<img src="<?php echo base_url()?>my/images/infos/tip.jpg" />
	</div>
</div-->

<div class="card">
	<div class="card-header">
		<div class="card-title judul">
			<div class="row">
				<div class="col">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">
								<i class="fa fa-calendar"></i>
							</div>
						</div>
						<input type="text" class="form-control datepicker" id="tgl">
					</div>
				</div>
				<!--div>-</div>
				<div class="col">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">
								<i class="fa fa-calendar"></i>
							</div>
						</div>
						<input type="text" class="form-control datepicker" id="tgl">
					</div>
				</div-->
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
						<th>Tanggal</th>
						<th>Jam</th>
						<th>Laporan</th>
						<th>Lokasi</th>
						<th>Pelapor</th>
						<th>Sumber</th>
						<th>Saluran</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php
$cols = "tgl,jam,j,jalan,pelapor,sumber,saluran,stts";
$tname="v_pservice";
?>
<script>
var  mytbl;
function load_table(){
	mytbl = $("#mytbl").DataTable({
		serverSide: true,
		processing: true,
		searching: false,
		ordering: false,
		buttons: ['copy', {extend : 'excelHtml5', messageTop: $(".judul").text()}],
		dom: '<"top"i>rt<"bottom"lp><"clear">',
		ajax: {
			type: 'POST',
			url: '<?php echo base_url()?>home/dttbl',
			data: function (d) {
				d.cols= '<?php echo base64_encode($cols); ?>',
				d.tname= '<?php echo base64_encode($tname); ?>',
				//d.ismap=true,
				//d.isverify=true,
				//d.isfile=true,
				//d.filefields="sim,ktp,sertifikat,kesehatan,lunas",
				//d.ftgl='ctddate',
				d.tgl= $('#tgl').val();
			}
		},
		initComplete: function(){
			//dttbl_buttons(); //for ajax call
		},
		columnDefs: [
			{
				//orderable: false,
				//targets: [10,11,12,13,14,15]
			}
		]
	});
	datepicker();
}

function thispage_ready(){
	load_table();
	setTimeout(auto_reload,15*1000);
}

function auto_reload(){
	reload_table();
	setTimeout(auto_reload,15*1000);
}

function reload_table(){
	mytbl.ajax.reload();
}

function mapview(lat,lng){
	window.open(base_url+"map/view?lat="+lat+"&lng="+lng,"MapWindow","width=830,height=500,location=no").focus();
}
function openmodal(rowid){
	$("#rowid").val(rowid);
	$("#myModal").modal("show");
}
function safeform(thef){
	sendData('#myfx',"rekap/save");
}
function senddatacallback(thef){
	reload_table();
}
</script>