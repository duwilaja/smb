var today = new Date();
var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
$(document).ready(function(){
    $('#start_tgl').val(date)
    $('#end_tgl').val(date)
    dt()
})

$('#form-filter').submit(function (e) { 
    dt();
});

$(document).on("change", "#end_tgl", function () {
    let x = $(this).val();
    if (x <= $('#start_tgl').val()) {
        alert('End Date tidak boleh kurang dari Start Date')
        $(this).val('mm/dd/yyyy')
    }
});

function dt() {
    $('#tbl_history').DataTable({
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
            "url": 'History/dt_history',
            "type": "POST",
            "data" : {
                'nrp' : $('#nrp').val(),
                'unit' : $('#unit').val(),
                's_date' : $('#start_tgl').val(),
                'e_date' : $('#end_tgl').val(),
            }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0,1,3,4],
            "orderable": false
        }]
    });
  }