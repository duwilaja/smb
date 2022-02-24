<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,dasar,nomor,";
$cols.="media,jenis,jenisd,ket,lat,lng";
?>

<input type="hidden" name="tablename" value="tmc_interaksi">
<input type="hidden" name="fieldnames" value="<?php echo $cols?>">

<div class="row">
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Media</label>
			<select name="media" class="form-select" placeholder="">
<?php for($i=0;$i<count($media);$i++){?>
<option value="<?php echo $media[$i]['val']?>"><?php echo $media[$i]['txt']?></option>
<?php }?>
				<!--option value="Facebook">Facebook</option>
				<option value="Tweeter">Tweeter</option>
				<option value="Youtube">Youtube</option>
				<option value="Instagram">Instagram</option>
				<option value="Tiktok">Tiktok</option>
				<option value="Website">Website</option>
				<option value="Center">Center</option-->
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Jenis</label>
			<select name="jenis" class="form-select" placeholder="" onchange="jenischanged(this.value)">
<?php for($i=0;$i<count($jenisinteraksi);$i++){?>
<option value="<?php echo $jenisinteraksi[$i]['val']?>"><?php echo $jenisinteraksi[$i]['txt']?></option>
<?php }?>
				<!--option value="Komplain">Komplain</option>
				<option value="Konsultasi">Konsultasi</option>
				<option value="Apresiasi">Apresiasi</option>
				<option value="Saran">Saran</option>
				<option value="Yan Aduan">Yan Aduan</option-->
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-3 aduan hidden">
		<div class="form-group">
			<label class="form-label">Aduan...</label>
			<select name="jenisd" id="jenisd" class="form-select" placeholder="">
				<option value=""></option>
				<!--option value="Kemacetan">Kemacetan</option>
				<option value="Kecelakaan">Kecelakaan</option>
				<option value="Tindak Pidana">Tindak Pidana</option>
				<option value="Kebakaran">Kebakaran</option>
				<option value="Bencana Alam">Bencana Alam</option>
				<option value="Gangguan APLL">Gangguan APLL</option-->
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Ket.</label>
			<textarea name="ket" class="form-control"></textarea>
		</div>
	</div>
	<div class="col-sm-6 col-md-2 aduan hidden">
		<div class="form-group">
			<label class="form-label">Latitude</label>
			<input type="text" id="lat" name="lat" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2 aduan hidden">
		<div class="form-group">
			<label class="form-label">Longitude</label>
			<input type="text" id="lng" name="lng" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-1 aduan hidden">
		<div class="form-group">
			<label class="form-label">&nbsp;</label>
			<button type="button" class="btn btn-danger" onclick="mappicker('#lat','#lng');"><i class="fa fa-map-marker"></i></button>
		</div>
	</div>
</div>


<script>
function mappicker(lat,lng){
	window.open(base_url+"map?lat="+$(lat).val()+"&lng="+$(lng).val(),"MapWindow","width=830,height=500,location=no").focus();
}
function jenischanged(tv){
	if(tv=='Yan Aduan'){
		$(".aduan").show();
		getSubQ('laporan/get_subq',tv,'#jenisd','','','lov','val as v,txt as t','grp');
	}else{
		$("#jenisd").val("");
		$("#lat").val("");
		$("#lng").val("");
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
		"media" : {
			required : true
		},
		"jenis" : {
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