<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,dasar,nomor,";
$cols.="namajalan,lat,lng,status,jammulai,jamsampai,penyebab,penyebabd,lainnya,statuspenggaljalan,sumber,petugas,tindakan";
?>

<input type="hidden" name="tablename" value="tmc_info_lalin">
<input type="hidden" name="fieldnames" value="<?php echo $cols?>">

<div class="row">
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Nama Jalan</label>
			<input type="text" name="namajalan" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Latitude</label>
			<input type="text" id="lat" name="lat" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Longitude</label>
			<input type="text" id="lng" name="lng" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">&nbsp;</label>
			<button type="button" class="btn btn-icon btn-facebook" onclick="mappicker('#lat','#lng');"><i class="fa fa-map-marker"></i></button>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Status</label>
			<select name="status" class="form-control" placeholder="" onchange="macetgak(this.value);">
				<option value="Lancar">Lancar</option>
				<option value="Padat">Padat</option>
				<option value="Macet">Macet</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Jam Mulai</label>
			<input type="text" name="jammulai" class="form-control timepicker" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Sampai</label>
			<input type="text" name="jamsampai" class="form-control timepicker" placeholder="" >
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-md-4 macet">
		<div class="form-group">
			<label class="form-label">Penyebab</label>
	<?php
$penyebab['']='';
$opt=array('class'=>'form-control','id'=>'penyebab','onchange'=>"getSubQ('laporan/get_subq',this.value,'#penyebabd','','','penyebab_macet_d','detil as v,detil as t','sebab');");
echo form_dropdown('penyebab', array_reverse($penyebab,true), '',$opt);
?>
		</div>
	</div>
	<div class="col-sm-6 col-md-4 macet">
		<div class="form-group">
			<label class="form-label">Detil</label>
			<select name="penyebabd" id="penyebabd" class="form-control" placeholder="" onchange="lainnyabukan(this.value);">
			<option value=""></option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-4 lainnya hidden">
		<div class="form-group">
			<label class="form-label">Lainnya</label>
			<input type="text" name="lainnya" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Petugas Lapangan</label>
			<input type="text" name="petugas" class="form-control" placeholder="" >
		</div>
	</div>

	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Status Penggal Jalan</label>
			<select name="statuspenggaljalan" class="form-control" placeholder="">
				<option value="None">None</option>
				<option value="Black Spot">Black Spot</option>
				<option value="Trouble Spot">Trouble Spot</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Sumber Info</label>
			<select name="sumber" class="form-control" placeholder="">
				<option value="Lap. Masyarakat">Lap. Masyarakat</option>
				<option value="Patroli CCTV">Patroli CCTV</option>
				<option value="Turjagwali">Turjagwali</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Tindakan</label>
			<textarea name="tindakan" class="form-control" placeholder="" ></textarea>
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
function macetgak(tv){
	if(tv=='Macet'){
		$(".macet").show();
	}else{
		$("#penyebab").val("");
		$("#penyebabd").val("");
		$("#lainnya").val("");
		$(".lainnya").hide();
		$(".macet").hide();
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

</script>