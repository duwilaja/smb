<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,dasar,nomor,";
$cols="nrp,tgl,namajalan,lat,lng,kategori,kejadian,penyebab,penyebabd,lainnya,tindakan,penindakan,ket,";
$cols.="instansi1,petugas1,instansi2,petugas2,instansi3,petugas3,instansi4,petugas4";

$tname="tmc_ops_pol";
?>

<?php $this->load->view('rekap/incl/head_rekap');?>
		<div class="table-responsive mt-4">
			<table id="mytbl" class="table table-striped table-bordered w-100">
				<thead>
					<tr>
						<th>ID/NRP</th>
						<th>Tanggal</th>
						<th>Jalan</th>
						<th>Latitude</th>
						<th>Longitude</th>
						<th>Kategori Ops</th>
						<th>Mendapati Kejadian/Laporan</th>
						<th>Penyebab</th>
						<th>Detil</th>
						<th>Lainnya</th>
						<th>Cara Bertindak</th>
						<th>Kategori Penindakan</th>
						<th>Keterangan CB</th>
						<th>Instansi 1</th>
						<th>Petugas 1</th>
						<th>Instansi 2</th>
						<th>Petugas 2</th>
						<th>Instansi 3</th>
						<th>Petugas 3</th>
						<th>Instansi 4</th>
						<th>Petugas 4</th>
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
				d.orders= '<?php echo base64_encode('tgl desc, rowid desc')?>',
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