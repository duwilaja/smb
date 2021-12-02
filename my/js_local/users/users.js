$(document).ready(function() {
    showtable();
    get_unit();
    get_polda();
    get_pangkat();
});

$('#form_add').submit(function (e) { 
  e.preventDefault();
  var formData = new FormData(this);

  var object = {};
  formData.forEach((value, key) => object[key] = value);
  var json = JSON.stringify(object);
  
  $.ajax({
      type: "POST",
      url: "../Api/users",
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

$('#form_edit').submit(function (e) { 
    e.preventDefault();
    var formData = new FormData(this);
  
    var object = {};
    formData.forEach((value, key) => object[key] = value);
    var json = JSON.stringify(object);
    
    $.ajax({
        type: "PUT",
        url: "../Api/users",
        secureuri: false,
        contentType: false,
        cache: false,
        processData:false,
        data: json,
        dataType: "json",
        beforeSend: function() {
           $('#btn-edit').hide();
           $('#btn-edit-loading').show();
        },
        success: function (r) {
            if (r.status) {
                swal("Berhasil", r.msg, "success");
  
                $('#btn-edit').show();
                $('#btn-edit-loading').hide();
  
                $('#modal_edit').modal('hide');
                $('#form_edit')[0].reset();
                showtable();
  
            }else{
                swal("Gagal", r.msg, "error");
  
                $('#btn-edit').show();
                $('#btn-edit-loading').hide();
            } 
        },
        error: function () { 
              swal("Gagal", "Terjadi gangguan sistem, harap hubungi developer", "error");
  
              $('#btn-edit').show();
              $('#btn-edit-loading').hide();
         }
    });
  });

function get_id(id) { 
    $.ajax({
        type: "get",
        url:'../Api/users?id='+id,
        dataType: "json",
        success: function (res) {
            var r = res.data;
            $('input[name="u_rowid"]').val(r.rowid);
            $('input[name="u_nama"]').val(r.uname);
            $('input[name="u_username"]').val(r.uid);
            // $('input[name="password"]').val(r.upwd);
            $('input[name="u_email"]').val(r.email);
            $('input[name="u_tlp"]').val(r.telp);
            $('select[name="u_usts"]').val(r.usts);

            get_unit(r.unit,'u_unit');
            get_polda(r.polda,'u_polda');
                setTimeout(() => {
                    get_polres(r.polres,'u_polres',$('select[name="u_polda"]').val());
                }, 1000);
            get_pangkat(r.pangkat,'u_pangkat');

        }
    });
}

function get_polda(id='',name='') { 
  if(name == '') name = 'polda';
  $('select[name="'+name+'"]').html('');
  $.ajax({
      type: "get",
      url:'../Api/polda',
      dataType: "json",
      success: function (res) {
          $('select[name="'+name+'"]').html('<option value="">-- Pilih --</option>');
          $.each( res.data, function( key, value ) {
              if (value.da_id == id) {
                  $('select[name="'+name+'"]').append("<option selected value='"+value.da_id+"'>"+value.da_nam+"</option>");
              }else{
                  $('select[name="'+name+'"]').append("<option value='"+value.da_id+"'>"+value.da_nam+"</option>");
              }
          });
      }
  });
}

function get_polres(id='',name='',polda='') { 
  if(name == '') name = 'polres';
  $('select[name="'+name+'"]').html('');
  $.ajax({
      type: "get",
      url:'../Api/polres?polda='+polda,
      dataType: "json",
      success: function (res) {
          $('select[name="'+name+'"]').html('<option value="">-- Pilih --</option>');
          $.each( res.data, function( key, value ) {
              if (value.res_id == id) {
                  $('select[name="'+name+'"]').append("<option selected value='"+value.res_id+"'>"+value.res_nam+"</option>");
              }else{
                  $('select[name="'+name+'"]').append("<option value='"+value.res_id+"'>"+value.res_nam+"</option>");
              }
          });
      }
  });
}

function get_pangkat(id='',name='') { 
  if(name == '') name = 'pangkat';
  $('select[name="'+name+'"]').html('');
  $.ajax({
      type: "get",
      url:'../Api/pangkat',
      dataType: "json",
      success: function (res) {
          $('select[name="'+name+'"]').html('<option value="">-- Pilih --</option>');
          $.each( res.data, function( key, value ) {
              if (value.pang_id == id) {
                  $('select[name="'+name+'"]').append("<option selected value='"+value.pang_id+"'>"+value.pang_nam+"</option>");
              }else{
                  $('select[name="'+name+'"]').append("<option value='"+value.pang_id+"'>"+value.pang_nam+"</option>");
              }
          });
      }
  });
}

function get_unit(id='',name='') { 
  if(name == '') name = 'unit';
  $('select[name="'+name+'"]').html('');
  $.ajax({
      type: "get",
      url:'../Api/unit',
      dataType: "json",
      success: function (res) {
          $('select[name="'+name+'"]').html('<option value="">-- Pilih --</option>');
          $.each( res.data, function( key, value ) {
              if (value.unit_id == id) {
                  $('select[name="'+name+'"]').append("<option selected value='"+value.unit_id+"'>"+value.unit_nam+"</option>");
              }else{
                  $('select[name="'+name+'"]').append("<option value='"+value.unit_id+"'>"+value.unit_nam+"</option>");
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
          "url": 'dt_users',
          "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          // "targets": [5],
          "orderable": false
        }]
      });
  }