function destroy(classe,id,parent){
    if(classe=="class"){
        route='classroom'
    }
    if(classe=="module"){
        route='module'
    }
    if(confirm("Voulez vous vraiment supprimer cet élément")){
        $('#tr'+id).addClass('MarkLigne');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'delete',
            url: '/configuration/'+route+'/'+id,
            data: {
            },
            //dataType: 'json',
            success: function(data) {
             toastada.info(data.msg);
             if(classe=="class" || classe=="module") {
                 $('#'+classe+""+id).remove();
             }
             else{
                $('#tr'+id).addClass('MarkLigne');

             $("#tr"+id).remove();
            }},
            error: function(data) {
                var errors = $.parseJSON(data.responseText);
                
                toastadaError();$.each(errors.messages, function(key, value) {
                    toastada.error(value+"");
                });
            }
        });
    }
    
}