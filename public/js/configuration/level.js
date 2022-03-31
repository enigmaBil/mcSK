$(document).ready(function(){

});
function edit(id){
    $('#tr'+id).addClass('MarkLigne');

    $("#name"+id).attr('contenteditable',true);
    $("#description"+id).attr('contenteditable',true);


    toastada.info('vous pouvez modifier la ligne ');
    toastada.info("n'oubliez pas de valider");

}
function validate(id, msg){
    $('#tr'+id).removeClass('MarkLigne');

    $("#name"+id).attr('contenteditable',false);
    $("#description"+id).attr('contenteditable',false);
   
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'PUT',
            url: '/configuration/level_study/' + id,
            data: {
                name: $("#name"+id).text(),
                description: $("#description"+id).text(),
                
            },
            //dataType: 'json',
            success: function(data) {
             toastada.info(msg);

              //  $('#frmEditTask').trigger("reset");
        // window.location.reload();
            },
            error: function(data) {
                var errors = $.parseJSON(data.responseText);
                
                toastadaError();$.each(errors.messages, function(key, value) {
                    toastada.error(value+"");
                });
            }
        });
}
function back(id,name,description){
    $('#tr'+id).removeClass('MarkLigne');

    $("#name"+id).attr('contenteditable',false);
    $("#description"+id).attr('contenteditable',false);
   

$("#name"+id).text(name);
$("#description"+id).text(description);
validate(id, 'Mise à jour annulée');
}
function add(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        beforeSend: function() {
            $("#btn-add").attr('disabled', true);
        },
        complete:function(){
            $("#btn-add").attr('disabled', false);
        },
        type: 'POST',
        url: '/configuration/level_study',
        data: {
            name: $("#name").val(),
            description: $("#description").val()+"",
        },
        //dataType: 'json',
        success: function(datas) {
            toastadaSuccess();           //datae=JSON.parse(datas);
            data=datas["level_study"];
            var news = "<tr id=tr"+data.id+">  <td id='name"+data.id+"'  contenteditable='false'>";
            news +="";
            news+=data.name+"</td>";
            news+="<td id='description"+data.id+"' contenteditable='false'><div> "+data.description+"</div></td>";
            news+='<td><div class="form-group"><a  onclick="edit('+data.id+')"><i class="fa fa-fw fa-pencil"></i></a><a  onclick="validate('+data.id+')">';
            news+='<i class="icon fa fa-check"></i></a>';
            news+='  <a onclick="back('+data.id+','+data.name+'\','+data.description+')">';
            news+='<i class="icon fa fa-reply"></i></a>';
            news+=' <a onclick="destroy('+data.id+')"><i class="icon fa fa-reply"></i></a></div></td> </tr>';


            $("#tbody").prepend(news);
            $("#btn-add").attr('disabled', false);
            //**********ajout de la nouvelle valeur dans le tableau */

        },
        error: function(data) {
            var errors = $.parseJSON(data.responseText);
                
            toastadaError();$.each(errors.messages, function(key, value) {
                toastada.error(value+"");
            });
        }
    });
}

function destroy(id){
    $('#tr'+id).addClass('MarkLigne');

    if(confirm("Voulez vous vraiment supprimer cet élément")){
        $('#tr'+id).addClass('MarkLigne');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'delete',
            url: '/configuration/level_study/' + id,
            data: {
            },
            //dataType: 'json',
            success: function(data) {
             toastada.info(data.msg);
             $("#tr"+id).remove();
            },
            error: function(data) {
                var errors = $.parseJSON(data.responseText);
                
                toastadaError();$.each(errors.messages, function(key, value) {
                    toastada.error(value+"");
                });
            }
        });
    }
}