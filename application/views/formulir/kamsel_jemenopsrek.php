<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,dasar,nomor,";
$cols.="giat,tempat,tanggal,peserta,lnk,pemateri1,pemateri2,pemateri3,pemateri4";
?>

<input type="hidden" name="tablename" value="kamsel_jemenopsrek">
<input type="hidden" name="fieldnames" value="<?php echo $cols?>">

<div class="row">
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Giat</label>
			<select name="giat" class="form-control" placeholder="">
				<option value="KAJIAN PARIWISATA">KAJIAN PARIWISATA</option>
				<option value="KAJIAN TOL">KAJIAN TOL</option>
				<option value="KAJIAN KAWASAN INDUSTRI">KAJIAN KAWASAN INDUSTRI</option>
				<option value="KAJIAN ASDP">KAJIAN ASDP</option>
				<option value="KAJIAN PERBATASAN">KAJIAN PERBATASAN</option>
				<option value="KAJIAN IKN">KAJIAN IKN</option>
				<option value="KAJIAN BLACK SPOT DAN TROUBLE SPOT">KAJIAN BLACK SPOT DAN TROUBLE SPOT</option>
				<option value="ALGORITMA ROAD SAFETY">ALGORITMA ROAD SAFETY</option>
				<option value="KAJIAN SDC">KAJIAN SDC</option>
				<option value="KAJIAN ANTAR MODA TRANSPORTASI">KAJIAN ANTAR MODA TRANSPORTASI</option>
				<option value="KAJIAN LRT MRT KCI ">KAJIAN LRT MRT KCI </option>
				<option value="KAJIAN SMART CITY / SUISTANABLE CITY">KAJIAN SMART CITY / SUISTANABLE CITY</option>
				<option value="KAJIAN SISPAM KOTA">KAJIAN SISPAM KOTA </option>
				<option value="KAJIAN OBYEK VITAL">KAJIAN OBYEK VITAL </option>
				<option value="BENCH MARK">BENCH MARK </option>
				<option value="SEMINAR DAN PENERBITAN PRODUK">SEMINAR DAN PENERBITAN PRODUK </option>
				<option value="PELATIHAN">PELATIHAN</option>
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
			<label class="form-label">Kesimpulan</label>
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
	sendData('#myf','kamsel/save_jemenopsrek');
}
</script>