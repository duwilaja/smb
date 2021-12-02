<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,dasar,nomor,";
$cols.="giat,tempat,tanggal,audien,sasaran,media,lnk";
?>

<input type="hidden" name="tablename" value="kamsel_dikmas">
<input type="hidden" name="fieldnames" value="<?php echo $cols?>">

<div class="row">
	<div class="col-sm-6 col-md-6">
		<div class="form-group">
			<label class="form-label">Giat</label>
			<select name="giat" class="form-control" placeholder="">
				<option value="LITERASI ROAD SAFETY">LITERASI ROAD SAFETY</option>
				<option value="PEMBINAAN KOMUNITAS">PEMBINAAN KOMUNITAS</option>
				<option value="PEMBANGUN SDC BERSAMA STANDAR N JEMEN OPS REK">PEMBANGUN SDC BERSAMA STANDAR N JEMEN OPS REK</option>
				<option value="PROGRAM DISEMINASI GURU">PROGRAM DISEMINASI GURU</option>
				<option value="KAMPUS PELOPOR TERTIB LALU LINTAS">KAMPUS PELOPOR TERTIB LALU LINTAS</option>
				<option value="TAMAN LALU LINTAS">TAMAN LALU LINTAS</option>
				<option value="KAMPANYE TERTIB LALU LINTAS">KAMPANYE TERTIB LALU LINTAS</option>
				<option value="POLSANAK">POLSANAK</option>
				<option value="PKS">PKS</option>
				<option value="CARA AMAN KE SEKOLAH">CARA AMAN KE SEKOLAH</option>
				<option value="MEDIA SOSIAL DAN MEDIA ON LINE">MEDIA SOSIAL DAN MEDIA ON LINE</option>
				<option value="MEDIA ELEKTRONIK">MEDIA ELEKTRONIK</option>
				<option value="IT ROAD SAFETY EXPO">IT ROAD SAFETY EXPO</option>
				<option value="SAFETY DRIVING DAN SAFETY RIDING">SAFETY DRIVING DAN SAFETY RIDING </option>
				<option value="IRSA INDONESIA ROAD SAFETY AWARD">IRSA INDONESIA ROAD SAFETY AWARD</option>
				<option value="PENGEMUDI TELADAN">PENGEMUDI TELADAN </option>
				<option value="KAMPUNG TERTIB LALU LINTAS">KAMPUNG TERTIB LALU LINTAS</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Tempat</label>
			<input type="text" name="tempat" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Tanggal</label>
			<input type="text" name="tanggal" class="form-control datepicker" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Jml. Audien</label>
			<input type="text" name="audien" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Sasaran</label>
			<select name="sasaran" class="form-control" placeholder="">
				<option value="Anggota">Anggota</option>
				<option value="Pengemudi">Pengemudi</option>
				<option value="Pelajar">Pelajar</option>
				<option value="Mahasiswa">Mahasiswa</option>
				<option value="Wiraswasta">Wiraswasta</option>
				<option value="Karyawan">Karyawan</option>
				<option value="Komunitas">Komunitas</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Media</label>
			<select name="media" class="form-control" placeholder="">
				<option value="Offline">Offline</option>
				<option value="Online">Online</option>
				<option value="Onair Elektronik">Onair Elektronik</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Link</label>
			<input type="text" name="lnk" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Materi</label>
			<input type="file" name="materi" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Kesimpulan</label>
			<input type="file" name="kesimpulan" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Doc.</label>
			<input type="file" name="doc" class="form-control" placeholder="" >
		</div>
	</div>
	
</div>


<script>
jvalidate = $("#myf").validate({
    rules :{
        "formulir" : {
            required : true
        },
		"dasar" : {
            required : true
        },
		"nomor" : {
			required : true
		},
		"tempat" : {
			required : true
		},
		"tanggal" : {
			required : true
		}
    }});

$("#btn_save").show();
$(".dasar").show();
$(".nomor").show();

datepicker(true);
timepicker();

$(".is-invalid").removeClass("is-invalid");
$(".is-valid").removeClass("is-valid");

function safeform(thef){
	sendData('#myf','kamsel/save_dikmas');
}
</script>