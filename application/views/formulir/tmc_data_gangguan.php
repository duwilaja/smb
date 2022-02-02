<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,";
$cols.="jalan,lat,lng,jenis,status,penyebab,penyebabd";
?>

<input type="hidden" name="tablename" value="tmc_data_gangguan">
<input type="hidden" name="fieldnames" value="<?php echo $cols?>">

<input type="hidden" name="lat" id="lat" value="">
<input type="hidden" name="lng" id="lng" value="">

<style>
	#map {
		width: 100%;
		height: 400px;
	}
</style>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

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
	<div class="col-md-7">
		<div id='map'></div>
	</div>
	<div class="col-md-5">
		<div class="table-responsive">
			<table id="mytbl" class="table table-striped table-bordered w-100">
				<thead>
					<tr>
						<th>Jenis</th>
						<th>Status</th>
						<th>Jumlah</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modal-->
<div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left modal_form">
  <div role="document" class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header"><strong id="exampleModalLabel" class="modal-title">Status Gangguan</strong>
		<button type="button" data-bs-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">x</span></button>
	  </div>
	  <div class="modal-body">
		<!--p>Lorem ipsum dolor sit amet consectetur.</p-->
		<!--form id="myf" class="form-horizontal"-->		
		  <div class="row">
			<div class="form-group col-md-12">
				<label>Nama Jalan</label>
				<input type="text" id="jalan" name="jalan" placeholder="..." class="form-control">
			</div>
		  </div>
		  <div class="row">
			<div class="form-group col-md-12">
				<label>Jenis Jalan</label>
				<select id="jenis" name="jenis" class="form-control" placeholder="">
					<option value="Nasional">Nasional</option>
					<option value="Propinsi">Propinsi</option>
					<option value="Kabupaten">Kabupaten</option>
					<option value="Desa">Desa</option>
					<option value="Tol">Tol</option>
					<option value="Arteri">Arteri</option>
					<option value="Kolektor">Kolektor</option>
					<option value="Lingkungan">Lingkungan</option>
				</select>
			</div>
		  </div>
		  <div class="row">
			<div class="form-group col-md-12">
				<label>Status</label>
				<select id="status" name="status" class="form-control" placeholder="">
					<option value="Potensi Gangguan">Potensi Gangguan</option>
					<option value="Ambang Gangguan">Ambang Gangguan</option>
					<option value="Gangguan Nyata">Gangguan Nyata</option>
				</select>
			</div>
		  </div>
		  <div class="row">
			<div class="form-group col-md-12">
				<label>Penyebab</label>
				<select id="penyebab" name="penyebab" class="form-control" placeholder="" onchange="getSubQ('laporan/get_subq',this.value,'#penyebabd','','','penyebab_macet_d','detil as v,detil as t','sebab');">
					
				</select>
			</div>
		  </div>
		  <div class="row">
			<div class="form-group col-md-12">
				<label>Detil</label>
				<select id="penyebabd" name="penyebabd" class="form-control" placeholder="">
					
				</select>
			</div>
		  </div>
		<!--/form-->
	  </div>
	  <div class="modal-footer">
	    <button type="button" class="btn btn-danger" id="bdel"  onclick="sendData('#myf','laporan/dele');">Delete</button>
		<button type="button" class="btn btn-success" id="btnsv" onclick="simpanlah();">Save</button>
		<button type="button" data-bs-dismiss="modal" class="btn btn-default">Close</button>
		
	  </div>
	</div>
  </div>
</div>

<script>
var map,mytbl,markers,marker;

function showModal(id){
	if(id==0){
		$("#jalan").val("");
		$("#rowid").val(0);
		$("#bdel").hide();
		$("#myModal").modal("show");
	}else{
		$.ajax({
			type: 'POST',
			url: base_url+'laporan/datas',
			data: {q:'gangguan',id:id},
			success: function(data){
				$("#bdel").show();
				var json = JSON.parse(data);
				console.log(json);
				var dv="";
				$.each(json[0],function (key,val){
					$('#'+key).val(val);
					if(key=='penyebabd') dv=val;
				});
				$("#myModal").modal("show");
				getSubQ('laporan/get_subq',$('#penyebab').val(),'#penyebabd',dv,'','penyebab_macet_d','detil as v,detil as t','sebab');
			},
			error: function(xhr){
				log('Please check your connection'+xhr);
				alrt("Failed retrieving data","error");
			}
		});
	}
	
}
function onMapClick(e) {
	/*popup
		.setLatLng(e.latlng)
		.setContent("You clicked the map at " + e.latlng.toString())
		.openOn(map);*/
		
	//L.marker(e.latlng).addTo(map);
	$("#lat").val(e.latlng.lat);
	$("#lng").val(e.latlng.lng);
	
	showModal(0);
}
function markerClickFunction(id) {
	return function(e) {
		e.cancelBubble = true;
	e.returnValue = false;
	if (e.stopPropagation) {
	  e.stopPropagation();
	  e.preventDefault();
	}
	//if(id=="0"){
		//location.href="device.php?id="+h;
	//}else{
	//	location.href="device.php?id="+id;
	//	}
	showModal(id);
}}
function senddatacallback(f){
	mytbl.ajax.reload();
	map.removeLayer(markers);
	loadMarker();
}
function loadMarker(){
	markers=L.layerGroup();
	$.ajax({
		type: 'POST',
		url: base_url+'laporan/datas',
		data: {q:'gangguan'},
		success: function(data){
			var json = JSON.parse(data);
			console.log(json);
			for(var i=0;i<json.length;i++){
				var data=json[i];
				marker = L.marker(new L.LatLng(data['lat'],data['lng']), { title: data['ttl']});
				fn=markerClickFunction(data['rowid']);
				marker.on('click', fn);
				marker.addTo(markers);
			}
			markers.addTo(map);
		},
		error: function(xhr){
			log('Please check your connection'+xhr);
		}
	});
}


$(document).ready(function(){
	map = L.map('map', {
		center: [-7.566139228199951,110.82310438156128],
		zoom: 13,
		//layers: [grayscale, cities]
	});
	
	L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
		}).addTo(map);

	map.on('click', onMapClick);
	
	loadMarker();
	
	mytbl = $("#mytbl").DataTable({
		serverSide: true,
		processing: true,
		searching: true,
		buttons: ['copy', 'csv'],
		ajax: {
			type: 'POST',
			url: base_url+'laporan/dttbl',
			data: function (d) {
				d.q= '<?php echo base64_encode("select jenis,status,count(status) as jumlah from tmc_data_gangguan group by jenis,status"); ?>';
			}
		},
		initComplete: function(){
			//dttbl_buttons(); //for ajax call
		}
	});
	
	getSubQ('laporan/get_subq','','#penyebab',"","","penyebab_macet","sebab as v,sebab as t","");
	
	$(".<?php echo $frid?>").attr("disabled",true);
});

jvalidate = $("#myf").validate({
    rules :{
        "jalan" : {
			required : true
		}
    }});
</script>