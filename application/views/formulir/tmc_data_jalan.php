<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$jj=json_decode($jenisjalan);
$jj=isset($jj->data)?$jj->data:[];
$sj=json_decode($statusjalan);
$sj=isset($sj->data)?$sj->data:[];
/*$kec=json_decode($kecamatan);
$kec=isset($kec->data)?$kec->data:[];
$kot=json_decode($kota);
$kot=isset($kot->data)?$kot->data:[];
$kel=json_decode($kelurahan);
$kel=isset($kel->data)?$kel->data:[];*/
$prov=json_decode($provinsi);
$prov=isset($prov->data)?$prov->data:[];
?>

<style>
	#map {
		width: 100%;
		height: 400px;
	}
</style>

<button type="button" class="btn btn-primary pull-right" onclick="showModal(0);"><i class="fa fa-plus"></i></button>
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table id="mytbl" class="table table-striped table-bordered w-100">
				<thead>
					<tr>
						<th>Nama</th>
						<th>Lat</th>
						<th>Lng</th>
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
  <div role="document" class="modal-dialog modal-lg">
	<div class="modal-content">
	  <div class="modal-header"><strong id="exampleModalLabel" class="modal-title">Jalan</strong>
		<button type="button" data-bs-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">x</span></button>
	  </div>
	  <div class="modal-body">
		<!--p>Lorem ipsum dolor sit amet consectetur.</p-->
		<!--form id="myf" class="form-horizontal"-->		
		  <div class="row">
			<div class="form-group col-md-12">
				<label>Nama Jalan</label>
				<input type="text" id="nama_jalan" name="nama_jalan" placeholder="..." class="form-control">
			</div>
		  </div>
		  <div class="row">
			<div class="form-group col-md-6">
				<label>Jenis Jalan</label>
				<select id="mstr_jalan_jenis_id" name="mstr_jalan_jenis_id" class="form-control select2" placeholder="">
				<?php foreach($jj as $j){?>
					<option value="<?php echo $j->id?>"><?php echo $j->jenis_jalan?></option>
				<?php }?>
				</select>
			</div>
			<div class="form-group col-md-6">
				<label>Status Jalan</label>
				<select id="mstr_jalan_status_id" name="mstr_jalan_status_id" class="form-control select2" placeholder="">
				<?php foreach($sj as $j){?>
					<option value="<?php echo $j->id?>"><?php echo $j->status_jalan?></option>
				<?php }?>
				</select>
			</div>
		  </div>
		  <div class="row">
			<div class="form-group col-md-6">
				<label>Provinsi</label>
				<select id="prov_id" name="prov_id" class="form-control select2" placeholder="" onchange="combochanged(this.value,'#kota_id');">
					<option  value=""></option>
				<?php foreach($prov as $j){?>
					<option value="<?php echo $j->prov_id?>"><?php echo $j->provinsi?></option>
				<?php }?>
				</select>
			</div>
			<div class="form-group col-md-6">
				<label>Kota</label>
				<select id="kota_id" name="kota_id" class="form-control select2" placeholder="" onchange="combochanged(this.value,'#kec_id');">
					<option  value=""></option>
				</select>
			</div>
		  </div>
		  <div class="row">
			<div class="form-group col-md-6">
				<label>Kecamatan</label>
				<select id="kec_id" name="kec_id" class="form-control select2" placeholder="" onchange="combochanged(this.value,'#kel_id');">
					<option  value=""></option>
				</select>
			</div>
			<div class="form-group col-md-6">
				<label>Kelurahan</label>
				<select id="kel_id" name="kel_id" class="form-control select2" placeholder="">
					<option  value=""></option>
				</select>
			</div>
		  </div>
		  <div class="row">
			<div class="form-group col-md-6">
				<label>Lat</label>
				<input type="text" id="lat" name="lat" placeholder="..." class="form-control">
			</div>
			<div class="form-group col-md-6">
				<label>Lng</label>
				<input type="text" id="lng" name="lng" placeholder="..." class="form-control">
			</div>
		  </div>
		  
		<!--/form-->
	  </div>
	  <div class="modal-footer">
	  <input type="hidden" id="id" name="id" value="0">
	  <input type="hidden" name="apilnk" value="jalan">
	  <input type="hidden" name="fieldnames" value="nama_jalan,prov_id,kota_id,kec_id,kel_id,lat,lng,mstr_jalan_status_id,mstr_jalan_jenis_id">
	    <button type="button" class="btn btn-danger" id="bdel"  onclick="dele('#myf','myapi/dele');">Delete</button>
		<button type="button" class="btn btn-success" id="btnsv" onclick="sendfrm('#myf','myapi/save');">Save</button>
		<button type="button" data-bs-dismiss="modal" class="btn btn-default">Close</button>
		
	  </div>
	</div>
  </div>
