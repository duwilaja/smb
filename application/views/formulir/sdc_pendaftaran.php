<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,dasar,nomor,";
$cols.="nama,jk,tmpl,tgll,idtt,pek,pers,lic,stl,pelg,kecl,ctt,trainer,materi,trmulai,trsampai";
?>

<input type="hidden" name="tablename" value="sdc_pendaftaran">
<input type="hidden" name="fieldnames" value="<?php echo $cols?>">

<div class="row">
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Nama</label>
			<input type="text" name="nama" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Gender</label>
			<select name="jk" class="form-control" placeholder="">
				<option value="L">L</option>
				<option value="P">P</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Tempat Lahir</label>
			<input type="text" name="tmpl" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Tgl Lahir</label>
			<input type="text" name="tgll" class="form-control datepicker" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Identitas</label>
			<select name="idtt" class="form-control" placeholder="">
				<option value="KTP">KTP</option>
				<option value="SIM Lama">SIM Lama</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Pekerjaan</label>
			<input type="text" name="pek" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Perusahaan</label>
			<input type="text" name="pers" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Lisensi Mengemudi</label>
			<select name="lic" class="form-control" placeholder="">
				<option value="A">A</option>
				<option value="C">C</option>
				<option value="B">B</option>
				<option value="B1">B1</option>
				<option value="B2">B2</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Status Lisensi</label>
			<select name="stl" class="form-control" placeholder="" onchange="stlchanged(this.value);">
				<option value="Baru">Baru</option>
				<option value="Perpanjangan">Perpanjangan</option>
				<option value="DPS">DPS</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-2 dps hidden">
		<div class="form-group">
			<label class="form-label">Pelanggaran</label>
			<input type="text" name="pelg" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2 dps hidden">
		<div class="form-group">
			<label class="form-label">Kecelakaan</label>
			<input type="text" name="kecl" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Catatan</label>
			<textarea class="form-control" name="ctt"></textarea>
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Trainer</label>
			<input type="text" name="trainer" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Materi</label>
			<input type="text" name="materi" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Mulai</label>
			<input type="text" name="trmulai" class="form-control datepicker" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Sampai</label>
			<input type="text" name="trsampai" class="form-control datepicker" placeholder="" >
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
		"nama" : {
			required : true
		},
		"panjang" : {
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

function mappicker(lat,lng){
	window.open(base_url+"map?lat="+$(lat).val()+"&lng="+$(lng).val(),"MapWindow","width=830,height=500,location=no").focus();
}
function stlchanged(tv){
	if(tv=="DPS"){
		$(".dps").show();
	}else{
		$(".dps").hide();
		$("#kecl").val("");
		$("#pelg").val("");
	}
}
</script>