<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,";
$cols.="objek,terdeteksi,nopol,posisik,waktuk,nama,jk,posisio,waktuo,uploadedfile,lat,lng";
?>

<input type="hidden" name="tablename" value="tmc_cctv_object">
<input type="hidden" name="fieldnames" value="<?php echo $cols?>">
<input type="hidden" name="path" value="cctv/obj/">

<div class="row">
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Objek</label>
			<select id="objek" name="objek" class="form-select" placeholder="" onchange="macetgak();">
				<option value="Kendaraan">Kendaraan</option>
				<option value="Orang">Orang</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Terdeteksi</label>
			<select id="terdeteksi" name="terdeteksi" class="form-select" placeholder="" onchange="macetgak();">
				<option value="Tidak Ada">Tidak Ada</option>
				<option value="Ada">Ada</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-4 ada">
		<div class="form-group files">
			<label class="form-label">Foto/Video</label>
			<input type="file" name="uploadedfile[]" class="form-control file" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-1 ada">
		<label class="form-label">&nbsp;</label>
		<button type="button" class="btn btn-icon btn-facebook" onclick="$('.files').append($('.file').clone().removeClass('file'));"><i class="fa fa-copy"></i></button>
	</div>
</div>
<div class="row ada">
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Latitude</label>
			<input type="text" id="lat" name="lat" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Longitude</label>
			<input type="text" id="lng" name="lng" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-1">
		<div class="form-group">
			<label class="form-label">&nbsp;</label>
			<button type="button" class="btn btn-danger" onclick="mappicker('#lat','#lng');"><i class="fa fa-map-marker"></i></button>
		</div>
	</div>
</div>
<div class="row kendaraan">
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Nopol</label>
			<input type="text" id="nopol" name="nopol" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Posisi</label>
			<input type="text" id="posisik" name="posisik" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Waktu</label>
			<input type="text" id="waktuk" name="waktuk" class="form-control timepicker" placeholder="" >
		</div>
	</div>
</div>
<div class="row orang">
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Nama</label>
			<input type="text" id="nama" name="nama" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">JK</label>
			<select id="jk" name="jk" class="form-select" placeholder="">
				<option value=""></option>
				<option value="Pria">Pria</option>
				<option value="Wanita">Wanita</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Posisi</label>
			<input type="text" id="posisio" name="posisio" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Waktu</label>
			<input type="text" id="waktuo" name="waktuo" class="form-control timepicker" placeholder="" >
		</div>
	</div>
</div>
<script>
function mappicker(lat,lng){
	window.open(base_url+"map?lat="+$(lat).val()+"&lng="+$(lng).val(),"MapWindow","width=830,height=500,location=no").focus();
}
function lainnyabukan(tv){
	if(tv=='Lainnya'){
		$(".lainnya").show();
	}else{
		$("#lainnya").val("");
		$(".lainnya").hide();
	}
}
function macetgak(){
	var tv=$("#terdeteksi").val();
	if(tv=='Ada'){
		if($("#objek").val()=="Kendaraan"){
			$("#nama").val("");
			$("#jk").val("");
			$("#posisio").val("");
			$("#waktuo").val("");
			$(".orang").hide();
			$(".kendaraan").show();
		}else{
			$("#nopol").val("");
			$("#posisik").val("");
			$("#waktuk").val("");
			$(".kendaraan").hide();
			$(".orang").show();
		}
		$(".ada").show();
	}else{
		$("#nopol").val("");
		$("#posisik").val("");
		$("#waktuk").val("");
		$("#nama").val("");
		$("#jk").val("");
		$("#posisio").val("");
		$("#waktuo").val("");
		$("#lat").val("");
		$("#lng").val("");
		$(".kendaraan").hide();
		$(".orang").hide();
		$(".ada").hide();
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
		"namajalan" : {
			required : true
		}
    }});

$("#btn_save").show();
$(".dasar").show();
$(".nomor").show();

datepicker(true);
timepicker();
macetgak('');

	$(".is-invalid").removeClass("is-invalid");
	$(".is-valid").removeClass("is-valid");

	$(".<?php echo $frid?>").attr("disabled",true);
</script>