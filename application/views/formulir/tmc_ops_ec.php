<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,";
$cols.="kejadian,lokasi,lat,lng,jam,dampak,radius,kebutuhan,ket,md,lb,pengungsi";
?>

<input type="hidden" name="tablename" value="tmc_ops_ec">
<input type="hidden" name="fieldnames" value="<?php echo $cols?>">

<div class="row">
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Jam</label>
			<input type="text" name="jam" class="form-control timepicker" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Kejadian</label>
			<select name="kejadian" class="form-control" placeholder="">
				<option value="Kebakaran">Kebakaran</option>
				<option value="Bencana Alam">Bencana Alam</option>
				<option value="Kerusuhan">Kerusuhan</option>
				<option value="Terorisme">Terorisme</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Nama Lokasi/Jalan</label>
			<input type="text" name="lokasi" class="form-control" placeholder="" >
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
			<button type="button" class="btn btn-danger" onclick="mappicker('lat','lng');"><i class="fa fa-map-marker"></i></button>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Dampak</label>
			<select name="dampak[]" class="form-control select2" placeholder="" multiple style="width:100%;">
				<option value="Kemacetan">Kemacetan</option>
				<option value="Arus Pengungsi">Arus Pengungsi</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Radius Terdampak</label>
			<select name="radius" class="form-control" placeholder="">
				<option value="100-500m">100-500m</option>
				<option value="600-1000m">600-1000m</option>
				<option value="1-5km">1-5km</option>
				<option value="6-10km">6-10km</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Kebutuhan</label>
			<select name="kebutuhan[]" class="form-control select2" placeholder="" multiple style="width:100%;">
				<option value="Tindakan Penyelamatan">Tindakan Penyelamatan</option>
				<option value="Alat Komunikasi">Alat Komunikasi</option>
				<option value="Makanan">Makanan</option>
				<option value="Pakaian">Pakaian</option>
				<option value="Obat Obatan">Obat Obatan</option>
				<option value="Tempat Penampungan">Tempat Penampungan</option>
			</select>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Jml Korban MD</label>
			<input type="text" name="md" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Jml Luka Berat</label>
			<input type="text" name="lb" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Estimai Pengungsi</label>
			<input type="text" name="pengungsi" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Keterangan</label>
			<textarea name="ket" class="form-control" placeholder="" ></textarea>
		</div>
	</div>
</div>

<hr />
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Fasilitas Kedaruratan</h3>
		<div class="card-options ">
			<button type="button" class="btn btn-primary pull-right" onclick="klon();"><i class="fa fa-plus"></i></button>
			&nbsp;
			<button type="button" class="btn btn-danger pull-right" onclick="delet();"><i class="fa fa-minus"></i></button>
			
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="mytbl" class="table table-striped table-bordered w-100">
				<thead>
					<tr>
						<th>Jenis</th>
						<th>Nama</th>
						<th>Lokasi/Jalan</th>
						<th>Call Center</th>
						<th>Koordinat</th>
					</tr>
				</thead>
				<tbody>
					<tr class="route">
						<td>
							<select name="jenis[]" class="form-control" placeholder="">
								<option value="Rumah Sakit">Rumah Sakit</option>
								<option value="Titik Penampungan">Titik Penampungan</option>
								<option value="Posko Koordinasi">Posko Koordinasi</option>
								<option value="Posko Bantuan">Posko Bantuan</option>
								<option value="Posko Relawan">Posko Relawan</option>
							</select>
						</td>
						<td><input type="text" name="nama[]" class="form-control" placeholder="" ></td>
						<td><input type="text" name="alamat[]" class="form-control" placeholder="" ></td>
						<td><input type="text" name="cc[]" class="form-control" placeholder="" ></td>
						<td><input type="text" name="latx[]" id="lat_0" class="form-control lat" placeholder="" >
						<input type="text" name="lngx[]" id="lng_0" class="form-control lng" placeholder="" >
			<button type="button" class="btn btn-danger btn-map" onclick="mappicker('lat_0','lng_0');"><i class="fa fa-map-marker"></i></button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modal-->
<div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left modal_form">
  <div role="document" class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header"><strong id="exampleModalLabel" class="modal-title">Ambang Gangguan</strong>
		<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">x</span></button>
	  </div>
	  <div class="modal-body">
		
	  </div>
	  <div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>		
	  </div>
	</div>
  </div>
</div>

<script>
function katechange(tv){
	$("#obyek").find('option').remove();
	var optvip=["Acara Kenegaraan","Tamu Negara","Lainnya"];
	var optmas=["Rombongan","Festival","Komunitas","Lainnya"];
	var optsus=["Muatan Berbahaya","Emergency","Lainnya"];
	var opt=optvip;
	if(tv=='Pengawalan Giat Masyarakat'){
		opt=optmas;
	}
	if(tv=='Pengawalan Khusus'){
		opt=optsus;
	}
	var s='';
	for(var i=0;i<opt.length;i++){
		s+='<option value="'+opt[i]+'">'+opt[i]+'</option>';
	}
	$("#obyek").append(s);
	lainnya($("#obyek").val());
}

function mappicker(lat,lng){
	var latv=$('#'+lat).val();
	var lngv=$('#'+lng).val();
	window.open(base_url+"map?latfld="+lat+"&lngfld="+lng+"&lat="+latv+"&lng="+lngv,"MapWindow","width=830,height=500,location=no").focus();
}
function lainnya(tv){
	if(tv=='Lainnya'){
		$(".lainnya").show();
	}else{
		$("#obyeklain").val("");
		$(".lainnya").hide();
	}
}
function safeform(thef){
	sendData('#myf',"laporan/save_ops_ec");
}

var cntr=0;
function klon(){
	cntr++;
//	$("select.select2").select2("destroy").removeAttr("data-select2-id");
//	$("select.select2 option").removeAttr("data-select2-id");
//	$("td").removeAttr("data-select2-id");
	var row = $(".route");
	
    var newrow = row.clone();
	newrow.removeClass("route");
	newrow.find('#lat_0').attr("id","lat_"+cntr);
	newrow.find('#lng_0').attr("id","lng_"+cntr);
	newrow.find("input").val("");
	//newrow.find("select.select2").on("change",function(){
		//console.log("i="+cntr+$(this).val());
		//$("#gangguan_"+cntr).val($(this).val());
	//});
	newrow.find("button.btn-map").on("click",function(){
		//console.log("i="+cntr+$(this).val());
		mappicker("lat_"+cntr,"lng_"+cntr);
	});
	
	$("tbody").append(newrow);
	//$("select.select2").select2();
}
var $tbody = $("#mytbl tbody");
function delet(){
    var $last = $tbody.find('tr:last');
    if($last.is(':first-child')){
        //alert('last is the only one')
    }else {
        $last.remove();
		cntr--;
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
$(".select2").select2({});
$('input[name="gangguan[]"]').attr("id","gangguan_0");


$(".is-invalid").removeClass("is-invalid");
$(".is-valid").removeClass("is-valid");

$("select.select2").on("change",function(){
//console.log("i="+cntr+$(this).val());
$("#gangguan_0").val($(this).val());
});

katechange('');
</script>