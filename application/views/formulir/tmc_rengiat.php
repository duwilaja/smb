<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,";
$cols.="jenis,tgldari,tglsampai,jamdari,jamsampai,lokasi,sasaran,rincian,kuatpers,pic,target,lat,lng,jalan_id";

$jj=json_decode($jalan);
$jj=isset($jj->data)?$jj->data:[];
?>

<input type="hidden" name="tablename" value="tmc_rengiat">
<input type="hidden" name="fieldnames" value="<?php echo $cols?>">

<div class="row">
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Jenis</label>
			<select name="jenis" class="form-control" placeholder="">
				<option value="PAM Road Savety">PAM Road Savety</option>
				<option value="Road Savety Campaign">Road Savety Campaign</option>
				<option value="Sosialisasi">Sosialisasi</option>
				<option value="Publikasi">Publikasi</option>
				<option value="Survey">Survey</option>
				<option value="Lainnya">Lainnya</option>
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
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Sasaran</label>
			<input type="text" id="sasaran" name="sasaran" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-6">
		<div class="form-group">
			<label class="form-label">Rincian Kegiatan</label>
			<textarea id="rincian" name="rincian" class="form-control" placeholder="" ></textarea>
		</div>
	</div>
	
</div>
<div class="row">
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Lokasi</label>
			<input type="hidden" id="lokasi" name="lokasi" class="form-control" placeholder="" >
			<select id="jalan_id" name="jalan_id" class="form-control select2" placeholder="" onchange="$('#lokasi').val(this.options[this.selectedIndex].text);">
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
<div class="row">
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Jml.Personel</label>
			<input type="text" id="kuatpers" name="kuatpers" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Penanggung Jawab</label>
			<input type="text" id="pic" name="pic" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Target</label>
			<textarea id="target" name="target" class="form-control" placeholder="" ></textarea>
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