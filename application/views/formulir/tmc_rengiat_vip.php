<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,";
$cols.="obyek,obyeklain,pejabat,tanggal,jam,dari,darinama,ke,kenama,wasdal,anggota1,anggota2,anggota3";
?>

<input type="hidden" name="tablename" value="tmc_rengiat_vip">
<input type="hidden" name="fieldnames" value="<?php echo $cols?>">
<input type="hidden" name="rengiatid" id="rengiatid" value="">

<div class="row">
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Obyek Pengawalan</label>
			<select name="obyek" class="form-select" placeholder="" onclick="lainnya(this.value)">
				<option value="Kunjungan Kerja">Kunjungan Kerja</option>
				<option value="Acara Kenegaraan">Acara Kenegaraan</option>
				<option value="Lainnya">Lainnya</option>
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
			<label class="form-label">Nama Pejabat</label>
			<input type="text" name="pejabat" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Tanggal</label>
			<input type="text" name="tanggal" class="form-control datepicker" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Jam</label>
			<input type="text" name="jam" class="form-control timepicker" placeholder="" >
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Dari</label>
			<select name="dari" class="form-select" placeholder="">
				<option value="Bandara">Bandara</option>
				<option value="Hotel">Hotel</option>
				<option value="Gedung Pemerintah">Gedung Pemerintah</option>
				<option value="Lainnya">Lainnya</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Sebutkan</label>
			<input type="text" name="darinama" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Ke</label>
			<select name="ke" class="form-select" placeholder="">
				<option value="Bandara">Bandara</option>
				<option value="Hotel">Hotel</option>
				<option value="Gedung Pemerintah">Gedung Pemerintah</option>
				<option value="Lainnya">Lainnya</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Sebutkan</label>
			<input type="text" name="kenama" class="form-control" placeholder="" >
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Perwira WasDal</label>
			<input type="text" name="wasdal" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Anggota 1</label>
			<input type="text" name="anggota1" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Anggota 2</label>
			<input type="text" name="anggota2" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Anggota 3</label>
			<input type="text" name="anggota3" class="form-control" placeholder="" >
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
						<th>Identifikasi Ambang Gangguan</th>
						<th>Estimasi Jarak</th>
						<th>Estimasi Waktu Tempuh</th>
						<th>Rencana Transit</th>
						<th>Lat/Lng</th>
					</tr>
				</thead>
				<tbody>
					<tr class="route">
						<td><input type="text" name="nama[]" class="form-control" placeholder="" ></td>
						<td>
						<?php
						//$selected_specs=explode(";",$session['specs']);
$opt=array('class'=>'form-select select2','multiple'=>'multiple','onchange'=>"",'style'=>"width:100%;");
echo form_dropdown('ganggu', $gangguan, array(),$opt);
echo form_hidden('gangguan[]','');
						?>
						</td>
						<td><input type="text" name="ejarak[]" class="form-control" placeholder="" ></td>
						<td><input type="text" name="ewaktu[]" class="form-control" placeholder="" ></td>
						<td><input type="text" name="transit[]" class="form-control" placeholder="" ></td>
						<td><input type="text" name="lat[]" id="lat_0" class="form-control lat" placeholder="" >
						<input type="text" name="lng[]" id="lng_0" class="form-control lng" placeholder="" >
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
function mappicker(lat,lng){
	var latx=$("#"+lat).val();
	var lngx=$("#"+lng).val();
	window.open(base_url+"map?lat="+latx+"&lng="+lngx+"&latfld="+lat+"&lngfld="+lng,"MapWindow","width=830,height=500,location=no").focus();
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
	sendData('#myf',"laporan/save_rengiat_vip");
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
	newrow.find('#lat_0').attr("id","lat_"+cntr);
	newrow.find('#lng_0').attr("id","lng_"+cntr);
	newrow.find("input").val("");
	newrow.find("select.select2").on("change",function(){
		//console.log("i="+cntr+$(this).val());
		$("#gangguan_"+cntr).val($(this).val());
	});
	newrow.find("button.btn-map").on("click",function(){
		//console.log("i="+cntr+$(this).val());
		mappicker("lat_"+cntr,"lng_"+cntr);
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

$(".<?php echo $frid?>").attr("disabled",true);

$("select.select2").on("change",function(){
//console.log("i="+cntr+$(this).val());
$("#gangguan_0").val($(this).val());
});
</script>