var nrp = $('#nrp').val();
var today = new Date();
var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
function GetURLParameter(sParam) {
	var sPageURL = window.location.search.substring(1);
	var sURLVariables = sPageURL.split("&");
	for (var i = 0; i < sURLVariables.length; i++) {
		var sParameterName = sURLVariables[i].split("=");
		if (sParameterName[0] == sParam) {
			return sParameterName[1];
		}
	}
}
let tbl = GetURLParameter("tbl");
let tbln = GetURLParameter("tbln");
var urlParameter = {
	table: tbl,
	tablen: tbln,
};

$(document).ready(function(){
    $('#htitle').text(urlParameter['tablen'].replace(/%20/g, " "))
    $('#start_tgl').val(date)
    $('#end_tgl').val(date)
    dt(urlParameter['table'])
})

$('#form-filter').submit(function (e) { 
    dt(urlParameter['table']);
});

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
        url: "get_jumlah_input",
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
        url: "get_table",
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

    //   setTimeout(() => {
    //       $('#tbl_history').DataTable()
    //   }, 1000);
  }