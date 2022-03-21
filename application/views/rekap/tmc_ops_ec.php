<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,dasar,nomor,";
$cols="nrp,tgl,lokasi,lat,lng,jam,kejadian,dampak,radius,kebutuhan,ket,md,lb,pengungsi,'' as btnset,rowid";
//$cols.="instansi1,petugas1,instansi2,petugas2,instansi3,petugas3,instansi4,petugas4";

$tname="tmc_ops_ec";
?>

<?php $this->load->view('rekap/incl/head_rekap');?>
		<div class="table-responsive mt-4">
			<table id="mytbl" class="table table-striped table-bordered w-100">
				<thead>
					<tr>
						<th>ID/NRP</th>
						<th>Tanggal</th>
						<th>Lokasi</th>
						<th>Latitude</th>
						<th>Longitude</th>
						<th>Jam</th>
						<th>Kejadian</th>
						<th>Dampak</th>
						<th>Radius</th>
						<th>Kebutuhan</th>
						<th>Keterangan</th>
						<th>Meninggal Dunia</th>
						<th>Luka Berat</th>
						<th>Estimasi Pengungsi</th>
						<th></th>
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
	  <div class="modal-header"><strong id="exampleModalLabel" class="modal-title">Jumlah Korban</strong>
	  	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	  </div>
	  <div class="modal-body">
		<form id="myfx">
			<input type="hidden" name="tablename" value="<?php echo $tname?>">
			<input type="hidden" name="fieldnames" value="md,lb,pengungsi">
			<input type="hidden" name="rowid" id="rowid" value="">
			  <div class="row">
				<div class="form-group col-md-12">
					<label>Meninggal Dunia</label>
					<input type="text" id="md" name="md" placeholder="..." class="form-control">
				</div>
			  </div>
			  <div class="row">
				<div class="form-group col-md-12">
					<label>Luka Berat</label>
					<input type="text" id="lb" name="lb" placeholder="..." class="form-control">
				</div>
			  </div>
			  <div class="row">
				<div class="form-group col-md-12">
					<label>Estimasi Pengungsi</label>
					<input type="text" id="pengungsi" name="pengungsi" placeholder="..." class="form-control">
				</div>
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
		ordering: false,
		processing: true,
		searching: false,
		buttons: ['copy', {extend : 'excelHtml5', messageTop: $(".judul").text()}],
		ajax: {
			type: 'POST',
			url: '<?php echo base_url()?>rekap/datatable_all',
			data: function (d) {
				d.cols= '<?php echo base64_encode($cols); ?>',
				d.tname= '<?php echo base64_encode($tname); ?>',
				d.orders= '<?php echo base64_encode('tgl desc, jam desc, rowid desc')?>',
				d.isverify=true,
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
function openmodal(rowid){
	$("#rowid").val(rowid);
//	$("#myModal").modal("show");
	
		$.ajax({
			type: 'POST',
			url: base_url+'laporan/datas',
			data: {q:'ec',id:rowid},
			success: function(data){
//				$("#bdel").show();
				var json = JSON.parse(data);
				console.log(json);
				$.each(json[0],function (key,val){
					$('#'+key).val(val);
				})
				$("#myModal").modal("show");
			},
			error: function(xhr){
				log('Please check your connection'+xhr);
				alrt("Failed retrieving data","error");
			}
		});

}
function safeform(thef){
	sendData('#myfx',"rekap/save");
}
function senddatacallback(thef){
	reload_table();
}
</script>