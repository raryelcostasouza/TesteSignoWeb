
//listener para adicionar uma linha de opcao
$("#btnAddOption").click(function (event)
{
   var rowCount = $("#tbopcoes tr").length;
    
    var tr = '<tr><div class="form-group">'+
    '<td>'+rowCount+'</div></td>'+
    '<td><input type="text" name="opcao_resposta[]"></td>'+
    '<td><a id="hey" href="#" class="btn btn-danger remove btnRemove"><i class="fas fa-times"></i>Remover</a></td>'+
    '</div></tr>';
   
    $('tbody').append(tr);
  });
 
  //remove a linha e reindexa a primeira coluna
  $("tbody").on("click", "a.btn-danger", function(event)
  {
      //obtem a linha da tabela onde o botao foi clicado
     var tr = event.currentTarget.closest('tr');
     tr.remove();
     
     //reindexa a primeira coluna
     var i = 0;
     $("#tbopcoes tr").each(function()
     {
        $(this).find("td:eq(0)").text(i);
        i++;
     });
  });