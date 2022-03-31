$(document).ready(function(){

});
function edit(id){
    $("#name"+id).attr('contenteditable',true);
    $("#description"+id).attr('contenteditable',true);


    toastada.info('vous pouvez modifier la ligne ');
    toastada.info("n'oubliez pas de valider");

}
function validate(id, msg){
  
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
            dataType: 'json',
            success: function(data) {
             toastada.info(msg);

              //  $('#frmEditTask').trigger("reset");
        // window.location.reload();
            },
            error: function(data) {
                var errors = $.parseJSON(data.responseText);
                
                $.each(errors.messages, function(key, value) {
                    toastada.error(value+"");
                });
            }
        });
}
function back(id,name,description){
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
	    "_token": $('#token').val(),
        type: 'POST',
        url: '/configuration/level_study/',
        data: {
            name: $("#name").val(),
            description: $("#description").val()+"",
        },
        //dataType: 'json',
        success: function(datas) {
            toastada.success('enregistré!');
            window.location.reload();
           /* datae=JSON.parse(datas);
            data=datas["msg"];
            var news = "<tr> <form id="+data.id+"> <td id='name"+data.id+"'  contenteditable='false'>";
            news +="<a  href='{{ url('configuration/"+data.id+"discipline') }}'>";
            news+=data.name+"</a> </td>";
            news+="<td id='scolarity"+data.id+"' contenteditable='false'><div> "+data.scolarity+"</div></td>";
            news+="<td contenteditable='false'> <a  id='status"+data.id+"'><i class='icon fa fa-eye-slash'></i> </a></td>";
            news+='<td><div class="form-group"><a  onclick="edit('+data.id+')"><i class="fa fa-fw fa-pencil"></i></a><a  onclick="validate('+data.id+','+departmentId+')">';
            news+='<i class="icon fa fa-check"></i></a>';
            news+='  <a onclick="back('+data.id+',\''+data.name+'\','+data.description+','+data.status+')">';
            news+='<i class="icon fa fa-close"></i></a></div></td> </form></tr>';


            $("#tbody").prepend(news);*/
            //**********ajout de la nouvelle valeur dans le tableau */

        },
        error: function(data) {
            var errors = $.parseJSON(data.responseText);
                
            $.each(errors.messages, function(key, value) {
                toastada.error(value+"");
            });
        }
    });

}

function destroy(id){
    if(confirm("Voulez vous vraiment supprimer cet élément")){
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
            dataType: 'json',
            success: function(data) {
             toastada.info(data.msg);
             $("#tr"+id).remove();
            },
            error: function(data) {
                var errors = $.parseJSON(data.responseText);
                
                $.each(errors.messages, function(key, value) {
                    toastada.error(value+"");
                });
            }
        });
    }
}