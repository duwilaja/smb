<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,dasar,nomor,";
$cols="nrp,tgl,nama,jk,tmpl,tgll,idtt,pek,pers,lic,stl,pelg,kecl,ctt,trainer,materi,trmulai,trsampai";
$tname="sdc_pendaftaran";
?>

<?php $this->load->view('rekap/incl/head_rekap');?>
		<div class="table-responsive mt-4">
			<table id="mytbl" class="table table-striped table-bordered w-100">
				<thead>
					<tr>
						<th>NRP</th>
						<th>Tanggal</th>
						<th>Nama</th>
						<th>Gender</th>
						<th>Tempat Lahir</th>
						<th>Tgl Lahir</th>
						<th>Identitas</th>
						<th>Pekerjaan</th>
						<th>Perusahaan</th>
						<th>Lisensi Mengemudi</th>
						<th>Status Lisensi</th>
						<th>Pelanggaran</th>
						<th>Kecelakaan</th>
						<th>Catatan</th>
						<th>Trainer</th>
						<th>Materi</th>
						<th>Mulai</th>
						<th>Sampai</th>
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