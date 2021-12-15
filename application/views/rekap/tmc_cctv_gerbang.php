<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,dasar,nomor,";
$cols="nrp,tgl,in_a,out_a,dominasi_a,in_b,out_b,dominasi_b,in_c,out_c,dominasi_c,in_d,out_d,dominasi_d";
$cols="nrp,tgl,in_a,out_a,in_b,out_b,in_c,out_c,in_d,out_d,klasifikasi";
$tname="tmc_cctv_gerbang";
?>

<?php $this->load->view('rekap/incl/head_rekap');?>
		<div class="table-responsive mt-4">
			<table id="mytbl" class="table table-striped table-bordered w-100">
				<thead>
					<tr>
						<th>ID/NRP</th>
						<th>Tanggal</th>
						<th>Gerbang Masuk A</th>
						<th>Gerbang Keluar A</th>
						<th>Gerbang Masuk B</th>
						<th>Gerbang Keluar B</th>
						<th>Gerbang Masuk C</th>
						<th>Gerbang Keluar C</th>
						<th>Gerbang Masuk D</th>
						<th>Gerbang Keluar D</th>
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