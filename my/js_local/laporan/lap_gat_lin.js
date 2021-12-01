$(document).ready(function() {
    showtable();
    get_kegiatan();
    get_kejadian();
});

$('#form_add').submit(function (e) { 
  e.preventDefault();
  var formData = new FormData(this);

  var object = {};
  formData.forEach((value, key) => object[key] = value);
  var json = JSON.stringify(object);
  
  $.ajax({
      type: "POST",
      url: "../Api/lap_gatlin",
      secureuri: false,
      contentType: false,
      cache: false,
      processData:false,
      data: json,
      dataType: "json",
      beforeSend: function() {
         $('#btn-save').hide();
         $('#btn-save-loading').show();
      },
      success: function (r) {
          if (r.status) {
              swal("Berhasil", r.msg, "success");

              $('#btn-save').show();
              $('#btn-save-loading').hide();

              $('#form_add')[0].reset();
              $('#modal_add').modal('hide');
              showtable();

          }else{
              swal("Gagal", r.msg, "error");

              $('#btn-save').show();
              $('#btn-save-loading').hide();
          } 
      },
      error: function () { 
            swal("Gagal", "Terjadi gangguan sistem, harap hubungi developer", "error");
            

            $('#btn-save').show();
            $('#btn-save-loading').hide();
       }
  });

});

function get_status(v) { 
  $('.rsp_status').html('');
  if (v == '2') {
    $('.rsp_status').html(`<div class="row">
    <div class="col-md-12">
      <table class="table table-bordred">
        <thead>
          <tr>
            <th>Dari Arah</th>
            <th>Antrian</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Timur</td>
            <td><select name="a_timur" class="form-control"></select></td>
          </tr>
          <tr>
            <td>Barat</td>
            <td><select name="a_barat" class="form-control"></select></td>
          </tr>
          <tr>
            <td>Utara</td>
            <td><select name="a_utara" class="form-control"></select></td>
          </tr>
          <tr>
            <td>Selatan</td>
            <td><select name="a_selatan" class="form-control"></select></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-12">
      <label>Penyebab</label>
      <select class="form-control" name="penyebab" id="penyebab"></select>
    </div>
  </div>`);

  setTimeout(() => {
    get_parameter_antrian('','a_timur');
    get_parameter_antrian('','a_barat');
    get_parameter_antrian('','a_utara');
    get_parameter_antrian('','a_selatan');
    get_penyebab();
  }, 1000);

  }

}

function get_kegiatan(id='',name='') { 
  if(name == '') name = 'kegiatan';
  $('select[name="'+name+'"]').html('');
  $.ajax({
      type: "get",
      url:'../Api/kegiatan',
      dataType: "json",
      success: function (res) {
          $('select[name="'+name+'"]').html('<option value="">-- Select --</option>');
          $.each( res.data, function( key, value ) {
              if (value.nilai == id) {
                  $('select[name="'+name+'"]').append("<option selected value='"+value.rowid+"'>"+value.k_nama+"</option>");
              }else{
                  $('select[name="'+name+'"]').append("<option value='"+value.rowid+"'>"+value.k_nama+"</option>");
              }
          });
      }
  });
}

function get_kejadian(id='',name='') { 
  if(name == '') name = 'kejadian';
  $('select[name="'+name+'"]').html('');
  $.ajax({
      type: "get",
      url:'../Api/kejadian',
      dataType: "json",
      success: function (res) {
          $('select[name="'+name+'"]').html('<option value="">-- Select --</option>');
          $.each( res.data, function( key, value ) {
              if (value.nilai == id) {
                  $('select[name="'+name+'"]').append("<option selected value='"+value.rowid+"'>"+value.kjd_dit_nam+"</option>");
              }else{
                  $('select[name="'+name+'"]').append("<option value='"+value.rowid+"'>"+value.kjd_dit_nam+"</option>");
              }
          });
      }
  });
}

function get_penyebab(id='',name='') { 
  if(name == '') name = 'penyebab';
  $('select[name="'+name+'"]').html('');
  $.ajax({
      type: "get",
      url:'../Api/penyebab',
      dataType: "json",
      success: function (res) {
          $('select[name="'+name+'"]').html('<option value="">-- Select --</option>');
          $.each( res.data, function( key, value ) {
              if (value.nilai == id) {
                  $('select[name="'+name+'"]').append("<option selected value='"+value.rowid+"'>"+value.p_nam+"</option>");
              }else{
                  $('select[name="'+name+'"]').append("<option value='"+value.rowid+"'>"+value.p_nam+"</option>");
              }
          });
      }
  });
}

function get_parameter_antrian(id='',name='') { 
  if(name == '') name = 'parameter_antrian';
  $('select[name="'+name+'"]').html('');
  $.ajax({
      type: "get",
      url:'../Api/parameter_antrian',
      dataType: "json",
      success: function (res) {
          $('select[name="'+name+'"]').html('<option value="">-- Select --</option>');
          $.each( res.data, function( key, value ) {
              if (value.nilai == id) {
                  $('select[name="'+name+'"]').append("<option selected value='"+value.rowid+"'>"+value.prm_antr_nam+"</option>");
              }else{
                  $('select[name="'+name+'"]').append("<option value='"+value.rowid+"'>"+value.prm_antr_nam+"</option>");
              }
          });
      }
  });
}

function showtable() {
    $('#tabel').DataTable({
        // Processing indicator
        "bAutoWidth": false,
        "destroy": true,
        "searching": true,
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        "scrollX": true,
        // Initial no order.
        "order": [],
        // Load data from an Ajax source
        "ajax": {
          "url": 'dt_lap_gat_lin',
          "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          // "targets": [5],
          "orderable": false
        }]
      });
  }