<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,dasar,nomor,";
$cols.="jenis,nama,gangguan,lat,lng";
?>

<input type="hidden" name="tablename" value="ssc_status_gangguan">
<input type="hidden" name="fieldnames" value="<?php echo $cols?>">

<div class="row">
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Jenis Jalan</label>
			<select name="jenis" class="form-control" placeholder="">
				<option value="Jalan Nasional">Jalan Nasional</option>
				<option value="Jalan Provinsi">Jalan Provinsi</option>
				<option value="Jalan Kota">Jalan Kota</option>
				<option value="Jalan Kabupaten">Jalan Kabupaten</option>
				<option value="Jalan Tol">Jalan Tol</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-5">
		<div class="form-group">
			<label class="form-label">Nama Jalan</label>
			<input type="text" name="nama" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Jenis Gangguan</label>
			<select name="gangguan" class="form-control" placeholder="">
				<option value="Black Spot">Black Spot</option>
				<option value="Trouble Spot">Trouble Spot</option>
				<option value="Tindak Pidana">Tindak Pidana</option>
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
			<button type="button" class="btn btn-icon btn-facebook" onclick="mappicker('#lat','#lng');"><i class="fa fa-map-marker"></i></button>
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

</script>