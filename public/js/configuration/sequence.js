$(document).ready(function(){

});s
function edit(id){
    
    $('#tr'+id).addClass('MarkLigne');
    $("#name"+id).attr('contenteditable',true);
    $("#end_date"+id).attr('contenteditable',true);
    $("#start_date"+id).attr('contenteditable',true);
    $("#session_id"+id).attr('disabled',false);


   
    toastada.info('vous pouvez modifier la ligne ensuite validez ');

}
function validate(id,sessionId, msg){
    $('#tr'+id).removeClass('MarkLigne');
    sessionId=sessionId;
    $("#name"+id).attr('contenteditable',false);
    $("#end_date"+id).attr('contenteditable',false);
    $("#start_date"+id).attr('contenteditable',false);

    $("#session_id"+id).attr('disabled',true);
  
    
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'PUT',
            url: '/configuration/sequence/' + id,
            data: {
                name: $("#name"+id).text(),
                end_date: $("#end_date"+id).text(),
                start_date: $("#start_date"+id).text(),
                session_id:$("#session_id"+id).val(),
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
function back(id,name, start_date,end_date, session_id){
        $('#tr'+id).removeClass('MarkLigne');
    $("#name"+id).attr('contenteditable',false);
    $("#end_date"+id).attr('contenteditable',false);
    $("#start_date"+id).attr('contenteditable',false);

    statuse=0;
    coche=$("#status"+id).find(':first');;
    if ( coche.hasClass('fa-eye') ){
    statuse=1;
    }   
    else{
    statuse=0;

    }   
    if(statuse!=status){

        if ( coche.hasClass('fa-eye') ){
            coche=$("#status"+id).find(':first');;
            coche.removeClass('fa-eye');
            coche.addClass('fa-eye-slash');
        }   
        else{
            coche.removeClass('fa-eye-slash');
            coche.addClass('fa-eye');

        }
    }
    $("#name"+id).text(name);
    $("#end_date"+id).text(end_date);
    $("#start_date"+id).text(start_date);

    $('#session_id'+id+' option[value="'+session_id+'"]').prop('selected', true);
    validate(id,sessionId , 'Mise à jour annulée');
}
function add2(){
            var z = $('#session_id').val();
            add(z);
}
function add(sessionId){
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
        url: '/configuration/sequence',
        data: {
            name: $("#name").val(),
           start_date: $("#start_date").val()+" ",
            end_date: $("#end_date").val()+" ",
            session_id: sessionId,
        },
        //dataType: 'json',
        success: function(data) {
            toastadaSuccess();            data=data["sequence"];
            var news = "<tr id='tr"+data.id+"'> <form id="+data.id+"> <td id='name"+data.id+"'   contenteditable='false'>";
            news +="";
            news+= data.name+"</td>";
            news+="<td id='start_date"+data.id+"' contenteditable='false'><div> "+data.start_date+"</div></td>";
            news+="<td id='end_date"+data.id+"' contenteditable='false'><div> "+data.end_date+"</div></td>";
            news+="<td id='cd"+data.id+"' contenteditable='false'></td>";
            news+="<td><a id ='status"+data.id+"'";
            news+="onclick='createrattrapage("+data.id+")'><i class='icon fa fa-close'></i></a></td>";


            news+='<td><div class="form-group"><a  onclick="edit('+data.id+')"><i class="fa fa-fw fa-pencil"></i></a><a  onclick="validate(\''+data.id+'\',\''+sessionId+'\', \'Mise à jour effectuée avec succès\')">';
            news+='<i class="icon fa fa-check"></i></a>';
            news+='  <a onclick="back(\''+data.id+'\',\''+data.name+'\',\''+data.start_date+'\',\''+data.end_date+'\',\''+sessionId+'\')">';
            news+='<i class="icon fa fa-reply"></i></a>';
            news+='  <a onclick="destroy('+data.id+')">';
            news+='<i class="fa fa-fw fa-trash"></i></a></div></td> </form></tr>';

            $("#tbody").prepend(news);
            $("#cd"+data.id).prepend($('#session_id').clone());
            $('#cd'+data.id+' select').attr("id", "session_id"+data.id);
            $('#session_id'+data.id+' option[value="'+data.session_id+'"]').prop('selected', true);
            $('#session_id'+data.id).attr('disabled', true);
            $("#btn-add").attr('disabled', false);
            //**********ajout de la nouvelle valeur dans le tableau */

        },
        error: function(data) {
            var errors = JSON.parse(data.responseText);
              // toastada.error(data.responseText) ;
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
            url: '/configuration/sequence/' + id,
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
function createrattrapage($id){
    if(confirm("Action irréversible: êtes vous certains de vouloir créer une session de rattrapage pour cette séquence")){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/configuration/sequence/rattrapage',
            data: {
                sequence_id:$id,

            },
            dataType: 'json',
            success: function(data) {
                toastadaSuccess();                coche=$("#status"+$id).find(':first');;
                coche.removeClass('fa fa-close');
                coche.addClass('glyphicon glyphicon-ok');
                              
   
            },
            error: function(data) {
               
            }
        });
    }
}