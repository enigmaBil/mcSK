$(document).ready(function(){

});
function edit(id, msg){
    $('#tr'+id).addClass('MarkLigne');
    $("#name"+id).attr('contenteditable',true);
    $("#start_date"+id).attr('contenteditable',true);
    $("#end_date"+id).attr('contenteditable',true);
    $("#deadline"+id).attr('contenteditable',true);
    $("#status"+id).click(function(){
        coche=$("#status"+id).find(':first');;
    if ( coche.hasClass('fa-eye') ){
        coche.removeClass('fa-eye');
        coche.addClass('fa-eye-slash');
    }   
    else{
        coche.removeClass('fa-eye-slash');
        coche.addClass('fa-eye');

    }

    });
    toastada.info('vous pouvez modifier la ligne ');
    toastada.info("n'oubliez pas de valider");

}
function validate(id, msg){
    $('#tr'+id).removeClass('MarkLigne');

    $("#name"+id).attr('contenteditable',false);
    $("#start_date"+id).attr('contenteditable',false);
    $("#end_date"+id).attr('contenteditable',false);
    $("#deadline"+id).attr('contenteditable',false);
    $("#status"+id).unbind('click');

    statuse=0;
        coche=$("#status"+id).find(':first');;
    if ( coche.hasClass('fa-eye') ){
       statuse=1;
    }   
    else{
       statuse=0;

    }
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'PUT',
            url: '/scolarity/academic_year/' + id,
            data: {
                name: $("#name"+id).text(),
                start_date: $("#start_date"+id).text(),
                end_date: $("#end_date"+id).text(),
                deadline: $("#deadline"+id).text(),
                status: statuse,
            },
            //dataType: 'json',
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
function back(id,name,start_date, end_date, deadline, status){
    $('#tr'+id).removeClass('MarkLigne');

    statuse=0;
    coche=$("#status"+id).find(':first');;
    if ( coche.hasClass('fa-eye') ){
    statuse=1;
    }   
    else{
    statuse=0;

    }
    if(statuse!=status){
        console.log(statuse);

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
    $("#start_date"+id).text(start_date);
    $("#end_date"+id).text(end_date);
    $("#deadline"+id).text(deadline);
    msg='Mise à jour annulée'
    validate(id, msg);
}
function add(){
    console.log($("#name").val()+"addin"+$("#scolarity").val());
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
        url: '/scolarity/academic_year',
        data: {
            name: $("#name").val(),
            start_date: $("#start_date").val(),
            end_date: $("#end_date").val(),
            deadline: $("#deadline").val(),
            status: 0,
        },
        //dataType: 'json',
        success: function(data) {
            toastadaSuccess();            data=data["academic_year"];
            var news = "<tr id='tr"+data.id+"'> <form id="+data.id+"> <td  contenteditable='false'>";
            news +="<a id='name"+data.id+"' href='/scolarity/academic_year/session/"+data.id+"') }}') }}'>";
            news+=data.name+"</a> </td>";
            news+="<td id='start_date"+data.id+"' contenteditable='false'><div> "+data.start_date+"</div></td>";
            news+="<td id='end_date"+data.id+"' contenteditable='false'><div> "+data.end_date+"</div></td>";
            news+="<td id='deadline"+data.id+"' contenteditable='false'><div> "+data.deadline+"</div></td>";
            news+="<td contenteditable='false'> <a  id='status"+data.id+"'><i class='icon fa fa-eye-slash'></i> </a></td>";
            news+='<td><div class="form-group"><a  onclick="edit('+data.id+')"><i class="fa fa-fw fa-pencil"></i></a><a  onclick="validate('+data.id+', \'Mise à jour effectuée avec succès\' )">';
            news+='<i class="icon fa fa-check"></i></a>';
            news+='  <a onclick="back('+data.id+',\''+data.name+'\','+data.start_date+',\''+data.end_date+'\',\''+data.deadline+'\',\''+data.status+'\')">';
            news+='<i class="icon fa fa-close"></i></a>';
            news+='  <a onclick="destroy('+data.id+')">';
            news+='<i class="fa fa-fw fa-trash"></i></a></div></td> </form></tr>';


            $("#tbody").prepend(news);
            $("#btn-add").attr('disabled', false);
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
    if(confirm("Voulez vous vraiment supprimer cet élément")){
        $('#tr'+id).addClass('MarkLigne');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'delete',
            url: '/scolarity/academic_year/' + id,
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