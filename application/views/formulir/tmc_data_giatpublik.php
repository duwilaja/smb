<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,";
$cols.="giat,tgldari,tglsampai,jamdari,jamsampai,jalan,lat,lng";
?>

<input type="hidden" name="tablename" value="tmc_data_giatpublik">
<input type="hidden" name="fieldnames" value="<?php echo $cols?>">

<!--div class="row">
<div class="col-lg-12">
	<div class="btn-list">
		<?php 
		$keys=array_keys($subm);
		$values=array_values($subm);
		for($i=0;$i<count($keys);$i++){
		?>
		<button type="button" class="btn btn-warning btn-pill <?php echo $keys[$i]?>" onclick="ambil_isi('<?php echo $keys[$i]?>');"><i class="fa fa-list-alt"></i> <?php echo $values[$i]?></button>
		<?php } ?>
	</div>
</div>
</div>
<hr /-->

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
			<input type="text" id="jalan" name="jalan" class="form-control" placeholder="" >
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
			<button type="button" class="btn btn-icon btn-facebook" onclick="mappicker('#lat','#lng');"><i class="fa fa-map-marker"></i></button>
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

datepicker(true);
timepicker();

$(".is-invalid").removeClass("is-invalid");
$(".is-valid").removeClass("is-valid");

$(".<?php echo $frid?>").attr("disabled",true);
</script>