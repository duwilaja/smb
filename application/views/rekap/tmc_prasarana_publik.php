<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,dasar,nomor,";
$cols="nrp,tgl,prasarana,nama,k_datang,k_berangkat,p_datang,p_berangkat,parkir,k_diangkut,r2_gowes,r2_motor,r4,r6,pengunjung,k_kendaraan";
$tname="tmc_prasarana_publik";
?>

<?php $this->load->view('rekap/incl/head_rekap');?>
		<div class="table-responsive mt-4">
			<table id="mytbl" class="table table-striped table-bordered w-100">
				<thead>
					<tr>
						<th>NRP</th>
						<th>Tanggal</th>
						<th>Prasarana</th>
						<th>Nama</th>
						<th>Kedatangan</th>
						<th>Keberangkatan</th>
						<th>Penumpang Datang</th>
						<th>Penumpang Berangkat</th>
						<th>Kapasitas Parkir</th>
						<th>Kendaraan Diangkut</th>
						<th>R2 Gowes</th>
						<th>R2 Motor</th>
						<th>R4</th>
						<th>R6</th>
						<th>Jumlah Pengunjung</th>
						<th>Klasifikasi Kendaraan</th>
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