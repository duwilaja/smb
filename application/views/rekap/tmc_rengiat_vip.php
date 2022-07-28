<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,dasar,nomor,";
$cols="nrp,obyek,obyeklain,pejabat,tanggal as tgl,jam,dari,darinama,ke,kenama,wasdal,anggota1,anggota2,anggota3,'' as btnset,rowid";
$tname="tmc_rengiat_vip";
?>

<?php $this->load->view('rekap/incl/head_rekap');?>
		<div class="table-responsive mt-4">
			<table id="mytblx" class="table table-striped table-bordered w-100">
				<thead>
					<tr>
						<th>ID/NRP</th>
						<th>Obyek Pengawalan</th>
						<th>Obyek Lain</th>
						<th>Nama Pejabat</th>
						<th>Tanggal</th>
						<th>Jam</th>
						<th>Dari</th>
						<th>Nama</th>
						<th>Ke</th>
						<th>Nama</th>
						<th>Perwira WAsdal</th>
						<th>Anggota1</th>
						<th>Anggota2</th>
						<th>Anggota3</th>
						<th></th>
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
	mytbl = $("#mytblx").DataTable({
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
				d.isedit=true,
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