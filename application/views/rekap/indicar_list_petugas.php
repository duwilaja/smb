<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

// $cols="nrp,unit,polda,polres,dinas,subdinas,tgl,dasar,nomor,";
// $cols="nrp,tgl,da_nam,res_nam,pnp,bus,brg,motor,khusus";
// $tname="eri_kendaraan";

?>

<div class="card">
	<div class="card-header">
		<div class="card-title judul">
             List Petugas		
            <!-- <div class="row mt-5">
                <div class="col">
                <form method="POST">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-calendar"></i>
                        </div>
                    </div>
                    <input type="text" class="form-control datepicker" id="date">
                </div>
                </div>
                <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                        <i class="fa fa-times"></i>
                        </div>
                    </div>
                    <input type="text" class="form-control timepicker" id="time">
                </div>
                </div>
                <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                        <i class="fa fa-list"></i>
                        </div>
                    </div>
                    <select name="status" id="status" class="form-control">
                        <option value="">All</option>
                        <option value="0">Pengajuan</option>
                        <option value="1">Disetujui</option>
                        <option value="2">Ditolak</option>
                        <option value="3">Sedang Berjalan</option>
                        <option value="4">Selesai</option>
                    </select>
                </div>
                </div>
                <div class="col">
                <div class="input-group">
                    <button type="button" id="cari" class="btn btn-success" >Cari</button>
                </div>
                </form>
                </div>
            </div> -->
		</div>
		<div class="card-options ">
			<!--a href="#" title="Batch" class=""><i class="fe fe-upload"></i></a>-->
			<a href="#" onclick="f_tambah(0);" data-toggle="modal" data-target="#tambah" title="Add" class=""><i class="fe fe-plus"></i></a>
			<a href="#" title="Refresh" onclick="reload_table();"><i class="fe fe-refresh-cw"></i></a>
			<a href="#" title="Expand/Collapse" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
			<!--a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a-->
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="mytbl" class="table table-striped table-bordered w-100">
				<thead>
					<tr>
                        <th>Id</th>
						<th>Nama</th>
						<th>Kendaraan Nama</th>
						<th>Kendaraan Nopol</th>
						<th>Status</th>
                        <th>Action</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="modal fade" id="f_tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">Insert Kendaraan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form>
        <div class="modal-body">
          <div class="form-group">
            <label for="text1">Nama Kendaraan</label>
            <input type="text" class="form-control" id="t_nama" name="t_nama" value="" aria-describedby="textHelp" placeholder="Enter text">
            <small id="textHelp" class="form-text text-muted">Your information is safe with us.</small>
          </div>
          <div class="form-group">
            <label for="text1">Nopol Kendaraan</label>
            <input type="text" class="form-control" id="t_nopol" name="t_nopol" value="" aria-describedby="textHelp" placeholder="Enter text">
            <small id="textHelp" class="form-text text-muted">Your information is safe with us.</small>
          </div>
          <div class="form-group">
            <label for="text1">latitude Kendaraan</label>
            <input type="text" class="form-control" id="t_latitude" name="t_latitude" value="" aria-describedby="textHelp" placeholder="Enter text">
            <small id="textHelp" class="form-text text-muted">Your information is safe with us.</small>
          </div>
          <div class="form-group">
            <label for="text1">longitude Kendaraan</label>
            <input type="text" class="form-control" id="t_longitude" name="t_longitude" value="" aria-describedby="textHelp" placeholder="Enter text">
            <small id="textHelp" class="form-text text-muted">Your information is safe with us.</small>
          </div>
          <div >
              <div id="map" style="width: 480px; height: 200px;"></div>
          </div>
        </div>
        <div class="modal-footer border-top-0 d-flex justify-content-center">
            <button type="button" id="btn_insert" class="btn btn-success" >Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="f_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">Update Kendaraan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form>
        <div class="modal-body">
          <div class="form-group">
            <label for="text1">Nama Kendaraan</label>
            <input type="hidden" name="kendaraanid" id="kendaraanid">
            <input type="text" class="form-control" id="kendaraannama" name="kendaraannama" value="" aria-describedby="textHelp" placeholder="Enter text">
            <small id="textHelp" class="form-text text-muted">Your information is safe with us.</small>
          </div>
        </div>
        <div class="modal-footer border-top-0 d-flex justify-content-center">
            <button type="button" id="btn_update" class="btn btn-success" >Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
    dt();
    datepicker(); 
    timepicker();
    $("#cari").click(function(){
            dt();
            datepicker(); 
            timepicker();
        // }
    });
    $('#btn_insert').on('click',function(){
            var t_nama=$('#t_nama').val();
            var t_nopol=$('#t_nopol').val();
            var t_latitude=$('#t_latitude').val();
            var t_longitude=$('#t_longitude').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url()?>api_indicar/proses_tambah",
                dataType : "JSON",
                data : {
                    t_nama:t_nama,
                    t_nopol:t_nopol,
                    t_latitude:t_latitude,
                    t_longitude:t_longitude
                },
                success: function(data){
                    $('[name="t_nama"]').val("");
                    $('[name="t_nopol"]').val("");
                    $('[name="t_latitude"]').val("");
                    $('[name="t_longitude"]').val("");
                    $('#f_tambah').modal('hide');
                    dt();
                }
            });
            return false;
    });
    $('#btn_update').on('click',function(){
            var kendaraanid=$('#kendaraanid').val();
            var kendaraannama=$('#kendaraannama').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url()?>api_indicar/proses_edit",
                dataType : "JSON",
                data : {kendaraanid:kendaraanid , kendaraannama:kendaraannama,},
                success: function(data){
                    $('[name="kendaraanid"]').val("");
                    $('[name="kendaraannama"]').val("");
                    $('#f_edit').modal('hide');
                    dt();
                }
            });
            return false;
    });
    $('#btn_delete').on('click',function(){
            var kendaraanid=$('#kendaraanid').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url()?>api_indicar/proses_delete",
                dataType : "JSON",
                data : {kendaraanid:kendaraanid,},
                success: function(data){
                    $('[name="kendaraanid"]').val("");
                    $('#f_delete').modal('hide');
                    dt();
                }
            });
            return false;
    });
});

function dt(){
    $(document).ready(function() {
        $('#mytbl').DataTable( {
            "ajax": '<?php echo base_url()?>api_indicar/dt_list_petugas'
        } );
    });
}

function f_tambah(){
    $('#f_tambah').modal('show');
}

function f_edit(kendaraanid){
    $.ajax({
        url: "<?php echo base_url()?>api_indicar/detail_kendaraan",
        type: "post",
        dataType: "JSON",
        data:{ kendaraanid: kendaraanid},
        success: function (response) {
            for (key in response){
                $("#kendaraanid").val(kendaraanid);
                $("#kendaraannama").val(Object.values(response[key]).join(' '));
            }
            $('#f_edit').modal('show');
           // You will get response from your PHP page (what you echo or print)
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
}

function f_delete(kendaraanid) {
        confirm("Are you sure?, You won't be able to revert this!");
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }),
            $.ajax({
                url: "<?php echo base_url()?>api_indicar/proses_delete",
                type: "POST",
                data: {kendaraanid: kendaraanid},
                dataType: "html",
                success: function () {
                    swal("Done!","It was succesfully deleted!","success");
                    dt();
                }
            });
}

</script>