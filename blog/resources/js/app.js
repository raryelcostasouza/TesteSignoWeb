import './bootstrap';

$("#btnAddOption").click(function addRow()
{
    console.log("HELLO");
    var rowCount = $("#tbopcoes").length;
    
    var tr = '<div class="form-group"><tr>'+
    '<td>'+(rowCount+1)+'</td>'+
    '<td><input type="text" name="opcao_resposta[]"></td>'+
    //'<td><a class="btn btn-danger remove"><i class="fas fa-times"></i></a></td>'+
    '</tr></div>';
    $('tbody').append(tr);
  });
