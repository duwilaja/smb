<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,";
$cols.="kategori,obyek,obyeklain,namaob,tanggal,jam,dari,darilat,darilng,ke,kelat,kelng,status,identifikasiag,ag,identifikasigm,gm,ringkasan";
?>

<input type="hidden" name="tablename" value="tmc_ops_wal">
<input type="hidden" name="fieldnames" value="<?php echo $cols?>">

<div class="row">
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Tanggal</label>
			<input type="text" name="tanggal" class="form-control datepicker" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Jam Berangkat</label>
			<input type="text" name="jam" class="form-control timepicker" placeholder="" >
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Kategori</label>
			<select name="kategori" class="form-control" placeholder="" onclick="katechange(this.value)">
				<option value="Pengawalan VIP">Pengawalan VIP</option>
				<option value="Pengawalan Giat Masyarakat">Pengawalan Giat Masyarakat</option>
				<option value="Pengawalan Khusus">Pengawalan Khusus</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Obyek Pengawalan</label>
			<select id="obyek" name="obyek" class="form-control" placeholder="" onclick="lainnya(this.value)">
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-3 lainnya hidden">
		<div class="form-group">
			<label class="form-label">Obyek Lainnya</label>
			<input type="text" id="obyeklain" name="obyeklain" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Nama</label>
			<input type="text" name="namaob" class="form-control" placeholder="" >
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Dari</label>
			<input type="text" name="dari" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Latitude</label>
			<input type="text" id="darilat" name="darilat" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Longitude</label>
			<input type="text" id="darilng" name="darilng" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-1">
		<div class="form-group">
			<label class="form-label">&nbsp;</label>
			<button type="button" class="btn btn-danger" onclick="mappicker('darilat','darilng');"><i class="fa fa-map-marker"></i></button>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Ke</label>
			<input type="text" name="ke" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Latitude</label>
			<input type="text" id="kelat" name="kelat" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Longitude</label>
			<input type="text" id="kelng" name="kelng" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-1">
		<div class="form-group">
			<label class="form-label">&nbsp;</label>
			<button type="button" class="btn btn-danger" onclick="mappicker('kelat','kelng');"><i class="fa fa-map-marker"></i></button>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Identifikasi Ambang Gangguan</label>
			<select name="identifikasiag" class="form-control" placeholder="">
				<option value="Tidak Ada">Tidak Ada</option>
				<option value="Ada">Ada</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Ambang Gangguan</label>
			<textarea name="ag" class="form-control" placeholder="" ></textarea>
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Identifikasi Giat Masyarakat</label>
			<select name="identifikasigm" class="form-control" placeholder="">
				<option value="Tidak Ada">Tidak Ada</option>
				<option value="Ada">Ada</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Giat Masyarakat</label>
			<textarea name="gm" class="form-control" placeholder="" ></textarea>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Status Perjalanan</label>
			<select name="status" class="form-control" placeholder="">
				<option value="TKA">TKA</option>
				<option value="Macet">Macet</option>
				<option value="Padat">Padat</option>
				<option value="Lancar">Lancar</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-6">
		<div class="form-group">
			<label class="form-label">Ringkasan Hasil Giat</label>
			<textarea name="ringkasan" class="form-control" placeholder="" ></textarea>
		</div>
	</div>
</div>

<hr />
<div class="card">
	<div class="card-header">
		<h3 class="card-title">ROUTE</h3>
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
						<th>Lokasi/Jalan</th>
						<th>Estimasi Jarak</th>
						<th>Realisasi Jarak</th>
						<th>Estimasi Waktu Tempuh</th>
						<th>Realisasi Waktu</th>
						<th>Transit</th>
					</tr>
				</thead>
				<tbody>
					<tr class="route">
						<td><input type="text" name="nama[]" class="form-control" placeholder="" ></td>
						<td><input type="text" name="ejarak[]" class="form-control" placeholder="" ></td>
						<td><input type="text" name="jarak[]" class="form-control" placeholder="" ></td>
						<td><input type="text" name="ewaktu[]" class="form-control" placeholder="" ></td>
						<td><input type="text" name="waktu[]" class="form-control" placeholder="" ></td>
						<td><input type="text" name="transit[]" class="form-control" placeholder="" ></td>
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
	sendData('#myf',"laporan/save_ops_wal");
}

var cntr=0;
function klon(){
	cntr++;
	$("select.select2").select2("destroy").removeAttr("data-select2-id");
	$("select.select2 option").removeAttr("data-select2-id");
	$("td").removeAttr("data-select2-id");
	var row = $(".route");
	
    var newrow = row.clone();
	newrow.removeClass("route").find('#gangguan_0').attr("id","gangguan_"+cntr);
	newrow.find("input").val("");
	newrow.find("select.select2").on("change",function(){
		//console.log("i="+cntr+$(this).val());
		$("#gangguan_"+cntr).val($(this).val());
	});
	
	$("tbody").append(newrow);
	$("select.select2").select2();
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