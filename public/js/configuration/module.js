function addModule(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            beforeSend: function() {
                $("#btn-addModule").attr('disabled', true);
            },
            complete:function(){
                $("#btn-addModule").attr('disabled', false);
            },
            type: 'POST',
            url: '/configuration/moduleSave/saving',
            data: {
                name: $("#name").val(),
                description: $("#description").val(),
                discipline_id:$("#discipline").val(),
                level_id: $("#level").val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(datas) {
                toastadaSuccess();
                window.location.reload();
                $("#btn-addModule").attr('disabled', false);
            },
            error: function(data) {

                 var errors = $.parseJSON(data.responseText);
                toastada.error(errors.message);
/*
                  $.each(errors.messages, function(key, value) {
                      toastada.error(value+"");
                  });*/
            }
        });
}

function edit(id){
    $('#tr'+id).addClass('MarkLigne');

    disciplineLevel(id);
    $("#name"+id).attr('contenteditable',true);
    $("#description"+id).attr('contenteditable',true);
    $("#discipline"+id).attr('disabled',false);
    $("#level"+id).attr('disabled',false);

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
    toastada.info("vous pouvez modifier la ligne /n n'oubliez pas de valider") ;

}

function validate(id, msg){
    $('#tr'+id).removeClass('MarkLigne');

    $("#name"+id).attr('contenteditable',false);
    $("#description"+id).attr('contenteditable',false);
    $("#discipline"+id).attr('disabled',true);
    $("#level"+id).attr('disabled',true);
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
            url: '/configuration/updateModule/'+ id,
            data: {
                name: $("#name"+id).text(),
                description: $("#description"+id).text(),
                status: statuse,
                discipline_id: $("#discipline"+id).val(),
                level_id: $("#level"+id).val(),
            },
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
            url: '/configuration/module/' + id,
            data: {
            },
            //dataType: 'json',
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

function back(id,name,description, discipline, level, status){
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
    $("#description"+id).text(description);
    $('#discipline'+id+' option[value="'+discipline+'"]').prop('selected', true);
    $('#level'+id+' option[value="'+level+'"]').prop('selected', true);
    validate(id, 'Mise à jour annulée');
}