<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,dasar,nomor,";
$cols.="namajalan,lat,lng,kategori,keterlibatan,penindakan,ket,tindakan,md,lb,lr,nopol,instansi,petugas,rs,rsalm,rslat,rslng,rscc,jam,penggal";
?>

<style>
	#isilaporan{
		padding-bottom: 0px;
	}
</style>

<input type="hidden" name="tablename" value="tmc_ops_laka">
<input type="hidden" name="fieldnames" value="<?php echo $cols?>">

<div class="row">
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Nama Jalan</label>
			<input type="text" name="namajalan" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Status Penggal</label>
			<select name="penggal" class="form-control" placeholder="">
	<?php for($i=0;$i<count($penggal);$i++){?>
	<option value="<?php echo $penggal[$i]['val']?>"><?php echo $penggal[$i]['txt']?></option>
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
			<button type="button" class="btn btn-danger" onclick="mappicker('lat','lng');"><i class="fa fa-map-marker"></i></button>
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
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Kategori Laka</label>
			<select name="kategori" class="form-control" placeholder="">
				<option value="Laka Tunggal">Laka Tunggal</option>
				<option value="Laka 2 Kendaraan">Laka 2 Kendaraan</option>
				<option value="Laka Jol">Laka Jol</option>
				<option value="Laka Beruntun">Laka Beruntun</option>
				<option value="Tabrak Lari">Tabrak Lari</option>
			</select>
		</div> 
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Kendaraan Terlibat</label>
			<select name="keterlibatan" class="form-control" placeholder="">
				<option value="R2">R2</option>
				<option value="R4">R4</option>
				<option value="R2 VS R2">R2 VS R2</option>
				<option value="R2 VS R4">R2 VS R4</option>
				<option value="R4 VS R4">R4 VS R4</option>
				<option value="R2 Menabrak Pejalan Kaki">R2 Menabrak Pejalan Kaki</option>
				<option value="R4 Menabrak Pejalan Kaki">R4 Menabrak Pejalan Kaki</option>
			</select>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Call Center</label>
			<input type="text" name="rscc" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Jml Korban MD</label>
			<input type="text" name="md" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Jml Luka Berat</label>
			<input type="text" name="lb" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Jml Luka Ringan</label>
			<input type="text" name="lr" class="form-control" placeholder="" >
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Cara Bertindak</label>
			<select name="tindakan" class="form-control" placeholder="">
				<option value="Pre Ventif">Pre Ventif</option>
				<option value="Pre Entif">Pre Entif</option>
				<option value="Represif">Represif</option>
				<option value="Kuratif">Kuratif</option>
				<option value="Rehabilitasi">Rehabilitasi</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Kategori Penindakan</label>
			<select name="penindakan" class="form-control" placeholder="">
				<option value="Turjagwali">Turjagwali</option>
				<option value="Monitoring">Monitoring</option>
				<option value="Sosialisasi">Sosialisasi</option>
				<option value="Publikasi">Publikasi</option>
				<option value="Teguran">Teguran</option>
				<option value="Rekayasa Lalin">Rekayasa Lalin</option>
				<option value="Tilang">Tilang</option>
				<option value="Penangkapan">Penangkapan</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Keterangan CB</label>
			<textarea name="ket" class="form-control" placeholder="" ></textarea>
		</div>
	</div>
</div>

<div class="row mb-4 mt-4">
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Faskes Rujukan</label>
			<!-- <input type="text" name="rs" class="form-control" placeholder="" > -->
			<select name="rs" id="rs" class="form-control" onchange="show_faskes(this.value)"  placeholder="">
				<option value=""></option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Alamat</label>
			<input type="text" name="rsalm" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Latitude</label>
			<input type="text" id="rslat" name="rslat" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Longitude</label>
			<input type="text" id="rslng" name="rslng" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-1">
		<div class="form-group">
			<label class="form-label">&nbsp;</label>
			<button type="button" class="btn btn-danger" onclick="mappicker('rslat','rslng');"><i class="fa fa-map-marker"></i></button>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12" id="show_faskes">
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header" style="padding:20px;">
				<div class="btn btn-primary btn-sm" onclick="add_nopol()"><i class="fa fa-plus"></i> Nopol</div>
				<div class="btn btn-danger btn-sm ml-2" onclick="clear_html('#view_nopol','nopol')"><i class="fa fa-trash"></i> Nopol</div>
			</div>
			<div class="card-body">
				<div class="row" id="view_nopol">
					Tidak ada data nopol
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-header" style="padding:20px;">
				<div class="btn btn-primary btn-sm" onclick="add_instansi()"><i class="fa fa-plus"></i> Instansi</div>
				<div class="btn btn-danger btn-sm ml-2" onclick="clear_html('#view_instansi','instansi')"><i class="fa fa-trash"></i> Instansi</div>
			</div>
			<div class="card-body">
				<div class="row" id="view_instansi">
					Tidak ada data instansi
				</div>
			</div>
		</div>
	</div>
</div>
<script>
var no_nopol = 0;
var no_instansi = 0;
var faskes_arr = [];


function get_data() { 

	$.ajax({
		type: "POST",
		url: "../Api/get_data",
		data: {
			't' : '<?=$this->input->get('t');?>',
			'rowid' : '<?=$this->input->get('rowid');?>',
			'col' : '<?=$this->input->get('col');?>'
		},
		dataType: "json",
		success: function (r) {
			faskes_html(r.rs);
			if (r.nopol) {
				add_nopol(r.nopol);
			}	
			if (r.instansi) {
				add_instansi(r.instansi,r.petugas);
			}

			for (const k in r) {
				if (Object.hasOwnProperty.call(r, k)) {
					const element = r[k];
					document.getElementsByTagName("select").forEach(element => {
						if (element.name == k) {
							$('select[name='+k+']').val(r[k]);
						}
					});

					document.getElementsByTagName("input").forEach(element => {
						if (element.name == k) {
							$('input[name='+k+']').val(r[k]);
						}
					});

					document.getElementsByTagName("textarea").forEach(element => {
						if (element.name == k) {
							$('textarea[name='+k+']').val(r[k]);
						}
					});

				}
			}
		}
	});	
	
}

function add_nopol(data='') {
	no_nopol++;
	if (no_nopol == 1) {
		$('#view_nopol').html('');	
	}
	if (data != '') {
		data.forEach((e,i) => {
			no_nopol += i;
			$('#view_nopol').append(`
			<div class="col-sm-6 col-md-6">
				<div class="form-group">
					<label class="form-label">Nopol ${no_nopol}</label>
					<input type="text" name="nopol[]" class="form-control" placeholder="Nopol ${no_nopol}" value="${e}">
				</div>
			</div>`);
		});
	}else{
		$('#view_nopol').append(`
			<div class="col-sm-6 col-md-6">
				<div class="form-group">
					<label class="form-label">Nopol ${no_nopol}</label>
					<input type="text" name="nopol[]" class="form-control" placeholder="Nopol ${no_nopol}" >
				</div>
			</div>`);
	}
}

function add_instansi(data='',petugas='') {
	no_instansi++;
	if (data != '') {
		$('#view_instansi').html('');	
		data.forEach((v,i) => {
			get_instansi().then(r => {
				no_instansi += i;

				$('#view_instansi').append(`<div class="col-sm-6 col-md-6">
				<div class="form-group">
					<label class="form-label">Instansi ${no_instansi}</label>
					<select name="instansi[]" id="instansi${no_instansi}" class="form-control" placeholder="">
						<option value=""></option>
					</select>
				</div>
			</div>
			<div class="col-sm-6 col-md-6">
				<div class="form-group">
					<label class="form-label">Nama/CallSign ${no_instansi}</label>
					<input type="text" name="petugas[]" class="form-control" placeholder="" value="${petugas[i]}">
				</div>
			</div>`);

				var option_instansi = '<option value=""></option>';
				r.forEach(e => {
					if (v.id == e.id) {
						option_instansi += '<option value="'+e.id+'" selected>'+e.nama_instansi+'</option>';
					}else{
						option_instansi += '<option value="'+e.id+'">'+e.nama_instansi+'</option>';
					}
				});
				$('#instansi'+no_instansi).select2();
				$('#instansi'+no_instansi).html(option_instansi);
			})
		});
	}else{
		if (no_instansi == 1) {
			$('#view_instansi').html('');	
		}
		$('#view_instansi').append(`<div class="col-sm-6 col-md-6">
				<div class="form-group">
					<label class="form-label">Instansi ${no_instansi}</label>
					<select name="instansi[]" id="instansi${no_instansi}" class="form-control" placeholder="">
						<option value=""></option>
					</select>
				</div>
			</div>
			<div class="col-sm-6 col-md-6">
				<div class="form-group">
					<label class="form-label">Nama/CallSign ${no_instansi}</label>
					<input type="text" name="petugas[]" class="form-control" placeholder="" >
				</div>
			</div>`);
		
			get_instansi().then(r => {
				var option_instansi = '<option value=""></option>';
				r.forEach(e => {
					option_instansi += '<option value="'+e.id+'">'+e.nama_instansi+'</option>';
				});
				$('#instansi'+no_instansi).select2();
				$('#instansi'+no_instansi).html(option_instansi);
			})
	}
}

function clear_html(dom='',tanda='') {
	$(dom).html('');
	if (tanda == 'nopol') {
		no_nopol = 0;
		$(dom).html('Tidak ada nopol');
	}

	if (tanda == 'instansi') {
		no_instansi = 0;
		$(dom).html('Tidak ada instansi');
	}
}

function get_instansi() {
 return new Promise(resolve => {
	$.ajax({
		type: "POST",
		url: "<?=site_url('Api/instansi')?>",
		dataType: "json",
		success: function (r) {
			resolve(r);
		}
	});
  })
}

function faskes_html(id=''){
	var selected = '';
	get_faskes().then(r => {
		$('#rs').html('<option value=""></option>');
		r.forEach(e => {
			if (id == e.id) {
				$('#rs').append('<option value="'+e.id+'" selected >'+e.nama_lokasi+'</option>');	
				show_faskes(e.id);
			}else{
				$('#rs').append('<option value="'+e.id+'" >'+e.nama_lokasi+'</option>');	
			}		
		});
		// $("#rs").select2({
		// 	tags : true
		// });
	});
}

function show_faskes(id) {
	var faskes =  faskes_arr.filter(function(a) {
		return a.id == id;
	});

	$('#show_faskes').html('');
	$('input[name="rslat"]').val('');
	$('input[name="rslng"]').val('');

	$('input[name="rslat"]').val(faskes[0].lat);
	$('input[name="rslng"]').val(faskes[0].lng);
	$('#show_faskes').html(`<div class="card">
			<div class="card-header">
			${faskes[0].nama_lokasi}
			</div>
			<div class="card-body">
			<div>${faskes[0].deskripsi}</div>
			</div>
		</div>`);
}

function get_faskes() {
 return new Promise(resolve => {
	$.ajax({
		type: "POST",
		url: "<?=site_url('/Api/faskes')?>",
		dataType: "json",
		success: function (r) {
			faskes_arr = r;
			resolve(r);
		}
	});
  })
}

function mappicker(lat,lng){
	var latv=$('#'+lat).val();
	var lngv=$('#'+lng).val();
	window.open(base_url+"map?latfld="+lat+"&lngfld="+lng+"&lat="+latv+"&lng="+lngv,"MapWindow","width=830,height=500,location=no").focus();
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
faskes_html();
setTimeout(() => {
	get_data();
}, 300);

	$(".is-invalid").removeClass("is-invalid");
	$(".is-valid").removeClass("is-valid");

</script>