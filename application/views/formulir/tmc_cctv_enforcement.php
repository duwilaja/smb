<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,";
$cols.="jam,jalan,lat,lng,jenis,pelanggaran,nopol,uploadedfile";
?>

<input type="hidden" name="tablename" value="tmc_cctv_enforcement">
<input type="hidden" name="fieldnames" value="<?php echo $cols?>">
<input type="hidden" name="kategori" value="enforce">

<div class="row">
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Kategori Pelanggaran</label>
			<select name="pelanggaran" class="form-select" placeholder="" onchange="katechange(this.value);">
				<option value="Lalu Lintas">Lalu Lintas</option>
				<option value="Perda">Perda</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-5">
		<div class="form-group">
			<label class="form-label">Jenis Pelanggaran</label>
			<select name="jenis" id="jenis" class="form-select" placeholder="">
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-2 nopol">
		<div class="form-group">
			<label class="form-label">Nopol</label>
			<input type="text" id="nopol" name="nopol" class="form-control" placeholder="" >
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Jam</label>
			<input type="text" name="jam" class="form-control timepicker" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Lokasi/Jalan</label>
			<input type="text" name="jalan" class="form-control" placeholder="" >
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
	<div class="col-sm-6 col-md-6">
		<div class="form-group files">
			<label class="form-label">Foto/Video</label>
			<input type="file" name="uploadedfile[]" class="form-control file" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-1">
		<label class="form-label">&nbsp;</label>
		<button type="button" class="btn btn-danger" onclick="$('.files').append($('.file').clone().removeClass('file'));"><i class="fa fa-copy"></i></button>
	</div>
</div>


<script>
function mappicker(lat,lng){
	window.open(base_url+"map?lat="+$(lat).val()+"&lng="+$(lng).val(),"MapWindow","width=830,height=500,location=no").focus();
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
		"tempat" : {
			required : true
		},
		"tanggal" : {
			required : true
		}
    }});

$("#btn_save").show();
$(".dasar").show();
$(".nomor").show();

datepicker(true);
timepicker();
$(".select2").select2();

$(".is-invalid").removeClass("is-invalid");
$(".is-valid").removeClass("is-valid");

katechange("");

function safeform(thef){
	sendData('#myf','PublicService/save');
}

function katechange(tv){
	$("#jenis").find('option').remove();
	var optlalin=["Pelanggaran garis penyeberangan (Zebra Cross)","Pelanggaran lampu APL","Pelanggaran Penggunaan Handphone saat mengemudi",
	"Pelanggaran Batas Kecepatan (Speeding)","Tidak menggunakan Sabuk Pengaman"];
	var optperda=["Tertib Pajak Kendaraan Bermotor","Terib Jalan dan Angkutan Jalan","Tertib Jalur Hijau, Taman & Tempat Umum",
	"Tertib Usaha & Tempat Usaha","Tertib Tempat Hiburan & Keramaian"];
	var opt=optlalin;
	if(tv=='Perda'){
		opt=optperda;
		$(".nopol").hide();
		$("#nopol").val("");
	}else{
		$(".nopol").show();
	}
	var s='';
	for(var i=0;i<opt.length;i++){
		s+='<option value="'+opt[i]+'">'+opt[i]+'</option>';
	}
	$("#jenis").append(s);
}
</script>