</div>

<script>
var map,mytbl,markers,currentdata;

function showModal(id){
	$("#myf")[0].reset();
	if(id==0){
		$("#id").val(0);
		$("#bdel").hide();
		$("#myModal").modal("show");
		//$(".select2").trigger("change");
		currentdata={kota_id:"",kec_id:"",kel_id:""};
	}else{
		$.ajax({
			type: 'POST',
			url: base_url+'myapi/show',
			data: {lnk:'jalan',id:id},
			success: function(data){
				$("#bdel").show();
				var json = JSON.parse(data);
				currentdata=json;
				console.log(json);
				$.each(json,function (key,val){
					$('#'+key).val(val);
				})
				$("#myModal").modal("show");
				$("#prov_id").trigger("change");
			},
			error: function(xhr){
				log('Please check your connection'+xhr);
				alrt("Gagal mengambil data","error");
			}
		});
	}
}
function dele(f,l){
	swal({
	  title: "Hapus Data?",
	  text: "Data akan dihapus secara permanen",
	  icon: "warning",
	  buttons: true,
	  dangerMode: true,
	})
	.then((willDelete) => {
	  if (willDelete) {
		sendfrm(f,l);
	  }
	});
}
function sendfrm(f,ln){
	if($(f).valid()){
		var frmdata=new FormData($(f)[0]);
		$.ajax({
			type: 'POST',
			url: base_url+ln,
			data: frmdata,
			processData: false, //formdata
			contentType: false, //formdata
			success: function(data){
				var json = JSON.parse(data);
				//log(data);
				//log(json);
				var typ=json['status']?'success':'error';
				alrt(json['msg'],typ,'');
				mytbl.ajax.reload();
			},
			error: function(xhr,status){
				log(status);
				alrt('Connection error','error','Err');
			}
		});
	}else{
		alrt('Please enter all mandatory fields','warning','');
	}
}
function combochanged(tv,tgt){
	var lnk="";
	switch(tgt){
		case "#kota_id": lnk="kota/?prov_id="+tv; comboclear("#kel_id"); comboclear("#kec_id"); comboclear("#kota_id"); break;
		case "#kec_id": lnk="kecamatan/?kota_id="+tv; comboclear("#kel_id"); comboclear("#kec_id"); break;
		case "#kel_id": lnk="kelurahan/?kec_id="+tv; break;
	}
	if(lnk!=""&&tv!=''){
		getCombo(lnk,tgt);
	}
}
function extract_data(data,tgt){
	var s="";
	var selected="";
	switch(tgt){
		case "#kota_id": selected=data['kota_id']==currentdata['kota_id']?"selected":"";
				s='<option '+selected+' value="'+data['kota_id']+'">'+data['kota']+'</option>'; break;
		case "#kec_id": selected=data['kec_id']==currentdata['kec_id']?"selected":"";
				s='<option '+selected+' value="'+data['kec_id']+'">'+data['kecamatan']+'</option>'; break;
		case "#kel_id": selected=data['kel_id']==currentdata['kel_id']?"selected":"";
				s='<option '+selected+' value="'+data['kel_id']+'">'+data['kelurahan']+'</option>'; break;
	}
	return s;
}
function comboclear(tgt){
	$(tgt).find('option').remove();
	var s='<option value=""></option>';
	$(tgt).append(s).trigger("change");
}
function getCombo(lnk,tgt,dv="",blnk=""){
	var url=base_url+'myapi/get';
	var mtd='POST';
	var frmdata={lnk:lnk};
	
	//alert(frmdata);
	
	$.ajax({
		type: mtd,
		url: url,
		data: frmdata,
		success: function(data){
			var json=JSON.parse(data);
			console.log(json);
			$(tgt).find('option').remove();
			var s='<option value="">'+blnk+'</option>';
			for(var i=0;i<json.length;i++){
				s+=extract_data(json[i],tgt);
			}
			$(tgt).append(s).trigger("change");
		},
		error: function(xhr){
			console.log("Error:"+xhr);
		}
	});
}

$(document).ready(function(){
	mytbl = $("#mytbl").DataTable({
		serverSide: false,
		processing: true,
		searching: true,
		buttons: ['copy', 'csv'],
		stateSave: true,
		bDestroy: true,
		ajax: {
			type: 'POST',
			url: base_url+'myapi/dttbl',
			data: function (d) {
				d.lnk='<?php echo base64_encode('jalan')?>';
			}
		},
		initComplete: function(){
			//dttbl_buttons(); //for ajax call
		}
	});
	
	//*
	$(".select2").select2({
        dropdownParent: $('#myModal')
    });//*/
	
	$(".<?php echo $frid?>").attr("disabled",true);
});

jvalidate = $("#myf").validate({
    rules :{
        "nama_jalan" : {
			required : true
		}
    }});
</script>