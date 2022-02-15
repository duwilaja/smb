<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,";
$cols.="giat,tgldari,tglsampai,jamdari,jamsampai,jalan,lat,lng,jalan_id";

$jj=json_decode($jalan);
$jj=isset($jj->data)?$jj->data:[];
?>

<input type="hidden" name="tablename" value="tmc_data_giatpublik">
<input type="hidden" name="fieldnames" value="<?php echo $cols?>">

<div class="row">
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Giat</label>
			<select name="giat" class="form-control" placeholder="">
				<option value="SIMLing">SIMLing</option>
				<option value="SAMLing">SAMLing</option>
				<option value="Unras">Unras</option>
				<option value="Konser">Konser</option>
				<option value="Pameran">Pameran</option>
				<option value="Olahraga">Olahraga</option>
				<option value="Keagamaan">Keagamaan</option>
				<option value="Pembangunan Jalan">Pembangunan Jalan</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Dari Tgl</label>
			<input type="text" id="tgldari" name="tgldari" class="form-control datepicker" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Sampai Tgl</label>
			<input type="text" id="tglsampai" name="tglsampai" class="form-control datepicker" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Dari Jam</label>
			<input type="text" id="jamdari" name="jamdari" class="form-control timepicker" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Sampai Jam</label>
			<input type="text" id="jamsampai" name="jamsampai" class="form-control timepicker" placeholder="" >
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Jalan</label>
			<input type="hidden" id="jalan" name="jalan" class="form-control" placeholder="" >
			<select id="jalan_id" name="jalan_id" class="form-control select2" placeholder="" onchange="$('#jalan').val(this.options[this.selectedIndex].text);">
			<?php foreach($jj as $j){?>
				<option value="<?php echo $j->id?>"><?php echo $j->nama_jalan?></option>
			<?php }?>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Latitude</label>
			<input type="text" id="lat" name="lat" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
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


<script>
function mappicker(lat,lng){
	window.open(base_url+"map?lat="+$(lat).val()+"&lng="+$(lng).val(),"MapWindow","width=830,height=500,location=no").focus();
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
		"lat" : {
			required : true
		},
		"lng" : {
			required : true
		}
    }});

$("#btn_save").show();
$(".dasar").show();
$(".nomor").show();

$(".select2").select2();

datepicker(true);
timepicker();

$(".is-invalid").removeClass("is-invalid");
$(".is-valid").removeClass("is-valid");

$(".<?php echo $frid?>").attr("disabled",true);
</script>