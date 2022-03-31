$(document).ready(function(){

});s
function edit(id){
    
    $('#tr'+id).addClass('MarkLigne');
    $("#name"+id).attr('contenteditable',true);
    $("#description"+id).attr('contenteditable',true);
    $("#code"+id).attr('contenteditable',true);
    $("#responsible"+id).attr('disabled',false);

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
    toastada.info('vous pouvez modifier la ligne ensuite validez ');

}
function validate(id,departmentId, msg){
    $('#tr'+id).removeClass('MarkLigne');
    departmtId=departmentId;
    $("#name"+id).attr('contenteditable',false);
    $("#description"+id).attr('contenteditable',false);
    $("#code"+id).attr('contenteditable',false);

    $("#responsible"+id).attr('disabled',true);
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
            url: '/configuration/discipline/' + id,
            data: {
                name: $("#name"+id).text(),
                description: $("#description"+id).text(),
                code: $("#code"+id).text(),
                department_id: departmentId,
                responsible:$("#responsible"+id).val(),
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
                
                toastadaError();$.each(errors.messages, function(key, value) {
                    toastada.error(value+"");
                });
            }
        });
}
function back(id,name,description, responsible, departmentId,status,code){
        $('#tr'+id).removeClass('MarkLigne');
    $("#name"+id).attr('contenteditable',false);
    $("#description"+id).attr('contenteditable',false);
    $("#code"+id).attr('contenteditable',false);

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
    $("#description"+id).text(description);
    $("#code"+id).text(code);

    $('#responsible'+id+' option[value="'+responsible+'"]').prop('selected', true);
    validate(id,departmentId , 'Mise à jour annulée');
}
function add2(){
    var x = $('#choix_department').val();
            var z = $('#departments');
            var val = $(z).find('option[value="' + x + '"]');
            var endval = val.attr('data-id');
    add(endval)
}
function add(departmentId){
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
        url: '/configuration/discipline',
        data: {
            name: $("#name").val(),
            description: $("#description").val()+" ",
            code: $("#code").val()+" ",
            department_id: departmentId,
            responsible:$('#responsible').val(),
            status:0, 
        },
        //dataType: 'json',
        success: function(data) {
            toastadaSuccess();            data=data["discipline"];
            var news = "<tr id='tr"+data.id+"'> <form id="+data.id+"> <td   contenteditable='false'>";
            news +="<a id='name"+data.id+"' href=\'/configuration/discipline/level/"+data.id+"\'>";
            news+= data.name+"</a> </td>";
            news+="<td id='code"+data.id+"' contenteditable='false'><div> "+data.code+"</div></td>";
            news+="<td id='description"+data.id+"' contenteditable='false'><div> "+data.description+"</div></td>";
            news+="<td id='cd"+data.id+"' contenteditable='false'></td>";
            news+="<td contenteditable='false'> <a  id='status"+data.id+"'><i class='icon fa fa-eye-slash'></i> </a></td>";
            news+='<td><div class="form-group"><a  onclick="edit('+data.id+')"><i class="fa fa-fw fa-pencil"></i></a><a  onclick="validate(\''+data.id+'\',\''+departmentId+'\', \'Mise à jour effectuée avec succès\')">';
            news+='<i class="icon fa fa-check"></i></a>';
            news+='  <a onclick="back(\''+data.id+'\',\''+data.name+'\',\''+data.description+'\',\''+departmentId+'\',\''+data.status+'\')">';
            news+='<i class="icon fa fa-reply"></i></a>';
            news+='  <a onclick="destroy('+data.id+')">';
            news+='<i class="fa fa-fw fa-trash"></i></a></div></td> </form></tr>';

            $("#tbody").prepend(news);
            $("#cd"+data.id).prepend($('#responsible').clone());
            $('#cd'+data.id+' select').attr("id", "responsible"+data.id);
            $('#responsible'+data.id+' option[value="'+data.responsible+'"]').prop('selected', true);
            $('#responsible'+data.id).attr('disabled', true);
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
            url: '/configuration/discipline/' + id,
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