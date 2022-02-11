<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,dasar,nomor,";
$cols.="giat,tempat,tanggal,peserta,lnk,pemateri1,pemateri2,pemateri3,pemateri4";
?>

<input type="hidden" name="tablename" value="kamsel_audit">
<input type="hidden" name="fieldnames" value="<?php echo $cols?>">

<div class="row">
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Giat</label>
			<select name="giat" class="form-select" placeholder="">
				<option value="RSPA">RSPA</option>
				<option value="ANALISA DAMPAK LALU LINTAS">ANALISA DAMPAK LALU LINTAS</option>
				<option value="TARC">TARC</option>
				<option value="RISET DAN HIBAH RISET">RISET DAN HIBAH RISET</option>
				<option value="FGD DAN SEMINAR">FGD DAN SEMINAR</option>
				<option value="JURNAL">JURNAL</option>
				<option value="RSRDC DAN LABORATORIUM ROAD SAFETY">RSRDC DAN LABORATORIUM ROAD SAFETY</option>
				<option value="AUDIT KECEPATAN">AUDIT KECEPATAN</option>
				<option value="IRSMM">IRSMM</option>
				<option value="AUDIT ROAD SAFETY POLICING">AUDIT ROAD SAFETY POLICING</option>
				<option value="PELATIHAN ANDALALIN">PELATIHAN ANDALALIN</option>
				<option value="PELATIHAN KEGIATAN RISET">PELATIHAN KEGIATAN RISET </option>
				<option value="INDEKS ROAD SAFETY">INDEKS ROAD SAFETY</option>
				<option value="BENCH MARK">BENCH MARK</option>
				<option value="AUDIT PELAYANAN PUBLIK">AUDIT PELAYANAN PUBLIK </option>
				<option value="SMART MANAGEMENT SYSTEM">SMART MANAGEMENT SYSTEM</option>
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
			<label class="form-label">Jml. Peserta</label>
			<input type="text" name="peserta" class="form-control" placeholder="" >
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Pemateri 1</label>
			<input type="text" name="pemateri1" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Doc Materi 1</label>
			<input type="file" name="materi1" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Pemateri 2</label>
			<input type="text" name="pemateri2" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Doc Materi 2</label>
			<input type="file" name="materi2" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Pemateri 3</label>
			<input type="text" name="pemateri3" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Doc Materi 3</label>
			<input type="file" name="materi3" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Pemateri 4</label>
			<input type="text" name="pemateri4" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Doc Materi 4</label>
			<input type="file" name="materi4" class="form-control" placeholder="" >
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Run Down Acara</label>
			<input type="file" name="rundown" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Notulen</label>
			<input type="file" name="notulen" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Kesimpulan & Rekomendasi</label>
			<input type="file" name="kesimpulan" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Doc. Kegiatan</label>
			<input type="file" name="doc" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Link</label>
			<input type="text" name="lnk" class="form-control" placeholder="" >
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
	sendData('#myf','kamsel/save_audit');
}
</script>