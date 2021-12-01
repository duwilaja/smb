<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,dasar,nomor,";
$cols.="instansi,deskripsi,darilat,darilng,kelat,kelng,via,tanggal,mulai,sampai,petugas";
?>

<input type="hidden" name="tablename" value="pjr_pengawalan">
<input type="hidden" name="fieldnames" value="<?php echo $cols?>">

<div class="row">
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Instansi</label>
			<input type="text" name="instansi" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Deskripsi</label>
			<textarea name="deskripsi" class="form-control" placeholder="" ></textarea>
		</div>
	</div>
	<!--div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Giat</label>
			<select name="giat" class="form-control" placeholder="">
				<option value="Unras">Unras</option>
				<option value="Konser">Konser</option>
				<option value="Pameran">Pameran</option>
				<option value="Olahraga">Olahraga</option>
				<option value="Keagamaan">Keagamaan</option>
				<option value="Pembangunan Jalan">Pembangunan Jalan</option>
			</select>
		</div>
	</div-->
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Tanggal</label>
			<input type="text" name="tanggal" class="form-control datepicker" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Mulai</label>
			<input type="text" name="mulai" class="form-control timepicker" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Sampai</label>
			<input type="text" name="sampai" class="form-control timepicker" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Dari Latitude</label>
			<input type="text" id="darilat" name="darilat" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Dari Longitude</label>
			<input type="text" id="darilng" name="darilng" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-1">
		<div class="form-group">
			<label class="form-label">&nbsp;</label>
			<button type="button" class="btn btn-icon btn-facebook" onclick="mappicker('darilat','darilng');"><i class="fa fa-map-marker"></i></button>
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Ke Latitude</label>
			<input type="text" id="kelat" name="kelat" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Ke Longitude</label>
			<input type="text" id="kelng" name="kelng" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-1">
		<div class="form-group">
			<label class="form-label">&nbsp;</label>
			<button type="button" class="btn btn-icon btn-facebook" onclick="mappicker('kelat','kelng');"><i class="fa fa-map-marker"></i></button>
		</div>
	</div>
	<div class="col-sm-6 col-md-5">
		<div class="form-group">
			<label class="form-label">Via</label>
			<textarea name="via" class="form-control" placeholder="" ></textarea>
		</div>
	</div>
	<div class="col-sm-6 col-md-5">
		<div class="form-group">
			<label class="form-label">Petugas</label>
			<input type="text" name="petugas" class="form-control" placeholder="" >
		</div>
	</div>
</div>


<script>
function mappicker(lat,lng){
	window.open(base_url+"map?latfld="+lat+"&lngfld="+lng+"&lat="+$('#'+lat).val()+"&lng="+$('#'+lng).val(),"MapWindow","width=830,height=500,location=no").focus();
}
function jenischanged(tv){
	if(tv=='Yan Aduan'){
		$(".aduan").show();
	}else{
		$("#jenisd").val("");
		$(".aduan").hide();
	}
}
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
		"instansi" : {
			required : true
		},
		"deskripsi" : {
			required : true
		},
		"tanggal" : {
			required : true
		},
		"mulai" : {
			required : true
		},
		"sampai" : {
			required : true
		},
		"darilat" : {
			required : true
		},
		"darilng" : {
			required : true
		},
		"kelat" : {
			required : true
		},
		"kelng" : {
			required : true
		},
		"via" : {
			required : true
		},
		"petugas" : {
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

</script>