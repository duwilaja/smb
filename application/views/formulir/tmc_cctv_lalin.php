<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,";
$cols.="situasi,kejadian,jalan,status,mulai,sampai,sebab,petugas,callsign,lat,lng,ket,uploadedfile";
?>

<input type="hidden" name="tablename" value="tmc_cctv_lalin">
<input type="hidden" name="fieldnames" value="<?php echo $cols?>">
<input type="hidden" name="path" value="cctv/lalin/">

<div class="row">
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Situasi Lalin</label>
			<select name="situasi" class="form-select" placeholder="" onchange="">
				<option value="Lancar">Lancar</option>
				<option value="Padat">Padat</option>
				<option value="Macet">Macet</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Kejadian Terpantau</label>
			<select id="kejadian" name="kejadian" class="form-select" placeholder="">
				<option value="Nihil">Nihil</option>
				<option value="Kemacetan">Kemacetan</option>
				<option value="Demo">Demo</option>
				<option value="Laka">Laka</option>
				<option value="Langgar">Langgar</option>
				<option value="TindakPidana">Tindak Pidana</option>
			</select>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Lokasi</label>
			<!--input type="text" name="jalan" class="form-control" placeholder="" -->
			<select id="jalan" name="jalan" class="form-select" placeholder="" onchange="jalanberubah();">
			<option value=""></option>
		<?php foreach($cctvs  as $cctv){?>
			<option value="<?php echo $cctv['nama_cctv']?>"><?php echo $cctv['nama_cctv']?></option>
		<?php }?>
			</select>
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
	<div class="col-sm-6 col-md-1">
		<div class="form-group">
			<label class="form-label">&nbsp;</label>
			<button type="button" class="btn btn-icon btn-facebook" onclick="mappicker('#lat','#lng');"><i class="fa fa-map-marker"></i></button>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Status Penggal Jalan</label>
			<select name="status" id="penggal" class="form-select" placeholder="">
				<option value="None">None</option>
				<option value="Rawan Bencana">Rawan Bencana</option>
				<option value="Black Spot">Black Spot</option>
				<option value="Trouble Spot">Trouble Spot</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Jam Mulai</label>
			<input type="text" id="mulai" name="mulai" class="form-control timepicker" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Sampai</label>
			<input type="text" id="sampai" name="sampai" class="form-control timepicker" placeholder="" >
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Penyebab</label>
	<?php
$penyebab['']='';
$opt=array('class'=>'form-select','id'=>'sebab');
echo form_dropdown('sebab', array_reverse($penyebab,true), '',$opt);
?>
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Keterangan</label>
			<textarea name="ket" class="form-control" placeholder="" ></textarea>
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group files">
			<label class="form-label">Foto/Video</label>
			<input type="file" name="uploadedfile[]" class="form-control file" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-1">
		<label class="form-label">&nbsp;</label>
		<button type="button" class="btn btn-icon btn-facebook" onclick="$('.files').append($('.file').clone().removeClass('file'));"><i class="fa fa-copy"></i></button>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Petugas Lapangan</label>
			<input type="text" id="petugas" name="petugas" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">CallSign</label>
			<input type="text" id="callsign" name="callsign" class="form-control" placeholder="" >
		</div>
	</div>
</div>


<script>
var cctvs=<?php echo json_encode($cctvs)?>;

function jalanberubah(){
	var idx=$("#jalan").prop('selectedIndex');
	if(idx>0){
		var kord=cctvs[idx-1]['kordinat'];
		var latlng=kord.split(",");
		$("#lat").val(latlng[0]);
		$("#lng").val(latlng[1]);
	}else{
		$("#lat").val("");
		$("#lng").val("");
	}
}
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
		$("#kejadian").val("Kemacetan");
	}else{
		$("#sebab").val("");
		$("#penggal").val("");
		$("#callsign").val("");
		$("#mulai").val("");
		$("#sampai").val("");
		$("#petugas").val("");
		$("#kejadian").val("");
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
	$(".<?php echo $frid?>").attr("disabled",true);
</script>