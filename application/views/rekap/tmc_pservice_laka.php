<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,dasar,nomor,";
$cols="nrp,saluran,sumber,tgl,jam,jalan,jenis,jmlkorban,korbanmd,kebutuhan,pelapor,telp,verifikasi,'' as btnset,uploadedfile,lat,lng,rowid,concat('Kecelakaan (',jenis,')') as tit";
$tname="tmc_pservice_laka";
$orders = "dtm desc";
$dispatched="'1' as kategori_peng_id,tgl as ctddate,jam as ctdtime,lat,lng,pelapor as nama_pelapor,jalan as alamat,
telp,masyarakat_id as pelapor_id,concat(jenis,' korban:',jmlkorban,' MD:',korbanmd,' kebutuhan:',kebutuhan) as keterangan,'kecelakaan' as judul,'1' as status";

$dispatched="'1' as kategori_peng_id,tgl as ctddate,jam as ctdtime,lat,lng,pelapor as nama_pelapor,jalan as alamat,
telp,masyarakat_id as input_peng,concat(jenis,' korban:',jmlkorban,' MD:',korbanmd,' kebutuhan:',kebutuhan) as keterangan,'kecelakaan' as judul,'0' as status,rowid as mobile_uniqueid";
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
						<th>Jenis</th>
						<th>Korban</th>
						<th>MD</th>
						<th>Kebutuhan</th>
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
		<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">x</span></button>
	  </div>
	  <div class="modal-body">
		<form id="myfx">
		<input type="hidden" name="tablename" value="<?php echo $tname?>">
		<input type="hidden" name="fieldnames" value="verifikasi,stts">
		<input type="hidden" name="stts" value="Processed">
		<input type="hidden" name="rowid" id="rowid" value="">
		<input type="hidden" name="dispatch" value="yes">
		<input type="hidden" name="dispatched" value="<?php echo base64_encode($dispatched)?>">
		
		Data Valid? <select name="verifikasi" class="form-control"><option value="Y">Y</option><option value="N">N</option></select>
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-success" onclick="simpanlah();">Simpan</button>
		<button type="button" data-dismiss="modal" class="btn btn-default">Tutup</button>
	  </div>
	</div>
  </div>
</div>

<script>
var  mytbl;
function load_table(){
	mytbl = $("#mytbl").DataTable({
		serverSide: true,
		ordering: false,
		processing: true,
		searching: false,
		buttons: ['copy', {extend : 'excelHtml5', messageTop: $(".judul").text()}],
		ajax: {
			type: 'POST',
			url: '<?php echo base_url()?>rekap/datatable',
			data: function (d) {
				d.cols= '<?php echo base64_encode($cols); ?>',
				d.tname= '<?php echo base64_encode($tname); ?>',
				d.ismap=true,
				d.isverify=true,
				d.isfile=true,
				d.filefields="uploadedfile",
				d.orders = '<?php echo base64_encode($orders); ?>',
				d.tgl= $('#tgl').val();
			}
		},
		initComplete: function(){
			dttbl_buttons(); //for ajax call
		},
		columnDefs: [
			{
				orderable: false,
				targets: [13,14]
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