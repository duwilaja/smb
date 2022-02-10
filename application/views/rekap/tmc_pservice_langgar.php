<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,dasar,nomor,";
$cols="nrp,saluran,sumber,tgl,jam,jalan,langgar,jenis,pelapor,telp,verifikasi,'' as btnset,uploadedfile,lat,lng,rowid,concat('Pelanggaran (',jenis,')') as tit";
$tname="tmc_pservice_langgar";
$dispatched="'1020' as kategori_peng_id,tgl as ctddate,jam as ctdtime,lat,lng,pelapor as nama_pelapor,jalan as alamat,
telp,masyarakat_id as pelapor_id,jenis as keterangan,'pelanggaran' as judul,'1' as status";

$dispatched="'1020' as kategori_peng_id,tgl as ctddate,jam as ctdtime,lat,lng,pelapor as nama_pelapor,jalan as alamat,
telp,masyarakat_id as input_peng,jenis as keterangan,'pelanggaran' as judul,'0' as status,rowid as mobile_uniqueid";
?>

<?php $this->load->view('rekap/incl/head_rekap');?>
		<div class="table-responsive mt-4">
			<table id="mytbl" class="table table-striped table-bordered w-100">
				<thead>
					<tr>
						<th>NRP</th>
						<th>Saluran</th>
						<th>Sumber</th>
						<th>Tanggal</th>
						<th>Jam</th>
						<th>Jalan</th>
						<th>Langgar</th>
						<th>Jenis</th>
						<th>Pelapor</th>
						<th>Telp</th>
						<th>TerVerifikasi?</th>
						<th></th>
						<th>FileUpload</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modal-->
<div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left modal_form">
  <div role="document" class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header"><strong id="exampleModalLabel" class="modal-title">Verifikasi</strong>
	  	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	  </div>
	  <div class="modal-body">
		<form id="myfx">
		<input type="hidden" name="tablename" value="<?php echo $tname?>">
		<input type="hidden" name="fieldnames" value="verifikasi,nopol,sumber_data">
		<input type="hidden" name="rowid" id="rowid" value="">
		<input type="hidden" name="dispatch" value="no">
		<input type="hidden" name="dispatched" value="<?php echo base64_encode($dispatched)?>">
		<div class="form-group lalin">
			<label for="nopol">NO PLAT</label>
			<input type="text" name="nopol" class="form-control" id="nopol">
		</div>
		<div class="form-group">
			<label for="verifikasi">Data Valid ?</label>
			<select name="verifikasi" class="form-control"><option value="Y">Y</option><option value="N">N</option></select>
		</div>
		<div class="form-group">
			<label for="sumber">Sumber Data</label>
			<select class="form-control" name="sumber_data" id="sumber">
			<option value="Sumber dari pantauan CCTV">Sumber dari pantauan CCTV</option>
			<option value="Sumber dari masyarakat">Sumber dari masyarakat</option>
			<option value="Sumber dari analytic camera">Sumber dari analytic camera</option>
			</select>
		</div>
		</form>
	  </div>
	  <div class="modal-footer">
		  <button type="button" data-bs-dismiss="modal" class="btn btn-danger">Tutup</button>
		<button type="button" class="btn btn-success" onclick="simpanlah();">Simpan</button>
	  </div>
	</div>
  </div>
</div>

<script>
var  mytbl;
function load_table(){
	mytbl = $("#mytbl").DataTable({
		serverSide: true,
		processing: true,
		searching: false,
		ordering: false,
		buttons: ['copy', {extend : 'excelHtml5', messageTop: $(".judul").text()}],
		ajax: {
			type: 'POST',
			url: '<?php echo base_url()?>rekap/datatable',
			data: function (d) {
				d.cols= '<?php echo base64_encode($cols); ?>',
				d.tname= '<?php echo base64_encode($tname); ?>',
				d.orders= '<?php echo base64_encode('dtm desc')?>',
				d.ismap=true,
				d.isverify=true,
				d.isfile=true,
				d.filefields="uploadedfile",
				d.tgl= $('#tgl').val();
			}
		},
		initComplete: function(){
			dttbl_buttons(); //for ajax call
		},
		columnDefs: [
			{
				orderable: false,
				targets: [10,11]
			}
		]
	});
	datepicker();
}

function contentcallback(){
	load_table();
}

function reload_table(){
	mytbl.ajax.reload();
}

function mapview(lat,lng){
	window.open(base_url+"map/view?lat="+lat+"&lng="+lng,"MapWindow","width=830,height=500,location=no").focus();
}
function openmodal(rowid,langgar){
	$("#nopol").val('');
	$("#rowid").val(rowid);
	$("#langgar").val(langgar);
	if(langgar=='lalin') {$(".lalin").show()} else {$(".lalin").hide();}
	$("#myModal").modal("show");
}
function safeform(thef){
	sendData('#myfx',"rekap/save");
}
function senddatacallback(thef){
	reload_table();
}
</script>