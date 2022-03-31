$(document).ready(function(){

});
function edit(id){
    $('#tr'+id).addClass('MarkLigne');
    $("#name"+id).attr('contenteditable',true);
    $("#scolarity"+id).attr('contenteditable',true);
    $("#head_of_department"+id).attr('disabled',false);
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
    $("#head_of_department"+id).attr('disabled',true);
    $("#name"+id).attr('contenteditable',false);
    $("#scolarity"+id).attr('contenteditable',false);
    $("#status"+id).unbind('click');

    statuse=0;
        coche=$("#status"+id).find(':first');
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
            url: '/configuration/department/' + id,
            data: {
                name: $("#name"+id).text(),
                scolarity: $("#scolarity"+id).text(),
                head_of_department: $("#head_of_department"+id).val(),
                status: statuse,
            },
            success: function(data) {
             toastada.info(msg);
            },
            error: function(data) {
                var errors = $.parseJSON(data.responseText);
                
                toastadaError();$.each(errors.messages, function(key, value) {
                    toastada.error(value+"");
                });
            }
        });
}
function back(id,name,scolarity, head_of_department, status){
    $('#tr'+id).removeClass('MarkLigne');
    $("#name"+id).attr('contenteditable',false);
    $("#scolarity"+id).attr('contenteditable',false);
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
    $("#scolarity"+id).text(scolarity);
    $('#head_of_department'+id+' option[value="'+head_of_department+'"]').prop('selected', true);
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
        url: '/configuration/department',
        data: {
            name: $("#name").val(),
            scolarity: $("#scolarity").val(),
            head_of_department: $("#head_of_department").val(),
            status:0,
        },
        //dataType: 'json',
        success: function(data) {
            toastadaSuccess();            data=data["department"];
            var news = "<tr id='tr"+data.id+"'> <form id="+data.id+"> <td  contenteditable='false'>";
            news +="<a id='name"+data.id+"' href='/configuration/department/discipline/"+data.id+"') }}'>";
            news+=data.name+"</a> </td>";
            news+="<td><a title='listes des disciplines'> </span> Disciplines</span><span class=\"pull-right-container\"><i class=\"fa fa-angle-left pull-right\"></i></span></a> </td>";
            news+="<td id='scolarity"+data.id+"' contenteditable='false'><div> "+data.scolarity+"</div></td>";
            news+="<td id='cd"+data.id+"' contenteditable='false'></td>";
            news+="<td contenteditable='false'> <a  id='status"+data.id+"'><i class='icon fa fa-eye-slash'></i> </a></td>";
            news+='<td><div class="form-group"><a  onclick="edit('+data.id+')"><i class="fa fa-fw fa-pencil"></i></a><a  onclick="validate('+data.id+', \'Mise à jour effectuée avec succès\' )">';
            news+='<i class="icon fa fa-check"></i></a>';
            news+='  <a onclick="back('+data.id+',\''+data.name+'\','+data.scolarity+','+data.head_of_department+','+data.status+')">';
            news+='<i class="icon fa fa-reply"></i></a>';
            news+='  <a onclick="destroy('+data.id+')">';
            news+='<i class="fa fa-fw fa-trash"></i></a></div></td> </form></tr>';

            $("#tbody").prepend(news);
            $("#cd"+data.id).prepend($('#head_of_department').clone());
            $('#cd'+data.id+' select').attr("id", "head_of_department"+data.id);
            $('#head_of_department'+data.id+' option[value="'+data.head_of_department+'"]').prop('selected', true);
            $('#head_of_department'+data.id).attr('disabled', true);
            $("#btn-add").attr('disabled', false);
            //**********ajout de la nouvelle valeur dans le tableau */
            //window.location.reload()
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
            url: '/configuration/department/' + id,
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