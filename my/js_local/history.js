var nrp = $('#nrp').val();
$(document).ready(function(){
    get_jumlah($('#opt_history').val(), nrp)
})

$(document).on("change", "#opt_history", function () {
    let x = $(this).val();
    dt(x)
});

function get_jumlah(tbl,nrp) {
    let start_tgl = $('#start_tgl').val();
    let end_tgl = $('#end_tgl').val();
    $("#jumlah_input").html('');
    $.ajax({
        type: "POST",
        url: "History/get_jumlah_input",
        data: {tbl:tbl,nrp:nrp,s_date:start_tgl,e_date:end_tgl},
        dataType: 'json',
        success: function (r) {
          $("#jumlah_input").append(r.count);
        },
      });
  }

  function dt(tbl) {

    let start_tgl = $('#start_tgl').val();
    let end_tgl = $('#end_tgl').val();
    $.ajax({
        type: "POST",
        url: "History/get_table",
        data: {tbl:tbl,nrp:nrp,s_date:start_tgl,e_date:end_tgl},
        dataType: 'json',
        success: function (r) {
            let html = '';
            html += '<thead><tr>';
                r.key.forEach(e => {
                    html += "<th>"+e+"</th>";
                });
            html += '</tr></thead>';
                html += '<tbody>';
                r.data.forEach((e,i) => {
                    html += "<tr>";
                        r.key.forEach((field,no) => {
                            html += '<td>'+e[field]+'</td>';
                        });
                    html += "</tr>";
                });
                html += '<tbody>';
            html += '</tbody>';
            $('#jumlah_input').text(r.count);
            $('#tbl_history').html(html);
        },
      });

      setTimeout(() => {
          $('#tbl_history').DataTable()
      }, 5000);
  }